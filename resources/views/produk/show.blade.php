@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <img src="{{ $produk->gambar ?? 'https://via.placeholder.com/300' }}" class="mb-4 w-full h-64 object-cover">
    <h1 class="text-2xl font-bold">{{ $produk->nama }}</h1>
    <p class="mt-2">{{ $produk->deskripsi }}</p>
    <p class="mt-2 text-xl font-semibold text-green-600">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>

    <form method="POST" action="{{ route('keranjang.tambah') }}" class="mt-4">
        @csrf
        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
        <input type="number" name="jumlah" value="1" min="1" class="border p-2 rounded w-20">
        <button class="bg-indigo-600 text-white px-4 py-2 rounded">Tambah ke Keranjang</button>
    </form>
</div>
@endsection
