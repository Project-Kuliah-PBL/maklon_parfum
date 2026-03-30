<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Konfirmasi Pesanan | PT. Arum Jaya Gemilang</title>
<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@400,0&display=swap" rel="stylesheet"/>
<style>
    body { font-family:'Manrope',sans-serif; background:#f7f6f7; }
    .material-symbols-outlined { font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24; }
    .primary { color:#513678; }
    .bg-primary { background-color:#513678; }
</style>
</head>
<body class="text-slate-900">

<header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-200">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 h-14 flex justify-between items-center">
    <div class="flex items-center gap-3">
      <img src="{{ asset('Assets/Image/logo.png') }}" alt="Logo" class="w-9 h-9 object-contain">
      <span class="font-bold text-[#523678] text-sm md:text-base">PT. Arum Jaya Gemilang</span>
    </div>
    <div class="flex items-center gap-3">
        <a href="{{ route('pemesanan.pilih-aroma') }}" class="text-xs text-[#523678] hover:underline">← Kembali</a>
        <span class="text-xs text-slate-400 hidden sm:block">{{ auth()->user()->nama_brand ?? auth()->user()->name }}</span>
    </div>
  </div>
</header>

<main class="max-w-6xl mx-auto px-4 py-8 sm:px-6">

    {{-- Step Indicator --}}
    <div class="flex items-center justify-center gap-2 mb-8 text-xs font-semibold flex-wrap">
        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">✓ Pengajuan</span>
        <span class="text-gray-300">──</span>
        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">✓ Pilih Aroma</span>
        <span class="text-gray-300">──</span>
        <span class="bg-[#513678] text-white px-3 py-1 rounded-full">③ Checkout</span>
    </div>

    @if($errors->any())
    <div class="mb-5 bg-red-50 border border-red-200 rounded-xl p-4 text-sm">
        @foreach($errors->all() as $e)<p class="text-red-700">• {{ $e }}</p>@endforeach
    </div>
    @endif

    <form action="{{ route('pemesanan.checkout.process') }}" method="POST">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

        {{-- KIRI: Detail Pesanan --}}
        <div class="lg:col-span-8 space-y-5">
            <div>
                <h1 class="text-2xl font-black tracking-tight mb-1">Finalisasi Pesanan Produksi</h1>
                <p class="text-slate-500 text-sm">Tinjau spesifikasi pesanan Anda sebelum dikonfirmasi.</p>
            </div>

            {{-- Ringkasan produk --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
                <div class="p-6">
                    <div class="flex items-start gap-4 pb-5 mb-5 border-b border-slate-100">
                        <div class="w-14 h-14 rounded-xl bg-purple-50 flex items-center justify-center text-3xl flex-shrink-0">🧴</div>
                        <div class="flex-1">
                            <div class="flex justify-between items-start flex-wrap gap-2">
                                <div>
                                    <h3 class="text-lg font-bold">{{ auth()->user()->nama_brand ?? auth()->user()->name }}</h3>
                                    <p class="text-xs text-slate-400">ID akan diberikan setelah konfirmasi</p>
                                </div>
                                <span class="px-3 py-1 bg-purple-100 text-[#513678] text-xs font-bold rounded-full">
                                    {{ $hargaParfum->jenis_parfum }}
                                </span>
                            </div>
                            <div class="mt-3 flex flex-wrap gap-2">
                                <span class="inline-flex items-center gap-1 px-2 py-1 bg-slate-100 rounded text-xs">
                                    🌺 {{ $aroma->nama_kategori }}
                                </span>
                                <span class="inline-flex items-center gap-1 px-2 py-1 bg-slate-100 rounded text-xs">
                                    📦 {{ $kemasan->jenis_botol }} {{ $kemasan->ukuran }}
                                </span>
                                <span class="inline-flex items-center gap-1 px-2 py-1 bg-slate-100 rounded text-xs">
                                    🏭 {{ number_format($jumlah) }} Unit
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                        <div>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Detail Produk</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between"><span class="text-slate-500">Jenis Parfum</span><span class="font-semibold">{{ $hargaParfum->jenis_parfum }}</span></div>
                                <div class="flex justify-between"><span class="text-slate-500">Harga/ml</span><span class="font-semibold">Rp {{ number_format($hargaParfum->harga_per_ml, 0, ',', '.') }}</span></div>
                                <div class="flex justify-between"><span class="text-slate-500">Target Market</span><span class="font-semibold">{{ $data['target_market'] }}</span></div>
                                <div class="flex justify-between"><span class="text-slate-500">Jumlah</span><span class="font-semibold">{{ number_format($jumlah) }} unit</span></div>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Detail Kemasan</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between"><span class="text-slate-500">Botol</span><span class="font-semibold">{{ $kemasan->jenis_botol }}</span></div>
                                <div class="flex justify-between"><span class="text-slate-500">Ukuran</span><span class="font-semibold">{{ $kemasan->ukuran }}</span></div>
                                @if($kemasan->jenis_box)
                                <div class="flex justify-between"><span class="text-slate-500">Box</span><span class="font-semibold">{{ $kemasan->jenis_box }}</span></div>
                                @endif
                                <div class="flex justify-between"><span class="text-slate-500">Aroma</span><span class="font-semibold">{{ $aroma->nama_kategori }}</span></div>
                            </div>
                        </div>
                    </div>

                    @if(!empty($data['catatan']))
                    <div class="mt-4 p-3 bg-slate-50 rounded-lg text-sm text-slate-600 italic border border-slate-100">
                        <strong class="not-italic text-slate-700">Catatan:</strong> {{ $data['catatan'] }}
                    </div>
                    @endif
                </div>
            </div>

            {{-- Metode Pembayaran --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <h3 class="text-base font-bold mb-4">Metode Pembayaran <span class="text-red-500">*</span></h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    @foreach(['Transfer BCA' => 'account_balance', 'Transfer Mandiri' => 'account_balance', 'QRIS' => 'qr_code_2'] as $m => $icon)
                    <label class="relative flex flex-col p-4 bg-white border-2 rounded-xl cursor-pointer transition-colors
                        {{ old('metode_pembayaran', 'Transfer BCA') === $m ? 'border-[#513678]' : 'border-slate-200 hover:border-purple-300' }}">
                        <input type="radio" name="metode_pembayaran" value="{{ $m }}"
                               class="absolute top-3 right-3 text-[#513678] h-4 w-4"
                               {{ old('metode_pembayaran', 'Transfer BCA') === $m ? 'checked' : '' }}>
                        <span class="material-symbols-outlined text-[#513678] mb-2">{{ $icon }}</span>
                        <span class="text-sm font-bold">{{ $m }}</span>
                        <span class="text-[10px] text-slate-400">Verifikasi manual</span>
                    </label>
                    @endforeach
                </div>
                @error('metode_pembayaran')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- KANAN: Ringkasan Biaya --}}
        <div class="lg:col-span-4 lg:sticky lg:top-20">
            <div class="bg-white rounded-xl border border-slate-200 shadow-xl overflow-hidden">
                <div class="p-6">
                    <h3 class="text-base font-bold mb-5">Ringkasan Biaya</h3>
                    <div class="space-y-3 mb-5 text-sm">
                        <div class="flex justify-between">
                            <span class="text-slate-500">Biaya Parfum ({{ $jumlah }} × Rp {{ number_format($hargaParfum->harga_per_ml,0,',','.') }})</span>
                            <span class="font-medium">Rp {{ number_format($biayaParfum,0,',','.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500">Biaya Aroma ({{ $aroma->nama_kategori }})</span>
                            <span class="font-medium">Rp {{ number_format($biayaAroma,0,',','.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500">Biaya Kemasan ({{ $kemasan->jenis_botol }})</span>
                            <span class="font-medium">Rp {{ number_format($biayaKemasan,0,',','.') }}</span>
                        </div>
                        <div class="pt-4 border-t border-slate-100 flex justify-between items-end">
                            <div>
                                <span class="text-xs text-slate-400 font-bold uppercase">Total Estimasi</span>
                                <p class="text-3xl font-black text-[#513678]">Rp {{ number_format($totalHarga,0,',','.') }}</p>
                            </div>
                            <span class="text-[10px] text-slate-400">Belum termasuk pajak</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <input id="setuju" name="setuju" type="checkbox" value="1"
                                   class="mt-1 rounded text-[#513678] focus:ring-[#513678] border-slate-300">
                            <label for="setuju" class="text-xs text-slate-500 leading-relaxed cursor-pointer">
                                Saya setuju dengan <a href="#" class="text-[#513678] underline">Syarat & Ketentuan</a> dan memahami bahwa pengajuan bersifat final setelah dikonfirmasi.
                            </label>
                        </div>
                        @error('setuju')<p class="text-red-500 text-xs">{{ $message }}</p>@enderror

                        <button type="submit"
                                class="w-full bg-[#513678] hover:bg-[#422c63] active:scale-[.98] text-white py-3.5 rounded-xl font-bold transition-all shadow-lg flex items-center justify-center gap-2 group">
                            KONFIRMASI PESANAN
                            <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </button>

                        <div class="flex justify-center gap-5 pt-2">
                            <div class="flex items-center gap-1 text-[10px] font-bold text-slate-400">
                                <span class="material-symbols-outlined text-sm">verified_user</span> PEMBAYARAN TERJAMIN
                            </div>
                            <div class="flex items-center gap-1 text-[10px] font-bold text-slate-400">
                                <span class="material-symbols-outlined text-sm">workspace_premium</span> BERSERTIFIKAT GMP
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 p-4 border-t border-slate-100">
                    <p class="text-[10px] text-slate-400 text-center">
                        Bantuan: <a href="mailto:arumjayagemilang1@gmail.com" class="text-[#513678] font-bold">arumjayagemilang@gmail.com</a>
                    </p>
                </div>
            </div>
        </div>

    </div>
    </form>
</main>

<footer class="mt-14 border-t border-slate-200 py-8 bg-white">
    <div class="max-w-6xl mx-auto px-4 text-center">
        <p class="text-xs text-slate-400">© {{ date('Y') }} PT. Arum Jaya Gemilang. Hak Cipta Dilindungi.</p>
    </div>
</footer>
</body>
</html>
