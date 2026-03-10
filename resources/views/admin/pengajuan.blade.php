@extends('layouts.admin')

@section('title', 'Persetujuan Pengajuan - PT Arum Jaya Gemilang')
@section('page-title', 'Persetujuan & Antrean Pengajuan')
@section('page-subtitle', 'Kelola pengajuan maklon baru dari klien Anda.')

@section('content')
    {{-- Flash Messages --}}
    @if(session('success'))
    <div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-2xl p-4 flex items-center gap-3">
        <div class="p-2 bg-emerald-100 rounded-lg"><i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i></div>
        <p class="text-sm text-emerald-700 font-medium">{{ session('success') }}</p>
    </div>
    @endif
    @if(session('deleted'))
    <div class="mb-6 bg-red-50 border border-red-200 rounded-2xl p-4 flex items-center gap-3">
        <div class="p-2 bg-red-100 rounded-lg"><i data-lucide="x-circle" class="w-5 h-5 text-red-600"></i></div>
        <p class="text-sm text-red-700 font-medium">{{ session('deleted') }}</p>
    </div>
    @endif
    @if(session('error'))
    <div class="mb-6 bg-orange-50 border border-orange-200 rounded-2xl p-4 flex items-center gap-3">
        <div class="p-2 bg-orange-100 rounded-lg"><i data-lucide="alert-circle" class="w-5 h-5 text-orange-600"></i></div>
        <p class="text-sm text-orange-700 font-medium">{{ session('error') }}</p>
    </div>
    @endif

    {{-- Stats Cards --}}
    @php
        $totalPending  = \App\Models\Pengajuan::where('status','pending')->count();
        $totalProses   = \App\Models\Pengajuan::where('status','proses')->count();
        $totalSelesai  = \App\Models\Pengajuan::where('status','selesai')->count();
    @endphp
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="bg-amber-50 text-amber-600 p-3 rounded-xl"><i data-lucide="clock" class="w-6 h-6"></i></div>
            <div>
                <p class="text-slate-400 text-xs font-medium uppercase tracking-wider">Menunggu Persetujuan</p>
                <span class="text-3xl font-bold text-slate-800">{{ $totalPending }}</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="bg-blue-50 text-blue-600 p-3 rounded-xl"><i data-lucide="flask-conical" class="w-6 h-6"></i></div>
            <div>
                <p class="text-slate-400 text-xs font-medium uppercase tracking-wider">Sedang Diproses</p>
                <span class="text-3xl font-bold text-slate-800">{{ $totalProses }}</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="bg-emerald-50 text-emerald-600 p-3 rounded-xl"><i data-lucide="check-circle" class="w-6 h-6"></i></div>
            <div>
                <p class="text-slate-400 text-xs font-medium uppercase tracking-wider">Selesai</p>
                <span class="text-3xl font-bold text-slate-800">{{ $totalSelesai }}</span>
            </div>
        </div>
    </div>

    {{-- Main Content + Sidebar --}}
    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Daftar Pengajuan --}}
        <div class="flex-1 space-y-6">
            {{-- Search Bar --}}
            <form method="GET" action="{{ route('admin.pengajuan') }}" class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex gap-4">
                <div class="flex-1 relative">
                    <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama klien..."
                        class="w-full pl-10 pr-4 py-2 bg-slate-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-purple-500 outline-none">
                </div>
                <button type="submit" class="flex items-center gap-2 px-4 py-2 bg-purple-600 text-white rounded-xl text-sm font-semibold hover:bg-purple-700 transition-colors">
                    <i data-lucide="search" class="w-4 h-4"></i> Cari
                </button>
            </form>

            {{-- List Pengajuan --}}
            @forelse ($submissions as $sub)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-6">
                    {{-- Header --}}
                    <div class="flex flex-col sm:flex-row justify-between items-start gap-4 mb-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-purple-50 flex items-center justify-center font-bold text-purple-600">
                                {{ strtoupper(substr($sub->user->name, 0, 2)) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800">{{ $sub->user->name }}</h4>
                                <p class="text-xs text-slate-400 uppercase tracking-wider">
                                    ID: PJ-{{ str_pad($sub->id, 5, '0', STR_PAD_LEFT) }} • {{ $sub->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <span class="bg-amber-50 text-amber-600 px-3 py-1 rounded-lg text-[10px] font-bold uppercase">
                            MENUNGGU APPROVAL
                        </span>
                    </div>

                    {{-- Detail Grid --}}
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 p-4 bg-slate-50 rounded-2xl mb-6">
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Jenis Parfum</p>
                            <p class="text-sm font-semibold text-slate-700">{{ $sub->jenis_parfum }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Jumlah</p>
                            <p class="text-sm font-semibold text-slate-700">{{ number_format($sub->jumlah) }} unit</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Target Market</p>
                            <p class="text-sm font-semibold text-slate-700">{{ $sub->target_market ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Tanggal</p>
                            <p class="text-sm font-semibold text-slate-700">{{ $sub->created_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    @if($sub->catatan)
                    <p class="text-xs text-slate-500 bg-slate-50 rounded-xl px-4 py-3 mb-4 italic">"{{ $sub->catatan }}"</p>
                    @endif

                    {{-- Action Buttons --}}
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <span class="text-xs text-slate-400 font-medium">Status: <span class="text-amber-600 font-bold">Pending</span></span>
                        <div class="flex gap-3 w-full sm:w-auto">
                            <button onclick="openTolakModal({{ $sub->id }})"
                                class="flex-1 sm:flex-none px-6 py-2 border border-red-200 rounded-xl text-sm font-bold text-red-500 hover:bg-red-50 transition-all">
                                Tolak
                            </button>
                            <button onclick="openSetujuModal({{ $sub->id }}, '{{ $sub->jenis_parfum }}')"
                                class="flex-1 sm:flex-none px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-xl text-sm font-bold flex items-center justify-center gap-2 transition-all">
                                <i data-lucide="check" class="w-4 h-4"></i> Setujui
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-12 text-center">
                <div class="w-20 h-20 mx-auto bg-slate-50 rounded-full flex items-center justify-center mb-4">
                    <i data-lucide="inbox" class="w-10 h-10 text-slate-300"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">Belum Ada Pengajuan</h3>
                <p class="text-sm text-slate-400">Tidak ada pengajuan yang menunggu persetujuan saat ini.</p>
            </div>
            @endforelse
        </div>

        {{-- Sidebar Antrean Prioritas --}}
        <div class="lg:w-80 space-y-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 sticky top-6">
                <h3 class="font-bold text-slate-800 flex items-center gap-2 mb-6">
                    <i data-lucide="zap" class="w-4 h-4 text-purple-600"></i> Antrean Prioritas
                </h3>
                <div class="space-y-4">
                    @forelse($priorities as $p)
                    <div class="relative pl-4 border-l-2 {{ $p->jumlah > 1000 ? 'border-red-400' : 'border-slate-200' }}">
                        <p class="text-[10px] font-medium text-slate-400 mb-1">{{ $p->created_at->diffForHumans() }}</p>
                        <h5 class="text-sm font-bold text-slate-800">{{ $p->user->name }}</h5>
                        <p class="text-xs text-slate-500 mb-2">{{ $p->jenis_parfum }} — {{ number_format($p->jumlah) }} unit</p>
                        @if($p->jumlah > 1000)
                        <span class="text-[10px] font-bold text-red-500 uppercase">⚠ Volume Tinggi</span>
                        @endif
                    </div>
                    @empty
                    <p class="text-sm text-slate-400 text-center py-4">Tidak ada antrean</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-slate-900 p-6 rounded-2xl text-white">
                <h4 class="text-[10px] font-bold text-yellow-400 uppercase tracking-wider mb-3">Insight Produksi</h4>
                @php $totalUnit = $submissions->sum('jumlah'); @endphp
                <p class="text-xs text-slate-400 leading-relaxed">
                    Terdapat <span class="font-bold text-white">{{ $submissions->count() }} pengajuan</span> menunggu persetujuan
                    dengan total <span class="font-bold text-white">{{ number_format($totalUnit) }} unit</span> yang perlu dijadwalkan.
                </p>
            </div>
        </div>
    </div>
@endsection

{{-- ===================== MODALS ===================== --}}
@push('modals')

{{-- Modal Setujui --}}
<div id="modalSetuju" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl p-8 w-full max-w-md shadow-2xl">
        <div class="flex items-center gap-4 mb-6">
            <div class="p-3 bg-purple-50 rounded-full"><i data-lucide="check-circle" class="w-6 h-6 text-purple-600"></i></div>
            <div>
                <h2 class="text-xl font-bold text-slate-800">Setujui Pengajuan</h2>
                <p class="text-sm text-slate-500" id="setuju-subtitle">Isi detail persetujuan di bawah</p>
            </div>
        </div>
        <form id="formSetuju" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Total Harga Estimasi (Rp) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="total_harga" required min="0" placeholder="Contoh: 15000000"
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none">
                    <p class="text-xs text-slate-400 mt-1">Estimasi total biaya produksi untuk klien</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Target Selesai <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="estimasi_selesai" required min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent outline-none">
                </div>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="button" onclick="closeModal('modalSetuju')"
                    class="flex-1 py-2.5 bg-slate-100 text-slate-600 rounded-xl font-medium hover:bg-slate-200 transition-colors">
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 py-2.5 bg-purple-600 text-white rounded-xl font-bold hover:bg-purple-700 transition-colors flex items-center justify-center gap-2">
                    <i data-lucide="check" class="w-4 h-4"></i> Konfirmasi Setujui
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Tolak --}}
<div id="modalTolak" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl p-8 w-full max-w-md shadow-2xl">
        <div class="flex items-center gap-4 mb-6">
            <div class="p-3 bg-red-50 rounded-full"><i data-lucide="x-circle" class="w-6 h-6 text-red-500"></i></div>
            <div>
                <h2 class="text-xl font-bold text-slate-800">Tolak Pengajuan</h2>
                <p class="text-sm text-slate-500">Berikan alasan penolakan yang jelas</p>
            </div>
        </div>
        <form id="formTolak" method="POST">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                    Alasan Penolakan <span class="text-red-500">*</span>
                </label>
                <textarea name="alasan_tolak" required rows="4" minlength="10"
                    placeholder="Jelaskan alasan penolakan, contoh: Kapasitas produksi penuh, stok bahan baku tidak mencukupi, dll."
                    class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-400 focus:border-transparent outline-none resize-none"></textarea>
                <p class="text-xs text-slate-400 mt-1">Minimal 10 karakter. Alasan ini akan dicatat di sistem.</p>
            </div>
            <div class="flex gap-3 mt-6">
                <button type="button" onclick="closeModal('modalTolak')"
                    class="flex-1 py-2.5 bg-slate-100 text-slate-600 rounded-xl font-medium hover:bg-slate-200 transition-colors">
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 py-2.5 bg-red-500 text-white rounded-xl font-bold hover:bg-red-600 transition-colors">
                    Konfirmasi Tolak
                </button>
            </div>
        </form>
    </div>
</div>

@endpush

@push('scripts')
<script>
    function openSetujuModal(id, product) {
        document.getElementById('formSetuju').action = "{{ url('admin/pengajuan') }}/" + id + "/setuju";
        document.getElementById('setuju-subtitle').textContent = 'Produk: ' + product;
        openModal('modalSetuju');
    }

    function openTolakModal(id) {
        document.getElementById('formTolak').action = "{{ url('admin/pengajuan') }}/" + id + "/tolak";
        openModal('modalTolak');
    }

    function openModal(id) {
        const el = document.getElementById(id);
        el.classList.remove('hidden');
        el.classList.add('flex');
        lucide.createIcons();
    }

    function closeModal(id) {
        const el = document.getElementById(id);
        el.classList.remove('flex');
        el.classList.add('hidden');
    }

    // Close on backdrop click
    window.addEventListener('click', function(e) {
        if (e.target.classList.contains('bg-black/50')) {
            e.target.classList.remove('flex');
            e.target.classList.add('hidden');
        }
    });

    // Auto-dismiss flash messages
    setTimeout(() => {
        document.querySelectorAll('[class*="mb-6"][class*="rounded-2xl"]').forEach(el => {
            el.style.transition = 'opacity 0.5s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 500);
        });
    }, 5000);
</script>
@endpush
