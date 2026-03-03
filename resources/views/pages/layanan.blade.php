@extends('layouts.app')

@section('title', 'Layanan Maklon Parfum - Maklon.id')

@section('content')
<!-- Hero Section -->
<section class="relative py-24 lg:py-32 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img alt="Premium Perfume Ingredients" 
             class="w-full h-full object-cover opacity-20 dark:opacity-10" 
             src="https://lh3.googleusercontent.com/aida-public/AB6AXuBQlV6jlkx-KsNQ7d6FUIbTRvXo_bWFno3h0TP5L7qw40QIqFc_oq_m_LZ4_zrGDb0D-CS8B_bNE4rUTUYapMxOsZue6rX-rmoX4BnRFbK9BTyZlhgQ2W-mAq7wx_d0z5JYwDXioYt7WZsWDtJlbO8bcXZ8gsYFjbrVl9vK6wIzmyjtiNBMFXnw3KDQCubBqHpYbY3pwIo1dp_vvFo6bc1OwZaBVKty5pUAgjdbkSrmkHGL0apAVdyxqXDAvzkLAN_7tZhWDjVELxE"/>
        <div class="absolute inset-0 hero-bg-overlay"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>
    </div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
        <span class="inline-block px-4 py-1.5 mb-6 text-xs font-bold uppercase tracking-widest text-primary bg-primary/10 rounded-full">Premium Manufacturing</span>
        <h1 class="text-4xl md:text-6xl font-800 text-slate-900 dark:text-white mb-6 leading-[1.1]">
            Layanan Maklon Parfum Kami
        </h1>
        <p class="text-lg md:text-xl text-slate-600 dark:text-slate-400 font-medium max-w-2xl mx-auto leading-relaxed">
            Solusi end-to-end untuk membangun brand parfum impian Anda dengan standar kualitas internasional.
        </p>
    </div>
</section>

<!-- Service Cards Section -->
<section class="py-12 pb-24 bg-white dark:bg-background-dark/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <!-- Card 1: Custom Formulation -->
        <div class="service-card group bg-background-light dark:bg-slate-900/50 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-xl hover:shadow-primary/5 transition-all overflow-hidden">
            <div class="flex flex-col md:flex-row h-full min-h-[400px]">
                <div class="md:w-3/5 overflow-hidden h-64 md:h-auto">
                    <img alt="Custom Formulation" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" 
                         src="https://lh3.googleusercontent.com/aida-public/AB6AXuCq3UP_5GDC0MrAqXz2PLsDVRLRMWAAgW-SQGwwBFRT2k7TNMgeE28w22__LQKFQq8y4C89odOYAxpd_PV7b5yt1m6zFer6lmmuHvT5jPbM1s5wcD_lSrxwHR-EW_8ExiLJ1kC55i4sP9cK9vSIjUVAWDfs2WZsbvcERG-82uqTVEYwUdpjU8DXKI8aS4dUDMBaAZsCtfjPpXMQgH5A7x_8VLR7uzgffxMv2DRLBw2Ou5CpI_8Pxx0swKZEZaNRtfM6ji5HLpprk0k"/>
                </div>
                <div class="md:w-2/5 p-8 md:p-12 flex flex-col justify-center">
                    <div>
                        <div class="size-12 bg-primary text-white rounded-xl flex items-center justify-center mb-6 shadow-lg shadow-primary/20">
                            <span class="material-symbols-outlined text-2xl">science</span>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white mb-4">Maklon Parfum Custom</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-base leading-relaxed mb-8">
                            Ciptakan aroma unik dan eksklusif dengan formulasi dari nol oleh tim ahli kimia kami. Layanan paling komprehensif untuk identitas brand yang tak tertandingi.
                        </p>
                    </div>
                    <a href="{{ route('detail.layanan', 'custom') }}" class="w-full md:w-fit inline-flex items-center justify-center px-8 py-4 bg-primary text-white text-base font-bold rounded-lg hover:bg-primary/90 transition-colors gap-2">
    Lihat Detail
    <span class="material-symbols-outlined text-sm">arrow_forward</span>
