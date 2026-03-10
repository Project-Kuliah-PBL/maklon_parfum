@extends('layouts.admin')

@section('title', 'Monitoring Produksi - PT Arum Jaya Gemilang')
@section('page-title', 'Monitoring Produksi')
@section('page-subtitle', 'Pantau status real-time setiap batch produksi di lantai pabrik.')

@section('content')
    {{-- Flash Messages --}}
    @if(session('success'))
    <div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-2xl p-4 flex items-center gap-3">
        <div class="p-2 bg-emerald-100 rounded-lg"><i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i></div>
        <p class="text-sm text-emerald-700 font-medium">{{ session('success') }}</p>
    </div>
    @endif

    {{-- Stats --}}
    @php
        $totalProses  = \App\Models\Pengajuan::where('status','proses')->count();
        $totalSelesai = \App\Models\Pengajuan::where('status','selesai')->count();
        $totalPending = \App\Models\Pengajuan::where('status','pending')->count();
    @endphp
    <div class="grid grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="bg-blue-50 text-blue-600 p-3 rounded-xl"><i data-lucide="flask-conical" class="w-6 h-6"></i></div>
            <div>
                <p class="text-slate-400 text-xs font-medium uppercase">Sedang Diproduksi</p>
                <span class="text-3xl font-bold text-slate-800">{{ $totalProses }}</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="bg-emerald-50 text-emerald-600 p-3 rounded-xl"><i data-lucide="check-circle" class="w-6 h-6"></i></div>
            <div>
                <p class="text-slate-400 text-xs font-medium uppercase">Selesai</p>
                <span class="text-3xl font-bold text-slate-800">{{ $totalSelesai }}</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="bg-amber-50 text-amber-600 p-3 rounded-xl"><i data-lucide="clock" class="w-6 h-6"></i></div>
            <div>
                <p class="text-slate-400 text-xs font-medium uppercase">Antrian Berikutnya</p>
                <span class="text-3xl font-bold text-slate-800">{{ $totalPending }}</span>
            </div>
        </div>
    </div>

    {{-- Tabel Batch Produksi --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center">
            <h3 class="font-bold text-slate-800">Batch Produksi Aktif</h3>
            <form method="GET" class="flex gap-2">
                <div class="relative">
                    <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ID/Klien..."
                        class="pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm w-52 outline-none focus:ring-2 focus:ring-purple-500">
                </div>
                <button type="submit" class="px-4 py-2 bg-slate-100 text-slate-600 rounded-xl text-sm font-medium hover:bg-slate-200">
                    Cari
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 text-[11px] font-semibold text-slate-500 uppercase tracking-wider">
                        <th class="px-6 py-4 text-left">ID Proyek</th>
                        <th class="px-6 py-4 text-left">Klien</th>
                        <th class="px-6 py-4 text-left">Produk</th>
                        <th class="px-6 py-4 text-left">Jumlah</th>
                        <th class="px-6 py-4 text-left">Progress</th>
                        <th class="px-6 py-4 text-left">Tahap Saat Ini</th>
                        <th class="px-6 py-4 text-left">Target</th>
                        <th class="px-6 py-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($batches as $batch)
                    <tr class="text-sm text-slate-600 hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-mono text-xs text-purple-600 font-bold">{{ $batch['id'] }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-purple-50 flex items-center justify-center text-xs font-bold text-purple-600">
                                    {{ strtoupper(substr($batch['client'], 0, 2)) }}
                                </div>
                                <span class="font-medium text-slate-800">{{ $batch['client'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-700">{{ $batch['product'] }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ number_format($batch['jumlah']) }} unit</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="flex-1 h-2 bg-slate-100 rounded-full min-w-[80px]">
                                    <div class="h-2 rounded-full transition-all duration-300
                                        {{ $batch['progress'] >= 100 ? 'bg-emerald-500' : 'bg-purple-500' }}"
                                        style="width: {{ $batch['progress'] }}%">
                                    </div>
                                </div>
                                <span class="text-xs font-bold {{ $batch['progress'] >= 100 ? 'text-emerald-600' : 'text-slate-600' }}">
                                    {{ $batch['progress'] }}%
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded-lg text-xs font-semibold">
                                {{ $batch['status'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-xs text-slate-500">{{ $batch['eta'] }}</td>
                        <td class="px-6 py-4">
                            <button onclick="openUpdateModal({{ json_encode($batch) }})"
                                class="px-4 py-2 bg-purple-600 text-white rounded-xl text-xs font-bold hover:bg-purple-700 transition-colors flex items-center gap-1.5">
                                <i data-lucide="edit-3" class="w-3.5 h-3.5"></i> Update
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="p-4 bg-slate-50 rounded-full">
                                    <i data-lucide="flask-conical" class="w-8 h-8 text-slate-300"></i>
                                </div>
                                <p class="text-slate-400 font-medium">Tidak ada batch produksi aktif saat ini</p>
                                <p class="text-sm text-slate-400">Setujui pengajuan terlebih dahulu untuk memulai produksi</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('modals')
{{-- Modal Update Progress Produksi --}}
<div id="progressModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
    <div class="bg-white w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden">
        {{-- Header --}}
        <div class="bg-purple-700 p-6 text-white flex justify-between items-center">
            <div class="flex items-center gap-3">
                <i data-lucide="list-checks" class="w-6 h-6"></i>
                <h3 class="text-lg font-bold">Update Progres Produksi</h3>
            </div>
            <button onclick="closeProgressModal()" class="text-white/70 hover:text-white">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        {{-- Body --}}
        <form id="formUpdateProduksi" method="POST">
            @csrf
            <div class="p-8 space-y-5">
                {{-- Info --}}
                <div class="flex justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">ID Proyek</p>
                        <p class="text-sm font-bold text-purple-600" id="modal-id"></p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Produk</p>
                        <p class="text-sm font-bold text-slate-700" id="modal-product"></p>
                    </div>
                </div>

                {{-- Tahap Produksi --}}
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Tahap Produksi Saat Ini</label>
                    <select name="tahapan" id="modal-stage-select"
                        class="w-full p-3 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-purple-500 outline-none">
                        <option value="Persiapan Bahan">Persiapan Bahan</option>
                        <option value="Mixing">Mixing</option>
                        <option value="Filling">Filling</option>
                        <option value="Packaging">Packaging</option>
                        <option value="QC">QC</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    {{-- Progress --}}
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Persentase (%)</label>
                        <div class="relative">
                            <input type="number" name="progress" id="modal-progress" min="0" max="100" required
                                class="w-full p-3 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-purple-500">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm">%</span>
                        </div>
                    </div>
                    {{-- Estimasi Selesai --}}
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Target Selesai (Revisi)</label>
                        <input type="date" name="estimasi_selesai" id="modal-eta"
                            class="w-full p-3 border border-slate-200 rounded-xl text-sm outline-none text-slate-600 focus:ring-2 focus:ring-purple-500">
                    </div>
                </div>

                {{-- Catatan --}}
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Catatan Internal</label>
                    <textarea name="catatan" id="modal-catatan" rows="3"
                        placeholder="Tambahkan catatan untuk tim produksi..."
                        class="w-full p-4 border border-slate-200 rounded-xl text-sm outline-none resize-none focus:ring-2 focus:ring-purple-500"></textarea>
                </div>

                {{-- Footer Buttons --}}
                <div class="flex gap-4 pt-2">
                    <button type="button" onclick="closeProgressModal()"
                        class="flex-1 py-3 border border-slate-200 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 py-3 bg-purple-600 text-white rounded-xl text-sm font-bold hover:bg-purple-700 shadow-lg shadow-purple-200 transition-colors">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endpush

@push('scripts')
<script>
    function openUpdateModal(batch) {
        // Isi data ke modal
        document.getElementById('modal-id').textContent      = batch.id;
        document.getElementById('modal-product').textContent = batch.product;
        document.getElementById('modal-progress').value      = batch.progress;
        document.getElementById('modal-catatan').value       = '';

        // Set tahap yang aktif
        const stageSelect = document.getElementById('modal-stage-select');
        Array.from(stageSelect.options).forEach(opt => {
            opt.selected = (opt.value === batch.status);
        });

        // Set action form → POST ke /admin/produksi/{id}/update
        document.getElementById('formUpdateProduksi').action =
            "{{ url('admin/produksi') }}/" + batch.pengajuan_id + "/update";

        // Tampilkan modal
        const modal = document.getElementById('progressModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        lucide.createIcons();
    }

    function closeProgressModal() {
        const modal = document.getElementById('progressModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

    // Tutup saat klik backdrop
    document.getElementById('progressModal').addEventListener('click', function(e) {
        if (e.target === this) closeProgressModal();
    });

    // Auto-dismiss flash
    setTimeout(() => {
        document.querySelectorAll('[class*="mb-6"][class*="rounded-2xl"]').forEach(el => {
            el.style.transition = 'opacity 0.5s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 500);
        });
    }, 5000);
</script>
@endpush
