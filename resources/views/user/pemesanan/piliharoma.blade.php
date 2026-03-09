<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Pilih Aroma dan Formula | PT. Arum Jaya Gemilang</title>
  
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@1,500;1,700&display=swap" rel="stylesheet">
  
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: { 
              purple: '#523678', 
              lightPurple: '#E9E3F1',
              dark: '#351A5C',
              gold: '#C5A358'
            }
          }
        }
      }
    }
  </script>
  
  <style>
    /* Mengatur standar font size dasar agar tidak kebesaran di zoom 100% */
    html { font-size: 14px; }
    body { font-family: 'Poppins', sans-serif; }
    .font-italic-serif { font-family: 'Playfair Display', serif; font-style: italic; }
    
    /* Animasi Klik */
    .click-pop { transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    .click-pop:active { transform: scale(0.94); }

    /* Kategori Aroma Aktif */
    .aroma-btn.active {
      background-color: #E9E3F1;
      border: 2px solid #523678;
      transform: translateY(-3px);
      box-shadow: 0 4px 12px rgba(82, 54, 120, 0.15);
    }

    /* Vessel Card Aktif (Blok Terpilih) */
    .vessel-card.active {
      border: 4px solid #C5A358;
      transform: scale(1.02);
      box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1);
    }
    .vessel-card.active .check-icon { opacity: 1; transform: scale(1); }
    .vessel-card.active img { filter: grayscale(0); }

    .check-icon { 
      opacity: 0; 
      transform: scale(0.5); 
      transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
    }

    .dashed-upload {
      border: 2px dashed #D1D5DB;
      background-color: #F9F7FC;
      transition: all 0.3s ease;
    }
    .dashed-upload:hover { border-color: #523678; background-color: #E9E3F1; }

    .note-tag {
        animation: fadeIn 0.5s ease forwards;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body class="bg-white text-brand-dark antialiased">

  <header class="w-full py-3 px-6 lg:px-12 flex justify-between items-center border-b border-gray-100 bg-white sticky top-0 z-50">
    <div class="flex items-center gap-2">
      <img src="{{ asset('Assets/Image/logo.png') }}" alt="Logo" class="h-8">
      <span class="font-bold text-base text-brand-purple tracking-tight">PT. Arum Jaya Gemilang</span>
    </div>
    <div class="bg-gray-100 p-1.5 rounded-full cursor-pointer hover:bg-gray-200 transition-colors">
      <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/></svg>
    </div>
  </header>

  <main class="max-w-6xl mx-auto px-6 py-10">
    
    <div class="text-center mb-12">
      <h1 class="text-5xl font-italic-serif text-brand-purple mb-3">Pilih Aroma dan Formula</h1>
      <p class="text-base text-brand-purple/70 max-w-2xl mx-auto leading-relaxed font-light">
        Tentukan karakter aroma dan komposisi formula sebagai dasar pengembangan produk maklon Anda.
      </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-16 gap-y-12">
      
      <div class="space-y-10">
        <section>
          <h2 class="text-lg font-bold mb-5 flex items-center gap-2">
            <span class="text-brand-purple text-xl">•</span> Kategori Aroma Utama
          </h2>
          <div class="grid grid-cols-4 gap-3">
            <button onclick="selectAroma(this)" class="aroma-btn click-pop flex flex-col items-center justify-center p-4 bg-white border border-brand-purple/20 rounded-xl group">
              <span class="mb-1 text-xl group-hover:scale-110 transition-transform">🌸</span>
              <span class="text-[0.6rem] font-bold uppercase tracking-widest text-brand-purple">Floral</span>
            </button>
            <button onclick="selectAroma(this)" class="aroma-btn active click-pop flex flex-col items-center justify-center p-4 bg-white border border-brand-purple/20 rounded-xl group">
              <span class="mb-1 text-xl group-hover:scale-110 transition-transform">🌲</span>
              <span class="text-[0.6rem] font-bold uppercase tracking-widest text-brand-purple">Woody</span>
            </button>
            <button onclick="selectAroma(this)" class="aroma-btn click-pop flex flex-col items-center justify-center p-4 bg-white border border-brand-purple/20 rounded-xl group">
              <span class="mb-1 text-xl group-hover:scale-110 transition-transform">🏺</span>
              <span class="text-[0.6rem] font-bold uppercase tracking-widest text-brand-purple">Oriental</span>
            </button>
            <button onclick="selectAroma(this)" class="aroma-btn click-pop flex flex-col items-center justify-center p-4 bg-white border border-brand-purple/20 rounded-xl group">
              <span class="mb-1 text-xl group-hover:scale-110 transition-transform">💧</span>
              <span class="text-[0.6rem] font-bold uppercase tracking-widest text-brand-purple">Fresh</span>
            </button>
          </div>
        </section>

        <section>
          <h2 class="text-lg font-bold mb-5 flex items-center gap-2">
            <span class="text-brand-purple text-xl">•</span> Komposisi Aroma
          </h2>
          <div class="border border-brand-purple/30 rounded-[2rem] p-8 space-y-8 bg-white shadow-sm">
            
            <div class="border-b border-gray-100 pb-6">
              <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-gray-700 text-sm">Top Notes ( 15-25% )</h3>
                <button class="text-xs text-brand-purple/50 font-medium hover:text-brand-purple">+ Tambah</button>
              </div>
              <div class="flex flex-wrap gap-2">
                <span class="note-tag bg-brand-purple text-white px-4 py-1.5 rounded-lg text-xs font-medium">Bergamot</span>
                <span class="note-tag bg-brand-purple text-white px-4 py-1.5 rounded-lg text-xs font-medium">Lemon Zets</span>
                <span class="note-tag bg-brand-purple text-white px-4 py-1.5 rounded-lg text-xs font-medium">Mandarin</span>
              </div>
            </div>

            <div class="border-b border-gray-100 pb-6">
              <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-gray-700 text-sm">Heart Notes ( 30-40% )</h3>
                <button class="text-xs text-brand-purple/50 font-medium hover:text-brand-purple">+ Tambah</button>
              </div>
              <div class="flex flex-wrap gap-2">
                <span class="note-tag bg-brand-purple text-white px-4 py-1.5 rounded-lg text-xs font-medium">Lavender</span>
                <span class="note-tag bg-brand-purple text-white px-4 py-1.5 rounded-lg text-xs font-medium">Sandalwood</span>
                <span class="note-tag bg-brand-purple text-white px-4 py-1.5 rounded-lg text-xs font-medium">Jasmine</span>
              </div>
            </div>

            <div>
              <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-gray-700 text-sm">Base Notes ( 30-40% )</h3>
                <button class="text-xs text-brand-purple/50 font-medium hover:text-brand-purple">+ Tambah</button>
              </div>
              <div class="flex flex-wrap gap-2">
                <span class="note-tag bg-brand-purple text-white px-4 py-1.5 rounded-lg text-xs font-medium">Vanilla</span>
                <span class="note-tag bg-brand-purple text-white px-4 py-1.5 rounded-lg text-xs font-medium">Musk</span>
              </div>
            </div>

          </div>
        </section>
      </div>

      <div class="space-y-10">
        <section>
          <h2 class="text-lg font-bold mb-5 flex items-center gap-2">
            <span class="text-brand-purple text-xl">•</span> Pilih Bentuk
          </h2>
          <div class="flex gap-6">
            <div onclick="selectVessel(this)" class="vessel-card active relative w-1/2 group cursor-pointer overflow-hidden rounded-[1.5rem] transition-all duration-500 shadow-md">
              <img src="https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=500" class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-700" alt="Parfum">
              <div class="absolute inset-0 bg-black/20 flex items-end p-4">
                <span class="text-white font-bold text-[0.7rem] uppercase tracking-widest">Parfum Extract</span>
              </div>
              <div class="check-icon absolute top-3 right-3 bg-brand-gold rounded-full p-1 shadow-md">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
              </div>
            </div>
            
            <div onclick="selectVessel(this)" class="vessel-card relative w-1/2 group cursor-pointer overflow-hidden rounded-[1.5rem] transition-all duration-500 shadow-md grayscale">
              <img src="https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?q=80&w=500" class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-700" alt="Body Mist">
              <div class="absolute inset-0 bg-black/30 flex items-end p-4">
                <span class="text-white font-bold text-[0.7rem] uppercase tracking-widest">Body Mist</span>
              </div>
              <div class="check-icon absolute top-3 right-3 bg-brand-gold rounded-full p-1 shadow-md">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
              </div>
            </div>
          </div>
        </section>

        <section>
          <h2 class="text-lg font-bold mb-5 flex items-center gap-2">
            <span class="text-brand-purple text-xl">•</span> Inspirasi Visual
          </h2>
          <div class="dashed-upload rounded-[1.5rem] p-12 flex flex-col items-center justify-center text-center space-y-3 cursor-pointer">
            <div class="w-12 h-12 text-brand-gold/60 animate-bounce">
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
            </div>
            <p class="text-brand-purple font-semibold text-sm">Unggah Moodboard Aroma</p>
          </div>
        </section>

        <a href="{{ route('pemesanan.checkout') }}" 
           class="w-full bg-brand-purple hover:bg-brand-dark text-white font-bold py-4 rounded-xl text-lg shadow-xl transition-all active:scale-[0.98] inline-flex items-center justify-center">
            Lanjut Ke Checkout
        </a>
      </div>
    </div>

    <footer class="mt-20 text-center border-t border-gray-100 pt-8 pb-10">
      <p class="text-[0.7rem] lg:text-xs text-brand-purple/60 font-medium mb-1 uppercase tracking-wider">
        Mohon periksa kembali pilihan aroma dan formula Anda sebelum mengajukan.
      </p>
      <p class="text-[0.7rem] lg:text-xs text-brand-purple/60 font-medium leading-relaxed italic">
        Data yang telah dikirim akan menjadi dasar pengembangan produk maklon.
      </p>
    </footer>

  </main>

  <script>
    function selectAroma(element) {
      document.querySelectorAll('.aroma-btn').forEach(btn => btn.classList.remove('active'));
      element.classList.add('active');
    }

    function selectVessel(element) {
      document.querySelectorAll('.vessel-card').forEach(card => card.classList.remove('active'));
      element.classList.add('active');
    }
  </script>
</body>
</html>