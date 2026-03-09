<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PT Arum Jaya Gemilang')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    @stack('styles')
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
    {{-- Sidebar --}}
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
                <a href="{{ route($item['route']) }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 
                   {{ request()->routeIs($item['route']) 
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

    {{-- Main Content --}}
    <main class="flex-1 ml-64 p-8">
        {{-- Header --}}
        <header class="flex justify-between items-start mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-800 mb-1">@yield('page-title')</h2>
                <p class="text-slate-500 text-sm">@yield('page-subtitle')</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-bold text-slate-800">Super Admin</p>
                    <p class="text-xs text-slate-400">admin@arumjaya.co.id</p>
                </div>
                <div class="w-10 h-10 rounded-full brand-purple flex items-center justify-center text-white font-bold text-sm">SA</div>
            </div>
        </header>

        {{-- Content Section --}}
        @yield('content')
    </main>
</div>

@stack('modals')
<script>
    lucide.createIcons();
</script>
@stack('scripts')
</body>
</html>