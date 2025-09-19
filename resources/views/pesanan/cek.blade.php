@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Keranjang Belanja</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (count($keranjang) > 0)
            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2">Produk</th>
                        <th class="p-2">Harga</th>
                        <th class="p-2">Jumlah</th>
                        <th class="p-2">Subtotal</th>
                        <th class="p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($keranjang as $item)
                        @php
                            $subtotal = $item->produk->harga * $item->jumlah;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td class="p-2">{{ $item->produk->nama }}</td>
                            <td class="p-2">Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                            <td class="p-2">{{ $item->jumlah }}</td>
                            <td class="p-2">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                            <td class="p-2">
                                <form action="{{ route('keranjang.hapus', $item->produk->id) }}" method="POST">
                                    @csrf
                                    <button class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    <tr class="font-bold">
                        <td colspan="3" class="p-2 text-right">Total</td>
                        <td class="p-2">Rp {{ number_format($total, 0, ',', '.') }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-6 text-right">
                <a href="{{ route('checkout') }}" class="bg-indigo-600 text-white px-6 py-2 rounded">
                    Lanjut ke Checkout
                </a>
            </div>
        @else
            <p>Keranjang masih kosong.</p>
        @endif
    </div>
@endsection
