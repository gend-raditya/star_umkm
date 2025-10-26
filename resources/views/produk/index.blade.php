@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>
    <div class="grid grid-cols-4 gap-6">
        @foreach($produks as $produk)
            <div class="bg-white p-4 rounded shadow flex flex-col">
                {{-- Foto Produk --}}
                <div class="w-full h-48 mb-4 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                    @if($produk->foto)
                        <img src="{{ asset('storage/' . $produk->foto) }}"
                             alt="{{ $produk->nama }}"
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
                   class="bg-blue-600 text-white px-3 py-1 mt-auto inline-block rounded text-center">Detail</a>
            </div>
        @endforeach
    </div>
</div>
@endsection
