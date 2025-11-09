@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
            <h1 class="text-2xl font-bold">Daftar Produk</h1>

            <!-- 🔍 Form Pencarian Produk -->
            <form action="{{ route('produk.search') }}" method="GET" class="flex items-center bg-white border rounded-full px-4 py-2 shadow-sm w-full sm:w-1/3">
                <input type="text" name="q" placeholder="Cari produk..." value="{{ request('q') }}"
                    class="flex-1 focus:outline-none text-gray-700 placeholder-gray-400">
                <button type="submit" class="text-blue-600 hover:text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18.5a7.5 7.5 0 006.15-3.85z" />
                    </svg>
                </button>
            </form>
        </div>

        <!-- 🔸 Hasil Produk -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($produks as $produk)
                <div class="bg-white p-4 rounded shadow flex flex-col hover:shadow-md transition">
                    {{-- Foto Produk --}}
                    <div class="w-full h-48 mb-4 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                        @if ($produk->fotos->count() > 0)
                            <img src="{{ asset('storage/' . $produk->fotos->first()->path) }}" alt="{{ $produk->nama }}"
                                class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-400">Tidak ada foto</span>
                        @endif
                    </div>

                    {{-- Nama dan Harga --}}
                    <h2 class="font-semibold text-lg mb-1 truncate">{{ $produk->nama }}</h2>
                    <p class="text-gray-600 mb-3">Rp {{ number_format($produk->harga) }}</p>

                    {{-- Tombol Detail --}}
                    <a href="{{ route('produk.show', $produk->id) }}"
                        class="bg-blue-600 text-white px-3 py-1 mt-auto inline-block rounded text-center hover:bg-blue-700 transition">
                        Detail
                    </a>
                </div>
            @empty
                <p class="col-span-4 text-gray-600">Tidak ada produk ditemukan.</p>
            @endforelse
        </div>
    </div>
@endsection
