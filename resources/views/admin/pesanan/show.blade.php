@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Detail Pesanan #{{ $pesanan->id }}</h1>

    <p><strong>Nama Customer:</strong> {{ $pesanan->nama }}</p>
    <p><strong>Email:</strong> {{ $pesanan->email }}</p>
    <p><strong>Total:</strong> Rp {{ number_format($pesanan->total) }}</p>
    <p><strong>Status:</strong> {{ $pesanan->status }}</p>

    <h2 class="text-xl font-bold mt-6">Daftar Item</h2>
    <table class="w-full mt-2 border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">Produk</th>
                <th class="p-2 border">Jumlah</th>
                <th class="p-2 border">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanan->items as $item)
            <tr>
                <td class="p-2 border">{{ $item->produk->nama }}</td>
                <td class="p-2 border">{{ $item->jumlah }}</td>
                <td class="p-2 border">Rp {{ number_format($item->subtotal) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