</a>
                </div>
            </div>
        </div>

        <!-- Grid Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Card 2: Private Label -->
            <div class="service-card group bg-background-light dark:bg-slate-900/50 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-xl hover:shadow-primary/5 transition-all overflow-hidden">
                <div class="flex flex-col sm:flex-row h-full">
                    <div class="sm:w-2/5 overflow-hidden h-48 sm:h-auto">
                        <img alt="Private Label Perfume" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" 
                             src="https://lh3.googleusercontent.com/aida-public/AB6AXuDLsiIVTv-OlLb3WMwhyg3SSCFWwfYiDrzu-q1TUR6ZJt51djQ8fpum2MOGpVamwxnfQLqBejVLAnZDei5Mx3HVKQqPt9mFxuTxLVhN4y2rni1GyvgQdqtQubIGQjGvFaRCB_ER7Ff8ZzUziTcQg9XBoGWMWhnVvuVGIMkJRT58f9xeHo9plLMI5P9b0L7_qroDz53jYgfx-_jni9C6Zob3PgceGDHrUuhFsCFTJ8WW-JrsA2W071GP8JlXvJt44s9-NybOnI1vGWA"/>
                    </div>
                    <div class="sm:w-3/5 p-8 flex flex-col justify-between">
                        <div>
                            <div class="size-10 bg-primary/20 text-primary rounded-lg flex items-center justify-center mb-4">
                                <span class="material-symbols-outlined text-xl">label</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Private Label (Siap Pakai)</h3>
                            <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed mb-6">
                                Pilih koleksi aroma premium kami yang telah teruji dan siap dipasarkan dengan brand Anda.
                            </p>
                        </div>
                        <a href="{{ route('detail.layanan', 'private-label') }}" class="w-full inline-flex items-center justify-center px-6 py-3 bg-primary text-white text-sm font-bold rounded-lg hover:bg-primary/90 transition-colors gap-2">
    Lihat Detail
    <span class="material-symbols-outlined text-sm">arrow_forward</span>
</a>

                    </div>
                </div>
            </div>

            <!-- Card 3: Refill & Reformulasi -->
            <div class="service-card group bg-background-light dark:bg-slate-900/50 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-xl hover:shadow-primary/5 transition-all overflow-hidden">
                <div class="flex flex-col sm:flex-row h-full">
                    <div class="sm:w-2/5 overflow-hidden h-48 sm:h-auto">
                        <img alt="Refill and Reformulation" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" 
                             src="https://lh3.googleusercontent.com/aida-public/AB6AXuCS5afJhRXcDYQStQk2JxxVuaWdgVOLCMj45B485EGmVsAEfeBlbKwCPJxnY5B1OnNiSKywDtYjRaBKTa3r2wzeY_YPoZWK2aeWRQW0YBkWUJYGd9dasOEsss0f1tm2fN5jxjQ2Kr0tpn9BFg64MI8Bg_ROGGjbaRIlMyb6UTGYCpt6jgMO_olN9CUEl4j--xanXUTaEewrWKFTc1zID3f2kyix7gVyIsfc0xvkW8Pg6y6wRH3xHv2TtjFSxC33795qVzIIp_OxmMo"/>
                    </div>
                    <div class="sm:w-3/5 p-8 flex flex-col justify-between">
                        <div>
                            <div class="size-10 bg-primary/20 text-primary rounded-lg flex items-center justify-center mb-4">
                                <span class="material-symbols-outlined text-xl">refresh</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Refill &amp; Reformulasi</h3>
                            <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed mb-6">
                                Sempurnakan formula lama Anda atau ciptakan versi refill berkualitas tinggi standar Eropa.
                            </p>
                        </div>
                        <a href="{{ route('detail.layanan', 'refill') }}" class="w-full inline-flex items-center justify-center px-6 py-3 bg-primary text-white text-sm font-bold rounded-lg hover:bg-primary/90 transition-colors gap-2">
    Lihat Detail
    <span class="material-symbols-outlined text-sm">arrow_forward</span>
</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section with WhatsApp Button - MODIFIED BUTTONS -->
<section class="py-20 bg-background-light dark:bg-background-dark relative">
    <div class="max-w-5xl mx-auto px-4">
        <div class="bg-gradient-to-br from-primary to-primary/90 rounded-2xl p-10 md:p-16 text-center text-white relative overflow-hidden shadow-2xl">
            <div class="absolute inset-0 opacity-10 pointer-events-none">
                <svg class="h-full w-full" preserveAspectRatio="none" viewBox="0 0 100 100">
                    <pattern height="10" id="grid" patternUnits="userSpaceOnUse" width="10">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"></path>
                    </pattern>
                    <rect fill="url(#grid)" height="100%" width="100%"></rect>
                </svg>
            </div>
            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-800 mb-6">Siap Memulai Brand Parfum Anda?</h2>
                <p class="text-white/80 text-lg mb-10 max-w-xl mx-auto">
                    Konsultasikan kebutuhan maklon Anda dengan tim ahli kami sekarang dan wujudkan visi produk Anda menjadi nyata.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
    <!-- Tombol Mulai Produksi Sekarang - Outline Elegan -->
    <button class="px-8 py-4 bg-transparent text-white font-medium tracking-wide rounded-xl border border-white/30 hover:bg-white/10 hover:border-white/50 transition-all duration-300 inline-flex items-center justify-center gap-2 backdrop-blur-sm">
        <span class="material-symbols-outlined" style="font-size: 1.25rem;">bolt</span>
        <span class="text-sm md:text-base">Mulai Produksi Sekarang</span>
    </button>
    
    <!-- Tombol Hubungi WA - Solid Elegan -->
    <button class="px-8 py-4 bg-white text-primary font-medium tracking-wide rounded-xl hover:bg-gray-50 transition-all duration-300 inline-flex items-center justify-center gap-2 shadow-sm">
        
        <span class="text-sm md:text-base">Hubungi WhatsApp</span>
    </button>
</div>
            </div>
        </div>
    </div>
</section>
@endsection