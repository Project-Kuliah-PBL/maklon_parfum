<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-[#523678]/10 bg-white dark:bg-gray-900 px-4 md:px-10 py-1.5 md:py-2 sticky top-0 z-50">
    <!-- Logo and Navigation Container -->
    <div class="flex items-center gap-4 md:gap-8">
        <!-- Logo section -->
        <div class="flex-shrink-0">
            <img src="{{ asset('Assets/Image/logo.png') }}" 
                 alt="Logo PT. Arum Jaya Gemilang" 
                 class="w-[45px] h-[45px] md:w-[50px] md:h-[50px] lg:w-[60px] lg:h-[60px] object-contain">
        </div>
        
        <!-- Navigation menu -->
        <nav class="hidden lg:flex items-center gap-3 lg:gap-4">
            <a class="text-slate-600 dark:text-slate-400 hover:text-[#523678] transition-colors text-[10px] lg:text-xs font-semibold uppercase tracking-wider" 
               href="{{ route('home') }}">Home</a>
            <a class="text-slate-600 dark:text-slate-400 hover:text-[#523678] transition-colors text-[10px] lg:text-xs font-semibold uppercase tracking-wider" 
               href="{{ route('layanan') }}">Layanan</a>
            <a class="text-slate-600 dark:text-slate-400 hover:text-[#523678] transition-colors text-[10px] lg:text-xs font-semibold uppercase tracking-wider" 
               href="{{ route('tentang-kami') }}">Tentang Kami</a>
        </nav>
    </div>
    
    <!-- Action Buttons -->
    <div class="flex items-center gap-2 md:gap-3">
        <a href="{{ route('login') }}" 
               class="text-[#523678] hover:text-[#523678]/80 px-1.5 md:px-2 py-0.5 md:py-1 text-[9px] md:text-[10px] lg:text-xs font-bold transition-all underline decoration-2 underline-offset-2 whitespace-nowrap">
                Lanjutkan Proyek Anda
            </a>
            
            <!-- Tombol Wujudkan Brand Impian Segera -->
            <a href="{{ route('register') }}" 
               class="bg-[#523678] hover:bg-[#523678]/90 text-white px-3 md:px-4 py-1 md:py-1.5 rounded-lg text-[9px] md:text-[10px] lg:text-xs font-bold transition-all shadow-md shadow-[#523678]/20 hover:scale-105 active:scale-95 whitespace-nowrap inline-flex items-center gap-1">
                Wujudkan Brand Impian Segera
            </a>
    </div>
</header>