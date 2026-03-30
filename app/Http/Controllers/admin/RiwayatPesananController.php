<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Pembayaran;

class RiwayatPesananController extends Controller
{
    private function getNavItems()
    {
        return [
            ['icon' => 'layout-dashboard', 'label' => 'Dashboard',        'route' => 'admin.dashboard'],
            ['icon' => 'file-text',        'label' => 'Pengajuan',         'route' => 'admin.pengajuan'],
            ['icon' => 'flask-conical',    'label' => 'Produksi',          'route' => 'admin.produksi'],
            ['icon' => 'package',          'label' => 'Komponen Produksi', 'route' => 'admin.komponen.produksi'],
            ['icon' => 'archive',          'label' => 'Riwayat Pesanan',   'route' => 'admin.riwayat.pesanan'],
        ];
    }

    /**
     * Halaman Daftar Riwayat Pesanan
     */
    public function index(Request $request)
    {
        $navItems = $this->getNavItems();
        $search   = $request->input('search');
        $status   = $request->input('status');

        $query = Pengajuan::with(['user', 'hargaParfum', 'pembayarans']);

        $query->when($search, function ($q) use ($search) {
            $q->whereHas('user', fn($u) => $u->where('name', 'LIKE', "%{$search}%"))
              ->orWhere('jenis_parfum', 'LIKE', "%{$search}%");
        });

        $query->when($status, fn($q) => $q->where('status', $status));

        $orders = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // Statistik
        $totalPesanan    = Pengajuan::count();
        $pesananSelesai  = Pengajuan::where('status', 'selesai')->count();
        $pesananProses   = Pengajuan::whereIn('status', ['proses', 'pending'])->count();
        $totalPendapatan = Pembayaran::sum('total') ?? 0;

        $stats = [
            ['icon' => 'shopping-bag',  'label' => 'Total Pesanan',      'value' => $totalPesanan,   'trend' => 'Semua pesanan',  'color' => 'bg-purple-100 text-purple-600'],
            ['icon' => 'check-circle',  'label' => 'Pesanan Selesai',     'value' => $pesananSelesai, 'trend' => number_format($totalPesanan ? ($pesananSelesai / $totalPesanan) * 100 : 0, 1) . '% dari total', 'color' => 'bg-emerald-100 text-emerald-600'],
            ['icon' => 'clock',         'label' => 'Dalam Proses',        'value' => $pesananProses,  'trend' => 'Menunggu/Diproses', 'color' => 'bg-blue-100 text-blue-600'],
            ['icon' => 'wallet',        'label' => 'Total Pendapatan',    'value' => 'Rp ' . number_format($totalPendapatan, 0, ',', '.'), 'trend' => '', 'color' => 'bg-orange-100 text-orange-600'],
        ];

        return view('admin.riwayat-pesanan', compact('navItems', 'orders', 'stats', 'search', 'status'));
    }

    /**
     * Search via AJAX (dipanggil oleh route admin.riwayat.search)
     * → Redirect ke index dengan parameter
     */
    public function search(Request $request)
    {
        return redirect()->route('admin.riwayat.pesanan', $request->only('search', 'status'));
    }

