@extends('layouts.app')

@section('title', 'Detail Layanan Maklon Parfum | Essence & Co.')

@section('content')
{{-- Breadcrumb --}}
<nav class="flex items-center gap-2 mb-8 text-sm font-medium text-slate-500 dark:text-slate-400">
    <a class="hover:text-primary transition-colors" href="{{ route('home') }}">Beranda</a>
    <span class="material-symbols-outlined text-xs">chevron_right</span>
    <a class="hover:text-primary transition-colors" href="{{ route('layanan') }}">Layanan</a>
    <span class="material-symbols-outlined text-xs">chevron_right</span>
    <span class="text-primary font-bold">
        @switch(request()->jenis)
            @case('custom')
                Maklon Custom
                @break
            @case('private-label')
                Private Label
                @break
            @case('refill')
                Refill & Reformulasi
                @break
            @default
                Detail Layanan
        @endswitch
    </span>
</nav>

@switch(request()->jenis)
    @case('custom')
        {{-- Detail Maklon Parfum Custom --}}
        <div class="relative overflow-hidden rounded-xl bg-white dark:bg-slate-900 shadow-xl border border-primary/5 mb-10">
            <div class="grid grid-cols-1 lg:grid-cols-5">
                <div class="p-8 md:p-12 lg:col-span-3 flex flex-col justify-center">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-widest mb-6">
                        <span class="material-symbols-outlined text-sm">science</span> 
                        Formulasi Eksklusif & Unik
                    </div>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 dark:text-white leading-[1.1] mb-6 tracking-tight">
                        Maklon Parfum <br/><span class="text-primary">Custom Formulation</span>
                    </h1>
                    <p class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed max-w-xl mb-8">
                        Ciptakan aroma eksklusif yang menjadi signature brand Anda. Dikembangkan dari nol oleh tim R&D berpengalaman dengan standar internasional.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <button class="bg-primary text-white px-8 py-4 rounded-xl font-bold flex items-center gap-2 hover:shadow-lg hover:shadow-primary/30 transition-all">
                            <span class="material-symbols-outlined">bolt</span> Konsultasi Custom Sekarang
                        </button>
                    </div>
                </div>
                <div class="relative min-h-[400px] lg:col-span-2 hidden lg:block">
                    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCq3UP_5GDC0MrAqXz2PLsDVRLRMWAAgW-SQGwwBFRT2k7TNMgeE28w22__LQKFQq8y4C89odOYAxpd_PV7b5yt1m6zFer6lmmuHvT5jPbM1s5wcD_lSrxwHR-EW_8ExiLJ1kC55i4sP9cK9vSIjUVAWDfs2WZsbvcERG-82uqTVEYwUdpjU8DXKI8aS4dUDMBaAZsCtfjPpXMQgH5A7x_8VLR7uzgffxMv2DRLBw2Ou5CpI_8Pxx0swKZEZaNRtfM6ji5HLpprk0k');"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-white dark:from-slate-900 via-transparent to-transparent"></div>
                </div>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white dark:bg-slate-900 p-8 rounded-xl border border-primary/10 shadow-sm hover:shadow-md transition-shadow group">
                <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-3xl">science</span>
                </div>
                <h3 class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-2">Tim R&D</h3>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-white">5+ Ahli Kimia</p>
                <p class="mt-4 text-sm text-slate-500 leading-relaxed">Berpengalaman dalam menciptakan formula parfum kelas premium dengan standar internasional.</p>
            </div>
            
            <div class="bg-white dark:bg-slate-900 p-8 rounded-xl border border-primary/10 shadow-sm hover:shadow-md transition-shadow group">
                <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-3xl">flash_on</span>
                </div>
                <h3 class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-2">Waktu Sampling</h3>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-white">7-14 Hari</p>
                <p class="mt-4 text-sm text-slate-500 leading-relaxed">Proses pembuatan sampel cepat dan tepat untuk mempercepat realisasi brand Anda.</p>
            </div>
            
            <div class="bg-white dark:bg-slate-900 p-8 rounded-xl border border-primary/10 shadow-sm hover:shadow-md transition-shadow group">
                <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-3xl">payments</span>
                </div>
                <h3 class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-2">Biaya Formulasi</h3>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-white">Mulai Rp 5JT</p>
                <p class="mt-4 text-sm text-slate-500 leading-relaxed">Investasi pengembangan formula eksklusif yang sepadan dengan keunikan brand Anda.</p>
            </div>
        </div>

        {{-- Main Content Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="lg:col-span-2 space-y-8">
                {{-- Keunggulan Section --}}
                <div class="bg-white dark:bg-slate-900 rounded-xl p-8 border border-primary/5">
                    <h2 class="text-2xl font-bold mb-6 flex items-center gap-3">
                        <span class="material-symbols-outlined text-primary">diversity_2</span> 
                        Keunggulan Maklon Custom
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <h4 class="font-bold text-slate-800 dark:text-slate-200">Formulasi Eksklusif</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Aroma unik yang tidak dimiliki brand lain, menjadi signature scent khas brand Anda.</p>
                            <ul class="space-y-2 text-sm text-slate-600 dark:text-slate-400">
                                <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Pengembangan dari nol (bespoke)</li>
                                <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> 3-5 opsi sampel awal</li>
                                <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Revisi hingga sempurna</li>
                            </ul>
                        </div>
                        <div class="space-y-4">
                            <h4 class="font-bold text-slate-800 dark:text-slate-200">Standar Internasional</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Seluruh formula dikembangkan sesuai standar keamanan dan kualitas global.</p>
                            <ul class="space-y-2 text-sm text-slate-600 dark:text-slate-400">
                                <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Sesuai standar IFRA</li>
                                <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Bahan baku premium impor</li>
                                <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Stability test menyeluruh</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                {{-- Proses Pengerjaan --}}
                <div class="bg-white dark:bg-slate-900 rounded-xl p-8 border border-primary/5">
                    <h2 class="text-2xl font-bold mb-8">Proses Pengerjaan Custom</h2>
                    <div class="relative">
                        <div class="absolute top-6 left-0 w-full h-0.5 bg-slate-100 dark:bg-slate-800 hidden md:block"></div>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative z-10">
                            <div class="text-center md:text-left">
                                <div class="size-12 -mt-1 bg-primary text-white rounded-full flex items-center justify-center font-extrabold mb-4 mx-auto md:mx-0 shadow-lg shadow-primary/30 ring-4 ring-white dark:ring-slate-900 scale-110">1</div>
                                <h5 class="font-bold text-sm mb-1 uppercase tracking-wider text-primary">BRIEF</h5>
                                <p class="text-xs text-slate-500 font-semibold">Konsep & Mood Aroma</p>
                            </div>
                            <div class="text-center md:text-left">
                                <div class="size-12 -mt-1 bg-primary text-white rounded-full flex items-center justify-center font-extrabold mb-4 mx-auto md:mx-0 shadow-lg shadow-primary/30 ring-4 ring-white dark:ring-slate-900 scale-110">2</div>
                                <h5 class="font-bold text-sm mb-1 uppercase tracking-wider text-primary">SAMPEL</h5>
                                <p class="text-xs text-slate-500 font-semibold">Pembuatan & Revisi</p>
                            </div>
                            <div class="text-center md:text-left">
                                <div class="size-12 -mt-1 bg-primary text-white rounded-full flex items-center justify-center font-extrabold mb-4 mx-auto md:mx-0 shadow-lg shadow-primary/30 ring-4 ring-white dark:ring-slate-900 scale-110">3</div>
                                <h5 class="font-bold text-sm mb-1 uppercase tracking-wider text-primary">APPROVAL</h5>
                                <p class="text-xs text-slate-500 font-semibold">Finalisasi Formula</p>
                            </div>
                            <div class="text-center md:text-left">
                                <div class="size-12 -mt-1 bg-primary text-white rounded-full flex items-center justify-center font-extrabold mb-4 mx-auto md:mx-0 shadow-lg shadow-primary/30 ring-4 ring-white dark:ring-slate-900 scale-110">4</div>
                                <h5 class="font-bold text-sm mb-1 uppercase tracking-wider text-primary">PRODUKSI</h5>
                                <p class="text-xs text-slate-500 font-semibold">Eksekusi Massal</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Sidebar --}}
            <div class="space-y-6">
                <div class="bg-primary p-8 rounded-xl text-white shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Mulai Custom Formula</h3>
                    <p class="text-primary-100/80 text-sm mb-6 leading-relaxed">Konsultasikan konsep aroma impian Anda dengan tim R&D kami.</p>
                    <form class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest mb-1.5 opacity-80">Nama Lengkap</label>
                            <input class="w-full bg-white/10 border-white/20 rounded-lg py-2 px-3 text-sm focus:ring-white/30 focus:border-white/40 placeholder:text-white/40" placeholder="Contoh: Budi Santoso" type="text"/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest mb-1.5 opacity-80">WhatsApp / Email</label>
                            <input class="w-full bg-white/10 border-white/20 rounded-lg py-2 px-3 text-sm focus:ring-white/30 focus:border-white/40 placeholder:text-white/40" placeholder="0812xxx atau email@anda.com" type="text"/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest mb-1.5 opacity-80">Deskripsi Aroma</label>
                            <textarea class="w-full bg-white/10 border-white/20 rounded-lg py-2 px-3 text-sm focus:ring-white/30 focus:border-white/40 placeholder:text-white/40" rows="3" placeholder="Jelaskan konsep aroma yang diinginkan..."></textarea>
                        </div>
                        <button class="w-full bg-white text-primary font-bold py-3 rounded-lg hover:bg-slate-100 transition-colors mt-2" type="submit">Konsultasi Sekarang</button>
                    </form>
                </div>
                
                <div class="bg-white dark:bg-slate-900 rounded-xl p-6 border border-primary/5">
                    <h4 class="font-bold mb-4 flex items-center gap-2"><span class="material-symbols-outlined text-primary">verified</span> Sertifikasi & Izin</h4>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-slate-100 dark:bg-slate-800 rounded-full text-[10px] font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-700">BPOM RI</span>
                        <span class="px-3 py-1 bg-slate-100 dark:bg-slate-800 rounded-full text-[10px] font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-700">HALAL MUI</span>
                        <span class="px-3 py-1 bg-slate-100 dark:bg-slate-800 rounded-full text-[10px] font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-700">CPKB Certified</span>
                        <span class="px-3 py-1 bg-slate-100 dark:bg-slate-800 rounded-full text-[10px] font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-700">IFRA Standard</span>
                    </div>
                </div>
            </div>
        </div>
        @break

    @case('private-label')
        {{-- Detail Private Label --}}
        <div class="relative overflow-hidden rounded-xl bg-white dark:bg-slate-900 shadow-xl border border-primary/5 mb-10">
            <div class="grid grid-cols-1 lg:grid-cols-5">
                <div class="p-8 md:p-12 lg:col-span-3 flex flex-col justify-center">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-widest mb-6">
                        <span class="material-symbols-outlined text-sm">label</span> 
                        Siap Pakai & Cepat Launch
                    </div>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 dark:text-white leading-[1.1] mb-6 tracking-tight">
                        Private Label <br/><span class="text-primary">Siap Pasang Brand</span>
                    </h1>
                    <p class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed max-w-xl mb-8">
                        Pilih dari ratusan koleksi aroma premium kami yang telah teruji dan siap dipasarkan dengan brand Anda sendiri. Solusi tercepat untuk memulai bisnis parfum.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <button class="bg-primary text-white px-8 py-4 rounded-xl font-bold flex items-center gap-2 hover:shadow-lg hover:shadow-primary/30 transition-all">
                            <span class="material-symbols-outlined">bolt</span> Jelajahi Koleksi Aroma
                        </button>
                    </div>
                </div>
                <div class="relative min-h-[400px] lg:col-span-2 hidden lg:block">
                    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDLsiIVTv-OlLb3WMwhyg3SSCFWwfYiDrzu-q1TUR6ZJt51djQ8fpum2MOGpVamwxnfQLqBejVLAnZDei5Mx3HVKQqPt9mFxuTxLVhN4y2rni1GyvgQdqtQubIGQjGvFaRCB_ER7Ff8ZzUziTcQg9XBoGWMWhnVvuVGIMkJRT58f9xeHo9plLMI5P9b0L7_qroDz53jYgfx-_jni9C6Zob3PgceGDHrUuhFsCFTJ8WW-JrsA2W071GP8JlXvJt44s9-NybOnI1vGWA');"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-white dark:from-slate-900 via-transparent to-transparent"></div>
                </div>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white dark:bg-slate-900 p-8 rounded-xl border border-primary/10 shadow-sm hover:shadow-md transition-shadow group">
                <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-3xl">inventory_2</span>
                </div>
                <h3 class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-2">Koleksi Aroma</h3>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-white">200+ Varian</p>
                <p class="mt-4 text-sm text-slate-500 leading-relaxed">Beragam kategori aroma dari fresh, floral, woody, hingga oriental.</p>
            </div>
            
            <div class="bg-white dark:bg-slate-900 p-8 rounded-xl border border-primary/10 shadow-sm hover:shadow-md transition-shadow group">
                <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-3xl">flash_on</span>
                </div>
                <h3 class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-2">Waktu Produksi</h3>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-white">4-6 Minggu</p>
                <p class="mt-4 text-sm text-slate-500 leading-relaxed">Lebih cepat karena formula sudah tersedia dan teruji.</p>
            </div>
            
            <div class="bg-white dark:bg-slate-900 p-8 rounded-xl border border-primary/10 shadow-sm hover:shadow-md transition-shadow group">
                <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-3xl">payments</span>
                </div>
                <h3 class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-2">Harga Mulai</h3>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-white">Rp58.000 <span class="text-lg font-medium text-slate-400">/ unit</span></p>
                <p class="mt-4 text-sm text-slate-500 leading-relaxed">Lebih ekonomis karena tanpa biaya pengembangan formula.</p>
            </div>
        </div>
        @break

    @case('refill')
        {{-- Detail Refill & Reformulasi --}}
        <div class="relative overflow-hidden rounded-xl bg-white dark:bg-slate-900 shadow-xl border border-primary/5 mb-10">
            <div class="grid grid-cols-1 lg:grid-cols-5">
                <div class="p-8 md:p-12 lg:col-span-3 flex flex-col justify-center">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-widest mb-6">
                        <span class="material-symbols-outlined text-sm">refresh</span> 
                        Sempurnakan & Kembangkan
                    </div>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 dark:text-white leading-[1.1] mb-6 tracking-tight">
                        Refill & <br/><span class="text-primary">Reformulasi</span>
                    </h1>
                    <p class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed max-w-xl mb-8">
                        Sempurnakan formula produk eksisting Anda atau ciptakan varian baru dengan bantuan tim ahli kami. Tersedia juga layanan refill berkualitas tinggi.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <button class="bg-primary text-white px-8 py-4 rounded-xl font-bold flex items-center gap-2 hover:shadow-lg hover:shadow-primary/30 transition-all">
                            <span class="material-symbols-outlined">bolt</span> Konsultasi Reformulasi
                        </button>
                    </div>
                </div>
                <div class="relative min-h-[400px] lg:col-span-2 hidden lg:block">
                    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCS5afJhRXcDYQStQk2JxxVuaWdgVOLCMj45B485EGmVsAEfeBlbKwCPJxnY5B1OnNiSKywDtYjRaBKTa3r2wzeY_YPoZWK2aeWRQW0YBkWUJYGd9dasOEsss0f1tm2fN5jxjQ2Kr0tpn9BFg64MI8Bg_ROGGjbaRIlMyb6UTGYCpt6jgMO_olN9CUEl4j--xanXUTaEewrWKFTc1zID3f2kyix7gVyIsfc0xvkW8Pg6y6wRH3xHv2TtjFSxC33795qVzIIp_OxmMo');"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-white dark:from-slate-900 via-transparent to-transparent"></div>
                </div>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white dark:bg-slate-900 p-8 rounded-xl border border-primary/10 shadow-sm hover:shadow-md transition-shadow group">
                <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-3xl">science</span>
                </div>
                <h3 class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-2">Analisis Formula</h3>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-white">Gratis</p>
                <p class="mt-4 text-sm text-slate-500 leading-relaxed">Kami analisis formula eksisting Anda dan berikan rekomendasi pengembangan.</p>
            </div>
            
            <div class="bg-white dark:bg-slate-900 p-8 rounded-xl border border-primary/10 shadow-sm hover:shadow-md transition-shadow group">
                <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-3xl">flash_on</span>
                </div>
                <h3 class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-2">Waktu Reformulasi</h3>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-white">3-4 Minggu</p>
                <p class="mt-4 text-sm text-slate-500 leading-relaxed">Proses lebih cepat karena pengembangan dari formula existing.</p>
            </div>
            
            <div class="bg-white dark:bg-slate-900 p-8 rounded-xl border border-primary/10 shadow-sm hover:shadow-md transition-shadow group">
                <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-3xl">payments</span>
                </div>
                <h3 class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-2">MOQ Refill</h3>
                <p class="text-3xl font-extrabold text-slate-900 dark:text-white">300 Unit</p>
                <p class="mt-4 text-sm text-slate-500 leading-relaxed">Minimum order lebih rendah untuk varian refill.</p>
            </div>
        </div>
        @break

    @default
        <div class="text-center py-20 bg-white dark:bg-slate-900 rounded-xl">
            <span class="material-symbols-outlined text-6xl text-slate-300 mb-4">error</span>
            <h2 class="text-2xl font-bold mb-2">Layanan Tidak Ditemukan</h2>
            <p class="text-slate-500 mb-6">Halaman detail layanan yang Anda cari tidak tersedia.</p>
            <a href="{{ route('layanan') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali ke Halaman Layanan
            </a>
        </div>
@endswitch
@endsection