@extends('layouts.app')

@section('content')
    <style>
        /* Hero Section */
        .hero-section {
            background: url('{{ asset('images/bg-umkm.jpg') }}') center/cover no-repeat;
            height: 50vh;
            position: relative;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
        }

        /* Card Produk */
        .produk-card {
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            transition: all 0.3s ease;
        }

        .produk-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .produk-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        /* Tombol Utama */
        .btn-utama {
            background: #facc15;
            color: #000;
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s;
            display: inline-block;
        }

        .btn-utama:hover {
            background: #fde047;
        }
    </style>

    <!-- Hero Section -->
    <div class="hero-section flex items-center justify-center text-center text-white">
        <div class="hero-overlay"></div>
        <div class="relative z-10 px-6">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4 drop-shadow-lg">
                ⭐ Selamat Datang di <span class="text-yellow-400">Star UMKM</span>
            </h1>
            <p class="text-lg md:text-2xl text-gray-200 mb-8 max-w-2xl mx-auto leading-relaxed">
                Temukan oleh-oleh dan kerajinan tangan terbaik dari UMKM lokal
            </p>

            <a href="#produk-terbaru" class="btn-utama shadow-lg">Belanja Sekarang</a>
        </div>
    </div>

    <!-- Produk Terbaru -->
    <div id="produk-terbaru" class="max-w-7xl mx-auto px-6 mt-16">
        <h2 class="text-3xl font-bold text-center text-indigo-700 mb-12">✨ Produk Terbaru</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($produkTerbaru as $produk)
                <div class="produk-card shadow-md">
                    @if ($produk->fotos->isNotEmpty())
                        <img src="{{ asset('storage/' . $produk->fotos->first()->path) }}"
                             alt="{{ $produk->nama }}">
                    @else
                        <img src="{{ asset('images/no-image.png') }}" alt="No Image">
                    @endif

                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-800 truncate">{{ $produk->nama }}</h3>
                        <p class="text-indigo-600 font-semibold mt-1">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </p>

                        <a href="{{ route('produk.show', $produk->id) }}"
                           class="mt-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                            Detail
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 col-span-full text-center">Belum ada produk tersedia.</p>
            @endforelse
        </div>
    </div>
@endsection
