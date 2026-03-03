<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Daftar Akun | PT. Arum Jaya Gemilang</title>
  
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: { 
              purple: '#523678', 
              lightPurple: '#E9E3F1',
              dark: '#351A5C' 
            }
          }
        }
      }
    }
  </script>
  
  <style>
    /* Mengatur standar font size dasar agar tidak kebesaran di zoom 100% */
    html { font-size: 14px; } 

    .glass-box {
      background-color: rgba(53, 26, 92, 0.85); 
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .bg-perfume {
      background-image: url('../Assets/Image/Helmut Lang.jpeg');
      background-size: cover;
      background-position: center;
    }

    /* Ukuran input disesuaikan lebih slim */
    .input-field {
      width: 100%;
      padding: 0.6rem 0.9rem;
      background-color: #E9E3F1 !important; 
      border-radius: 0.4rem;
      border: 1px solid transparent;
      font-size: 0.85rem;
      color: #523678;
      transition: all 0.3s ease;
    }

    .input-field:focus {
      border-color: #523678;
      outline: none;
      background-color: #dfd5ed !important;
    }

    .no-scrollbar::-webkit-scrollbar { display: none; }
  </style>
</head>
<body class="antialiased h-screen w-full flex overflow-hidden font-['Poppins'] bg-[#F8F9FA]">

  <section class="relative hidden lg:flex lg:w-1/2 h-full bg-perfume items-end p-12">
    <div class="absolute inset-0 bg-black/15"></div>
    
    <div class="relative z-10 glass-box rounded-2xl p-8 w-full max-w-[360px] shadow-xl">
      <h2 class="font-bold text-2xl xl:text-3xl tracking-wide mb-3 text-white uppercase leading-tight">
        OFFICIAL MAKLON PARFUM
      </h2>
      <p class="text-xs xl:text-sm text-white/80 leading-relaxed font-light">
        Partner manufaktur parfum terpercaya dengan standar kualitas premium untuk membangun identitas aroma eksklusif Anda.
      </p>
    </div>
  </section>

  <section class="w-full lg:w-1/2 h-full flex items-center justify-center p-6 overflow-y-auto no-scrollbar">
    
    <div class="w-full max-w-[360px] py-4">
      
      <div class="mb-6">
        <h1 class="text-3xl font-bold text-brand-purple mb-1">Daftar Akun</h1>
        <p class="text-[0.8rem] text-gray-500">
          Apakah anda sudah punya akun? 
          <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Log In</a>
        </p>
      </div>

      <form action="#" method="POST" class="space-y-3.5">
        
        <div>
          <label class="block text-[0.8rem] font-semibold text-gray-700 mb-1">Nama Brand</label>
          <input type="text" placeholder="Nama Brand" class="input-field">
        </div>

        <div>
          <label class="block text-[0.8rem] font-semibold text-gray-700 mb-1">Email</label>
          <input type="email" placeholder="Email" class="input-field">
        </div>

        <div>
          <label class="block text-[0.8rem] font-semibold text-gray-700 mb-1">No Telepon</label>
          <input type="text" placeholder="No Telepon" class="input-field">
        </div>

        <div>
          <label class="block text-[0.8rem] font-semibold text-gray-700 mb-1">Password</label>
          <input type="password" placeholder="Password" class="input-field">
        </div>

        <div class="pt-3">
          <button class="w-full bg-brand-purple hover:bg-brand-dark text-white font-bold py-3 rounded-lg text-sm transition-all shadow-md active:scale-[0.98]">
            Daftar Akun
          </button>
        </div>

        <div class="relative flex items-center py-3">
          <div class="flex-grow border-t border-gray-200"></div>
          <span class="flex-shrink mx-3 text-[9px] text-gray-400 uppercase tracking-widest font-bold">Atau</span>
          <div class="flex-grow border-t border-gray-200"></div>
        </div>

        <button type="button" class="w-full flex items-center justify-center gap-2 py-2.5 border border-gray-200 bg-white rounded-lg hover:bg-gray-50 transition-all text-gray-700 text-[0.8rem] font-semibold shadow-sm">
          <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" class="w-4 h-4" alt="Google">
          Google
        </button>
      </form>

      <p class="text-[0.65rem] text-gray-400 italic mt-8 text-center leading-relaxed">
        Dengan mendaftar, Anda menyetujui <span class="underline">Ketentuan Layanan</span> dan <span class="underline">Kebijakan Privasi</span> kami.
      </p>
    </div>
  </section>

</body>
</html>