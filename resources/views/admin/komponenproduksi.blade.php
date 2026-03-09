<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Aroma - PT Arum Jaya Gemilang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .brand-purple { background-color: #4c2b62; }
        .text-brand-purple { color: #4c2b62; }
        .brand-gold { color: #c5a059; }
        .bg-brand-purple-btn { background-color: #8b5cf6; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

<div class="min-h-screen flex">
    <aside class="w-64 brand-purple text-white h-screen fixed left-0 top-0 flex flex-col p-6">
        <div class="mb-10 flex flex-col items-center">
            <div class="w-16 h-16 mb-2 flex items-center justify-center">
                <svg viewBox="0 0 100 100" class="w-full h-full fill-current brand-gold">
                    <path d="M30 50 C30 35, 45 35, 50 50 C55 65, 70 65, 70 50 C70 35, 55 35, 50 50 C45 65, 30 65, 30 50 Z" stroke="currentColor" stroke-width="8" fill="none" />
                </svg>
            </div>
            <h1 class="text-[10px] font-bold tracking-wider text-center brand-gold uppercase">PT Arum Jaya Gemilang</h1>
        </div>

        <nav class="flex-1 space-y-2">
            {{-- PERBAIKAN SIDEBAR DISINI --}}
            @foreach ($navItems as $item)
                <a href="{{ route($item['route']) }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors 
                   {{ Route::is($item['route']) ? 'bg-white text-brand-purple shadow-sm' : 'text-white/70 hover:bg-white/10' }}">
                    <i data-lucide="{{ $item['icon'] }}" class="w-5 h-5"></i>
                    <span class="font-medium">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <div class="mt-auto">
             <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-4 py-3 w-full text-white/70 border border-white/20 rounded-lg hover:bg-white/10 transition-colors">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                    <span class="font-medium uppercase tracking-wider text-xs">Log Out</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 ml-64 p-8">
        <header class="flex justify-between items-start mb-10">
            <div>
                <h2 class="text-3xl font-bold text-slate-800 mb-1">Katalog Aroma & Kemasan</h2>
                <p class="text-slate-500 text-sm">Manajemen komponen produksi parfum PT Arum Jaya Gemilang.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-bold text-slate-800">Super Admin</p>
                    <p class="text-xs text-slate-400">admin@arumjaya.co.id</p>
                </div>
                <div class="w-10 h-10 rounded-full brand-purple flex items-center justify-center text-white font-bold text-sm">SA</div>
            </div>
        </header>

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
                    <!-- Modal Edit Aroma -->
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

                        <button type="button" onclick="closeModal('editAroma{{ $cat->id }}')" class="px-4 py-2 text-gray-500">
                        Batal
                        </button>

                        <button class="bg-brand-purple-btn text-white px-4 py-2 rounded-lg">
                        Update
                        </button>

                        </div>

                        </form>

                        </div>
                        </div>


                    <tr class="text-sm text-slate-600 hover:bg-slate-50 transition-colors">

                    <td class="px-6 py-4 font-medium text-slate-400">
                    {{ $cat->id }}
                    </td>

                    <td class="px-6 py-4 font-bold text-slate-800">
                    {{ $cat->nama_kategori }}
                    </td>

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
    
                     <!-- Modal Delete Aroma -->

                    <div id="deleteAromaModal" 
                    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

                    <div class="bg-white rounded-xl p-6 w-96 shadow-lg">

                    <div class="flex items-center gap-3 mb-4">

                    <div class="bg-red-100 p-2 rounded-lg">
                    <i data-lucide="alert-triangle" class="w-5 h-5 text-red-500"></i>
                    </div>

                    <h2 class="text-lg font-bold text-gray-800">
                    Hapus Aroma
                    </h2>

                    </div>

                    <p class="text-sm text-gray-500 mb-6">
                    Apakah Anda yakin ingin menghapus kategori aroma ini?
                    Data yang dihapus tidak dapat dikembalikan.
                    </p>

                    <form id="deleteAromaForm" method="POST">

                    @csrf
                    @method('DELETE')

                    <div class="flex justify-end gap-3">

                    <button type="button"
                    onclick="closeDeleteModal()"
                    class="px-4 py-2 text-gray-500 hover:text-gray-700">
                    Batal
                    </button>

                    <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                    Hapus
                    </button>

                    </div>

                    </form>

                    </div>

                    </div>
                    </div>

                    </td>

                    </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal Tambah Aroma -->
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
                <button type="button" onclick="closeModal('modalAroma')" class="px-4 py-2 text-gray-500">
                Batal
                </button>

                <button class="bg-brand-purple-btn text-white px-4 py-2 rounded-lg">
                Simpan
                </button>
            </div>

            </form>

        </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-purple-50 text-brand-purple rounded-lg">
                        <i data-lucide="package" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 text-lg">Katalog Kemasan</h3>
                </div>
                <button class="bg-brand-purple-btn hover:opacity-90 text-white px-6 py-2 rounded-xl text-sm font-bold flex items-center gap-2 transition-all">
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

                    <td class="px-6 py-4 font-medium text-slate-400">
                    {{ $item->id }}
                    </td>

                    <td class="px-6 py-4 font-bold text-slate-800">
                    {{ $item->jenis_botol }}
                    </td>

                    <td class="px-6 py-4">
                    {{ $item->ukuran }}
                    </td>

                    <td class="px-6 py-4">
                    {{ $item->jenis_box }}
                    </td>

                    <td class="px-6 py-4 text-xs italic">
                    {{ $item->catatan }}
                    </td>

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
    </main>
</div>

<script>
    lucide.createIcons();
    function openModal(id){
document.getElementById(id).classList.remove('hidden')
document.getElementById(id).classList.add('flex')
}

function closeModal(id){
document.getElementById(id).classList.remove('flex')
document.getElementById(id).classList.add('hidden')
}
function openDeleteModal(id)
{

let modal = document.getElementById('deleteAromaModal');

let form = document.getElementById('deleteAromaForm');

form.action = "/admin/aroma/" + id;

modal.classList.remove('hidden');
modal.classList.add('flex');

}

function closeDeleteModal()
{

let modal = document.getElementById('deleteAromaModal');

modal.classList.remove('flex');
modal.classList.add('hidden');

}
</script>
</body>
</html>