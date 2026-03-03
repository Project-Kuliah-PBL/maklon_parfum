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
            <button class="flex items-center gap-3 px-4 py-3 w-full text-white/70 border border-white/20 rounded-lg hover:bg-white/10 transition-colors">
                <i data-lucide="log-out" class="w-5 h-5"></i>
                <span class="font-medium uppercase tracking-wider text-xs">Log Out</span>
            </button>
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
                <button class="bg-brand-purple-btn hover:opacity-90 text-white px-6 py-2 rounded-xl text-sm font-bold flex items-center gap-2 transition-all">
                    <i data-lucide="plus" class="w-4 h-4"></i> Tambah Kategori
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] font-bold text-slate-400 uppercase tracking-wider border-y border-slate-50">
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Nama Kategori</th>
                            <th class="px-6 py-4">Variant Aroma</th>
                            <th class="px-6 py-4">Harga Per Aroma</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($aromaCategories as $cat)
                            <tr class="text-sm text-slate-600 hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-400">{{ $cat['id'] }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full {{ $cat['color'] }}"></span>
                                        <span class="font-bold text-slate-800">{{ $cat['name'] }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <button class="px-4 py-1.5 border border-purple-100 rounded-lg text-[10px] font-bold text-brand-purple hover:bg-purple-50">
                                        Lihat Semua Varian
                                    </button>
                                </td>
                                <td class="px-6 py-4 font-medium text-slate-800">{{ $cat['price'] }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-3">
                                        <button class="text-slate-300 hover:text-slate-500"><i data-lucide="edit-3" class="w-4 h-4"></i></button>
                                        <button class="text-slate-300 hover:text-red-500"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                            <th class="px-6 py-4">ID Kemasan</th>
                            <th class="px-6 py-4">Jenis Botol</th>
                            <th class="px-6 py-4">Ukuran</th>
                            <th class="px-6 py-4">Jenis Box</th>
                            <th class="px-6 py-4">Catatan</th>
                            <th class="px-6 py-4">Biaya</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($packagingItems as $item)
                            <tr class="text-sm text-slate-600 hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-400">{{ $item['id'] }}</td>
                                <td class="px-6 py-4 font-bold text-slate-800">{{ $item['bottle'] }}</td>
                                <td class="px-6 py-4">{{ $item['size'] }}</td>
                                <td class="px-6 py-4">{{ $item['box'] }}</td>
                                <td class="px-6 py-4 text-xs italic">{{ $item['note'] }}</td>
                                <td class="px-6 py-4 font-bold text-emerald-600">{{ $item['cost'] }}</td>
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
</script>
</body>
</html>