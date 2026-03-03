<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arum Jaya Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <h2 class="text-2xl font-bold text-slate-800 mb-1">Admin Dashboard Overview</h2>
                <p class="text-slate-500 text-sm">Ringkasan operasional manufaktur parfum hari ini.</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-bold text-slate-800">Super Admin</p>
                    <p class="text-xs text-slate-400">admin@arumjaya.co.id</p>
                </div>
                <div class="w-10 h-10 rounded-full brand-purple flex items-center justify-center text-white font-bold text-sm">SA</div>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            @foreach($stats as $stat)
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <div class="{{ $stat['bg'] }} {{ $stat['color'] }} p-2 rounded-lg">
                        <i data-lucide="{{ $stat['icon'] }}" class="w-5 h-5"></i>
                    </div>
                    <span class="text-xs font-bold {{ $stat['type'] === 'positive' ? 'text-emerald-500' : 'text-slate-400' }}">
                        {{ $stat['trend'] }}
                    </span>
                </div>
                <p class="text-slate-500 text-xs font-medium uppercase tracking-wider">{{ $stat['label'] }}</p>
                <h3 class="text-2xl font-bold mt-1">{{ $stat['value'] }}</h3>
            </div>
            @endforeach
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 flex justify-between items-center border-b border-slate-50">
                <h3 class="font-bold text-slate-800">Aktivitas Terbaru</h3>
                <a href="#" class="text-brand-purple text-sm font-bold hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[10px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-50">
                            <th class="px-6 py-4">ID PROYEK</th>
                            <th class="px-6 py-4">KLIEN</th>
                            <th class="px-6 py-4">JENIS</th>
                            <th class="px-6 py-4">STATUS</th>
                            <th class="px-6 py-4 text-right">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($activities as $act)
                        <tr class="text-sm text-slate-600 hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 font-medium">{{ $act['id'] }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500">
                                        {{ $act['initial'] }}
                                    </div>
                                    <span class="font-medium text-slate-800">{{ $act['client'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $act['type'] }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-lg text-[10px] font-bold {{ $act['class'] }}">
                                    {{ $act['status'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-slate-400 hover:text-brand-purple">
                                    <i data-lucide="eye" class="w-5 h-5"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
    lucide.createIcons();
</script>
</body>
</html>