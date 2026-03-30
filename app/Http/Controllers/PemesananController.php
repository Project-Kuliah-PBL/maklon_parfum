<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajuan;
use App\Models\HargaParfum;
use App\Models\Aroma;
use App\Models\Kemasan;
use App\Models\Pembayaran;

class PemesananController extends Controller
{
    // ──────────────────────────────────────────────────────────
    //  STEP 1 — Form Pengajuan
    // ──────────────────────────────────────────────────────────

    public function pengajuan()
    {
        $hargaParfums = HargaParfum::orderBy('harga_per_ml')->get();
        return view('user.pemesanan.pengajuan_maklon', compact('hargaParfums'));
    }

    /** POST Step 1 — simpan ke session, lanjut ke pilih aroma */
    public function store(Request $request)
    {
        $request->validate([
            'harga_parfum_id' => 'required|exists:harga_parfums,id',
            'jumlah'          => 'required|integer|min:50',
            'target_market'   => 'required|string|max:100',
            'catatan'         => 'nullable|string|max:1000',
        ], [
            'harga_parfum_id.required' => 'Pilih jenis parfum.',
            'harga_parfum_id.exists'   => 'Jenis parfum tidak valid.',
            'jumlah.required'          => 'Jumlah produksi wajib diisi.',
            'jumlah.min'               => 'Minimum order 50 unit.',
            'target_market.required'   => 'Target market wajib dipilih.',
        ]);

        session(['pengajuan' => [
            'harga_parfum_id' => $request->harga_parfum_id,
            'jumlah'          => $request->jumlah,
            'target_market'   => $request->target_market,
            'catatan'         => $request->catatan,
        ]]);

        return redirect()->route('pemesanan.pilih-aroma');
    }

    // ──────────────────────────────────────────────────────────
    //  STEP 2 — Pilih Aroma & Kemasan
    // ──────────────────────────────────────────────────────────

    public function pilihAroma()
    {
        if (!session('pengajuan')) {
            return redirect()->route('pemesanan.pengajuan')
                ->with('error', 'Lengkapi form pengajuan terlebih dahulu.');
        }

        $aromas   = Aroma::orderBy('nama_kategori')->get();
        $kemasans = Kemasan::orderBy('jenis_botol')->get();

        return view('user.pemesanan.piliharoma', compact('aromas', 'kemasans'));
    }

    /** POST Step 2 — simpan pilihan aroma+kemasan ke session */
    public function simpanAroma(Request $request)
    {
        $request->validate([
            'aroma_id'   => 'required|exists:aromas,id',
            'kemasan_id' => 'required|exists:kemasans,id',
        ], [
            'aroma_id.required'   => 'Pilih kategori aroma.',
            'kemasan_id.required' => 'Pilih jenis kemasan.',
        ]);

        session()->put('pengajuan.aroma_id',   $request->aroma_id);
        session()->put('pengajuan.kemasan_id', $request->kemasan_id);

        return redirect()->route('pemesanan.checkout');
    }

    // ──────────────────────────────────────────────────────────
    //  STEP 3 — Checkout
    // ──────────────────────────────────────────────────────────

    public function checkout()
    {
        $data = session('pengajuan');

        if (!$data || empty($data['aroma_id'])) {
            return redirect()->route('pemesanan.pilih-aroma')
                ->with('error', 'Pilih aroma dan kemasan terlebih dahulu.');
        }

        $hargaParfum  = HargaParfum::findOrFail($data['harga_parfum_id']);
        $aroma        = Aroma::findOrFail($data['aroma_id']);
        $kemasan      = Kemasan::findOrFail($data['kemasan_id']);
        $jumlah       = (int) $data['jumlah'];

        $biayaParfum  = $hargaParfum->harga_per_ml * $jumlah;
        $biayaAroma   = $aroma->biaya_kategori;
        $biayaKemasan = $kemasan->biaya_kemasan;
        $totalHarga   = $biayaParfum + $biayaAroma + $biayaKemasan;

        return view('user.pemesanan.checkout', compact(
            'hargaParfum', 'aroma', 'kemasan', 'jumlah',
            'biayaParfum', 'biayaAroma', 'biayaKemasan', 'totalHarga', 'data'
        ));
    }

    /** POST Step 3 — simpan ke DB */
    public function processCheckout(Request $request)
    {
        $request->validate([
            'metode_pembayaran' => 'required|in:Transfer BCA,Transfer Mandiri,QRIS',
            'setuju'            => 'accepted',
        ], [
            'setuju.accepted'            => 'Anda harus menyetujui syarat & ketentuan.',
            'metode_pembayaran.required' => 'Pilih metode pembayaran.',
        ]);

        $data = session('pengajuan');
        if (!$data) {
            return redirect()->route('pemesanan.pengajuan')
                ->with('error', 'Sesi habis, ulangi dari awal.');
        }

        $hargaParfum  = HargaParfum::findOrFail($data['harga_parfum_id']);
        $aroma        = Aroma::findOrFail($data['aroma_id']);
        $kemasan      = Kemasan::findOrFail($data['kemasan_id']);
        $jumlah       = (int) $data['jumlah'];
        $totalHarga   = ($hargaParfum->harga_per_ml * $jumlah)
                        + $aroma->biaya_kategori
                        + $kemasan->biaya_kemasan;

        // Simpan pengajuan
        $pengajuan = Pengajuan::create([
            'user_id'         => Auth::id(),
            'harga_parfum_id' => $hargaParfum->id,
            'jenis_parfum'    => $hargaParfum->jenis_parfum,
            'jumlah'          => $jumlah,
            'target_market'   => $data['target_market'],
            'catatan'         => $data['catatan'] ?? null,
            'total_harga'     => $totalHarga,
            'status'          => 'pending',
        ]);

        // Attach relasi pivot
        $pengajuan->aromas()->attach($aroma->id, ['note_id' => 1]);
        $pengajuan->kemasans()->attach($kemasan->id, [
            'aroma_id'   => $aroma->id,
            'logo_label' => 'Default Logo',
        ]);

        // Buat record pembayaran
        Pembayaran::create([
            'pengajuan_id'       => $pengajuan->id,
            'metode_pembayaran'  => $request->metode_pembayaran,
            'total'              => $totalHarga,
            'tanggal_pembayaran' => now(),
            'status_bayar'       => 'unpaid',
        ]);

        session()->forget('pengajuan');

        return redirect()->route('tracking.index')
            ->with('success', 'Pengajuan ' . 'MKL-' . str_pad($pengajuan->id, 5, '0', STR_PAD_LEFT) . ' berhasil dikirim! Tim kami akan segera menghubungi Anda.');
    }
}
