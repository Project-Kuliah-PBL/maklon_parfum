@extends('layouts.app')

@section('title', 'Maklon.id - Wujudkan Brand Parfum Impian Anda')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden pt-12 pb-20 lg:pt-20 lg:pb-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                    </span>
                    Premium Fragrance Manufacturer
                </div>
                <h1 class="text-5xl lg:text-7xl font-extrabold text-slate-900 dark:text-white leading-[1.1] tracking-tight">
                    Wujudkan Brand <span class="text-primary italic font-display">Parfum Mewah</span> Impian Anda
                </h1>
                <p class="text-lg text-slate-600 dark:text-slate-400 max-w-xl leading-relaxed">
                    Layanan manufaktur parfum profesional ujung-ke-ujung. Dari pemilihan signature scent hingga kemasan eksklusif yang memikat pasar global.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <button class="bg-primary text-white px-8 py-4 rounded-xl font-bold flex items-center gap-2 hover:shadow-lg hover:shadow-primary/30 transition-all">
                    <span class="material-symbols-outlined">bolt</span> Mulai Produksi Sekarang
                </button>
                    
                </div>
            </div>
            <div class="relative">
                <div class="absolute -top-10 -right-10 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
                <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-[4/5] bg-slate-200">
                    <img alt="Luxury perfume bottle on a marble surface" 
                         class="w-full h-full object-cover" 
                         src="https://lh3.googleusercontent.com/aida-public/AB6AXuDMGBoWD6i2KoT1I0bvCRkjTRPjDF-nKmIJTS9hT08scvJr9elfJqDkHdERJsLEp0EJiDLjArBF9nCUS6PqG01pNyupBGOLM4lc3_MrCk2vVuNMXZ_GV1ULL9nBZ_j0KSF0pzcoDjUUbg2Tjl90qIZYaCKrIefdSX9w8TOKRzXZr9CC37xl0ARkrExaj4Ji55d8sBGd2-6t5vvbpnpkbCP84daCXZIfmwYQWROt4avLYcpp-M8pwlPIowweO1GM5qDUnTld3VY_dxg"/>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Journey -->
