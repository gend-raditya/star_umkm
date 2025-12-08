@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow mt-20">
    <h1 class="text-xl font-bold mb-4">🧾 Detail Transaksi</h1>

    <p><strong>Invoice:</strong> {{ $pesanan->invoice }}</p>
    <p><strong>Pelanggan:</strong> {{ $pesanan->user->name ?? '-' }}</p>
    <p><strong>Total:</strong> Rp {{ number_format($pesanan->total, 0, ',', '.') }}</p>
    <p><strong>Status:</strong> {{ ucfirst($pesanan->status) }}</p>
    <p><strong>Tanggal:</strong> {{ $pesanan->created_at->format('d M Y H:i') }}</p>

    <hr class="my-4">

    <h2 class="font-semibold mb-2">💳 Informasi Pembayaran</h2>
    @if($pesanan->pembayaran)
        <p><strong>Metode:</strong> {{ $pesanan->pembayaran->metode }}</p>
        <p><strong>Status:</strong> {{ ucfirst($pesanan->pembayaran->status) }}</p>
        <p><strong>Jumlah:</strong> Rp {{ number_format($pesanan->pembayaran->jumlah, 0, ',', '.') }}</p>
    @else
        <p class="text-gray-500">Belum ada data pembayaran.</p>
    @endif

    <hr class="my-4">

    <h2 class="font-semibold mb-2">📦 Produk Dipesan</h2>
    <ul class="divide-y">
        @foreach ($pesanan->items as $item)
            <li class="py-2">
                <strong>{{ $item->produk->nama }}</strong> -
                {{ $item->jumlah }}x @ Rp {{ number_format($item->subtotal, 0, ',', '.') }}
            </li>
        @endforeach
    </ul>

    <a href="{{ route('admin.transaksi.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">
        ← Kembali ke Daftar Transaksi
    </a>
</div>
@endsection
