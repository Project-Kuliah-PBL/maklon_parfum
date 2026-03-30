<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Pembayaran;

class RiwayatPesananController extends Controller
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
            ['icon' => 'archive', 'label' => 'Riwayat Pesanan', 'route' => 'admin.riwayat.pesanan'],
        ];
    }

    /**
     * Menampilkan halaman riwayat pesanan
     */
    public function index(Request $request)
    {
        $navItems = $this->getNavItems();

        // Ambil parameter search dan filter
        $search = $request->input('search');
        $status = $request->input('status');

        // Query dasar dengan relasi
        $query = Pengajuan::with(['user', 'hargaParfum', 'pembayarans']);

       
        $query->when($search, function($q) use ($search) {
            return $q->whereHas('user', function($userQuery) use ($search) {
                $userQuery->where('name', 'LIKE', "%{$search}%");
            });
        });

      
        $query->when($status, function($q) use ($status) {
            return $q->where('status', $status);
        });

      
        $orders = $query->orderBy('created_at', 'desc')
                    ->paginate(10)
                    ->withQueryString();

        // Hitung statistik untuk header (tetap menggunakan semua data)
        $totalPesanan = Pengajuan::count();
        $pesananSelesai = Pengajuan::where('status', 'Selesai')->count();
        $pesananProses = Pengajuan::whereIn('status', ['Diproses', 'Proses', 'Menunggu', 'Pending'])->count();
        $pesananBatal = Pengajuan::whereIn('status', ['Dibatalkan', 'Ditolak', 'Batal'])->count();
        
        // Hitung total pendapatan dari semua pembayaran (tanpa filter status)
        try {
            $totalPendapatan = Pembayaran::sum('total') ?? 0;
        } catch (\Exception $e) {
            $totalPendapatan = 0;
        }

        $stats = [
            [
                'icon' => 'shopping-bag',
                'label' => 'Total Pesanan',
                'value' => $totalPesanan,
                'trend' => 'Semua pesanan',
                'color' => 'bg-purple-100 text-purple-600'
            ],
            [
                'icon' => 'check-circle',
                'label' => 'Pesanan Selesai',
                'value' => $pesananSelesai,
                'trend' => number_format(($pesananSelesai / max($totalPesanan, 1)) * 100, 1) . '% dari total',
                'color' => 'bg-emerald-100 text-emerald-600'
            ],
            [
                'icon' => 'clock',
                'label' => 'Dalam Proses',
                'value' => $pesananProses,
                'trend' => 'Menunggu/Diproses',
                'color' => 'bg-blue-100 text-blue-600'
            ],
            [
                'icon' => 'wallet',
                'label' => 'Total Pendapatan',
                'value' => 'Rp ' . number_format($totalPendapatan, 0, ',', '.'),
                'trend' => '',
                'color' => 'bg-orange-100 text-orange-600'
            ],
        ];

        return view('admin.riwayat-pesanan', compact('navItems', 'orders', 'stats', 'search', 'status'));
    }

    /**
     * Menampilkan detail pesanan
     */
    public function show($id)
    {
        $order = Pengajuan::with(['user', 'hargaParfum', 'pembayarans', 'aromas', 'kemasans'])
                    ->findOrFail($id);

        // TOTAL HARGA diambil dari jumlah semua pembayaran (kolom total) di tabel pembayarans
        $totalPembayaran = $order->pembayarans->sum('total') ?? 0;
        
       
        $totalHarga = $totalPembayaran;
        $sisaPembayaran = 0; 

        // Tentukan status pembayaran berdasarkan jumlah pembayaran
        if ($totalPembayaran == 0) {
            $paymentStatus = 'Belum Dibayar';
            $paymentColor = 'bg-red-100 text-red-600';
        } else {
            // Jika sudah ada pembayaran, tampilkan total yang sudah dibayar
            $paymentStatus = 'Dibayar (Rp ' . number_format($totalPembayaran, 0, ',', '.') . ')';
            $paymentColor = 'bg-emerald-100 text-emerald-600';
        }

        // Dapatkan daftar aroma
        $aromaList = $order->aromas->pluck('nama_kategori')->implode(', ');
        
        // Dapatkan daftar kemasan
        $kemasanList = $order->kemasans->map(function($item) {
            return $item->jenis_botol . ' (' . $item->ukuran . ')';
        })->implode(', ');

        // Dapatkan detail pembayaran
        $paymentDetails = $order->pembayarans->map(function($payment) {
            return [
                'tanggal' => $payment->created_at->format('d/m/Y'),
                'total' => 'Rp ' . number_format($payment->total, 0, ',', '.'),
                'metode' => $payment->metode_pembayaran ?? 'Transfer',
                'status' => $payment->status ?? 'Sukses'
            ];
        });

        // Buat ID pesanan format PJ-XXXXX
        $orderId = 'PJ-' . str_pad($order->id, 5, '0', STR_PAD_LEFT);

        return response()->json([
            'id' => $order->id,
            'no_pengajuan' => $orderId,
            'client' => $order->user->name ?? 'N/A',
            'initial' => $this->getInitials($order->user->name ?? 'N/A'),
            'product' => $order->hargaParfum->nama_parfum ?? 'Produk',
            'aroma' => $aromaList ?: ($order->hargaParfum->aroma ?? '-'),
            'kemasan' => $kemasanList ?: '-',
            'quantity' => number_format($order->jumlah, 0, ',', '.') . ' unit',
            'order_date' => $order->created_at->format('Y-m-d'),
            'completion_date' => $order->updated_at->format('Y-m-d'),
            'total_harga' => 'Rp ' . number_format($totalHarga, 0, ',', '.'), // Dari total pembayaran
            'total_pembayaran' => 'Rp ' . number_format($totalPembayaran, 0, ',', '.'),
            'sisa_pembayaran' => 'Rp ' . number_format($sisaPembayaran, 0, ',', '.'),
            'total' => 'Rp ' . number_format($totalPembayaran, 0, ',', '.'),
            'status' => $order->status,
            'status_color' => $this->getStatusColor($order->status),
            'payment_status' => $paymentStatus,
            'payment_color' => $paymentColor,
            'payment_details' => $paymentDetails,
            'notes' => $order->catatan ?? '-'
        ]);
    }

    /**
     * Mendapatkan inisial dari nama
     */
    private function getInitials($name)
    {
        $words = explode(' ', $name);
        $initials = '';
        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return substr($initials, 0, 2);
    }

    /**
     * Mendapatkan warna status
     */
    private function getStatusColor($status)
    {
        $colors = [
            'Selesai' => 'bg-emerald-100 text-emerald-600',
            'Dibatalkan' => 'bg-red-100 text-red-600',
            'Ditolak' => 'bg-red-100 text-red-600',
            'Batal' => 'bg-red-100 text-red-600',
            'Dalam Pengiriman' => 'bg-blue-100 text-blue-600',
            'Menunggu' => 'bg-yellow-100 text-yellow-600',
            'Pending' => 'bg-yellow-100 text-yellow-600',
            'Diproses' => 'bg-blue-100 text-blue-600',
            'Proses' => 'bg-blue-100 text-blue-600'
        ];

        return $colors[$status] ?? 'bg-slate-100 text-slate-600';
    }

    /**
     * Export ke CSV
     */
    public function exportCsv(Request $request)
    {
        $orders = Pengajuan::with(['user', 'hargaParfum', 'pembayarans'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        $filename = 'semua-pesanan-' . date('Y-m-d') . '.csv';
        $handle = fopen('php://output', 'w');
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Header CSV
        fputcsv($handle, [
            'ID Pesanan',
            'Klien',
            'Produk',
            'Jumlah',
            'Total Pembayaran',
            'Status Pesanan',
            'Status Pembayaran',
            'Tanggal Order',
            'Tanggal Update'
        ]);

        // Data CSV
        foreach ($orders as $order) {
            $totalPembayaran = $order->pembayarans->sum('total') ?? 0;
            $orderId = 'PJ-' . str_pad($order->id, 5, '0', STR_PAD_LEFT);
            
            // Tentukan status pembayaran
            if ($totalPembayaran == 0) {
                $paymentStatus = 'Belum Dibayar';
            } else {
                $paymentStatus = 'Dibayar (Rp ' . number_format($totalPembayaran, 0, ',', '.') . ')';
            }
            
            fputcsv($handle, [
                $orderId,
                $order->user->name ?? 'N/A',
                $order->hargaParfum->nama_parfum ?? 'Produk',
                number_format($order->jumlah, 0, ',', '.') . ' unit',
                'Rp ' . number_format($totalPembayaran, 0, ',', '.'),
                $order->status,
                $paymentStatus,
                $order->created_at->format('d/m/Y'),
                $order->updated_at->format('d/m/Y')
            ]);
        }

        fclose($handle);
        exit;
    }

    /**
     * Export ke PDF (sederhana)
     */
    public function exportPdf(Request $request)
    {
        $orders = Pengajuan::with(['user', 'hargaParfum', 'pembayarans'])
                    ->orderBy('created_at', 'desc')
                    ->get();
                    
        return view('admin.riwayat-pesanan-print', compact('orders'));
    }
}