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
            ['name' => 'Aroma Terrace Co.', 'wait' => '48 Jam+', 'desc' => 'EDT - 5k units', 'urgent' => true, 'team_ready' => true],
            ['name' => 'Luxe Essence', 'wait' => '12 Jam+', 'desc' => 'EDP - 1k units', 'urgent' => false, 'team_ready' => false]
        ];

        return view('admin.pengajuan', compact('navItems', 'submissions', 'priorities'));
    }

    /**
     * Halaman Monitoring Produksi (Batch Management)
     */
    public function produksi()
    {
        $navItems = $this->getNavItems();

        $stats = [
            ['label' => 'Total Produksi Aktif', 'value' => '12', 'trend' => 'Batch berjalan'],
            ['label' => 'QC Pass Rate', 'value' => '99.2%', 'trend' => 'Target tercapai'],
        ];

        $batches = [
            ['id' => 'MKL-2024-001', 'client' => 'Aroma Aura', 'product' => 'Midnight Bloom', 'progress' => 35, 'status' => 'MIXING', 'eta' => '10 Feb', 'stage_color' => 'bg-blue-100 text-blue-600'],
            ['id' => 'MKL-2024-002', 'client' => 'Essence Co.', 'product' => 'Ocean Breeze', 'progress' => 68, 'status' => 'FILLING', 'eta' => '12 Feb', 'stage_color' => 'bg-orange-100 text-orange-600'],
        ];

        return view('admin.produksi', compact('navItems', 'stats', 'batches'));
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