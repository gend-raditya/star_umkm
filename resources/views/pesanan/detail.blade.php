@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">
        <h2 class="text-2xl font-bold text-purple-700 mb-6">Detail Pesanan</h2>

        <div class="mb-6">
            <p><strong>Invoice:</strong> {{ $pesanan->invoice }}</p>
            <p><strong>Status:</strong> {{ $pesanan->status }}</p>
            <p><strong>Total:</strong> Rp {{ number_format($pesanan->total, 0, ',', '.') }}</p>
            <p><strong>Tanggal:</strong> {{ $pesanan->created_at->format('d M Y H:i') }}</p>
        </div>

        <h3 class="font-semibold text-lg mb-2">Daftar Produk</h3>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-purple-100 text-left">
                    <th class="p-2">Produk</th>
                    <th class="p-2">Jumlah</th>
                    <th class="p-2">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesanan->items as $item)
                    <tr class="border-t">
                        <td class="p-2">{{ $item->produk->nama }}</td>
                        <td class="p-2">{{ $item->jumlah }}</td>
                        <td class="p-2">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('pesanan.saya') }}"
           class="mt-6 inline-block text-purple-600 hover:underline">← Kembali ke Riwayat</a>
    </div>
@endsection
