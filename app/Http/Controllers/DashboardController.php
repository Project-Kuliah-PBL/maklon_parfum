<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajuan;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ── Stat cards ──────────────────────────────────────────
        $totalAktif    = Pengajuan::where('user_id', $user->id)
                            ->whereIn('status', ['pending', 'proses'])
                            ->count();

        $totalSelesai  = Pengajuan::where('user_id', $user->id)
                            ->where('status', 'selesai')
                            ->count();

        $totalProduksi = Pengajuan::where('user_id', $user->id)
                            ->whereIn('status', ['proses', 'selesai'])
                            ->sum('jumlah');

        // ── Pengajuan aktif (pending + proses) ──────────────────
        $pengajuanAktif = Pengajuan::with('tracking')
            ->where('user_id', $user->id)
            ->whereIn('status', ['pending', 'proses'])
            ->latest()
            ->get()
            ->map(function ($p) {
                $tracking  = $p->tracking;
                $total     = $tracking->count();
                $done      = $tracking->where('status', 'done')->count();
                $progress  = $total > 0 ? round(($done / $total) * 100) : 0;

                return (object) [
                    'id'               => $p->id,
                    'kode'             => 'MKL-' . str_pad($p->id, 5, '0', STR_PAD_LEFT),
                    'jenis_parfum'     => $p->jenis_parfum,
                    'target_pasar'     => $p->target_market ?? '-',
                    'jumlah_produksi'  => $p->jumlah,
                    'tanggal_pengajuan'=> $p->created_at,
                    'progress'         => $progress,
                    'status'           => match ($p->status) {
                        'proses'  => 'Dalam Produksi',
                        'pending' => 'Menunggu Approval',
                        default   => ucfirst($p->status),
                    },
                ];
            });

        // ── Riwayat proyek selesai ───────────────────────────────
        $riwayatProyek = Pengajuan::where('user_id', $user->id)
            ->where('status', 'selesai')
            ->latest('updated_at')
            ->get()
            ->map(fn($p) => (object) [
                'id_proyek'       => 'MKL-' . str_pad($p->id, 5, '0', STR_PAD_LEFT),
                'jenis_parfum'    => $p->jenis_parfum,
                'jumlah_produksi' => $p->jumlah,
                'tanggal_selesai' => $p->updated_at,
            ]);

        return view('user.dashboard_user', compact(
            'totalAktif', 'totalSelesai', 'totalProduksi',
            'pengajuanAktif', 'riwayatProyek'
        ));
    }
}
        