@extends('layouts.admin')

@section('title', 'Riwayat Pesanan - PT Arum Jaya Gemilang')
@section('page-title', 'Riwayat Pesanan')
@section('page-subtitle', 'Daftar lengkap semua pesanan termasuk yang masih dalam proses.')

@php
// Helper function untuk mendapatkan inisial
function getInitials($name) {
    if (empty($name)) return 'NA';
    $words = explode(' ', $name);
    $initials = '';
    foreach ($words as $word) {
        $initials .= strtoupper(substr($word, 0, 1));
    }
    return substr($initials, 0, 2);
}
@endphp

@section('content')
    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        @foreach($stats as $stat)
        <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="{{ $stat['color'] }} p-2 rounded-lg">
                    <i data-lucide="{{ $stat['icon'] }}" class="w-4 h-4"></i>
                </div>
                <div>
                    <p class="text-slate-400 text-[10px] font-medium uppercase tracking-wider">{{ $stat['label'] }}</p>
                    <div class="flex items-baseline gap-1">
                        <h3 class="text-lg font-bold text-slate-800">{{ $stat['value'] }}</h3>
                        <span class="text-[9px] font-medium text-slate-400">{{ $stat['trend'] }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Filter Section --}}
    <div class="bg-white p-3 rounded-xl shadow-sm border border-slate-100 flex gap-3 mb-6">
        <div class="flex-1 relative">
            <i data-lucide="search" class="w-3.5 h-3.5 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input type="text" id="searchInput" placeholder="Cari ID pesanan atau nama klien..." class="w-full pl-9 pr-3 py-1.5 bg-slate-50 border-none rounded-lg text-xs focus:ring-1 focus:ring-brand-purple">
        </div>
        <div class="flex gap-2">
            <select id="statusFilter" class="px-3 py-1.5 bg-slate-50 border-none rounded-lg text-xs focus:ring-1 focus:ring-brand-purple">
                <option value="">Semua Status</option>
                <option value="Menunggu">Menunggu</option>
                <option value="Pending">Pending</option>
                <option value="Diproses">Diproses</option>
                <option value="Proses">Proses</option>
                <option value="Dalam Pengiriman">Dalam Pengiriman</option>
                <option value="Selesai">Selesai</option>
                <option value="Dibatalkan">Dibatalkan</option>
                <option value="Ditolak">Ditolak</option>
                <option value="Batal">Batal</option>
            </select>
            <button class="flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 text-slate-600 rounded-lg text-xs font-medium">
                <i data-lucide="calendar" class="w-3.5 h-3.5"></i> Filter
            </button>
        </div>
    </div>

    {{-- Orders Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[9px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-50">
                        <th class="px-4 py-3">ID PESANAN</th>
                        <th class="px-4 py-3">KLIEN</th>
                        <th class="px-4 py-3">PRODUK</th>
                        <th class="px-4 py-3">JUMLAH</th>
                        <th class="px-4 py-3">TGL ORDER</th>
                        <th class="px-4 py-3">TGL UPDATE</th>
                        <th class="px-4 py-3">TOTAL BAYAR</th>
                        <th class="px-4 py-3">STATUS</th>
                        <th class="px-4 py-3 text-right">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50" id="ordersTableBody">
                    @forelse($orders as $order)
                    @php
                        $totalPembayaran = $order->pembayarans->sum('total') ?? 0;
                        $totalHarga = $order->total_harga ?? 0;
                        
                        // Warna untuk total bayar
                        if ($totalPembayaran == 0) {
                            $totalColor = 'text-slate-400';
                        } elseif ($totalPembayaran >= $totalHarga) {
                            $totalColor = 'text-emerald-600';
                        } else {
                            $totalColor = 'text-orange-600';
                        }
                        
                        // Warna untuk status
                        $statusClass = '';
                        switch ($order->status) {
                            case 'Selesai':
                                $statusClass = 'bg-emerald-100 text-emerald-600';
                                break;
                            case 'Dibatalkan':
                            case 'Ditolak':
                            case 'Batal':
                                $statusClass = 'bg-red-100 text-red-600';
                                break;
                            case 'Dalam Pengiriman':
                                $statusClass = 'bg-blue-100 text-blue-600';
                                break;
                            case 'Menunggu':
                                $statusClass = 'bg-yellow-100 text-yellow-600';
                                break;
                            case 'Pending':
                                $statusClass = 'bg-orange-100 text-orange-600';
                                break;
                            case 'Diproses':
                            case 'Proses':
                                $statusClass = 'bg-purple-100 text-purple-600';
                                break;
                            default:
                                $statusClass = 'bg-slate-100 text-slate-600';
                        }
                    @endphp
                    <tr class="text-xs text-slate-600 hover:bg-slate-50 transition-colors">
                        <td class="px-4 py-3 font-semibold text-brand-purple">
                            {{ $order->no_pengajuan ?? 'PJ-' . str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-[8px] font-bold text-slate-500">
                                    {{ getInitials($order->user->name ?? 'NA') }}
                                </div>
                                <span class="font-medium text-slate-800">{{ $order->user->name ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            {{ Str::limit($order->hargaParfum->nama_parfum ?? 'Produk', 20) }}
                        </td>
                        <td class="px-4 py-3">{{ number_format($order->jumlah, 0, ',', '.') }} unit</td>
                        <td class="px-4 py-3">{{ $order->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">{{ $order->updated_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 font-semibold {{ $totalColor }}">
                            Rp {{ number_format($totalPembayaran, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 rounded-lg text-[8px] font-bold {{ $statusClass }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-1">
                                <button onclick="viewOrder('{{ $order->id }}')" class="p-1 text-slate-400 hover:text-brand-purple rounded hover:bg-slate-50">
                                    <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                </button>
                                <button onclick="printOrder('{{ $order->id }}')" class="p-1 text-slate-400 hover:text-brand-purple rounded hover:bg-slate-50">
                                    <i data-lucide="printer" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-4 py-8 text-center text-slate-400 text-xs">
                            Tidak ada data pesanan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination dengan warna ungu --}}
        <div class="px-4 py-3 border-t border-slate-50 flex justify-between items-center">
            <p class="text-[9px] text-slate-400">
                Menampilkan {{ $orders->firstItem() ?? 0 }}-{{ $orders->lastItem() ?? 0 }} dari {{ $orders->total() }} pesanan
            </p>
            <div class="flex gap-1">
                {{-- Previous Page Link --}}
                @if ($orders->onFirstPage())
                    <span class="w-6 h-6 flex items-center justify-center rounded bg-slate-50 text-slate-300 cursor-not-allowed">
                        <i data-lucide="chevron-left" class="w-3 h-3"></i>
                    </span>
                @else
                    <a href="{{ $orders->previousPageUrl() }}" class="w-6 h-6 flex items-center justify-center rounded bg-slate-50 text-slate-400 hover:bg-brand-purple hover:text-white transition-colors">
                        <i data-lucide="chevron-left" class="w-3 h-3"></i>
                    </a>
                @endif
                
                {{-- Pagination Elements --}}
                @php
                    $start = max(1, $orders->currentPage() - 2);
                    $end = min($orders->lastPage(), $orders->currentPage() + 2);
                @endphp
                
                {{-- Link to First Page --}}
                @if ($start > 1)
                    <a href="{{ $orders->url(1) }}" class="w-6 h-6 flex items-center justify-center rounded bg-slate-50 text-slate-400 hover:bg-brand-purple hover:text-white transition-colors text-xs">1</a>
                    @if ($start > 2)
                        <span class="w-6 h-6 flex items-center justify-center text-slate-400 text-xs">...</span>
                    @endif
                @endif
                
                {{-- Page Numbers --}}
                @for ($i = $start; $i <= $end; $i++)
                    @if ($i == $orders->currentPage())
                        <span class="w-6 h-6 flex items-center justify-center rounded bg-brand-purple text-white text-xs font-bold">{{ $i }}</span>
                    @else
                        <a href="{{ $orders->url($i) }}" class="w-6 h-6 flex items-center justify-center rounded bg-slate-50 text-slate-400 hover:bg-brand-purple hover:text-white transition-colors text-xs">{{ $i }}</a>
                    @endif
                @endfor
                
                {{-- Link to Last Page --}}
                @if ($end < $orders->lastPage())
                    @if ($end < $orders->lastPage() - 1)
                        <span class="w-6 h-6 flex items-center justify-center text-slate-400 text-xs">...</span>
                    @endif
                    <a href="{{ $orders->url($orders->lastPage()) }}" class="w-6 h-6 flex items-center justify-center rounded bg-slate-50 text-slate-400 hover:bg-brand-purple hover:text-white transition-colors text-xs">{{ $orders->lastPage() }}</a>
                @endif
                
                {{-- Next Page Link --}}
                @if ($orders->hasMorePages())
                    <a href="{{ $orders->nextPageUrl() }}" class="w-6 h-6 flex items-center justify-center rounded bg-slate-50 text-slate-400 hover:bg-brand-purple hover:text-white transition-colors">
                        <i data-lucide="chevron-right" class="w-3 h-3"></i>
                    </a>
                @else
                    <span class="w-6 h-6 flex items-center justify-center rounded bg-slate-50 text-slate-300 cursor-not-allowed">
                        <i data-lucide="chevron-right" class="w-3 h-3"></i>
                    </span>
                @endif
            </div>
        </div>
    </div>

    {{-- Export Section --}}
    <div class="mt-4 flex justify-end gap-2">
        <a href="{{ route('admin.riwayat.export.csv') }}" class="flex items-center gap-1.5 px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-medium text-slate-600 hover:bg-slate-50">
            <i data-lucide="download" class="w-3.5 h-3.5"></i>
            CSV
        </a>
        <a href="{{ route('admin.riwayat.export.pdf') }}" class="flex items-center gap-1.5 px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-medium text-slate-600 hover:bg-slate-50">
            <i data-lucide="file-text" class="w-3.5 h-3.5"></i>
            PDF
        </a>
    </div>
@endsection

@push('modals')
    {{-- Modal Detail Pesanan --}}
    <div id="orderDetailModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden">
            <div class="brand-purple p-4 text-white flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                    <h3 class="text-sm font-bold">Detail Pesanan</h3>
                </div>
                <button onclick="closeOrderModal()" class="text-white/70 hover:text-white">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
            
            <div class="p-5 space-y-4 max-h-[80vh] overflow-y-auto">
                {{-- Info Umum --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-[9px] font-bold text-slate-400 uppercase mb-0.5">ID Pesanan</p>
                        <p class="text-xs font-semibold text-brand-purple" id="detail-id"></p>
                    </div>
                    <div>
                        <p class="text-[9px] font-bold text-slate-400 uppercase mb-0.5">Status</p>
                        <p class="text-xs" id="detail-status"></p>
                    </div>
                    <div>
                        <p class="text-[9px] font-bold text-slate-400 uppercase mb-0.5">Klien</p>
                        <p class="text-xs font-medium" id="detail-client"></p>
                    </div>
                    <div>
                        <p class="text-[9px] font-bold text-slate-400 uppercase mb-0.5">Produk</p>
                        <p class="text-xs font-medium" id="detail-product"></p>
                    </div>
                    <div>
                        <p class="text-[9px] font-bold text-slate-400 uppercase mb-0.5">Aroma</p>
                        <p class="text-xs" id="detail-aroma"></p>
                    </div>
                    <div>
                        <p class="text-[9px] font-bold text-slate-400 uppercase mb-0.5">Kemasan</p>
                        <p class="text-xs" id="detail-kemasan"></p>
                    </div>
                    <div>
                        <p class="text-[9px] font-bold text-slate-400 uppercase mb-0.5">Jumlah</p>
                        <p class="text-xs" id="detail-quantity"></p>
                    </div>
                    <div>
                        <p class="text-[9px] font-bold text-slate-400 uppercase mb-0.5">Tgl Order</p>
                        <p class="text-xs" id="detail-order-date"></p>
                    </div>
                </div>

                {{-- Info Pembayaran --}}
                <div class="bg-slate-50 p-3 rounded-lg">
                    <h4 class="text-xs font-bold text-slate-700 mb-2 flex items-center gap-1">
                        <i data-lucide="wallet" class="w-3.5 h-3.5"></i> Detail Pembayaran
                    </h4>
                    
                    <div class="grid grid-cols-3 gap-3 mb-3">
                        <div class="bg-white p-2 rounded border border-slate-200">
                            <p class="text-[8px] text-slate-400 uppercase">Total Harga</p>
                            <p class="text-xs font-bold text-slate-700" id="detail-total-harga"></p>
                        </div>
                        <div class="bg-white p-2 rounded border border-slate-200">
                            <p class="text-[8px] text-slate-400 uppercase">Total Bayar</p>
                            <p class="text-xs font-bold text-emerald-600" id="detail-total-pembayaran"></p>
                        </div>
                        <div class="bg-white p-2 rounded border border-slate-200">
                            <p class="text-[8px] text-slate-400 uppercase">Sisa</p>
                            <p class="text-xs font-bold text-orange-600" id="detail-sisa-pembayaran"></p>
                        </div>
                    </div>
                    
                    <div>
                        <p class="text-[9px] font-bold text-slate-400 uppercase mb-1">Status Pembayaran</p>
                        <p class="text-xs" id="detail-payment"></p>
                    </div>
                </div>

                {{-- Riwayat Pembayaran --}}
                <div id="payment-history-container" style="display: none;">
                    <h4 class="text-xs font-bold text-slate-700 mb-2 flex items-center gap-1">
                        <i data-lucide="history" class="w-3.5 h-3.5"></i> Riwayat Pembayaran
                    </h4>
                    <div class="space-y-2" id="payment-history-list">
                        <!-- Akan diisi oleh JavaScript -->
                    </div>
                </div>
                
                {{-- Catatan --}}
                <div>
                    <p class="text-[9px] font-bold text-slate-400 uppercase mb-0.5">Catatan</p>
                    <p class="text-xs bg-slate-50 p-2 rounded-lg" id="detail-notes"></p>
                </div>
                
                <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                    <button onclick="closeOrderModal()" class="px-4 py-1.5 border border-slate-200 rounded-lg text-xs font-medium text-slate-600 hover:bg-slate-50">Tutup</button>
                    <button onclick="printCurrentOrder()" class="px-4 py-1.5 brand-purple text-white rounded-lg text-xs font-medium flex items-center gap-1.5">
                        <i data-lucide="printer" class="w-3.5 h-3.5"></i> Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
<script>
    let currentOrderId = null;

    function viewOrder(orderId) {
        currentOrderId = orderId;
        
        fetch(`/admin/riwayat-pesanan/${orderId}`)
            .then(response => response.json())
            .then(order => {
                // Info Umum
                document.getElementById('detail-id').textContent = order.no_pengajuan;
                document.getElementById('detail-status').innerHTML = `<span class="px-2 py-0.5 rounded-lg text-[8px] font-bold ${order.status_color}">${order.status}</span>`;
                document.getElementById('detail-client').textContent = order.client;
                document.getElementById('detail-product').textContent = order.product;
                document.getElementById('detail-aroma').textContent = order.aroma;
                document.getElementById('detail-kemasan').textContent = order.kemasan;
                document.getElementById('detail-quantity').textContent = order.quantity;
                document.getElementById('detail-order-date').textContent = new Date(order.order_date).toLocaleDateString('id-ID');
                
                // Info Pembayaran
                document.getElementById('detail-total-harga').textContent = order.total_harga;
                document.getElementById('detail-total-pembayaran').textContent = order.total_pembayaran;
                document.getElementById('detail-sisa-pembayaran').textContent = order.sisa_pembayaran;
                document.getElementById('detail-payment').innerHTML = `<span class="px-2 py-0.5 rounded-lg text-[8px] font-bold ${order.payment_color}">${order.payment_status}</span>`;
                
                // Catatan
                document.getElementById('detail-notes').textContent = order.notes || '-';
                
                // Tampilkan riwayat pembayaran jika ada
                if (order.payment_details && order.payment_details.length > 0) {
                    document.getElementById('payment-history-container').style.display = 'block';
                    const historyList = document.getElementById('payment-history-list');
                    historyList.innerHTML = '';
                    
                    order.payment_details.forEach(payment => {
                        const item = document.createElement('div');
                        item.className = 'bg-white p-2 rounded border border-slate-200 flex justify-between items-center text-xs';
                        item.innerHTML = `
                            <div>
                                <span class="text-slate-600">${payment.tanggal}</span>
                                <span class="ml-2 text-slate-400">${payment.metode}</span>
                            </div>
                            <div>
                                <span class="font-semibold text-emerald-600">${payment.total}</span>
                                <span class="ml-2 text-[8px] px-1.5 py-0.5 bg-emerald-100 text-emerald-600 rounded">${payment.status}</span>
                            </div>
                        `;
                        historyList.appendChild(item);
                    });
                } else {
                    document.getElementById('payment-history-container').style.display = 'none';
                }
                
                document.getElementById('orderDetailModal').classList.remove('hidden');
                document.getElementById('orderDetailModal').classList.add('flex');
                
                // Refresh icons
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal mengambil data pesanan');
            });
    }
    
    function closeOrderModal() {
        document.getElementById('orderDetailModal').classList.remove('flex');
        document.getElementById('orderDetailModal').classList.add('hidden');
    }
    
    function printOrder(orderId) {
        window.open(`/admin/riwayat-pesanan/${orderId}/print`, '_blank');
    }
    
    function printCurrentOrder() {
        if (currentOrderId) {
            printOrder(currentOrderId);
        }
    }

    // Filter functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        filterTable();
    });

    document.getElementById('statusFilter').addEventListener('change', function() {
        filterTable();
    });

    function filterTable() {
        const searchText = document.getElementById('searchInput').value.toLowerCase();
        const statusFilter = document.getElementById('statusFilter').value;
        const rows = document.querySelectorAll('#ordersTableBody tr');

        rows.forEach(row => {
            if (row.cells.length > 1 && row.cells[0].textContent !== 'Tidak ada data pesanan') {
                const id = row.cells[0]?.textContent.toLowerCase() || '';
                const client = row.cells[1]?.textContent.toLowerCase() || '';
                const status = row.cells[7]?.textContent.trim() || '';
                
                const matchesSearch = id.includes(searchText) || client.includes(searchText);
                const matchesStatus = !statusFilter || status === statusFilter;
                
                row.style.display = matchesSearch && matchesStatus ? '' : 'none';
            }
        });
    }
</script>
@endpush