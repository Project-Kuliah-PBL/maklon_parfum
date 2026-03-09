@extends('layouts.admin')

@section('title', 'Katalog Aroma - PT Arum Jaya Gemilang')
@section('page-title', 'Katalog Aroma & Kemasan')
@section('page-subtitle', 'Manajemen komponen produksi parfum PT Arum Jaya Gemilang.')

@push('styles')
<style>
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-slideDown {
        animation: slideDown 0.3s ease-out;
    }
</style>
@endpush

@section('content')
<div class="space-y-8">
    {{-- Notification Alert --}}
    @if ($message = Session::get('success'))
    <div id="successAlert" class="bg-emerald-50 border border-emerald-200 rounded-2xl p-4 flex items-center gap-3 animate-slideDown">
        <div class="p-2 bg-emerald-100 rounded-lg">
            <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i>
        </div>
        <div class="flex-1">
            <h3 class="font-semibold text-emerald-800">Berhasil!</h3>
            <p class="text-sm text-emerald-700">{{ $message }}</p>
        </div>
        <button onclick="closeAlert('successAlert')" class="p-1 hover:bg-emerald-100 rounded transition-colors">
            <i data-lucide="x" class="w-4 h-4 text-emerald-600"></i>
        </button>
    </div>
    @endif

    @if ($message = Session::get('deleted'))
    <div id="deletedAlert" class="bg-red-50 border border-red-200 rounded-2xl p-4 flex items-center gap-3 animate-slideDown">
        <div class="p-2 bg-red-100 rounded-lg">
            <i data-lucide="trash-2" class="w-5 h-5 text-red-600"></i>
        </div>
        <div class="flex-1">
            <h3 class="font-semibold text-red-800">Dihapus!</h3>
            <p class="text-sm text-red-700">{{ $message }}</p>
        </div>
        <button onclick="closeAlert('deletedAlert')" class="p-1 hover:bg-red-100 rounded transition-colors">
            <i data-lucide="x" class="w-4 h-4 text-red-600"></i>
        </button>
    </div>
    @endif

    @if ($message = Session::get('error'))
    <div id="errorAlert" class="bg-red-50 border border-red-200 rounded-2xl p-4 flex items-center gap-3 animate-slideDown">
        <div class="p-2 bg-red-100 rounded-lg">
            <i data-lucide="alert-circle" class="w-5 h-5 text-red-600"></i>
        </div>
        <div class="flex-1">
            <h3 class="font-semibold text-red-800">Gagal!</h3>
            <p class="text-sm text-red-700">{{ $message }}</p>
        </div>
        <button onclick="closeAlert('errorAlert')" class="p-1 hover:bg-red-100 rounded transition-colors">
            <i data-lucide="x" class="w-4 h-4 text-red-600"></i>
        </button>
    </div>
    @endif
    

    {{-- Section Katalog Aroma --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="p-2.5 bg-purple-50 text-brand-purple rounded-xl">
                    <i data-lucide="flower-2" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="font-bold text-slate-800">Katalog Aroma</h3>
                    <p class="text-xs text-slate-400">Daftar kategori aroma dan biayanya</p>
                </div>
            </div>
            <button onclick="openModal('modalAroma')" 
                class="w-full sm:w-auto bg-brand-purple-btn hover:opacity-90 text-white px-5 py-2.5 rounded-xl text-sm font-semibold flex items-center justify-center gap-2 transition-all">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Aroma
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 text-[11px] font-semibold text-slate-500 uppercase tracking-wider">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Nama Kategori</th>
                        <th class="px-6 py-4">Harga Aroma</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($aromaCategories as $cat)
                    <tr class="text-sm text-slate-600 hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-mono text-xs text-slate-400">
                            #{{ str_pad($cat->id, 3, '0', STR_PAD_LEFT) }}
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-800">
                            {{ $cat->nama_kategori }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-emerald-600">
                                Rp {{ number_format($cat->biaya_kategori, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                <button onclick="openModal('editAroma{{ $cat->id }}')"
                                    class="p-2 text-slate-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition-all"
                                    title="Edit">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </button>
                                <button onclick="openDeleteModal({{ $cat->id }})"
                                    class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all"
                                    title="Hapus">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="p-3 bg-slate-50 rounded-full">
                                    <i data-lucide="inbox" class="w-6 h-6 text-slate-300"></i>
                                </div>
                                <p class="text-sm text-slate-400">Belum ada data aroma</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Section Katalog Kemasan --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="p-2.5 bg-amber-50 text-amber-600 rounded-xl">
                    <i data-lucide="package" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="font-bold text-slate-800">Katalog Kemasan</h3>
                    <p class="text-xs text-slate-400">Daftar jenis kemasan dan biayanya</p>
                </div>
            </div>
            <button onclick="openModal('modalKemasan')" 
                class="w-full sm:w-auto bg-brand-purple-btn hover:opacity-90 text-white px-5 py-2.5 rounded-xl text-sm font-semibold flex items-center justify-center gap-2 transition-all">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Kemasan
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 text-[11px] font-semibold text-slate-500 uppercase tracking-wider">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Jenis Botol</th>
                        <th class="px-6 py-4">Ukuran</th>
                        <th class="px-6 py-4">Jenis Box</th>
                        <th class="px-6 py-4">Catatan</th>
                        <th class="px-6 py-4">Biaya</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($packagingItems as $item)
                    <tr class="text-sm text-slate-600 hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-mono text-xs text-slate-400">
                            #{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-800">
                            {{ $item->jenis_botol }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->ukuran }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->jenis_box ?: '-' }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs italic {{ $item->catatan ? 'text-slate-500' : 'text-slate-300' }}">
                                {{ $item->catatan ?: '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-emerald-600">
                                Rp {{ number_format($item->biaya_kemasan, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                <button onclick="openModal('editKemasan{{ $item->id }}')"
                                    class="p-2 text-slate-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition-all"
                                    title="Edit">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </button>
                                <button onclick="openDeleteKemasanModal({{ $item->id }})"
                                    class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all"
                                    title="Hapus">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="p-3 bg-slate-50 rounded-full">
                                    <i data-lucide="package" class="w-6 h-6 text-slate-300"></i>
                                </div>
                                <p class="text-sm text-slate-400">Belum ada data kemasan</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="pt-6 text-center">
        <p class="text-[11px] text-slate-400">© 2024 PT Arum Jaya Gemilang. All rights reserved. Perfume Manufacturing Dashboard v2.0</p>
    </footer>
</div>
@endsection

@push('modals')
{{-- Modal Tambah Aroma --}}
<div id="modalAroma" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-xl">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-slate-800">Tambah Aroma</h2>
            <button onclick="closeModal('modalAroma')" class="p-2 hover:bg-slate-100 rounded-lg transition-colors">
                <i data-lucide="x" class="w-5 h-5 text-slate-400"></i>
            </button>
        </div>
        <form action="{{ route('admin.aroma.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Kategori</label>
                <input type="text" name="nama_kategori" required
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-purple-300 focus:border-brand-purple transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Harga Aroma</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">Rp</span>
                    <input type="number" name="biaya_kategori" required
                        class="w-full border border-slate-200 rounded-xl pl-12 pr-4 py-2.5 focus:ring-2 focus:ring-purple-300 focus:border-brand-purple transition-all">
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeModal('modalAroma')" 
                    class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">
                    Batal
                </button>
                <button type="submit" 
                    class="px-5 py-2.5 bg-brand-purple-btn text-white text-sm font-medium rounded-xl hover:opacity-90 transition-all">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Tambah Kemasan --}}
<div id="modalKemasan" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-xl">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-slate-800">Tambah Kemasan</h2>
            <button onclick="closeModal('modalKemasan')" class="p-2 hover:bg-slate-100 rounded-lg transition-colors">
                <i data-lucide="x" class="w-5 h-5 text-slate-400"></i>
            </button>
        </div>
        <form action="{{ route('admin.kemasan.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Botol</label>
                <input type="text" name="jenis_botol" required
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-purple-300 focus:border-brand-purple transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Ukuran</label>
                <input type="text" name="ukuran" required
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-purple-300 focus:border-brand-purple transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Box</label>
                <input type="text" name="jenis_box"
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-purple-300 focus:border-brand-purple transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Catatan</label>
                <textarea name="catatan" rows="2"
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-purple-300 focus:border-brand-purple transition-all"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Biaya Kemasan</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">Rp</span>
                    <input type="number" name="biaya_kemasan" required
                        class="w-full border border-slate-200 rounded-xl pl-12 pr-4 py-2.5 focus:ring-2 focus:ring-purple-300 focus:border-brand-purple transition-all">
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeModal('modalKemasan')" 
                    class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">
                    Batal
                </button>
                <button type="submit" 
                    class="px-5 py-2.5 bg-brand-purple-btn text-white text-sm font-medium rounded-xl hover:opacity-90 transition-all">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Edit Aroma (Dynamic) --}}
@foreach ($aromaCategories as $cat)
<div id="editAroma{{ $cat->id }}" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-xl">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-slate-800">Edit Aroma</h2>
            <button onclick="closeModal('editAroma{{ $cat->id }}')" class="p-2 hover:bg-slate-100 rounded-lg transition-colors">
                <i data-lucide="x" class="w-5 h-5 text-slate-400"></i>
            </button>
        </div>
        <form action="{{ route('admin.aroma.update', $cat->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Kategori</label>
                <input type="text" name="nama_kategori" value="{{ $cat->nama_kategori }}" required
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-purple-300 focus:border-brand-purple transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Harga Aroma</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">Rp</span>
                    <input type="number" name="biaya_kategori" value="{{ $cat->biaya_kategori }}" required
                        class="w-full border border-slate-200 rounded-xl pl-12 pr-4 py-2.5 focus:ring-2 focus:ring-purple-300 focus:border-brand-purple transition-all">
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeModal('editAroma{{ $cat->id }}')" 
                    class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">
                    Batal
                </button>
                <button type="submit" 
                    class="px-5 py-2.5 bg-brand-purple-btn text-white text-sm font-medium rounded-xl hover:opacity-90 transition-all">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endforeach

{{-- Modal Edit Kemasan (Dynamic) --}}
@foreach ($packagingItems as $item)
<div id="editKemasan{{ $item->id }}" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-xl">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-slate-800">Edit Kemasan</h2>
            <button onclick="closeModal('editKemasan{{ $item->id }}')" class="p-2 hover:bg-slate-100 rounded-lg transition-colors">
                <i data-lucide="x" class="w-5 h-5 text-slate-400"></i>
            </button>
        </div>
        <form action="{{ route('admin.kemasan.update', $item->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Botol</label>
                <input type="text" name="jenis_botol" value="{{ $item->jenis_botol }}" required
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-purple-300 focus:border-brand-purple transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Ukuran</label>
                <input type="text" name="ukuran" value="{{ $item->ukuran }}" required
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-purple-300 focus:border-brand-purple transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Box</label>
                <input type="text" name="jenis_box" value="{{ $item->jenis_box }}"
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-purple-300 focus:border-brand-purple transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Catatan</label>
                <textarea name="catatan" rows="2"
                    class="w-full border border-slate-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-purple-300 focus:border-brand-purple transition-all">{{ $item->catatan }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Biaya Kemasan</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">Rp</span>
                    <input type="number" name="biaya_kemasan" value="{{ $item->biaya_kemasan }}" required
                        class="w-full border border-slate-200 rounded-xl pl-12 pr-4 py-2.5 focus:ring-2 focus:ring-purple-300 focus:border-brand-purple transition-all">
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeModal('editKemasan{{ $item->id }}')" 
                    class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">
                    Batal
                </button>
                <button type="submit" 
                    class="px-5 py-2.5 bg-brand-purple-btn text-white text-sm font-medium rounded-xl hover:opacity-90 transition-all">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endforeach

{{-- Modal Delete Aroma --}}
<div id="deleteAromaModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-xl">
        <div class="flex items-center gap-4 mb-6">
            <div class="p-3 bg-red-50 rounded-full">
                <i data-lucide="alert-triangle" class="w-6 h-6 text-red-500"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-slate-800">Hapus Aroma</h2>
                <p class="text-sm text-slate-500">Tindakan ini tidak dapat dibatalkan</p>
            </div>
        </div>
        <p class="text-sm text-slate-600 mb-6">
            Apakah Anda yakin ingin menghapus kategori aroma ini? Data yang dihapus tidak dapat dikembalikan.
        </p>
        <form id="deleteAromaForm" method="POST" class="flex justify-end gap-3">
            @csrf
            @method('DELETE')
            <button type="button" onclick="closeDeleteModal()" 
                class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">
                Batal
            </button>
            <button type="submit" 
                class="px-5 py-2.5 bg-red-500 text-white text-sm font-medium rounded-xl hover:bg-red-600 transition-colors">
                Hapus
            </button>
        </form>
    </div>
</div>

{{-- Modal Delete Kemasan --}}
<div id="deleteKemasanModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-xl">
        <div class="flex items-center gap-4 mb-6">
            <div class="p-3 bg-red-50 rounded-full">
                <i data-lucide="alert-triangle" class="w-6 h-6 text-red-500"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold text-slate-800">Hapus Kemasan</h2>
                <p class="text-sm text-slate-500">Tindakan ini tidak dapat dibatalkan</p>
            </div>
        </div>
        <p class="text-sm text-slate-600 mb-6">
            Apakah Anda yakin ingin menghapus kemasan ini? Data yang dihapus tidak dapat dikembalikan.
        </p>
        <form id="deleteKemasanForm" method="POST" class="flex justify-end gap-3">
            @csrf
            @method('DELETE')
            <button type="button" onclick="closeDeleteKemasanModal()" 
                class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl transition-colors">
                Batal
            </button>
            <button type="submit" 
                class="px-5 py-2.5 bg-red-500 text-white text-sm font-medium rounded-xl hover:bg-red-600 transition-colors">
                Hapus
            </button>
        </form>
    </div>
</div>
@endpush

@push('scripts')
<script>
    lucide.createIcons();

    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.getElementById(id).classList.add('flex');
        lucide.createIcons();
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('flex');
        document.getElementById(id).classList.add('hidden');
    }

    function closeAlert(id) {
        const alert = document.getElementById(id);
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-10px)';
        setTimeout(() => {
            alert.remove();
        }, 300);
    }

    // Auto-dismiss notifications after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('[id$="Alert"]');
        alerts.forEach(alert => {
            setTimeout(() => {
                if (alert && alert.parentNode) {
                    closeAlert(alert.id);
                }
            }, 5000);
        });
    });

    function openDeleteModal(id) {
        let modal = document.getElementById('deleteAromaModal');
        let form = document.getElementById('deleteAromaForm');
        form.action = "{{ url('admin/aroma') }}/" + id;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        lucide.createIcons();
    }

    function closeDeleteModal() {
        let modal = document.getElementById('deleteAromaModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

    function openDeleteKemasanModal(id) {
        let modal = document.getElementById('deleteKemasanModal');
        let form = document.getElementById('deleteKemasanForm');
        form.action = "{{ url('admin/kemasan') }}/" + id;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        lucide.createIcons();
    }

    function closeDeleteKemasanModal() {
        let modal = document.getElementById('deleteKemasanModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target.classList.contains('bg-black/40')) {
            event.target.classList.remove('flex');
            event.target.classList.add('hidden');
        }
    }
</script>
@endpush