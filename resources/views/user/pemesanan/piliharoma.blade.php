<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pilih Aroma & Kemasan | PT. Arum Jaya Gemilang</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Playfair+Display:ital,wght@1,600&display=swap" rel="stylesheet">
  <script>
    tailwind.config = { theme: { extend: { colors: {
      brand: { purple:'#523678', dark:'#351A5C', gold:'#C5A358', light:'#E9E3F1' }
    }}}}
  </script>
  <style>
    body { font-family: 'Poppins', sans-serif; }
    .serif-it { font-family: 'Playfair Display', serif; font-style: italic; }
    .aroma-card  { transition: all .2s; cursor: pointer; border: 2px solid rgba(82,54,120,.15); }
    .aroma-card.active  { border-color: #523678; background: #f3eeff; box-shadow: 0 4px 14px rgba(82,54,120,.15); transform: translateY(-2px); }
    .kemasan-card { transition: all .2s; cursor: pointer; border: 2px solid #e5e7eb; }
    .kemasan-card.active { border-color: #C5A358; background: #fffbf0; box-shadow: 0 2px 8px rgba(197,163,88,.2); }
  </style>
</head>
<body class="bg-white min-h-screen">

<header class="py-3 px-6 lg:px-12 flex justify-between items-center border-b border-gray-100 bg-white sticky top-0 z-50">
    <div class="flex items-center gap-2">
        <img src="{{ asset('Assets/Image/logo.png') }}" alt="Logo" class="h-8">
        <span class="font-bold text-sm text-[#523678]">PT. Arum Jaya Gemilang</span>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('pemesanan.pengajuan') }}" class="text-xs text-[#523678] hover:underline">← Kembali</a>
        <span class="text-xs text-gray-400 hidden sm:block">{{ auth()->user()->nama_brand ?? auth()->user()->name }}</span>
    </div>
</header>

<main class="max-w-5xl mx-auto px-6 py-10">

    {{-- Step Indicator --}}
    <div class="flex items-center justify-center gap-2 mb-10 text-xs font-semibold flex-wrap">
        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">✓ Pengajuan</span>
        <span class="text-gray-300">──</span>
        <span class="bg-[#523678] text-white px-3 py-1 rounded-full">② Pilih Aroma</span>
        <span class="text-gray-300">──</span>
        <span class="bg-gray-100 text-gray-400 px-3 py-1 rounded-full">③ Checkout</span>
    </div>

    <div class="text-center mb-10">
        <h1 class="text-4xl serif-it text-[#523678] mb-2">Pilih Aroma & Kemasan</h1>
        <p class="text-sm text-[#523678]/60 max-w-xl mx-auto">Tentukan karakter aroma dan jenis kemasan untuk produk maklon Anda.</p>
    </div>

    @if(session('error'))
        <div class="mb-5 bg-red-50 border border-red-200 rounded-xl p-4 text-red-700 text-sm">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="mb-5 bg-red-50 border border-red-200 rounded-xl p-4 text-sm">
            @foreach($errors->all() as $e)<p class="text-red-700">• {{ $e }}</p>@endforeach
        </div>
    @endif

    <form action="{{ route('pemesanan.simpan-aroma') }}" method="POST" id="aromaForm">
        @csrf
        <input type="hidden" name="aroma_id"   id="inp_aroma">
        <input type="hidden" name="kemasan_id" id="inp_kemasan">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-10">

            {{-- KIRI: Aroma --}}
            <section>
                <h2 class="font-bold text-base mb-4 flex items-center gap-2">
                    <span class="text-[#523678]">•</span> Kategori Aroma
                    <span class="text-red-500 text-xs font-normal">(wajib)</span>
                </h2>

                @if($aromas->count())
                    <div class="grid grid-cols-2 gap-3">
                        @foreach($aromas as $a)
                        <div class="aroma-card rounded-xl p-4 bg-white"
                             onclick="pilihAroma({{ $a->id }}, this, '{{ addslashes($a->nama_kategori) }}')"
                             data-id="{{ $a->id }}">
                            <div class="font-bold text-sm text-[#523678] mb-0.5">{{ $a->nama_kategori }}</div>
                            <div class="text-xs text-gray-400">Rp {{ number_format($a->biaya_kategori, 0, ',', '.') }}</div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center text-gray-400 text-sm">
                        Belum ada data aroma. Hubungi admin.
                    </div>
                @endif

                <p id="err-aroma" class="text-red-500 text-xs mt-2 hidden">* Pilih salah satu aroma</p>
            </section>

            {{-- KANAN: Kemasan --}}
            <section>
                <h2 class="font-bold text-base mb-4 flex items-center gap-2">
                    <span class="text-[#523678]">•</span> Jenis Kemasan
                    <span class="text-red-500 text-xs font-normal">(wajib)</span>
                </h2>

                @if($kemasans->count())
                    <div class="space-y-3">
                        @foreach($kemasans as $k)
                        <div class="kemasan-card rounded-xl p-4 flex justify-between items-center bg-white"
                             onclick="pilihKemasan({{ $k->id }}, this, '{{ addslashes($k->jenis_botol) }}')"
                             data-id="{{ $k->id }}">
                            <div>
                                <div class="font-bold text-sm text-gray-800">{{ $k->jenis_botol }}</div>
                                <div class="text-xs text-gray-400">
                                    {{ $k->ukuran }}@if($k->jenis_box) • Box: {{ $k->jenis_box }}@endif
                                </div>
                            </div>
                            <div class="text-sm font-bold text-[#523678] whitespace-nowrap ml-4">
                                Rp {{ number_format($k->biaya_kemasan, 0, ',', '.') }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center text-gray-400 text-sm">
                        Belum ada data kemasan. Hubungi admin.
                    </div>
                @endif

                <p id="err-kemasan" class="text-red-500 text-xs mt-2 hidden">* Pilih salah satu kemasan</p>
            </section>
        </div>

        {{-- Ringkasan pilihan --}}
        <div id="summary" class="mt-8 bg-purple-50 border border-purple-100 rounded-2xl p-5 hidden">
            <p class="text-sm font-semibold text-purple-700 mb-2">✓ Pilihan Anda:</p>
            <div class="flex flex-wrap gap-8 text-sm">
                <div><span class="text-gray-500">Aroma:</span> <span id="lbl-aroma" class="font-bold text-[#523678]">-</span></div>
                <div><span class="text-gray-500">Kemasan:</span> <span id="lbl-kemasan" class="font-bold text-[#523678]">-</span></div>
            </div>
        </div>

        <div class="flex justify-center mt-10">
            <button type="button" onclick="submit()"
                    class="bg-[#523678] hover:bg-[#351A5C] active:scale-95 text-white px-16 py-4 rounded-xl font-bold text-base shadow-xl transition-all">
                Lanjut ke Checkout →
            </button>
        </div>
    </form>

    <footer class="mt-16 text-center text-xs text-[#523678]/50 pt-6 border-t border-gray-100 pb-8">
        Periksa kembali pilihan sebelum melanjutkan ke checkout.
    </footer>
</main>

<script>
    let aromaId = null, kemasanId = null;

    function pilihAroma(id, el, nama) {
        document.querySelectorAll('.aroma-card').forEach(c => c.classList.remove('active'));
        el.classList.add('active');
        aromaId = id;
        document.getElementById('inp_aroma').value = id;
        document.getElementById('lbl-aroma').textContent = nama;
        document.getElementById('err-aroma').classList.add('hidden');
        updateSummary();
    }

    function pilihKemasan(id, el, nama) {
        document.querySelectorAll('.kemasan-card').forEach(c => c.classList.remove('active'));
        el.classList.add('active');
        kemasanId = id;
        document.getElementById('inp_kemasan').value = id;
        document.getElementById('lbl-kemasan').textContent = nama;
        document.getElementById('err-kemasan').classList.add('hidden');
        updateSummary();
    }

    function updateSummary() {
        if (aromaId && kemasanId) {
            document.getElementById('summary').classList.remove('hidden');
        }
    }

    function submit() {
        let ok = true;
        if (!aromaId)   { document.getElementById('err-aroma').classList.remove('hidden');   ok = false; }
        if (!kemasanId) { document.getElementById('err-kemasan').classList.remove('hidden'); ok = false; }
        if (ok) document.getElementById('aromaForm').submit();
    }
</script>
</body>
</html>