<section class="py-24 bg-white dark:bg-background-dark/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 space-y-4">
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Langkah Mudah Memulai Brand Anda</h2>
            <p class="text-slate-600 dark:text-slate-400">Proses transparan dan profesional untuk kesuksesan bisnis Anda</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Step 1 -->
            <div class="group p-8 rounded-2xl border border-slate-100 dark:border-slate-800 hover:border-primary/30 hover:shadow-xl transition-all bg-background-light dark:bg-slate-900/50">
                <div class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-3xl">flare</span>
                </div>
                <h3 class="text-xl font-bold mb-3 text-slate-900 dark:text-white">Pilih Aroma</h3>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
                    Temukan signature scent unik dari ribuan koleksi fragrance oil premium standar internasional kami.
                </p>
            </div>
            <!-- Step 2 -->
            <div class="group p-8 rounded-2xl border border-slate-100 dark:border-slate-800 hover:border-primary/30 hover:shadow-xl transition-all bg-background-light dark:bg-slate-900/50">
                <div class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-3xl">package_2</span>
                </div>
                <h3 class="text-xl font-bold mb-3 text-slate-900 dark:text-white">Pilih Kemasan</h3>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
                    Botol kristal eksklusif dan desain box premium yang akan mengangkat nilai jual brand Anda di pasaran.
                </p>
            </div>
            <!-- Step 3 -->
            <div class="group p-8 rounded-2xl border border-slate-100 dark:border-slate-800 hover:border-primary/30 hover:shadow-xl transition-all bg-background-light dark:bg-slate-900/50">
                <div class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center text-primary mb-6 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-3xl">shopping_cart_checkout</span>
                </div>
                <h3 class="text-xl font-bold mb-3 text-slate-900 dark:text-white">Checkout &amp; Pantau</h3>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
                    Proses pemesanan mudah dengan sistem tracking real-time hingga produk sampai di gudang Anda.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-16 items-center">
            <div class="flex-1 space-y-8">
                <h2 class="text-4xl font-bold leading-tight">Kenapa Memilih <span class="text-primary">Maklon.id</span>?</h2>
                <div class="space-y-6">
                    <div class="flex gap-4">
                        <div class="mt-1 flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center text-white text-[10px]">
                            <span class="material-symbols-outlined text-sm">check</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-1">Kualitas Premium</h4>
                            <p class="text-slate-600 dark:text-slate-400">Bahan baku fragrance oil terbaik dengan standar kualitas internasional.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="mt-1 flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center text-white text-[10px]">
                            <span class="material-symbols-outlined text-sm">check</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-1">Minimum Order Rendah</h4>
                            <p class="text-slate-600 dark:text-slate-400">Memudahkan pengusaha muda dan UMKM untuk memulai brand parfum mereka sendiri.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="mt-1 flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center text-white text-[10px]">
                            <span class="material-symbols-outlined text-sm">check</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-1">Legalitas Lengkap</h4>
                            <p class="text-slate-600 dark:text-slate-400">Bantuan pengurusan izin BPOM, sertifikasi Halal, dan HAKI untuk keamanan bisnis Anda.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-1 grid grid-cols-2 gap-4">
                <div class="space-y-4">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBAkUmL6lL0AL0YH_PfTrHtS2hnJZj3sBCyr3kR0aMBjyLLfFPaoWbJuK3Y54Pu2iACcO00D4UCxDDwQ2UY_Ldhhv-IS7k6h3koeMtZ_dH_Vk8h3gV0sWRjdBtmhaG23uDATmrRBoNRW05c1K46qMV0Otjij6L23csZdsOkJwSztMGH5EEBcaimcfECUbno1YDq89o8shPFSAnWKgbtKViewrw6TvcjrMjPJxaKUiFHU8Xfa5_XcMuQEYavS6Qhtk6A7QMdCg0WSH8" 
                         alt="Raw perfume ingredients" 
                         class="rounded-2xl w-full aspect-square object-cover shadow-lg">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBVtOQsCkk-hNktnuQHxpgQL47L78LSPfMQg0a178337NviAc_1-7kqjtWev1Q6kujmlk6x1k3GPCPpMeAIELx7NLomkwzpZewVJGnME1UplY-reXe4zgAsAbHLoeoJKQsVVWtWyslI1TEFW7eHc0QOzxvzpQxGorsiNW6viXfO-IKyU1kypInv-crozvCdwIchSdbBEu-UctBqhx-_ahgFosPrc1g_eh9F3KHKqNN-YCm_AiNAiL0FVLnZ1Nf0u6lPJ3n4zbtGM64" 
                         alt="Perfume filling process" 
                         class="rounded-2xl w-full aspect-[3/4] object-cover shadow-lg">
                </div>
                <div class="space-y-4 pt-12">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDL4JvAhHo6vBLWV72NtXbeuoV5gkodC2YgQ0PkCHF1K0FkBxN2LlctNBl-9FOJ4E6AFBgue6W9XGP9Z_lZvTTO7pd87zTZpPKyGde-gX1wjkbBA6pB7sInH7mVvA4xZ0r56YhUUnXqgRyjXXCRo-AuaiUwUORA8H8v4vbHddI4FtQqxJOTVvD38EroY4Uopc4eakSWcCzojAO7vhTWqzqkYMP9bV5aXnmXpOiJsblEqU3QIsC7HYQu-1SFzHbalBsNjp1J38KiO1k" 
                         alt="Perfume packaging box" 
                         class="rounded-2xl w-full aspect-[3/4] object-cover shadow-lg">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuA5mGIlXvBsUPGo6jlRG3RvhL5wt732c_5lNAmlN4RcIqlgNFSgkJWQWQPiZEMRNpBuGD6SWWfrSZ2mrf1t2O0M0tI61fnWc_cZuHaRCYR7Ha8RiDsftfmV_9HJVpGFHuKuOoS_4LQJ0Bsd88a6INaAl3OVUw3RFwIAr1VO9pjZy-3Pv6O5wmL2qpc6vFvSFfV28_v1GpaseR2_FW991ZDdS7XiZH3zOnzy_6SBv5l3z6SIf2n-iUYhDYcRdgH44gWnq_pZSoFCwTM" 
                         alt="Laboratory testing" 
                         class="rounded-2xl w-full aspect-square object-cover shadow-lg">
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Bagian Tracking CTA dihapus sesuai permintaan --}}
@endsection