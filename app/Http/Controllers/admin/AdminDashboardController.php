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
     */
    private function getNavItems()
    {
        return [
            ['icon' => 'layout-dashboard', 'label' => 'Dashboard', 'route' => 'admin.dashboard'],
            ['icon' => 'file-text', 'label' => 'Pengajuan', 'route' => 'admin.pengajuan'],
            ['icon' => 'flask-conical', 'label' => 'Produksi', 'route' => 'admin.produksi'],
            ['icon' => 'package', 'label' => 'Komponen Produksi', 'route' => 'admin.komponen.produksi'],
            ['icon' => 'archive', 'label' => 'Riwayat Pesanan', 'route' => 'admin.riwayat.pesanan'], // Menu baru
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
     * Halaman Monitoring Produksi
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

    /**
     * Halaman Riwayat Pesanan
     */
    public function riwayatPesanan()
    {
        $navItems = $this->getNavItems();

        // Data contoh riwayat pesanan
        $orders = [
            [
                'id' => 'ORD-2024-001',
                'client' => 'Brand Parfum ABC',
                'initial' => 'BP',
                'product' => 'Eau de Parfum - Citrus',
                'quantity' => '2,500 unit',
                'order_date' => '2024-01-15',
                'completion_date' => '2024-02-20',
                'total' => 'Rp 187.500.000',
                'status' => 'SELESAI',
                'status_color' => 'bg-emerald-100 text-emerald-600'
            ],
            [
                'id' => 'ORD-2024-002',
                'client' => 'Luxe Mist Co.',
                'initial' => 'LM',
                'product' => 'Eau de Toilette - Ocean',
                'quantity' => '1,000 unit',
                'order_date' => '2024-01-20',
                'completion_date' => '2024-02-25',
                'total' => 'Rp 75.000.000',
                'status' => 'SELESAI',
                'status_color' => 'bg-emerald-100 text-emerald-600'
            ],
            [
                'id' => 'ORD-2024-003',
                'client' => 'Essence Co.',
                'initial' => 'EC',
                'product' => 'Parfum - Midnight Bloom',
                'quantity' => '3,500 unit',
                'order_date' => '2024-02-01',
                'completion_date' => '2024-03-10',
                'total' => 'Rp 262.500.000',
                'status' => 'DALAM PENGIRIMAN',
                'status_color' => 'bg-blue-100 text-blue-600'
            ],
            [
                'id' => 'ORD-2024-004',
                'client' => 'Aroma Terrace',
                'initial' => 'AT',
                'product' => 'Eau de Parfum - Floral',
                'quantity' => '1,500 unit',
                'order_date' => '2024-02-10',
                'completion_date' => '2024-03-15',
                'total' => 'Rp 112.500.000',
                'status' => 'SELESAI',
                'status_color' => 'bg-emerald-100 text-emerald-600'
            ],
            [
                'id' => 'ORD-2024-005',
                'client' => 'Parfum Deluxe',
                'initial' => 'PD',
                'product' => 'Eau de Toilette - Woody',
                'quantity' => '2,000 unit',
                'order_date' => '2024-02-15',
                'completion_date' => '2024-03-20',
                'total' => 'Rp 150.000.000',
                'status' => 'DALAM PENGIRIMAN',
                'status_color' => 'bg-blue-100 text-blue-600'
            ],
        ];

        // Statistik untuk header
        $stats = [
            [
                'icon' => 'shopping-bag',
                'label' => 'Total Pesanan',
                'value' => '156',
                'trend' => '+12 bulan ini',
                'color' => 'bg-purple-100 text-purple-600'
            ],
            [
                'icon' => 'check-circle',
                'label' => 'Pesanan Selesai',
                'value' => '142',
                'trend' => '91% sukses',
                'color' => 'bg-emerald-100 text-emerald-600'
            ],
            [
                'icon' => 'truck',
                'label' => 'Dalam Pengiriman',
                'value' => '14',
                'trend' => 'Estimasi 3-5 hari',
                'color' => 'bg-blue-100 text-blue-600'
            ],
            [
                'icon' => 'wallet',
                'label' => 'Total Pendapatan',
                'value' => 'Rp 12.8M',
                'trend' => 'Bulan ini',
                'color' => 'bg-orange-100 text-orange-600'
            ],
        ];

        return view('admin.riwayat-pesanan', compact('navItems', 'orders', 'stats'));
    }
}