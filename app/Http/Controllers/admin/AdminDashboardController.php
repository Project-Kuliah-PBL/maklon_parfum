<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aroma;
use App\Models\Kemasan;
use App\Models\Pengajuan;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Traking;

class AdminDashboardController extends Controller
{
    /**
     * Menyediakan data navigasi untuk semua halaman admin.
     */
    private function getNavItems()
    {
        return [
            ['icon' => 'layout-dashboard', 'label' => 'Dashboard',          'route' => 'admin.dashboard'],
            ['icon' => 'file-text',        'label' => 'Pengajuan',           'route' => 'admin.pengajuan'],
            ['icon' => 'flask-conical',    'label' => 'Produksi',            'route' => 'admin.produksi'],
            ['icon' => 'package',          'label' => 'Komponen Produksi',   'route' => 'admin.komponen.produksi'],
            ['icon' => 'archive',          'label' => 'Riwayat Pesanan',     'route' => 'admin.riwayat.pesanan'],
        ];
    }

    /* ---------------------------------------------------------------
     | DASHBOARD
     * ------------------------------------------------------------- */

    public function index()
    {
        $navItems = $this->getNavItems();

        $totalPengajuan = Pengajuan::count();
        $pending        = Pengajuan::where('status', 'pending')->count();
        $proses         = Pengajuan::where('status', 'proses')->count();
        $selesai        = Pengajuan::where('status', 'selesai')->count();

        $stats = [
            ['label' => 'Total Pengajuan', 'value' => $totalPengajuan, 'trend' => 'Semua data',  'type' => 'neutral',  'icon' => 'file-text',    'bg' => 'bg-blue-100',    'color' => 'text-blue-600'],
            ['label' => 'Pending',         'value' => $pending,        'trend' => 'Menunggu',    'type' => 'neutral',  'icon' => 'clock',         'bg' => 'bg-orange-100',  'color' => 'text-orange-600'],
            ['label' => 'Diproses',        'value' => $proses,         'trend' => 'Produksi',    'type' => 'positive', 'icon' => 'flask-conical', 'bg' => 'bg-purple-100',  'color' => 'text-purple-600'],
            ['label' => 'Selesai',         'value' => $selesai,        'trend' => 'Completed',   'type' => 'positive', 'icon' => 'check-circle',  'bg' => 'bg-emerald-100', 'color' => 'text-emerald-600'],
        ];

        $activities = Pengajuan::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('navItems', 'stats', 'activities'));
    }

    /* ---------------------------------------------------------------
     | PENGAJUAN — list
     * ------------------------------------------------------------- */

    public function pengajuan(Request $request)
    {
        $navItems = $this->getNavItems();

        $query = Pengajuan::with('user')->where('status', 'pending')->latest();

        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->whereHas('user', fn($q) => $q->where('name', 'like', "%$keyword%"));
        }

        $submissions = $query->get();

        $priorities = Pengajuan::where('status', 'pending')
            ->orderBy('jumlah', 'desc')
            ->take(5)
            ->get();

        return view('admin.pengajuan', compact('navItems', 'submissions', 'priorities'));
    }

    /* ---------------------------------------------------------------
     | PENGAJUAN — Setujui
     * ------------------------------------------------------------- */

    public function setujuPengajuan(Request $request, $id)
    {
        $request->validate([
            'estimasi_selesai' => 'required|date|after:today',
            'total_harga'      => 'required|numeric|min:0',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);

        if ($pengajuan->status !== 'pending') {
            return back()->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        $pengajuan->update([
            'status'           => 'proses',
            'estimasi_selesai' => $request->estimasi_selesai,
            'total_harga'      => $request->total_harga,
        ]);

        // Buat tracking awal
        $tahapAwal = ['Persiapan Bahan', 'Mixing', 'Filling', 'Packaging', 'QC'];
        foreach ($tahapAwal as $tahap) {
            Traking::create([
                'pengajuan_id' => $pengajuan->id,
                'tahapan'      => $tahap,
                'status'       => 'progress',
                'tanggal'      => now(),
                'catatan'      => '',
            ]);
        }

        return back()->with('success', "Pengajuan #" . str_pad($id, 5, '0', STR_PAD_LEFT) . " berhasil disetujui dan masuk ke antrian produksi.");
    }

    /* ---------------------------------------------------------------
     | PENGAJUAN — Tolak
     * ------------------------------------------------------------- */

    public function tolakPengajuan(Request $request, $id)
    {
        $request->validate([
            'alasan_tolak' => 'required|string|min:10|max:500',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);

        if ($pengajuan->status !== 'pending') {
            return back()->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        $pengajuan->update([
            'status'  => 'ditolak',
            'catatan' => $pengajuan->catatan . "\n[DITOLAK] " . $request->alasan_tolak,
        ]);

        return back()->with('deleted', "Pengajuan #" . str_pad($id, 5, '0', STR_PAD_LEFT) . " ditolak.");
    }

    /* ---------------------------------------------------------------
     | PRODUKSI — list
     * ------------------------------------------------------------- */

    public function produksi(Request $request)
    {
        $navItems = $this->getNavItems();

        $query = Pengajuan::with(['user', 'tracking'])
            ->where('status', 'proses');

        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->whereHas('user', fn($q) => $q->where('name', 'like', "%$keyword%"))
                  ->orWhere('jenis_parfum', 'like', "%$keyword%");
        }

        $batches = $query->get()->map(function ($p) {
            // Hitung progress dari tracking
            $tracking    = $p->tracking;
            $totalTahap  = $tracking->count();
            $doneTahap   = $tracking->where('status', 'done')->count();
            $progress    = $totalTahap > 0 ? round(($doneTahap / $totalTahap) * 100) : 0;

            // Tahap saat ini (yang sedang progress)
            $currentTahap = $tracking->where('status', 'progress')->first();

            return [
                'id'          => 'MKL-' . str_pad($p->id, 5, '0', STR_PAD_LEFT),
                'pengajuan_id'=> $p->id,
                'client'      => $p->user->name,
                'product'     => $p->jenis_parfum,
                'jumlah'      => $p->jumlah,
                'progress'    => $progress,
                'status'      => $currentTahap ? $currentTahap->tahapan : ($progress >= 100 ? 'Selesai QC' : 'Persiapan'),
                'eta'         => $p->estimasi_selesai ? \Carbon\Carbon::parse($p->estimasi_selesai)->format('d M Y') : '-',
                'stage_color' => 'bg-blue-100 text-blue-600',
                'tracking'    => $tracking,
            ];
        });

        return view('admin.produksi', compact('navItems', 'batches'));
    }

    /* ---------------------------------------------------------------
     | PRODUKSI — Update status/progress
     * ------------------------------------------------------------- */

    public function updateProduksi(Request $request, $id)
    {
        $request->validate([
            'tahapan'        => 'required|string',
            'progress'       => 'required|integer|min:0|max:100',
            'estimasi_selesai'=> 'nullable|date',
            'catatan'        => 'nullable|string|max:500',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);

        // Update estimasi jika diisi
        if ($request->filled('estimasi_selesai')) {
            $pengajuan->update(['estimasi_selesai' => $request->estimasi_selesai]);
        }

        // Update status tracking: tandai tahap aktif → done, buat/update tahap baru
        $tracking = $pengajuan->tracking()->where('tahapan', $request->tahapan)->first();
        if ($tracking) {
            $tracking->update([
                'status'  => $request->progress >= 100 ? 'done' : 'progress',
                'catatan' => $request->catatan,
                'tanggal' => now(),
            ]);
        }

        // Jika progress 100 dan semua tahap selesai, tandai pengajuan selesai
        if ($request->progress >= 100) {
            $allDone = $pengajuan->tracking()->where('status', '!=', 'done')->doesntExist();
            if ($allDone) {
                $pengajuan->update(['status' => 'selesai']);
            }
        }

        return back()->with('success', "Progress produksi " . 'MKL-' . str_pad($id, 5, '0', STR_PAD_LEFT) . " berhasil diperbarui.");
    }

    /* ---------------------------------------------------------------
     | KOMPONEN PRODUKSI
     * ------------------------------------------------------------- */

    public function komponenproduksi()
    {
        $navItems       = $this->getNavItems();
        $aromaCategories = Aroma::all();
        $packagingItems  = Kemasan::all();

        return view('admin.komponenproduksi', compact(
            'navItems',
            'aromaCategories',
            'packagingItems'
        ));
    }
}
