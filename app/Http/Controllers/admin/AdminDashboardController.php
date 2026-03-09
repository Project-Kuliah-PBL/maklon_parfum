<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aroma;
use App\Models\Kemasan;

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
        
        $stats = [
            ['label' => 'Total Pendapatan', 'value' => 'Rp 1.250M', 'trend' => '+12.5%', 'type' => 'positive', 'icon' => 'wallet', 'bg' => 'bg-purple-100', 'color' => 'text-purple-600'],
            ['label' => 'Proyek Aktif', 'value' => '24', 'trend' => '8 Aktif', 'type' => 'neutral', 'icon' => 'clipboard-list', 'bg' => 'bg-blue-100', 'color' => 'text-blue-600'],
            ['label' => 'Klien Baru', 'value' => '12', 'trend' => '+4 Bulan ini', 'type' => 'positive', 'icon' => 'user-plus', 'bg' => 'bg-orange-100', 'color' => 'text-orange-600'],
            ['label' => 'Status Produksi', 'value' => '45,200', 'trend' => 'Unit Parfum', 'type' => 'neutral', 'icon' => 'flask-conical', 'bg' => 'bg-emerald-100', 'color' => 'text-emerald-600'],
        ];

        $activities = [
            ['id' => 'MKL-2024-001', 'client' => 'Brand Parfum ABC', 'initial' => 'BP', 'type' => 'Eau de Parfum', 'status' => 'PRODUKSI', 'class' => 'bg-blue-100 text-blue-600'],
            ['id' => 'MKL-2024-002', 'client' => 'Luxe Mist Co.', 'initial' => 'LM', 'type' => 'Eau de Toilette', 'status' => 'WAITING', 'class' => 'bg-orange-100 text-orange-600'],
        ];

        return view('admin.dashboard', compact('navItems', 'stats', 'activities'));
    }

    /**
     * Halaman Daftar Pengajuan Maklon
     */
    public function pengajuan()
    {
        $navItems = $this->getNavItems();
        
        $submissions = [
            [
                'id' => 'REQ-2024-088', 
                'client' => 'Brand Parfum ABC', 
                'initial' => 'BP', 
                'time' => '2 jam yang lalu', 
                'type' => 'Eau de Parfum', 
                'aroma' => 'Citrus', 
                'amount' => '2,500', 
                'target' => 'Luxury'
            ]
        ];

        $priorities = [
            ['name' => 'Aroma Terrace Co.', 'wait' => '48 Jam+', 'desc' => 'EDT - 5k units', 'urgent' => true],
            ['name' => 'Luxe Essence', 'wait' => '12 Jam+', 'desc' => 'EDP - 1k units', 'urgent' => false]
        ];

        return view('admin.pengajuan', compact('navItems', 'submissions', 'priorities'));
    }

    /**
     * Halaman Monitoring Produksi
     */
    public function produksi()
    {
        $navItems = $this->getNavItems();

        $batches = [
            ['id' => 'MKL-2024-001', 'client' => 'Aroma Aura', 'product' => 'Midnight Bloom', 'progress' => 35, 'status' => 'MIXING', 'eta' => '10 Feb', 'stage_color' => 'bg-blue-100 text-blue-600'],
            ['id' => 'MKL-2024-002', 'client' => 'Essence Co.', 'product' => 'Ocean Breeze', 'progress' => 68, 'status' => 'FILLING', 'eta' => '12 Feb', 'stage_color' => 'bg-orange-100 text-orange-600'],
        ];

        return view('admin.produksi', compact('navItems', 'batches'));
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