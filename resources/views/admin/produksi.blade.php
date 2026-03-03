<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Produksi - PT Arum Jaya Gemilang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Alpine.js untuk logika Modal -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .brand-purple { background-color: #4c2b62; }
        .text-brand-purple { color: #4c2b62; }
        .brand-gold { color: #c5a059; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900" x-data="{ openModal: false, selectedBatch: {} }">


<div class="min-h-screen flex">
    <!-- Sidebar -->
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
    @foreach ($navItems as $item)
        <a href="{{ (isset($item['route']) && $item['route'] !== '#') ? route($item['route']) : '#' }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 
           {{ (isset($item['route']) && request()->routeIs($item['route'])) 
              ? 'bg-white text-brand-purple shadow-md scale-105' 
              : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
            
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

    <!-- Main Content -->
    <main class="flex-1 ml-64 p-8">
        <!-- Header -->
        <header class="flex justify-between items-start mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-800 mb-1">Monitoring Progres Produksi</h2>
                <p class="text-slate-500 text-sm">Pantau status real-time setiap batch produksi di lantai pabrik.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-bold text-slate-800">Super Admin</p>
                    <p class="text-xs text-slate-400">admin@arumjaya.co.id</p>
                </div>
                <div class="w-10 h-10 rounded-full brand-purple flex items-center justify-center text-white font-bold text-sm">SA</div>
            </div>
        </header>

        <!-- Stats Grid -->
        <div class="grid grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Total Produksi Aktif</p>
                <h3 class="text-3xl font-bold text-slate-800">12</h3>
                <p class="text-[10px] text-slate-400 mt-1">Batch sedang berjalan</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Kapasitas Mesin</p>
                <h3 class="text-3xl font-bold text-slate-800">84%</h3>
                <div class="w-full bg-slate-100 h-1.5 rounded-full mt-2">
                    <div class="bg-brand-gold h-full rounded-full" style="width: 84%"></div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">QC Pass Rate</p>
                <h3 class="text-3xl font-bold text-emerald-500">99.2%</h3>
                <p class="text-[10px] text-slate-400 mt-1">Target harian tercapai</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Tim Bertugas</p>
                <h3 class="text-3xl font-bold text-slate-800">48</h3>
                <p class="text-[10px] text-slate-400 mt-1">Operator & Supervisor</p>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 flex justify-between items-center border-b border-slate-50">
                <h3 class="font-bold text-slate-800 flex items-center gap-2">
                    <i data-lucide="list" class="w-5 h-5"></i> Daftar Batch Produksi
                </h3>
                <div class="flex gap-4">
                    <div class="relative">
                        <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="text" placeholder="Cari ID Proyek..." class="pl-10 pr-4 py-2 bg-slate-50 border-none rounded-xl text-sm w-64">
                    </div>
                    <button class="brand-purple text-white px-4 py-2 rounded-xl text-sm font-bold flex items-center gap-2">
                        <i data-lucide="plus" class="w-4 h-4"></i> Batch Baru
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-50">
                            <th class="px-6 py-4">ID Proyek</th>
                            <th class="px-6 py-4">Nama Brand</th>
                            <th class="px-6 py-4">Produk</th>
                            <th class="px-6 py-4">Progres</th>
                            <th class="px-6 py-4">Tahap</th>
                            <th class="px-6 py-4">Estimasi</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php foreach ($batches as $batch): ?>
                     <tr class="text-sm text-slate-600 hover:bg-slate-50 transition-colors">
    <td class="px-6 py-4 font-bold text-slate-800">{{ $batch['id'] ?? 'N/A' }}</td>
    <td class="px-6 py-4">{{ $batch['client'] ?? 'No Client' }}</td>
    <td class="px-6 py-4">{{ $batch['product'] ?? '-' }}</td>
    <td class="px-6 py-4"><span class="font-bold text-slate-800">{{ $batch['progress'] ?? 0 }}%</span></td>
    <td class="px-6 py-4">
        <span class="px-3 py-1 rounded-lg text-[10px] font-bold {{ $batch['stage_color'] ?? 'bg-slate-100' }}">
            {{ $batch['status'] ?? 'PENDING' }}
        </span>
    </td>
    <td class="px-6 py-4">{{ $batch['eta'] ?? '-' }}</td>
    <td class="px-6 py-4 text-right">
        <button @click="openModal = true; selectedBatch = {{ json_encode($batch) }}" class="text-brand-purple">Update</button>
    </td>
</tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Warning Banner -->
        <div class="mt-8 bg-orange-50 border border-orange-100 p-4 rounded-2xl flex items-start gap-4">
            <div class="bg-orange-100 p-2 rounded-lg text-orange-600">
                <i data-lucide="alert-triangle" class="w-5 h-5"></i>
            </div>
            <div>
                <h5 class="text-sm font-bold text-orange-800">Peringatan Stok Bahan Baku</h5>
                <p class="text-xs text-orange-700">Stok Alcohol 96% tersisa 450L (Mendekati batas minimum untuk Batch MKL-2024-006). Segera lakukan pengadaan.</p>
            </div>
        </div>
    </main>

    <!-- MODAL POP-UP -->
    <div 
        x-show="openModal" 
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        style="display: none;"
    >
        <div 
            class="bg-white w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden"
            @click.away="openModal = false"
        >
            <!-- Modal Header -->
            <div class="brand-purple p-6 text-white flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <i data-lucide="list-checks" class="w-6 h-6"></i>
                    <h3 class="text-lg font-bold">Update Progres Produksi</h3>
                </div>
                <button @click="openModal = false" class="text-white/70 hover:text-white">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-8 space-y-6">
                <!-- Project Info -->
                <div class="flex justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">ID Proyek</p>
                        <p class="text-sm font-bold text-brand-purple" x-text="selectedBatch.id"></p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Produk</p>
                        <p class="text-sm font-bold text-slate-700" x-text="selectedBatch.product"></p>
                    </div>
                </div>

                <!-- Form Fields -->
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Tahap Produksi Saat Ini</label>
                    <select class="w-full p-3 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-brand-purple outline-none">
                        <option x-text="selectedBatch.stage"></option>
                        <option>Mixing</option>
                        <option>Filling</option>
                        <option>Packaging</option>
                        <option>Sterilization</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Persentase (%)</label>
                        <div class="relative">
                            <input type="number" :value="selectedBatch.progress" class="w-full p-3 border border-slate-200 rounded-xl text-sm outline-none">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm">%</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Target Selesai (Revisi)</label>
                        <input type="date" class="w-full p-3 border border-slate-200 rounded-xl text-sm outline-none text-slate-400">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Catatan Internal (Admin)</label>
                    <textarea placeholder="Tambahkan catatan untuk tim produksi atau admin lainnya..." class="w-full p-4 border border-slate-200 rounded-xl text-sm h-24 outline-none resize-none"></textarea>
                </div>

                <!-- Modal Footer -->
                <div class="flex gap-4 pt-4">
                    <button @click="openModal = false" class="flex-1 py-3 border border-slate-200 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50">Batal</button>
                    <button @click="openModal = false" class="flex-1 py-3 brand-purple text-white rounded-xl text-sm font-bold shadow-lg shadow-purple-200">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();
</script>
</body>
</html>