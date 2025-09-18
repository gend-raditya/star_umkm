@extends('layouts.app')

@section('content')
    <div class="text-center py-12">
        <h1 class="text-4xl font-bold text-indigo-700 mb-4">⭐ Selamat Datang di Star UMKM</h1>
        <p class="text-gray-600 mb-6">Temukan oleh-oleh dan kerajinan tangan terbaik dari UMKM lokal</p>
        <a href="{{ route('produk.index') }}"
            class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700">
            Belanja Sekarang
        </a>

    </div>

    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-6 text-center">Produk Terbaru</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($produkTerbaru as $produk)
                <div class="bg-white p-4 rounded shadow">
                    <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}"
                        class="w-full h-40 object-cover rounded">
                    <h3 class="mt-2 text-lg font-bold">{{ $produk->nama }}</h3>
                    <p class="text-gray-600">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    <a href="{{ route('produk.show', $produk->id) }}"
                        class="mt-2 inline-block bg-indigo-600 text-white px-4 py-2 rounded">Detail</a>
                </div>
            @empty
                <p class="text-gray-500 col-span-3 text-center">Belum ada produk tersedia.</p>
            @endforelse
        </div>
    </div>
@endsection
