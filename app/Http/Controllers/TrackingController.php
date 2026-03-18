<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajuan;

class TrackingController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $proyekAktif = Pengajuan::where('user_id', $user->id)
                        ->whereIn('status', ['pending', 'proses'])
                        ->count();

        // Hitung rata-rata progress
        $semuaAktif = Pengajuan::with('tracking')
                        ->where('user_id', $user->id)
                        ->whereIn('status', ['pending', 'proses'])
                        ->get();

        $rataProgress = 0;
        if ($semuaAktif->count() > 0) {
            $sum = $semuaAktif->sum(function ($p) {
                $t = $p->tracking;
                return $t->count() > 0
                    ? round(($t->where('status', 'done')->count() / $t->count()) * 100)
                    : 0;
            });
            $rataProgress = round($sum / $semuaAktif->count());
        }

        // Semua proyek user (aktif + selesai + ditolak)
        $daftarProyek = Pengajuan::with('tracking')
            ->where('user_id', $user->id)
            ->latest()
            ->get()
            ->map(function ($p) {
                $tracking   = $p->tracking;
                $total      = $tracking->count();
                $done       = $tracking->where('status', 'done')->count();
                $progress   = $total > 0 ? round(($done / $total) * 100) : 0;
                $tahapAktif = $tracking->firstWhere('status', 'progress');

                return (object) [
                    'id'               => $p->id,
                    'kode'             => 'MKL-' . str_pad($p->id, 5, '0', STR_PAD_LEFT),
                    'jenis_parfum'     => $p->jenis_parfum,
                    'target_pasar'     => $p->target_market ?? '-',
                    'jumlah_produksi'  => $p->jumlah,
                    'tanggal_pengajuan'=> $p->created_at,
                    'estimasi_selesai' => $p->estimasi_selesai,
                    'progress'         => $progress,
                    'tahap_saat_ini'   => $tahapAktif?->tahapan ?? 'Menunggu',
                    'status'           => match ($p->status) {
                        'proses'  => 'Dalam Produksi',
                        'pending' => 'Menunggu Approval',
                        'selesai' => 'Selesai',
                        'ditolak' => 'Ditolak',
                        default   => ucfirst($p->status),
                    },
                ];
            });

        return view('user.tracking.tracking_user', compact(
            'proyekAktif', 'rataProgress', 'daftarProyek'
        ));
    }

    public function detail($id)
    {
        $user = Auth::user();

        $pengajuan = Pengajuan::with('tracking')
                        ->where('user_id', $user->id)
                        ->findOrFail($id);

        $tracking     = $pengajuan->tracking;
        $totalTahap   = $tracking->count();
        $tahapSelesai = $tracking->where('status', 'done')->count();
        $progress     = $totalTahap > 0 ? round(($tahapSelesai / $totalTahap) * 100) : 0;

        $proyek = (object) [
            'id'              => $pengajuan->id,
            'kode'            => 'MKL-' . str_pad($pengajuan->id, 5, '0', STR_PAD_LEFT),
            'jenis_parfum'    => $pengajuan->jenis_parfum,
            'jumlah_produksi' => $pengajuan->jumlah,
            'estimasi_selesai'=> $pengajuan->estimasi_selesai,
        ];

        // Urutan tahapan standar
        $urutan = ['Persiapan Bahan', 'Mixing', 'Filling', 'Packaging', 'QC'];

        if ($tracking->count() > 0) {
            // Ada data tracking real dari DB
            $timeline = collect();

            // Tambah entry "Pengajuan Diterima" di awal
            $timeline->push([
                'name'   => 'Pengajuan Diterima',
                'date'   => $pengajuan->created_at->isoFormat('D MMMM Y'),
                'desc'   => 'Pengajuan maklon telah diterima dan sedang ditinjau.',
                'status' => 'done',
            ]);

            // Tambah tahapan dari DB, diurutkan sesuai urutan standar
            $sorted = $tracking->sortBy(
                fn($t) => array_search($t->tahapan, $urutan) !== false
                    ? array_search($t->tahapan, $urutan)
                    : 99
            );

            foreach ($sorted as $t) {
                $timeline->push([
                    'name'   => $t->tahapan,
                    'date'   => $t->tanggal?->isoFormat('D MMMM Y') ?? '-',
                    'desc'   => $t->catatan ?: 'Tahap ' . $t->tahapan,
                    'status' => match ($t->status) {
                        'done'     => 'done',
                        'progress' => 'active',
                        default    => 'pending',
                    },
                ]);
            }

            $timeline = $timeline->values()->all();
        } else {
            // Belum ada tracking (masih pending)
            $timeline = [
                ['name' => 'Pengajuan Diterima',     'date' => $pengajuan->created_at->isoFormat('D MMMM Y'), 'desc' => 'Pengajuan diterima, menunggu konfirmasi admin.',   'status' => 'done'],
                ['name' => 'Menunggu Persetujuan',   'date' => '-', 'desc' => 'Admin sedang memproses pengajuan Anda.', 'status' => 'active'],
                ['name' => 'Persiapan Bahan',        'date' => '-', 'desc' => 'Persiapan bahan baku produksi.',         'status' => 'pending'],
                ['name' => 'Mixing',                 'date' => '-', 'desc' => 'Proses pencampuran formula parfum.',     'status' => 'pending'],
                ['name' => 'Filling & Packaging',    'date' => '-', 'desc' => 'Pengisian dan pengemasan produk.',       'status' => 'pending'],
                ['name' => 'Quality Control',        'date' => '-', 'desc' => 'Pemeriksaan kualitas akhir.',            'status' => 'pending'],
            ];
        }

        // Catatan dari trakings yang punya catatan terisi
        $catatan = $tracking->filter(fn($t) => !empty($t->catatan))
            ->map(fn($t) => (object) [
                'tanggal' => $t->updated_at ?? $t->tanggal,
                'isi'     => $t->catatan,
            ])->values();

        return view('user.tracking.detail_user', compact(
            'proyek', 'timeline', 'catatan',
            'totalTahap', 'tahapSelesai', 'progress'
        ));
    }
}
