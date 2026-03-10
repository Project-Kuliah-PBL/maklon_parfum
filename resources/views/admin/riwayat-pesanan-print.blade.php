<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan - PT Arum Jaya Gemilang</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #1e293b; }
        .header { padding: 20px 30px; border-bottom: 2px solid #4c2b62; margin-bottom: 20px; }
        .header h1 { font-size: 18px; color: #4c2b62; font-weight: bold; }
        .header p  { font-size: 11px; color: #64748b; margin-top: 4px; }
        .meta { display: flex; justify-content: space-between; padding: 0 30px 16px; font-size: 11px; color: #475569; }
        table { width: calc(100% - 60px); margin: 0 30px; border-collapse: collapse; }
        thead tr { background: #4c2b62; color: white; }
        th { padding: 8px 10px; text-align: left; font-size: 11px; font-weight: 600; }
        td { padding: 7px 10px; border-bottom: 1px solid #e2e8f0; font-size: 11px; }
        tbody tr:nth-child(even) { background: #f8fafc; }
        .status { padding: 2px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; display: inline-block; }
        .status-selesai  { background: #d1fae5; color: #059669; }
        .status-proses   { background: #dbeafe; color: #2563eb; }
        .status-pending  { background: #fef3c7; color: #ca8a04; }
        .status-ditolak  { background: #fee2e2; color: #dc2626; }
        .footer { padding: 20px 30px 0; text-align: right; font-size: 10px; color: #94a3b8; border-top: 1px solid #e2e8f0; margin-top: 20px; }
        @media print {
            .no-print { display: none; }
            body { print-color-adjust: exact; -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="padding:20px 30px;background:#f1f5f9">
        <button onclick="window.print()" style="padding:8px 20px;background:#4c2b62;color:white;border:none;border-radius:8px;cursor:pointer;font-size:13px;font-weight:bold">
            🖨 Cetak / Simpan PDF
        </button>
        <a href="{{ route('admin.riwayat.pesanan') }}" style="margin-left:12px;color:#4c2b62;text-decoration:none;font-size:13px">← Kembali</a>
    </div>

    <div class="header">
        <h1>PT Arum Jaya Gemilang</h1>
        <p>Laporan Riwayat Pesanan — Dicetak {{ now()->format('d F Y H:i') }} WIB</p>
    </div>

    <div class="meta">
        <span>Total Data: <strong>{{ $orders->count() }} pesanan</strong></span>
        <span>Periode: Semua waktu</span>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Klien</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total Pembayaran</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            @php
                $totalBayar = $order->pembayarans->sum('total') ?? 0;
                $statusClass = match(strtolower($order->status)) {
                    'selesai'              => 'status-selesai',
                    'proses','diproses'    => 'status-proses',
                    'ditolak','dibatalkan' => 'status-ditolak',
                    default                => 'status-pending',
                };
            @endphp
            <tr>
                <td><strong>PJ-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</strong></td>
                <td>{{ $order->user->name ?? 'N/A' }}</td>
                <td>{{ $order->hargaParfum->jenis_parfum ?? $order->jenis_parfum }}</td>
                <td>{{ number_format($order->jumlah, 0, ',', '.') }} unit</td>
                <td>Rp {{ number_format($totalBayar, 0, ',', '.') }}</td>
                <td><span class="status {{ $statusClass }}">{{ ucfirst($order->status) }}</span></td>
                <td>{{ $order->created_at->format('d/m/Y') }}</td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;padding:20px;color:#94a3b8">Tidak ada data</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dokumen ini digenerate otomatis oleh sistem PT Arum Jaya Gemilang
    </div>
</body>
</html>