    /**
     * Detail satu pesanan — JSON untuk modal
     */
    public function show($id)
    {
        $order = Pengajuan::with(['user', 'hargaParfum', 'pembayarans', 'aromas', 'kemasans'])
                    ->findOrFail($id);

        $totalPembayaran = $order->pembayarans->sum('total') ?? 0;

        $paymentStatus = $totalPembayaran == 0 ? 'Belum Dibayar'
            : 'Dibayar (Rp ' . number_format($totalPembayaran, 0, ',', '.') . ')';

        $paymentColor = $totalPembayaran == 0
            ? 'bg-red-100 text-red-600'
            : 'bg-emerald-100 text-emerald-600';

        $aromaList   = $order->aromas->pluck('nama_kategori')->implode(', ') ?: '-';
        $kemasanList = $order->kemasans->map(fn($k) => $k->jenis_botol . ' (' . $k->ukuran . ')')->implode(', ') ?: '-';

        $paymentDetails = $order->pembayarans->map(fn($p) => [
            'tanggal' => $p->created_at->format('d/m/Y'),
            'total'   => 'Rp ' . number_format($p->total, 0, ',', '.'),
            'metode'  => $p->metode_pembayaran ?? 'Transfer',
            'status'  => $p->status_bayar ?? 'Sukses',
        ]);

        return response()->json([
            'id'              => $order->id,
            'no_pengajuan'    => 'PJ-' . str_pad($order->id, 5, '0', STR_PAD_LEFT),
            'client'          => $order->user->name ?? 'N/A',
            'initial'         => $this->getInitials($order->user->name ?? 'NA'),
            'product'         => $order->hargaParfum->jenis_parfum ?? $order->jenis_parfum,
            'aroma'           => $aromaList,
            'kemasan'         => $kemasanList,
            'quantity'        => number_format($order->jumlah, 0, ',', '.') . ' unit',
            'order_date'      => $order->created_at->format('Y-m-d'),
            'completion_date' => $order->updated_at->format('Y-m-d'),
            'total_harga'     => 'Rp ' . number_format($totalPembayaran, 0, ',', '.'),
            'total_pembayaran'=> 'Rp ' . number_format($totalPembayaran, 0, ',', '.'),
            'sisa_pembayaran' => 'Rp 0',
            'total'           => 'Rp ' . number_format($totalPembayaran, 0, ',', '.'),
            'status'          => $order->status,
            'status_color'    => $this->getStatusColor($order->status),
            'payment_status'  => $paymentStatus,
            'payment_color'   => $paymentColor,
            'payment_details' => $paymentDetails,
            'notes'           => $order->catatan ?? '-',
        ]);
    }

    /**
     * Export CSV
     */
    public function exportCsv(Request $request)
    {
        $orders = Pengajuan::with(['user', 'hargaParfum', 'pembayarans'])
                    ->orderBy('created_at', 'desc')->get();

        $filename = 'riwayat-pesanan-' . date('Y-m-d') . '.csv';

        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Pragma: no-cache');

        $handle = fopen('php://output', 'w');
        fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF)); // UTF-8 BOM

        fputcsv($handle, ['ID Pesanan', 'Klien', 'Produk', 'Jumlah', 'Total Pembayaran', 'Status', 'Tanggal Order', 'Tanggal Update']);

        foreach ($orders as $order) {
            $totalBayar = $order->pembayarans->sum('total') ?? 0;
            fputcsv($handle, [
                'PJ-' . str_pad($order->id, 5, '0', STR_PAD_LEFT),
                $order->user->name ?? 'N/A',
                $order->hargaParfum->jenis_parfum ?? $order->jenis_parfum,
                number_format($order->jumlah, 0, ',', '.') . ' unit',
                'Rp ' . number_format($totalBayar, 0, ',', '.'),
                $order->status,
                $order->created_at->format('d/m/Y'),
                $order->updated_at->format('d/m/Y'),
            ]);
        }

        fclose($handle);
        exit;
    }

    /**
     * Export PDF (print view)
     */
    public function exportPdf(Request $request)
    {
        $navItems = $this->getNavItems();
        $orders   = Pengajuan::with(['user', 'hargaParfum', 'pembayarans'])
                        ->orderBy('created_at', 'desc')->get();

        return view('admin.riwayat-pesanan-print', compact('orders', 'navItems'));
    }

    /* ---------- helpers ---------- */

    private function getInitials(string $name): string
    {
        $words    = explode(' ', $name);
        $initials = '';
        foreach ($words as $w) {
            $initials .= strtoupper(substr($w, 0, 1));
        }
        return substr($initials, 0, 2);
    }

    private function getStatusColor(string $status): string
    {
        return match (strtolower($status)) {
            'selesai'              => 'bg-emerald-100 text-emerald-600',
            'dibatalkan', 'ditolak', 'batal' => 'bg-red-100 text-red-600',
            'dalam pengiriman'     => 'bg-blue-100 text-blue-600',
            'menunggu', 'pending'  => 'bg-yellow-100 text-yellow-600',
            'proses', 'diproses'   => 'bg-purple-100 text-purple-600',
            default                => 'bg-slate-100 text-slate-600',
        };
    }
}
