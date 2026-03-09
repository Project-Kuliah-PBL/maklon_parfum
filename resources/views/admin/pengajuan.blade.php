@extends('layouts.admin')

@section('title', 'Persetujuan Pengajuan - PT Arum Jaya Gemilang')
@section('page-title', 'Persetujuan & Antrean Pengajuan')
@section('page-subtitle', 'Kelola pengajuan maklon baru dari klien Anda.')

@section('content')
    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="bg-blue-50 text-blue-600 p-3 rounded-xl">
                <i data-lucide="mail" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-slate-400 text-xs font-medium uppercase tracking-wider">Total Pengajuan Baru</p>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-bold text-slate-800">12</span>
                    <span class="text-xs font-bold text-blue-500">+3 hari ini</span>
                </div>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="bg-emerald-50 text-emerald-600 p-3 rounded-xl">
                <i data-lucide="check-circle" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-slate-400 text-xs font-medium uppercase tracking-wider">Disetujui Minggu Ini</p>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-bold text-slate-800">45</span>
                    <span class="text-xs font-bold text-emerald-500">Lancar</span>
                </div>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="bg-amber-50 text-amber-600 p-3 rounded-xl">
                <i data-lucide="clock" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-slate-400 text-xs font-medium uppercase tracking-wider">Dalam Antrean</p>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-bold text-slate-800">8</span>
                    <span class="text-xs font-bold text-amber-500">Menunggu</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content dengan Sidebar --}}
    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Main Content --}}
        <div class="flex-1 space-y-6">
            {{-- Search Bar --}}
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex gap-4">
                <div class="flex-1 relative">
                    <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" placeholder="Cari nama klien..." 
                           class="w-full pl-10 pr-4 py-2 bg-slate-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-brand-purple">
                </div>
                <button class="flex items-center gap-2 px-4 py-2 bg-slate-50 text-slate-600 rounded-xl text-sm font-medium hover:bg-slate-100 transition-colors">
                    <i data-lucide="filter" class="w-4 h-4"></i> Filter
                </button>
            </div>

            {{-- Submissions List --}}
            @forelse ($submissions as $sub)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-6">
                    {{-- Header --}}
                    <div class="flex flex-col sm:flex-row justify-between items-start gap-4 mb-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-brand-purple/10 to-brand-gold/10 flex items-center justify-center font-bold text-brand-purple">
                                {{ strtoupper(substr(is_object($sub) && isset($sub->user) ? $sub->user->name : (is_array($sub) ? ($sub['client'] ?? '') : ''), 0, 2)) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800">
                                    {{ is_object($sub) && isset($sub->user) ? $sub->user->name : (is_array($sub) ? ($sub['client'] ?? 'N/A') : 'N/A') }}
                                </h4>
                                <p class="text-xs text-slate-400">
                                    ID: {{ is_object($sub) ? ('REQ-'.$sub->id) : (is_array($sub) ? ($sub['id'] ?? 'N/A') : 'N/A') }} • 
                                    {{ is_object($sub) ? $sub->created_at->diffForHumans() : (is_array($sub) ? ($sub['time'] ?? 'N/A') : 'N/A') }}
                                </p>
                            </div>
                        </div>
                        <span class="bg-orange-50 text-orange-600 px-3 py-1 rounded-lg text-[10px] font-bold self-start">
                            MENUNGGU APPROVAL
                        </span>
                    </div>

                    {{-- Detail Grid --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 p-4 bg-slate-50 rounded-2xl mb-6">
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Jenis</p>
                            <p class="text-sm font-semibold text-slate-700">
                                {{ is_object($sub) ? ($sub->jenis_parfum ?? '-') : (is_array($sub) ? ($sub['type'] ?? '-') : '-') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Aroma</p>
                            <p class="text-sm font-semibold text-slate-700">
                                @php
                                    if(is_object($sub) && method_exists($sub, 'aromas') && $sub->aromas) {
                                        echo $sub->aromas->pluck('nama_kategori')->implode(', ');
                                    } elseif(is_array($sub) && isset($sub['aroma'])) {
                                        echo $sub['aroma'];
                                    } else {
                                        echo '-';
                                    }
                                @endphp
                            </p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Jumlah</p>
                            <p class="text-sm font-semibold text-slate-700">
                                @php
                                    $amount = is_object($sub) ? ($sub->jumlah ?? 0) : (is_array($sub) ? (isset($sub['amount']) ? str_replace(['pcs', ' '], '', $sub['amount']) : 0) : 0);
                                    echo number_format($amount) . ' pcs';
                                @endphp
                            </p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Target Market</p>
                            <p class="text-sm font-semibold text-slate-700">
                                {{ is_object($sub) ? ($sub->target_market ?? '-') : (is_array($sub) ? ($sub['target'] ?? '-') : '-') }}
                            </p>
                        </div>
                    </div>

                    {{-- Actions --}}
                    {{-- Actions --}}
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div class="flex items-center gap-2">
        <span class="inline-flex items-center gap-1 text-xs text-slate-500">
            <i data-lucide="alert-circle" class="w-3 h-3"></i>
            Status: 
            @php
                $status = '';
                if(is_object($sub) && isset($sub->status)) {
                    $status = $sub->status;
                } elseif(is_array($sub) && isset($sub['status'])) {
                    $status = $sub['status'];
                }
            @endphp
            
            @if($status == 'proses' || $status == 'disetujui')
                <span class="font-medium text-emerald-600">{{ ucfirst($status) }}</span>
            @elseif($status == 'ditolak')
                <span class="font-medium text-red-600">{{ ucfirst($status) }}</span>
            @else
                <span class="font-medium text-amber-600">Pending</span>
            @endif
        </span>
    </div>
    
    {{-- Tampilkan tombol Tolak dan Setujui tanpa validasi status --}}
    <div class="flex gap-3 w-full sm:w-auto">
        <button class="flex-1 sm:flex-none px-6 py-2 border border-slate-200 rounded-xl text-sm font-bold text-red-500 hover:bg-red-50 hover:border-red-200 transition-all">
            Tolak
        </button>
        <button class="flex-1 sm:flex-none px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-xl text-sm font-bold flex items-center justify-center gap-2 transition-all">
            <i data-lucide="check" class="w-4 h-4"></i>
            Setujui
        </button>
    </div>
</div>
                </div>
            </div>
            @empty
            {{-- Empty State --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-12 text-center">
                <div class="w-20 h-20 mx-auto bg-slate-50 rounded-full flex items-center justify-center mb-4">
                    <i data-lucide="inbox" class="w-10 h-10 text-slate-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">Belum Ada Pengajuan</h3>
                <p class="text-sm text-slate-400 mb-6">Tidak ada pengajuan yang menunggu persetujuan saat ini.</p>
            </div>
            @endforelse

            {{-- Simple Pagination Info (tanpa links jika bukan paginator) --}}
            @if(method_exists($submissions, 'links'))
            <div class="mt-6">
                {{ $submissions->links() }}
            </div>
            @else
            <div class="flex justify-between items-center mt-6 text-sm text-slate-400">
                <span>Menampilkan {{ $submissions->count() }} pengajuan</span>
                @if($submissions->count() > 0)
                <span>Halaman 1 dari 1</span>
                @endif
            </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="lg:w-80 space-y-6">
            {{-- Priority Queue --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 sticky top-6">
                <h3 class="font-bold text-slate-800 flex items-center gap-2 mb-6">
                    <i data-lucide="zap" class="w-4 h-4 text-brand-purple"></i> 
                    Antrean Prioritas
                </h3>
                <div class="space-y-6">
                    @forelse ($priorities ?? [] as $p)
                    <div class="relative pl-4 border-l-2 {{ isset($p['urgent']) && $p['urgent'] ? 'border-red-400' : 'border-slate-200' }}">
                        <p class="text-[10px] font-medium text-slate-400 mb-1">{{ $p['wait'] ?? 'Menunggu' }}</p>
                        <h5 class="text-sm font-bold text-slate-800">{{ $p['name'] ?? 'N/A' }}</h5>
                        <p class="text-xs text-slate-500 mb-2">{{ $p['desc'] ?? '-' }}</p>
                        <a href="#" class="text-[10px] font-bold text-brand-purple hover:underline uppercase inline-flex items-center gap-1">
                            Detail <i data-lucide="arrow-right" class="w-3 h-3"></i>
                        </a>
                    </div>
                    @empty
                    <p class="text-sm text-slate-400 text-center py-4">Tidak ada antrean prioritas</p>
                    @endforelse
                </div>
            </div>

            

            {{-- Quick Actions --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Aksi Cepat</h4>
                <div class="space-y-2">
                    <button class="w-full flex items-center gap-3 p-3 text-left rounded-xl hover:bg-slate-50 transition-colors">
                        <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                            <i data-lucide="download" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-700">Export Data</p>
                            <p class="text-xs text-slate-400">Download laporan pengajuan</p>
                        </div>
                    </button>
                    <button class="w-full flex items-center gap-3 p-3 text-left rounded-xl hover:bg-slate-50 transition-colors">
                        <div class="p-2 bg-purple-50 rounded-lg text-brand-purple">
                            <i data-lucide="settings" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-700">Atur Prioritas</p>
                            <p class="text-xs text-slate-400">Ubah kriteria antrean</p>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection