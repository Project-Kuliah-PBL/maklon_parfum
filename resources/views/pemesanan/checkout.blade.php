<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Konfirmasi Pesanan | Maklon Perfume</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#513678",
                        "background-light": "#f7f6f7",
                        "background-dark": "#18151d",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
<style>
        body {
            font-family: 'Manrope', sans-serif;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 font-display">
<header class="sticky top-0 z-50 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-14 md:h-16">
      
      <!-- Logo dan Nama PT -->
      <div class="flex items-center gap-3">
        <!-- Logo perusahaan -->
        <div class="flex-shrink-0">
          <img src="{{ asset('Assets/Image/logo.png') }}" 
               alt="Logo PT. Arum Jaya Gemilang" 
               class="w-[40px] h-[40px] md:w-[45px] md:h-[45px] object-contain">
        </div>
        <!-- Nama PT -->
        <span class="font-serif text-base md:text-lg lg:text-xl font-bold text-[#523678] tracking-tight whitespace-nowrap">
          PT. Arum Jaya Gemilang
        </span>
      </div>
      
      <!-- Profile Icon -->
      <div class="flex items-center gap-4">
        <div class="w-8 h-8 rounded-full bg-[#523678]/10 flex items-center justify-center">
          <span class="material-symbols-outlined text-[#523678] text-sm">person</span>
        </div>
      </div>
      
    </div>
  </div>
</header>
<main class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
<div class="mb-10">
<div class="flex items-center justify-between max-w-2xl mx-auto relative">
<div class="absolute top-1/2 left-0 w-full h-0.5 bg-slate-200 dark:bg-slate-800 -translate-y-1/2 -z-10"></div>
<div class="flex flex-col items-center gap-2 bg-background-light dark:bg-background-dark px-2">
<div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold">
<span class="material-symbols-outlined text-sm">check</span>
</div>
<span class="text-xs font-semibold text-slate-500">Formulasi</span>
</div>
<div class="flex flex-col items-center gap-2 bg-background-light dark:bg-background-dark px-2">
<div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold">
<span class="material-symbols-outlined text-sm">check</span>
</div>
<span class="text-xs font-semibold text-slate-500">Desain</span>
</div>
<div class="flex flex-col items-center gap-2 bg-background-light dark:bg-background-dark px-2">
<div class="w-10 h-10 rounded-full ring-4 ring-primary/20 bg-primary text-white flex items-center justify-center text-xs font-bold">3</div>
<span class="text-xs font-bold text-primary">Checkout</span>
</div>
<div class="flex flex-col items-center gap-2 bg-background-light dark:bg-background-dark px-2">
<div class="w-8 h-8 rounded-full bg-slate-200 dark:bg-slate-800 text-slate-400 flex items-center justify-center text-xs font-bold">4</div>
<span class="text-xs font-semibold text-slate-400">Produksi</span>
</div>
</div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
<div class="lg:col-span-8 space-y-6">
<section>
<h1 class="text-3xl font-black tracking-tight mb-2">Finalisasi Pesanan Produksi</h1>
<p class="text-slate-500 dark:text-slate-400">Silakan tinjau spesifikasi parfum kustom dan lini masa manufaktur Anda.</p>
</section>
<div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
<div class="p-6">
<div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100 dark:border-slate-800">
<div class="w-24 h-24 rounded-lg bg-slate-100 dark:bg-slate-800 overflow-hidden shrink-0">
<img alt="Fragrance bottle silhouette" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDKb0wBVv--bmUQmryOyI6nhuZOoAhjUfMnwVqFhwQvqCbM3-yZsNkrczPSywE6mF8TWQHhzex6LhxNmjav8dn6ly899NBv7kkOEZu1Zp6g1vIgBVzaF8RDS38-E4siazmTsQY7C9MKTK1QeQCOX5OfEgsMaHPgtvvtFWDfOYOT88LKM3Z414i1HhCR8AHLOjK3kn-GotTx9UanyGMx1LkbFZnYiTWRIPMaXRQ8RhrT4XcMJyCTuTK_F-7woDw1CO2x-Eun_6lnJGI"/>
</div>
<div class="flex-1">
<div class="flex justify-between items-start">
<div>
<h3 class="text-xl font-bold">Velvet Oud &amp; Saffron</h3>
<p class="text-sm text-slate-500">Ref ID: MK-99283-2024</p>
</div>
<span class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full">Batch Premium</span>
</div>
<div class="mt-4 flex flex-wrap gap-2">
<span class="inline-flex items-center gap-1 px-2 py-1 bg-slate-100 dark:bg-slate-800 rounded text-xs">
<span class="material-symbols-outlined text-[14px]">opacity</span> 100ml
                                </span>
<span class="inline-flex items-center gap-1 px-2 py-1 bg-slate-100 dark:bg-slate-800 rounded text-xs"><span class="material-symbols-outlined text-[14px]">package_2</span> Botol Kaca Silinder</span>
<span class="inline-flex items-center gap-1 px-2 py-1 bg-slate-100 dark:bg-slate-800 rounded text-xs"><span class="material-symbols-outlined text-[14px]">inventory_2</span> 500 Unit</span>
</div>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
<div>
<h4 class="text-sm font-bold uppercase tracking-wider text-slate-400 mb-4">Komposisi Aroma</h4>
<ul class="space-y-3">
<li class="flex items-center justify-between">
<span class="text-sm">Atas: Saffron, Bergamot</span>
<span class="text-xs font-semibold text-primary">15%</span>
</li>
<li class="flex items-center justify-between">
<span class="text-sm">Tengah: Bulgarian Rose, Oud</span>
<span class="text-xs font-semibold text-primary">45%</span>
</li>
<li class="flex items-center justify-between">
<span class="text-sm">Bawah: Sandalwood, Amber</span>
<span class="text-xs font-semibold text-primary">40%</span>
</li>
</ul>
<button class="mt-4 text-xs font-bold text-primary flex items-center gap-1 hover:underline"><span class="material-symbols-outlined text-sm">visibility</span> LIHAT RESEP LENGKAP</button>
</div>
<div>
<h4 class="text-sm font-bold uppercase tracking-wider text-slate-400 mb-4">Detail Kemasan</h4>
<div class="space-y-2">
<div class="flex justify-between text-sm">
<span class="text-slate-500">Botol:</span>
<span class="font-medium">Frosted Gold Finish</span>
</div>
<div class="flex justify-between text-sm">
<span class="text-slate-500">Tutup:</span>
<span class="font-medium">Kayu Magnetik</span>
</div>
<div class="flex justify-between text-sm">
<span class="text-slate-500">Label:</span>
<span class="font-medium">Cetak Foil Emas</span>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="bg-primary/5 rounded-xl p-6 border border-primary/10">
<div class="flex items-start gap-4">
<div class="p-3 bg-white dark:bg-slate-900 rounded-lg text-primary shadow-sm">
<span class="material-symbols-outlined">event_upcoming</span>
</div>
<div class="flex-1">
<h3 class="text-lg font-bold">Lini Masa Produksi</h3>
<p class="text-sm text-slate-600 dark:text-slate-400 mb-4">Estimasi penyelesaian dan jadwal pengiriman.</p>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
<div class="bg-white dark:bg-slate-900 p-4 rounded-lg shadow-sm border border-slate-100 dark:border-slate-800">
<span class="text-[10px] font-black uppercase text-slate-400">Bahan Baku</span>
<p class="text-sm font-bold">12 Okt - 15 Okt</p>
</div>
<div class="bg-white dark:bg-slate-900 p-4 rounded-lg shadow-sm border border-slate-100 dark:border-slate-800">
<span class="text-[10px] font-black uppercase text-slate-400">Pencampuran &amp; Pengemasan</span>
<p class="text-sm font-bold">16 Okt - 05 Nov</p>
</div>
<div class="bg-primary p-4 rounded-lg shadow-sm border border-primary text-white">
<span class="text-[10px] font-black uppercase text-white/70">Tanggal Pengiriman</span>
<p class="text-sm font-bold">12 Nov 2024</p>
</div>
</div>
</div>
</div>
</div>
<div class="space-y-4">
<h3 class="text-lg font-bold">Metode Pembayaran</h3>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
<label class="relative flex flex-col p-4 bg-white dark:bg-slate-900 border-2 border-primary rounded-xl cursor-pointer shadow-sm">
<input checked="" class="absolute top-4 right-4 text-primary focus:ring-primary h-4 w-4" name="payment" type="radio"/>
<span class="material-symbols-outlined text-primary mb-2">account_balance</span>
<span class="text-sm font-bold">Transfer Bank</span>
<span class="text-[10px] text-slate-400">Verifikasi manual</span>
</label>
<label class="relative flex flex-col p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl cursor-pointer hover:border-primary/50 transition-colors">
<input class="absolute top-4 right-4 text-primary focus:ring-primary h-4 w-4" name="payment" type="radio"/>
<span class="material-symbols-outlined text-slate-600 dark:text-slate-400 mb-2">credit_card</span>
<span class="text-sm font-bold">Kartu Kredit</span>
<span class="text-[10px] text-slate-400">Verifikasi otomatis</span>
</label>
<label class="relative flex flex-col p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl cursor-pointer hover:border-primary/50 transition-colors">
<input class="absolute top-4 right-4 text-primary focus:ring-primary h-4 w-4" name="payment" type="radio"/>
<span class="material-symbols-outlined text-slate-600 dark:text-slate-400 mb-2">account_balance_wallet</span>
<span class="text-sm font-bold">Deposit 50%</span>
<span class="text-[10px] text-slate-400">Bayar sisa saat pengiriman</span>
</label>
</div>
</div>
</div>
<div class="lg:col-span-4 lg:sticky lg:top-24">
<div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-xl overflow-hidden">
<div class="p-6">
<h3 class="text-lg font-bold mb-6">Ringkasan Biaya Pesanan</h3>
<div class="space-y-4 mb-6">
<div class="flex justify-between text-sm">
<span class="text-slate-500">Esensi Parfum (5L)</span>
<span class="font-medium font-display">Rp 65.500.000</span>
</div>
<div class="flex justify-between text-sm">
<span class="text-slate-500">Kemasan (500 set)</span>
<span class="font-medium font-display">Rp 18.250.000</span>
</div>
<div class="flex justify-between text-sm">
<span class="text-slate-500">Tenaga Kerja &amp; Pengisian</span>
<span class="font-medium font-display">Rp 14.000.000</span>
</div>
<div class="flex justify-between text-sm">
<span class="text-slate-500">Biaya Lab Kontrol Kualitas</span>
<span class="font-medium font-display">Rp 4.700.000</span>
</div>
<div class="flex justify-between text-sm">
<span class="text-slate-500">Pengiriman (Kargo)</span>
<span class="font-medium font-display text-green-600 font-bold uppercase text-[10px] self-center">Gratis</span>
</div>
<div class="pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-between items-end">
<div>
<span class="text-xs text-slate-400 font-bold uppercase">Total Harga</span>
<p class="text-3xl font-black text-primary">Rp 102.450.000</p>
</div>
<span class="text-[10px] text-slate-400">Termasuk PPN 10%</span>
</div>
</div>
<div class="space-y-4">
<div class="flex items-start gap-3">
<input class="mt-1 rounded text-primary focus:ring-primary border-slate-300" id="terms" type="checkbox"/>
<label class="text-xs text-slate-500 leading-relaxed" for="terms">Saya setuju dengan <a class="text-primary underline" href="#">Syarat &amp; Ketentuan Manufaktur</a> dan memahami bahwa produksi parfum kustom tidak dapat dibatalkan setelah proses batch dimulai.</label>
</div>
<button class="w-full bg-primary hover:bg-[#422c63] text-white py-4 rounded-xl font-bold transition-all shadow-lg shadow-primary/25 flex items-center justify-center gap-2 group">KONFIRMASI PESANAN PRODUKSI <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span></button>
<div class="flex items-center justify-center gap-6 pt-4">
<div class="flex items-center gap-1 text-[10px] font-bold text-slate-400">
<span class="material-symbols-outlined text-sm">verified_user</span>
                                PEMBAYARAN TERJAMIN
                            </div>
<div class="flex items-center gap-1 text-[10px] font-bold text-slate-400">
<span class="material-symbols-outlined text-sm">workspace_premium</span>
                                BERSERTIFIKAT GMP
                            </div>
</div>
</div>
</div>
<div class="bg-slate-50 dark:bg-slate-800/50 p-4 border-t border-slate-100 dark:border-slate-800">
<p class="text-[10px] text-slate-400 text-center leading-tight">Butuh bantuan? Hubungi spesialis lab Anda di <br/><a class="text-primary font-bold" href="mailto:arumjayagemilang1@gmail.com">arumjayagemilang@gmail.com</a></p>
</div>
</div>
</div>
</div>
</main>
<footer class="mt-20 border-t border-slate-200 dark:border-slate-800 py-10 bg-white dark:bg-background-dark">
<div class="max-w-7xl mx-auto px-4 text-center">
<p class="text-xs text-slate-400">© 2026 PT. Arum Jaya Gemilang. Hak Cipta Dilindungi.</p>
</div>
</footer>

</body></html>