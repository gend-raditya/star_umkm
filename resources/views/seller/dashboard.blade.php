@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white shadow rounded-lg p-6 mt-10">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">🏪 Dashboard Seller</h1>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Info seller --}}
    <div class="bg-gray-50 p-4 rounded mb-6">
        <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Status Seller:</strong>
            <span class="text-green-600 font-semibold">{{ ucfirst(Auth::user()->seller_status) }}</span>
        </p>
    </div>

    {{-- Daftar Produk Seller --}}
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Produk Saya</h2>
        <a href="{{ route('seller.produk.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
           + Tambah Produk
        </a>
    </div>

    <table class="w-full border border-gray-200 rounded-lg">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-3 text-left">Nama Produk</th>
                <th class="py-2 px-3 text-left">Harga</th>
                <th class="py-2 px-3 text-left">Stok</th>
                <th class="py-2 px-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($produk as $p)
                <tr class="border-t hover:bg-gray-50">
                    <td class="py-2 px-3">{{ $p->nama }}</td>
                    <td class="py-2 px-3">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td class="py-2 px-3">{{ $p->stok }}</td>
                    <td class="py-2 px-3">
                        <a href="{{ route('seller.produk.edit', $p->id) }}" class="text-blue-600 hover:underline">Edit</a> |
                        <form action="{{ route('seller.produk.destroy', $p->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline"
                                onclick="return confirm('Hapus produk ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">Belum ada produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{-- Daftar Pesanan untuk Produk Saya --}}
    <div class="mt-10">
        <h2 class="text-lg font-semibold mb-4">🛒 Pesanan untuk Produk Saya</h2>

        @forelse ($pesanans as $p)
            <div class="border rounded p-4 mb-3">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="font-semibold">Invoice: {{ $p->invoice }}</div>
                        <div class="text-sm text-gray-600">Tanggal: {{ $p->created_at->format('d M Y H:i') }}</div>
                        <div class="text-sm text-gray-600">
                            Status: <span class="font-semibold">{{ ucfirst($p->status) }}</span>
                        </div>
                    </div>
                    <a href="{{ route('seller.pesanan.edit', $p->id) }}"
                       class="text-blue-600 hover:underline">
                       Lihat Detail
                    </a>
                </div>

                {{-- Tampilkan item produk milik seller --}}
                <ul class="mt-3 text-sm text-gray-700">
                    @foreach ($p->items as $item)
                        @if ($item->produk->user_id === Auth::id())
                            <li>• {{ $item->produk->nama }} ({{ $item->jumlah }}x)</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @empty
            <p class="text-gray-500 text-center">Belum ada pesanan untuk produk Anda.</p>
        @endforelse
    </div>
</div>
@endsection
