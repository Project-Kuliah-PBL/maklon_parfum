<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan Maklon | PT. Arum Jaya Gemilang</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Plus+Jakarta+Sans:wght@400;700&family=Brittany+Signature&display=swap" rel="stylesheet">

    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #ffffff; 
        }
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-signature { font-family: 'Brittany Signature', cursive; }

        /* Styling Box Isian (Input) sesuai gambar */
        .form-input-custom {
            width: 100%;
            padding: 1.25rem;
            background-color: #E9E3F1 !important; /* Warna ungu muda */
            border-radius: 0.5rem;
            border: 2px solid transparent;
            font-size: 1.125rem;
            color: #4B3D61;
            transition: all 0.3s ease;
        }

        .form-input-custom:focus {
            outline: none;
            background-color: #ffffff;
            border-color: #5C4B7A;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(92, 75, 122, 0.1);
        }

        .form-input-custom::placeholder {
            color: #A098AE;
            font-style: italic;
        }

        /* Styling Tombol sesuai gambar */
        .btn-custom {
            background-color: #5C4B7A !important; /* Warna ungu tua */
            color: white !important;
            padding: 1rem 4rem;
            border-radius: 0.75rem;
            font-weight: bold;
            font-size: 1.5rem;
            transition: all 0.2s ease;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .btn-custom:hover {
            background-color: #4B3D61 !important;
            transform: scale(1.02);
        }

        .btn-custom:active {
            transform: scale(0.95); /* Efek membal saat ditekan */
        }
    </style>
</head>
<body class="min-h-screen">

    <header class="flex justify-between items-center px-12 py-6 bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="flex items-center gap-3">
            <img src="{{ asset('Assets/Image/logo.png') }}" 
                 alt="Logo PT. Arum Jaya Gemilang" 
                 class="w-[45px] h-[45px] md:w-[50px] md:h-[50px] lg:w-[60px] lg:h-[60px] object-contain">
            <span class="text-xl font-bold text-[#5c4b7a] tracking-wider uppercase">PT. Arum Jaya Gemilang</span>
        </div>
            <div class="w-10 h-10 bg-[#e9e3f1] rounded-full flex items-center justify-center border border-gray-100 cursor-pointer">
                <span class="text-[#5c4b7a] text-sm">👤</span>
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto mt-16 px-6 text-center">
        <h1 class="text-6xl font-serif text-[#4b3d61] mb-2 tracking-tight">Form Pengajuan Maklon</h1>
        <p class="text-2xl font-signature text-purple-400 italic mb-16">Wujudkan produk impian Anda bersama kami</p>

       <form  action="{{ route('pemesanan.pilih-aroma') }}" method="GET" class="grid grid-cols-1 gap-4 md:grid-cols-3 gap-10 text-left">
            
            <div class="space-y-8">
                <div>
                    <label class="block text-2xl font-bold text-gray-800 mb-3 tracking-tight">Nama Brand</label>
                    <input type="text" placeholder="Nama Brand" class="form-input-custom">
                </div>
                <div>
                    <label class="block text-2xl font-bold text-gray-800 mb-3 tracking-tight">Jumlah Produksi</label>
                    <input type="number" placeholder="Jumlah Produksi" class="form-input-custom">
                </div>
            </div>

            <div class="space-y-8">
                <div>
                    <label class="block text-2xl font-bold text-gray-800 mb-3 tracking-tight">Jenis Parfum</label>
                    <input type="text" placeholder="Jenis Parfum" class="form-input-custom">
                </div>
                <div>
                    <label class="block text-2xl font-bold text-gray-800 mb-3 tracking-tight">Target Market</label>
                    <div class="relative">
                        <select class="form-input-custom appearance-none cursor-pointer">
                            <option>Gen Z / Remaja</option>
                            <option>Premium / Executive</option>
                            <option>Luxury / High-End</option>
                        </select>
                        <div class="absolute right-5 top-5 pointer-events-none text-gray-500">▼</div>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-2xl font-bold text-gray-800 mb-3 tracking-tight">Catatan</label>
                <textarea placeholder="*Isi Catatan" class="form-input-custom h-[225px] resize-none"></textarea>
            </div>

            <div class="md:col-span-3 flex justify-center mt-12">
                <button type="submit" class="btn-custom shadow-2xl">
                    Lanjut Ke Pilih Aroma
                </button>
            </div>
        </form>

        <footer class="mt-28 mb-12 text-gray-400 italic text-base">
            Silakan lengkapi formulir pengajuan maklon di atas dengan data yang benar dan lengkap.
        </footer>
    </main>

</body>
</html>