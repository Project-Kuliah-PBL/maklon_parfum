<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aroma;
use App\Models\Kemasan;
use App\Models\Pengajuan;
use App\Models\User;
use App\Models\Pembayaran;

class AdminDashboardController extends Controller
{
    /**
     * Menyediakan data navigasi untuk semua halaman admin.
     * Menu telah diringkas menjadi 4 kategori utama.
     */
    private function getNavItems()
    {
        return [
            ['icon' => 'layout-dashboard', 'label' => 'Dashboard', 'route' => 'admin.dashboard'],
            ['icon' => 'file-text', 'label' => 'Pengajuan', 'route' => 'admin.pengajuan'],
            ['icon' => 'flask-conical', 'label' => 'Produksi', 'route' => 'admin.produksi'],
            ['icon' => 'package', 'label' => 'Komponen Produksi', 'route' => 'admin.komponen.produksi'],
        ];
    }

    /**
     * Halaman Utama Admin (Dashboard)
     */
    public function index()
    {
        $navItems = $this->getNavItems();

        $totalPengajuan = Pengajuan::count();
        $pending = Pengajuan::where('status','pending')->count();
        $proses = Pengajuan::where('status','proses')->count();
        $selesai = Pengajuan::where('status','selesai')->count();

        $stats = [
            [
                'label' => 'Total Pengajuan',
                'value' => $totalPengajuan,
                'trend' => 'Semua data',
                'type' => 'neutral',
                'icon' => 'file-text',
                'bg' => 'bg-blue-100',
                'color' => 'text-blue-600'
            ],
            [
                'label' => 'Pending',
                'value' => $pending,
                'trend' => 'Menunggu',
                'type' => 'neutral',
                'icon' => 'clock',
                'bg' => 'bg-orange-100',
                'color' => 'text-orange-600'
            ],
            [
                'label' => 'Diproses',
                'value' => $proses,
                'trend' => 'Produksi',
                'type' => 'positive',
                'icon' => 'flask-conical',
                'bg' => 'bg-purple-100',
                'color' => 'text-purple-600'
            ],
            [
                'label' => 'Selesai',
                'value' => $selesai,
                'trend' => 'Completed',
                'type' => 'positive',
                'icon' => 'check-circle',
                'bg' => 'bg-emerald-100',
                'color' => 'text-emerald-600'
            ]
        ];

        $activities = Pengajuan::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('navItems','stats','activities'));
    }

    /**
     * Halaman Daftar Pengajuan Maklon
     */
    public function pengajuan()
    {
        $navItems = $this->getNavItems();

        $submissions = Pengajuan::with('user')
            ->where('status','pending')
            ->latest()
            ->get();

        $priorities = Pengajuan::where('status','pending')
            ->orderBy('jumlah','desc')
            ->take(5)
            ->get();

        return view('admin.pengajuan', compact('navItems','submissions','priorities'));
    }

    /**
     * Halaman Monitoring Produksi (Batch Management)
     */
    public function produksi()
    {
        $navItems = $this->getNavItems();

        $batches = Pengajuan::with('user')
            ->where('status','proses')
            ->get()
            ->map(function($p){

                return [
                    'id' => 'MKL-'.$p->id,
                    'client' => $p->user->name,
                    'product' => $p->jenis_parfum,
                    'progress' => rand(10,90),
                    'status' => strtoupper($p->status),
                    'eta' => $p->estimasi_selesai,
                    'stage_color' => 'bg-blue-100 text-blue-600'
                ];
            });

        return view('admin.produksi', compact('navItems','batches'));
    }

    /**
     * Halaman Komponen Produksi (Katalog Aroma & Kemasan)
     */
    public function komponenproduksi()
    {
        $navItems = $this->getNavItems();

        $aromaCategories = Aroma::all();
        $packagingItems = Kemasan::all();

        return view('admin.komponenproduksi', compact(
            'navItems',
            'aromaCategories',
            'packagingItems'
        ));
    }
}