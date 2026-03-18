<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan Maklon | PT. Arum Jaya Gemilang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Plus+Jakarta+Sans:wght@400;600;700&family=Brittany+Signature&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #fff; }
        .serif { font-family: 'Playfair Display', serif; }
        .sign  { font-family: 'Brittany Signature', cursive; }
        .fi {
            width: 100%; padding: 1rem 1.25rem;
            background: #E9E3F1; border-radius: .5rem;
            border: 2px solid transparent;
            font-size: 1rem; color: #4B3D61;
            transition: all .25s; outline: none;
            appearance: none;
        }
        .fi:focus { background: #fff; border-color: #5C4B7A; box-shadow: 0 8px 20px -4px rgba(92,75,122,.12); }
        .fi::placeholder { color: #A098AE; font-style: italic; }
        .fi.err { border-color: #dc2626 !important; background: #fff5f5; }
    </style>
</head>
<body class="min-h-screen">

<header class="flex justify-between items-center px-10 py-5 bg-white border-b border-gray-100 sticky top-0 z-50">
    <div class="flex items-center gap-3">
        <img src="{{ asset('Assets/Image/logo.png') }}" alt="Logo" class="w-12 h-12 object-contain">
        <span class="text-lg font-bold text-[#5c4b7a] tracking-wide uppercase">PT. Arum Jaya Gemilang</span>
    </div>
    <div class="flex items-center gap-3">
        <span class="text-sm text-gray-500 hidden sm:block">{{ auth()->user()->nama_brand ?? auth()->user()->name }}</span>
        <a href="{{ route('dashboard') }}" title="Dashboard"
           class="w-9 h-9 bg-[#e9e3f1] rounded-full flex items-center justify-center text-[#5c4b7a] hover:bg-[#d8cfee] transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
            </svg>
        </a>
    </div>
</header>

<main class="max-w-5xl mx-auto mt-14 px-6 text-center">
    <h1 class="text-5xl serif text-[#4b3d61] mb-2 tracking-tight">Form Pengajuan Maklon</h1>
    <p class="text-2xl sign text-purple-400 italic mb-12">Wujudkan produk impian Anda bersama kami</p>

    {{-- Pesan error / session --}}
    @if(session('error'))
        <div class="mb-6 text-left bg-red-50 border border-red-200 rounded-xl p-4 text-red-700 text-sm">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="mb-6 text-left bg-red-50 border border-red-200 rounded-xl p-4 text-sm">
            @foreach($errors->all() as $e)<p class="text-red-700">• {{ $e }}</p>@endforeach
        </div>
    @endif

    <form action="{{ route('pemesanan.store') }}" method="POST"
          class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
        @csrf

        {{-- Kolom 1 --}}
        <div class="space-y-7">
            {{-- Jenis Parfum --}}
            <div>
                <label class="block text-xl font-bold text-gray-800 mb-3">
                    Jenis Parfum <span class="text-red-500 text-base">*</span>
                </label>
                <div class="relative">
                    <select name="harga_parfum_id"
                            class="fi cursor-pointer {{ $errors->has('harga_parfum_id') ? 'err' : '' }}">
                        <option value="">-- Pilih Jenis Parfum --</option>
                        @foreach($hargaParfums as $hp)
                            <option value="{{ $hp->id }}"
                                {{ old('harga_parfum_id') == $hp->id ? 'selected' : '' }}>
                                {{ $hp->jenis_parfum }} — Rp {{ number_format($hp->harga_per_ml, 0, ',', '.') }}/ml
                            </option>
                        @endforeach
                    </select>
                    <span class="absolute right-4 top-4 pointer-events-none text-gray-500 text-sm">▼</span>
                </div>
                @error('harga_parfum_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Jumlah Produksi --}}
            <div>
                <label class="block text-xl font-bold text-gray-800 mb-3">
                    Jumlah Produksi (unit) <span class="text-red-500 text-base">*</span>
                </label>
                <input type="number" name="jumlah" min="50"
                       placeholder="Minimum 50 unit"
                       value="{{ old('jumlah') }}"
                       class="fi {{ $errors->has('jumlah') ? 'err' : '' }}">
                @error('jumlah')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- Kolom 2 --}}
        <div class="space-y-7">
            {{-- Nama Brand (read-only) --}}
            <div>
                <label class="block text-xl font-bold text-gray-800 mb-3">Nama Brand</label>
                <input type="text" class="fi opacity-60 cursor-not-allowed"
                       value="{{ auth()->user()->nama_brand ?? auth()->user()->name }}" disabled>
                <p class="text-xs text-gray-400 mt-1">Diambil otomatis dari profil akun</p>
            </div>

            {{-- Target Market --}}
            <div>
                <label class="block text-xl font-bold text-gray-800 mb-3">
                    Target Market <span class="text-red-500 text-base">*</span>
                </label>
                <div class="relative">
                    <select name="target_market"
                            class="fi cursor-pointer {{ $errors->has('target_market') ? 'err' : '' }}">
                        <option value="">-- Pilih Target Market --</option>
                        @foreach(['Remaja / Gen Z','Dewasa / Profesional','Premium / Executive','Luxury / High-End','Umum / Mass Market'] as $t)
                            <option value="{{ $t }}" {{ old('target_market') === $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                    <span class="absolute right-4 top-4 pointer-events-none text-gray-500 text-sm">▼</span>
                </div>
                @error('target_market')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- Kolom 3: Catatan --}}
        <div>
            <label class="block text-xl font-bold text-gray-800 mb-3">Catatan</label>
            <textarea name="catatan" placeholder="Deskripsikan kebutuhan khusus Anda (opsional)..."
                      class="fi resize-none" style="height:225px;">{{ old('catatan') }}</textarea>
        </div>

        {{-- Estimasi harga --}}
        @if($hargaParfums->count())
        <div class="md:col-span-3 bg-purple-50 rounded-2xl p-5 border border-purple-100">
            <p class="text-sm font-semibold text-purple-700 mb-2">💡 Referensi Harga Parfum per ml</p>
            <div class="flex flex-wrap gap-4">
                @foreach($hargaParfums as $hp)
                <span class="text-xs text-purple-600">
                    <strong>{{ $hp->jenis_parfum }}</strong>: Rp {{ number_format($hp->harga_per_ml, 0, ',', '.') }}
                </span>
                @endforeach
            </div>
            <p class="text-xs text-gray-400 mt-2">* Total = harga/ml × jumlah unit + biaya aroma + biaya kemasan</p>
        </div>
        @endif

        <div class="md:col-span-3 flex justify-center mt-4">
            <button type="submit"
                    class="bg-[#5C4B7A] hover:bg-[#4B3D61] active:scale-95 text-white px-16 py-4 rounded-xl font-bold text-lg shadow-xl transition-all">
                Lanjut ke Pilih Aroma →
            </button>
        </div>
    </form>

    <footer class="mt-20 mb-10 text-gray-400 italic text-sm">
        Silakan lengkapi formulir dengan data yang benar dan lengkap.
    </footer>
</main>
</body>
</html>
