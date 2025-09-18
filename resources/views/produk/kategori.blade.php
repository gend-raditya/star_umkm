@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Kategori: {{ $kategori->nama }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($produk as $item)
            <div class="bg-white rounded shadow p-4">
                <h2 class="font-bold text-lg">{{ $item->nama }}</h2>
                <p class="text-gray-600">Rp {{ number_format($item->harga) }}</p>
                <a href="{{ route('produk.show', $item->id) }}" class="text-blue-600">Detail</a>
            </div>
        @empty
            <p class="col-span-3 text-gray-500">Belum ada produk di kategori ini.</p>
        @endforelse
    </div>
</div>
@endsection
