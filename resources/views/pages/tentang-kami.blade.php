@extends('layouts.app')

@section('title', 'Tentang Kami - Maklon.id | Solusi Manufaktur Parfum Mewah')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden pt-16 pb-24 lg:pt-24 lg:pb-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-10">
        <div class="grid grid-cols-1 gap-16 lg:grid-cols-2 lg:items-center">
            <div>
                <span class="inline-block rounded-full bg-primary/10 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-primary mb-6">
                    World Class Fragrance Partner
                </span>
                <h1 class="text-4xl font-black leading-tight tracking-tight text-slate-900 dark:text-white sm:text-5xl lg:text-6xl mb-8">
                    Tentang Maklon.id: <br/>
                    <span class="text-primary">Menghidupkan Visi Aroma Anda</span>
                </h1>
                <p class="text-lg leading-relaxed text-slate-600 dark:text-slate-400 mb-10 max-w-xl">
                    Kami menghadirkan layanan manufaktur parfum kontrak (maklon) profesional untuk membantu pengusaha mewujudkan brand wangi mewah impian mereka dengan standar kualitas global.
                </p>
                <div class="flex flex-wrap gap-4">
                    <button class="bg-primary text-white px-8 py-4 rounded-xl font-bold flex items-center gap-2 hover:shadow-lg hover:shadow-primary/30 transition-all">
                    <span class="material-symbols-outlined">bolt</span> Mulai Produksi Sekarang
                </button>
                    
                </div>
            </div>
            <div class="relative">
                <div class="aspect-[4/5] rounded-3xl bg-slate-200 overflow-hidden shadow-2xl rotate-2 transition-transform hover:rotate-0 duration-700">
                    <img class="h-full w-full object-cover grayscale-[20%] hover:grayscale-0 transition-all duration-500" 
                         alt="Close up of luxury perfume bottle with golden liquid" 
                         src="https://lh3.googleusercontent.com/aida-public/AB6AXuCaxt-6QyXjckVIFlTEzX5oZbi9r2ZFWo0F90GPfCzzMsAiMjuc0d35VojNJgO12KYK8LXSqlI-SIO6hrqPfslfmKDSu_QNqXwbMHUjWolFL4bLe9vNdnnZr5LQEjb-3cKaVHVqPotxRALD3pvyskJPpuxB5R4bGxF68oLOGMFtAcpqjp8nc-z2QV-PTVOkx6JRvkTrXVigN-oj6LVu_KMue2ez_x_mX00YZ0CW5OgQV1HZWwKKkz8w17oqNaoUb8d1Jd5J3z8kTx0"/>
                </div>
                <div class="absolute -bottom-10 -left-10 hidden sm:block aspect-square w-48 rounded-2xl bg-primary p-6 text-white shadow-2xl -rotate-6">
                    <span class="material-symbols-outlined text-4xl mb-4">verified</span>
                    <p class="text-sm font-bold">100% Sertifikasi BPOM &amp; Halal</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission Section -->
<section class="bg-white dark:bg-background-dark py-24">
    <div class="mx-auto max-w-4xl px-6 text-center lg:px-10">
        <h2 class="text-primary text-sm font-bold uppercase tracking-[0.2em] mb-4">Misi Kami</h2>
        <p class="text-3xl font-bold leading-snug text-slate-900 dark:text-white sm:text-4xl">
            "Memberikan layanan pembuatan parfum berkualitas tinggi dan profesional bagi para wirausahawan dengan standar kemewahan global."
        </p>
        <div class="mt-12 flex justify-center gap-2">
            <span class="h-1.5 w-12 rounded-full bg-primary"></span>
            
        </div>
    </div>
</section>

<!-- Pillar Grid -->
<section class="py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-10">
        <div class="mb-16 max-w-2xl">
            <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white sm:text-4xl mb-4">Pilar Utama Kami</h2>
            <p class="text-slate-600 dark:text-slate-400">Nilai-nilai dasar yang kami tanamkan dalam setiap tetes mahakarya aroma yang diciptakan di fasilitas kami.</p>
        </div>
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            <!-- Card 1 -->
            <div class="group relative rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-8 hover:border-primary/50 transition-all duration-300">
                <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10 text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-3xl">workspace_premium</span>
                </div>
                <h3 class="mb-3 text-xl font-bold text-slate-900 dark:text-white">Kualitas Premium</h3>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed">Menggunakan bahan baku terbaik dari produsen fragrance terkemuka dengan standar luxury internasional.</p>
            </div>
            <!-- Card 2 -->
            <div class="group relative rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-8 hover:border-primary/50 transition-all duration-300">
                <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10 text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-3xl">auto_awesome</span>
                </div>
                <h3 class="mb-3 text-xl font-bold text-slate-900 dark:text-white">Inovasi Berkelanjutan</h3>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed">Terus memperbarui formulasi dan teknik ekstraksi sesuai dengan tren wewangian global terkini dan teknologi terbaru.</p>
            </div>
            <!-- Card 3 -->
            <div class="group relative rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 p-8 hover:border-primary/50 transition-all duration-300">
                <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10 text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-3xl">favorite</span>
                </div>
                <h3 class="mb-3 text-xl font-bold text-slate-900 dark:text-white">Kepuasan Pelanggan</h3>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed">Membangun kemitraan jangka panjang dengan layanan yang dipersonalisasi mulai dari konsep hingga distribusi.</p>
            </div>
        </div>
    </div>
