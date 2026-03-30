<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Daftar Akun | PT. Arum Jaya Gemilang</title>
  
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: { purple: '#523678', lightPurple: '#E9E3F1', dark: '#351A5C' }
          }
        }
      }
    }
  </script>
  <style>
    /* Ukuran dasar diperkecil lagi agar lebih padat */
    html { font-size: 11px; } 
    @media (max-width: 1023px) {
      html { font-size: 14px; }
    }
    .glass-box {
        background-color: rgba(53, 26, 92, 0.85); 
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .bg-perfume {
        background-image: url("{{ asset('Assets/Image/Helmut Lang.jpeg') }}");
        background-size: cover;
        background-position: center;
    }
    /* Padding input dibuat lebih tipis (0.3rem) */
    .input-field {
      width: 100%;
      padding: 0.35rem 0.7rem; 
      background-color: #E9E3F1 !important; 
      border-radius: 0.4rem;
      border: 1px solid transparent;
      font-size: 0.9rem;
      color: #523678;
    }
    @media (max-width: 1023px) {
      .input-field {
        padding: 0.5rem 0.8rem;
        font-size: 1rem;
      }
    }
    .no-scrollbar::-webkit-scrollbar { display: none; }
  </style>
</head>
<body class="antialiased h-screen w-full flex overflow-hidden font-['Poppins'] bg-[#F8F9FA]">

  <section class="relative hidden lg:flex lg:w-1/2 h-full bg-perfume items-end p-10">
    <div class="absolute inset-0 bg-black/15"></div>
    <div class="relative z-10 glass-box rounded-2xl p-6 w-full max-w-[320px] shadow-xl">
      <h2 class="font-bold text-xl text-white uppercase mb-2 leading-tight">OFFICIAL MAKLON PARFUM</h2>
      <p class="text-[0.7rem] text-white/80 leading-relaxed font-light">Partner manufaktur parfum terpercaya untuk identitas aroma eksklusif Anda.</p>
    </div>
  </section>

  <section class="w-full lg:w-1/2 h-full flex items-center justify-center p-4 overflow-y-auto no-scrollbar">
    <div class="w-full max-w-[290px] py-2"> <div class="mb-4">
        <h1 class="text-2xl font-bold text-brand-purple mb-0.5">Daftar Akun</h1>
        <p class="text-[0.75rem] text-gray-500">Apakah anda sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Log In</a></p>
      </div>

      <form action="{{ route('register') }}" method="POST" class="space-y-1.5 lg:space-y-2"> @csrf
        
        <div>
            <label class="block text-[0.7rem] lg:text-sm font-semibold text-gray-700 mb-0.5">Nama Pemilik</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" class="input-field @error('name') border-red-500 @enderror">
            @error('name') <p class="text-[9px] lg:text-xs text-red-500 mt-0.5 italic leading-none">* {{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-[0.7rem] lg:text-sm font-semibold text-gray-700 mb-0.5">Username</label>
            <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" class="input-field @error('username') border-red-500 @enderror">
            @error('username') <p class="text-[9px] lg:text-xs text-red-500 mt-0.5 italic leading-none">* {{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-[0.7rem] lg:text-sm font-semibold text-gray-700 mb-0.5">Nama Brand</label>
            <input type="text" name="nama_brand" value="{{ old('nama_brand') }}" placeholder="Nama Brand" class="input-field @error('nama_brand') border-red-500 @enderror">
            @error('nama_brand') <p class="text-[9px] lg:text-xs text-red-500 mt-0.5 italic leading-none">* {{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-[0.7rem] lg:text-sm font-semibold text-gray-700 mb-0.5">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="input-field @error('email') border-red-500 @enderror">
            @error('email') <p class="text-[9px] lg:text-xs text-red-500 mt-0.5 italic leading-none">* {{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-[0.7rem] lg:text-sm font-semibold text-gray-700 mb-0.5">No Telepon</label>
            <input type="text" name="no_telp" value="{{ old('no_telp') }}" placeholder="No Telepon" class="input-field @error('no_telp') border-red-500 @enderror">
            @error('no_telp') <p class="text-[9px] lg:text-xs text-red-500 mt-0.5 italic leading-none">* {{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-[0.7rem] lg:text-sm font-semibold text-gray-700 mb-0.5">Password</label>
            <input type="password" name="password" placeholder="Password" class="input-field @error('password') border-red-500 @enderror">
            @error('password') <p class="text-[9px] lg:text-xs text-red-500 mt-0.5 italic leading-none">* {{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-[0.7rem] font-semibold text-gray-700 mb-0.5">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="input-field @error('password_confirmation') border-red-500 @enderror">
            @error('password_confirmation') <p class="text-[9px] text-red-500 mt-0.5 italic leading-none">* {{ $message }}</p> @enderror
        </div>

        <div class="pt-1.5">
            <button type="submit" class="w-full bg-[#523678] text-white font-bold py-2 rounded-lg text-sm shadow-md active:scale-95 transition-all">Daftar Akun</button>
        </div>

        <div class="relative flex items-center py-2">
          <div class="flex-grow border-t border-gray-200"></div>
          <span class="flex-shrink mx-2 text-[8px] text-gray-400 uppercase font-bold">Atau</span>
          <div class="flex-grow border-t border-gray-200"></div>
        </div>

        <button type="button" class="w-full flex items-center justify-center gap-2 py-2 border border-gray-200 bg-white rounded-lg text-gray-700 text-[0.75rem] font-semibold hover:bg-gray-50 transition-all">
          <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" class="w-3.5 h-3.5" alt="Google"> Google
        </button>
      </form>

      <p class="text-[0.6rem] lg:text-sm text-gray-400 italic mt-4 text-center leading-tight">
        Dengan mendaftar, Anda menyetujui <span class="underline">Ketentuan Layanan</span> dan <span class="underline">Kebijakan Privasi</span> kami.
      </p>
    </div>
  </section>
</body>
</html>