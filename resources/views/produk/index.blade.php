@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>
    <div class="grid grid-cols-4 gap-6">
        @foreach($produks as $produk)
            <div class="bg-white p-4 rounded shadow">
                <h2 class="font-semibold">{{ $produk->nama }}</h2>
                <p class="text-gray-600">Rp {{ number_format($produk->harga) }}</p>
                <a href="{{ route('produk.show', $produk->id) }}"
                   class="bg-blue-600 text-white px-3 py-1 mt-2 inline-block rounded">Detail</a>
            </div>
        @endforeach
    </div>
</div>
@endsection
