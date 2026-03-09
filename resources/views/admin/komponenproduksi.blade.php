@extends('layouts.admin')

@section('title', 'Katalog Aroma - PT Arum Jaya Gemilang')
@section('page-title', 'Katalog Aroma & Kemasan')
@section('page-subtitle', 'Manajemen komponen produksi parfum PT Arum Jaya Gemilang.')

@section('content')
    {{-- Aroma Catalog --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-8">
        <div class="p-6 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-purple-50 text-brand-purple rounded-lg">
                    <i data-lucide="flask-conical" class="w-5 h-5"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-lg">Katalog Aroma</h3>
            </div>
            <button onclick="openModal('modalAroma')" 
                class="bg-brand-purple-btn hover:opacity-90 text-white px-6 py-2 rounded-xl text-sm font-bold flex items-center gap-2">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Kategori
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] font-bold text-slate-400 uppercase tracking-wider border-y border-slate-50">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Nama Kategori</th>
                        <th class="px-6 py-4">Harga Aroma</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach ($aromaCategories as $cat)
                    <tr class="text-sm text-slate-600 hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-400">{{ $cat->id }}</td>
                        <td class="px-6 py-4 font-bold text-slate-800">{{ $cat->nama_kategori }}</td>
                        <td class="px-6 py-4 font-medium text-emerald-600">
                            Rp {{ number_format($cat->biaya_kategori,0,',','.') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-3">
                                <button onclick="openModal('editAroma{{ $cat->id }}')" 
                                    class="text-slate-400 hover:text-blue-500">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </button>
                                <button onclick="openDeleteModal({{ $cat->id }})"
                                    class="text-slate-400 hover:text-red-500">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Packaging Catalog --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-purple-50 text-brand-purple rounded-lg">
                    <i data-lucide="package" class="w-5 h-5"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-lg">Katalog Kemasan</h3>
            </div>
            <button class="bg-brand-purple-btn hover:opacity-90 text-white px-6 py-2 rounded-xl text-sm font-bold flex items-center gap-2">
                <i data-lucide="plus" class="w-4 h-4"></i> Tambah Kemasan
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] font-bold text-slate-400 uppercase tracking-wider border-y border-slate-50">
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Jenis Botol</th>
                        <th class="px-6 py-4">Ukuran</th>
                        <th class="px-6 py-4">Jenis Box</th>
                        <th class="px-6 py-4">Catatan</th>
                        <th class="px-6 py-4">Biaya</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach ($packagingItems as $item)
                    <tr class="text-sm text-slate-600 hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-400">{{ $item->id }}</td>
                        <td class="px-6 py-4 font-bold text-slate-800">{{ $item->jenis_botol }}</td>
                        <td class="px-6 py-4">{{ $item->ukuran }}</td>
                        <td class="px-6 py-4">{{ $item->jenis_box }}</td>
                        <td class="px-6 py-4 text-xs italic">{{ $item->catatan }}</td>
                        <td class="px-6 py-4 font-bold text-emerald-600">
                            Rp {{ number_format($item->biaya_kemasan,0,',','.') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-3">
                                <button class="text-slate-400 hover:text-blue-500">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </button>
                                <form action="{{ route('admin.kemasan.delete',$item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-slate-400 hover:text-red-500">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <footer class="mt-12 text-center">
        <p class="text-[10px] text-slate-400">© 2024 PT Arum Jaya Gemilang. All rights reserved. Perfume Manufacturing Dashboard v2.0</p>
    </footer>
@endsection

@push('modals')
    {{-- Modal Tambah Aroma --}}
    <div id="modalAroma" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-96">
            <h2 class="text-lg font-bold mb-4">Tambah Kategori Aroma</h2>
            <form action="{{ route('admin.aroma.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="text-sm font-medium">Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="w-full border rounded-lg px-3 py-2 mt-1">
                </div>
                <div class="mb-4">
                    <label class="text-sm font-medium">Harga Aroma</label>
                    <input type="number" name="biaya_kategori" class="w-full border rounded-lg px-3 py-2 mt-1">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal('modalAroma')" class="px-4 py-2 text-gray-500">Batal</button>
                    <button class="bg-brand-purple-btn text-white px-4 py-2 rounded-lg">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit Aroma --}}
    @foreach ($aromaCategories as $cat)
    <div id="editAroma{{ $cat->id }}" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-96">
            <h2 class="text-lg font-bold mb-4">Edit Aroma</h2>
            <form action="{{ route('admin.aroma.update',$cat->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="text-sm font-medium">Nama Kategori</label>
                    <input type="text" name="nama_kategori" value="{{ $cat->nama_kategori }}" class="w-full border rounded-lg px-3 py-2 mt-1">
                </div>
                <div class="mb-4">
                    <label class="text-sm font-medium">Harga Aroma</label>
                    <input type="number" name="biaya_kategori" value="{{ $cat->biaya_kategori }}" class="w-full border rounded-lg px-3 py-2 mt-1">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal('editAroma{{ $cat->id }}')" class="px-4 py-2 text-gray-500">Batal</button>
                    <button class="bg-brand-purple-btn text-white px-4 py-2 rounded-lg">Update</button>
                </div>
            </form>
        </div>
    </div>
    @endforeach

    {{-- Modal Delete Aroma --}}
    <div id="deleteAromaModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-96 shadow-lg">
            <div class="flex items-center gap-3 mb-4">
                <div class="bg-red-100 p-2 rounded-lg">
                    <i data-lucide="alert-triangle" class="w-5 h-5 text-red-500"></i>
                </div>
                <h2 class="text-lg font-bold text-gray-800">Hapus Aroma</h2>
            </div>
            <p class="text-sm text-gray-500 mb-6">
                Apakah Anda yakin ingin menghapus kategori aroma ini? Data yang dihapus tidak dapat dikembalikan.
            </p>
            <form id="deleteAromaForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 text-gray-500 hover:text-gray-700">Batal</button>
                    <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">Hapus</button>
                </div>
            </form>
        </div>
    </div>
@endpush

@push('scripts')
<script>
    function openModal(id){
        document.getElementById(id).classList.remove('hidden')
        document.getElementById(id).classList.add('flex')
    }

    function closeModal(id){
        document.getElementById(id).classList.remove('flex')
        document.getElementById(id).classList.add('hidden')
    }

    function openDeleteModal(id){
        let modal = document.getElementById('deleteAromaModal');
        let form = document.getElementById('deleteAromaForm');
        form.action = "/admin/aroma/" + id;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal(){
        let modal = document.getElementById('deleteAromaModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>
@endpush