<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan Pengajuan - PT Arum Jaya Gemilang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .brand-purple { background-color: #4c2b62; }
        .text-brand-purple { color: #4c2b62; }
        .brand-gold { color: #c5a059; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

<div class="min-h-screen flex">
    <aside class="w-64 brand-purple text-white h-screen fixed left-0 top-0 flex flex-col p-6">
        <div class="mb-10 flex flex-col items-center">
            <div class="w-16 h-16 mb-2">
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

    <main class="flex-1 ml-64 p-8">
        <header class="flex justify-between items-start mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-800 mb-1">Persetujuan & Antrean Pengajuan</h2>
                <p class="text-slate-500 text-sm">Kelola pengajuan maklon baru dari klien Anda.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-bold text-slate-800">Super Admin</p>
                    <p class="text-xs text-slate-400">admin@arumjaya.co.id</p>
                </div>
                <div class="w-10 h-10 rounded-full brand-purple flex items-center justify-center text-white font-bold text-sm">SA</div>
            </div>
        </header>

        <div class="grid grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
                <div class="bg-blue-50 text-blue-600 p-3 rounded-xl"><i data-lucide="mail" class="w-6 h-6"></i></div>
                <div>
                    <p class="text-slate-400 text-xs font-medium uppercase tracking-wider">Total Pengajuan Baru</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-bold text-slate-800">12</span>
                        <span class="text-xs font-bold text-blue-500">+3 hari ini</span>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
                <div class="bg-orange-50 text-orange-600 p-3 rounded-xl"><i data-lucide="hourglass" class="w-6 h-6"></i></div>
                <div>
                    <p class="text-slate-400 text-xs font-medium uppercase tracking-wider">Menunggu Review</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-bold text-slate-800">8</span>
                        <span class="text-xs font-bold text-orange-500">Butuh segera</span>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
                <div class="bg-emerald-50 text-emerald-600 p-3 rounded-xl"><i data-lucide="check-circle" class="w-6 h-6"></i></div>
                <div>
                    <p class="text-slate-400 text-xs font-medium uppercase tracking-wider">Disetujui Minggu Ini</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-bold text-slate-800">45</span>
                        <span class="text-xs font-bold text-emerald-500">Lancar</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex gap-8">
            <div class="flex-1 space-y-6">
                <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex gap-4">
                    <div class="flex-1 relative">
                        <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="text" placeholder="Cari nama klien..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-brand-purple">
                    </div>
                    <button class="flex items-center gap-2 px-4 py-2 bg-slate-50 text-slate-600 rounded-xl text-sm font-medium">
                        <i data-lucide="filter" class="w-4 h-4"></i> Filter
                    </button>
                </div>

                @foreach ($submissions as $sub)
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-500">{{ $sub['initial'] }}</div>
                                <div>
                                    <h4 class="font-bold text-slate-800">{{ $sub['client'] }}</h4>
                                    <p class="text-xs text-slate-400 uppercase tracking-wider">ID: {{ $sub['id'] }} • {{ $sub['time'] }}</p>
                                </div>
                            </div>
                            <span class="bg-orange-50 text-orange-600 px-3 py-1 rounded-lg text-[10px] font-bold">MENUNGGU APPROVAL</span>
                        </div>

                        <div class="grid grid-cols-4 gap-4 p-4 bg-slate-50 rounded-2xl mb-6">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Jenis</p>
                                <p class="text-sm font-semibold text-slate-700">{{ $sub['type'] }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Aroma</p>
                                <p class="text-sm font-semibold text-slate-700">{{ $sub['aroma'] }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Jumlah</p>
                                <p class="text-sm font-semibold text-slate-700">{{ $sub['amount'] }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Target</p>
                                <p class="text-sm font-semibold text-slate-700">{{ $sub['target'] }}</p>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-2">
                               @if(isset($p['team_ready']) && $p['team_ready'])
                                     <span class="text-emerald-600 font-medium">Ready</span>
                                @else
                                    <span class="text-slate-400 font-medium">Pending</span>
                                    @endif
                                
                            </div>
                            <div class="flex gap-3">
                                <button class="px-6 py-2 border border-slate-200 rounded-xl text-sm font-bold text-red-500 hover:bg-red-50 transition-colors">Tolak</button>
                                <button class="px-6 py-2 brand-purple text-white rounded-xl text-sm font-bold flex items-center gap-2 hover:opacity-90 transition-opacity">
                                    <i data-lucide="check" class="w-4 h-4"></i> Setujui
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="w-80 space-y-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <h3 class="font-bold text-slate-800 flex items-center gap-2 mb-6">
                        <i data-lucide="zap" class="w-4 h-4 text-brand-purple"></i> Antrean Prioritas
                    </h3>
                    <div class="space-y-6">
                        @foreach ($priorities as $p)
                        <div class="relative pl-4 border-l-2 {{ $p['urgent'] ? 'border-red-400' : 'border-slate-200' }}">
                            <p class="text-[10px] font-medium text-slate-400 mb-1">{{ $p['wait'] }}</p>
                            <h5 class="text-sm font-bold text-slate-800">{{ $p['name'] }}</h5>
                            <p class="text-xs text-slate-500 mb-2">{{ $p['desc'] }}</p>
                            <a href="#" class="text-[10px] font-bold text-brand-purple hover:underline uppercase">Detail</a>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-slate-900 p-6 rounded-2xl text-white">
                    <h4 class="text-[10px] font-bold text-brand-gold uppercase tracking-wider mb-3">Insight Produksi</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Kapasitas produksi saat ini berada di <span class="font-bold text-white">82%</span>. Disarankan prioritaskan pengajuan dengan volume besar.
                    </p>
                </div>
            </div>
        </div>
    </main>
</div>

<script>lucide.createIcons();</script>
</body>
</html>