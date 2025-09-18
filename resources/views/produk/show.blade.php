@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <img src="{{ $produk->gambar ?? 'https://via.placeholder.com/300' }}" class="mb-4 w-full h-64 object-cover">
        <h1 class="text-2xl font-bold">{{ $produk->nama }}</h1>
        <p class="mt-2">{{ $produk->deskripsi }}</p>
        <p class="mt-2 text-xl font-semibold text-green-600">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>

        <form action="{{ route('keranjang.tambah', $produk->id) }}" method="POST">
            @csrf
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded mt-3">
                🛒 Tambah ke Keranjang
            </button>
        </form>

    </div>
@endsection
