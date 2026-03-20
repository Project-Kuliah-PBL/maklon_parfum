<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PT. Arum Jaya Gemilang</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Google Fonts: Poppins & Playfair Display -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: { purple: '#523678', light: '#F3F4F6' }
          },
          fontFamily: {
            sans: ['Poppins', 'sans-serif'],
            serif: ['Playfair Display', 'serif'],
          }
        }
      }
    }
  </script>
  <style>
    /* Glass effect dengan warna #351A5C opacity 76% */
    .glass-custom {
      background-color: rgba(53, 26, 92, 0.76);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.15);
    }
    .bg-perfume {
      background-image: url('../Assets/Image/Helmut Lang.jpeg');
      background-size: cover;
      background-position: center 30%;
    }
    /* Menghilangkan scrollbar */
    .no-scrollbar::-webkit-scrollbar {
      display: none;
    }
    .no-scrollbar {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }
  </style>
</head>
<body class="bg-[#7D718A] font-sans antialiased h-screen overflow-hidden flex items-center justify-center p-2">
  <!-- MAIN CARD -->
  <div class="w-full max-w-[880px] h-[90vh] max-h-[480px] lg:max-h-[460px] bg-white rounded-3xl overflow-hidden shadow-premium flex flex-col lg:flex-row">
    
    <!-- LEFT PANEL: visual -->
    <section class="hidden lg:flex relative w-full h-[25%] lg:w-1/2 lg:h-full bg-perfume overflow-hidden">
      <!-- Overlay gradient soft -->
      <div class="hidden lg:block absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
      
      <!-- Glass card di TENGAH BAWAH -->
      <div class="absolute left-1/2 -translate-x-1/2 bottom-3 lg:bottom-5 z-10 w-full flex justify-center">
        <div class="glass-custom rounded-xl px-4 py-3 lg:px-5 lg:py-3.5 max-w-[260px] lg:max-w-[280px]">
          <h1 class="font-sans text-white text-sm lg:text-base leading-tight font-semibold text-center">
            Wujudkan Visi Brand Parfum Anda Bersama Kami
          </h1>
          <p class="text-white/80 text-[0.7rem] lg:text-[0.7rem] leading-relaxed font-light text-center mt-1">
            Partner manufaktur parfum terpercaya dengan standar kualitas premium untuk membangun identitas aroma eksklusif Anda.
          </p>
        </div>
      </div>
    </section>

    <!-- RIGHT PANEL: login form -->
    <section class="w-full h-[75%] lg:w-1/2 lg:h-full flex flex-col justify-center items-center p-4 lg:p-6 overflow-y-auto no-scrollbar">
      <!-- Container form - beri padding kiri 0 -->
       <div class="mb-2 flex items-center gap-3 justify-start ml-0 pl-0">
          <!-- Logo -->
          <img src="{{ asset('Assets/Image/logo.png') }}" 
               alt="Logo PT. Arum Jaya Gemilang" 
               class="w-[50px] h-[50px] lg:w-[55px] lg:h-[55px] object-contain flex-shrink-0">
          
          <!-- Teks perusahaan - memanjang ke kanan -->
          <h2 class="font-serif text-[1.1rem] lg:text-[1.4rem] text-brand-purple tracking-tight leading-tight whitespace-nowrap pl-0 text-left">
            PT. Arum Jaya Gemilang
          </h2>
        </div>
      <div class="w-full max-w-[280px] lg:max-w-[260px] pl-0">
        <!-- Header dengan LOGO dan TEKS sejajar ke KIRI SEKALI -->
        
        
        <!-- Selamat Datang dan subtitle (rata kiri) -->
        <div class="mb-3 text-left ml-0 pl-0">
          <h3 class="font-semibold text-gray-800 text-base lg:text-lg">Selamat Datang</h3>
          <p class="text-gray-500 text-[0.65rem] lg:text-xs font-light">Masuk ke akun Anda</p>
        </div>

        <!-- Form -->
         <!-- jika login gagal -->
         @if ($errors->any())
        <div class="text-red-500 text-xs mb-2">
        {{ $errors->first() }}
        </div>
        @endif
        <!-- jika login berhasil -->
        @if(session('success'))
        <div class="text-green-600 text-xs mb-2">
        {{ session('success') }}
        </div>
        @endif
        <form action="{{ route('login') }}" class="space-y-2.5" method="POST">
        @csrf
          <!-- Email -->
          <div>
            <label class="block text-[0.6rem] lg:text-xs font-medium text-gray-700 mb-0.5" for="email">Email</label>
            <input class="w-full px-3 py-1.5 lg:px-3.5 lg:py-2 text-[0.65rem] lg:text-xs border border-gray-200 rounded-lg focus:border-brand-purple focus:ring-1 focus:ring-brand-purple transition-all bg-gray-50/50" id="email" name="email" placeholder="nama@email.com" required="" type="text">
          </div>
          
          <!-- Password -->
          <div>
            <div class="flex justify-between items-center mb-0.5">
              <label class="block text-[0.6rem] lg:text-xs font-medium text-gray-700" for="password">Password</label>
              <a class="text-[0.55rem] lg:text-[0.6rem] font-medium text-brand-purple hover:underline" href="#">Lupa password?</a>
            </div>
            <input class="w-full px-3 py-1.5 lg:px-3.5 lg:py-2 text-[0.65rem] lg:text-xs border border-gray-200 rounded-lg focus:border-brand-purple focus:ring-1 focus:ring-brand-purple transition-all bg-gray-50/50" id="password" name="password" placeholder="••••••••" required="" type="password">
          </div>
          
          <!-- Remember me -->
          <div class="flex items-center">
            <input class="h-3 w-3 lg:h-3.5 lg:w-3.5 text-brand-purple focus:ring-brand-purple border-gray-300 rounded" id="remember-me" name="remember-me" type="checkbox">
            <label class="ml-2 text-[0.6rem] lg:text-xs text-gray-700" for="remember-me">Ingat saya</label>
          </div>
          
          <!-- Submit button -->
          <button class="w-full bg-brand-purple hover:bg-[#432d63] text-white font-medium py-2 lg:py-2.5 text-[0.65rem] lg:text-xs rounded-lg transition-all shadow-lg shadow-purple-900/10 active:scale-[0.98]" type="submit">Masuk</button>
        </form>

        <!-- Divider -->
        <div class="relative my-2.5">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-200"></div>
          </div>
          <div class="relative flex justify-center">
            <span class="px-3 bg-white text-gray-400 text-[0.55rem] lg:text-[0.6rem] font-light">Atau</span>
          </div>
        </div>

        <!-- Social Login - Google -->
        <div class="grid grid-cols-1">
          <button class="flex items-center justify-center gap-1.5 px-3 py-1.5 lg:py-2 border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors text-gray-700 text-[0.6rem] lg:text-xs font-normal">
            <svg class="w-3.5 h-3.5 lg:w-4 lg:h-4" viewbox="0 0 24 24">
              <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"></path>
              <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
              <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"></path>
              <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
            </svg>
            Google
          </button>
        </div>

        <!-- Daftar link -->
        <p class="text-center mt-2.5 text-gray-600 text-[0.55rem] lg:text-[0.6rem]">Belum punya akun?
          <a class="font-semibold text-brand-purple hover:underline" href="{{ route('register') }}">Daftar Sekarang</a>
        </p>
      </div>
    </section>
  </div>

  <!-- Shadow premium -->
  <style>.shadow-premium { box-shadow: 0 20px 50px rgba(82, 54, 120, 0.1); }</style>
</body>
</html>