</section>

<!-- Expertise & Facility Section -->
<section class="bg-primary py-24 text-white">
    <div class="mx-auto max-w-7xl px-6 lg:px-10">
        <div class="grid grid-cols-1 gap-16 lg:grid-cols-2 lg:items-center">
            <div class="order-2 lg:order-1">
                <div class="grid grid-cols-2 gap-4">
                    <div class="aspect-square overflow-hidden rounded-2xl shadow-xl">
                        <img class="h-full w-full object-cover" 
                             alt="Modern perfume laboratory with advanced equipment" 
                             src="https://lh3.googleusercontent.com/aida-public/AB6AXuCMTlwVCV7nYjEzia0cm_gX8UeTVO3d1zCTg9dGqNbACUd1fl7Xg00Sce6lsx_pAbeCf6tIKpHAryPdzVp2nn0wdeS1AIxgmXmIXHHfSHJ-6RmXxr0KtaU28l2Mm8CTj8zVe3w4gbP1YEbGrbOpIFqyh3ORViy1JAgtlToQa0xUh8JIjvxoRZrgLMCjverL3RR-Wp7QKcWLsTWpkWJ4qHwn4WsIhpGNdwNxLh_yCtzT6jh7_3yqRUigK01xpoFTnBklUt_TrgxK8vA"/>
                    </div>
                    <div class="aspect-square overflow-hidden rounded-2xl shadow-xl translate-y-8">
                        <img class="h-full w-full object-cover" 
                             alt="Expert perfumer working with essential oils" 
                             src="https://lh3.googleusercontent.com/aida-public/AB6AXuB1fFQDRgVw1WzwXBNnu_zOMu7RT8wwAU_6fS68EcQdrWnbg1Fdf4DimUlAdZpV0QYyQZmDTpiF121gaw1bZ1MAxPBpx610mHOaNgCX39AK7Fi9pl9a-uZoTRTfy8yXjh3DZpPvO9c0VMTTqMr8RcDAS7wBlgSLGyju8bh5jy5ps6NdXnP6h1E4Ld82FhZMx98irwYx3GCnvCZvV1Exd8RAr2kP0rlOz7NQ0bNo-UWgL5DMk7taqQAggCu8nQAIQbRtpgAzrdvO7vc"/>
                    </div>
                </div>
            </div>
            <div class="order-1 lg:order-2">
                <h2 class="text-3xl font-black sm:text-4xl mb-6">Didukung oleh Perfumer Ahli &amp; Fasilitas Modern</h2>
                <p class="text-lg bg-white/10 p-6 rounded-xl border border-white/20 text-slate-100 mb-8">
                    Kami menggabungkan keahlian seni peracikan aroma (The Art of Perfumery) dengan teknologi manufaktur mutakhir untuk menghasilkan produk yang kompetitif di pasar global.
                </p>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-white">check_circle</span>
                        <span>Laboratorium R&amp;D canggih untuk kustomisasi aroma unik.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-white">check_circle</span>
                        <span>Kapasitas produksi skala besar dengan akurasi tinggi.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-white">check_circle</span>
                        <span>Tim konsultan brand yang membantu strategi pasar Anda.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA -->
<section class="py-24 text-center bg-white dark:bg-background-dark">
    <div class="mx-auto max-w-3xl px-6">
        <h2 class="text-3xl font-bold mb-6 text-slate-900 dark:text-white">Siap Memulai Brand Parfum Anda?</h2>
        <p class="text-slate-600 dark:text-slate-400 mb-10 text-lg">Konsultasikan visi produk Anda dengan tim ahli kami secara gratis dan temukan potensi aroma yang tak terbatas.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <button class="bg-primary text-white px-8 py-4 rounded-xl font-bold flex items-center gap-2 hover:shadow-lg hover:shadow-primary/30 transition-all">
                    <span class="material-symbols-outlined">bolt</span> Mulai Produksi Sekarang
                </button>
            <button class="px-8 py-4 rounded-xl font-semibold text-primary border-2 border-primary/20 hover:bg-primary/5 transition-all inline-flex items-center justify-center gap-2">
               
                Hubungi WhatsApp
            </button>
        </div>
    </div>
</section>
@endsection