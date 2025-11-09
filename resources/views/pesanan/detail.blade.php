@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">
        <h2 class="text-2xl font-bold text-purple-700 mb-6">Detail Pesanan</h2>

        {{-- Informasi Pesanan --}}
        <div class="mb-6">
            <p><strong>Invoice:</strong> {{ $pesanan->invoice }}</p>

            {{-- Badge Status --}}
            <p>
                <strong>Status:</strong>
                <span class="px-2 py-1 rounded text-white text-sm
                    {{ $pesanan->status === 'Selesai' ? 'bg-green-500' : ($pesanan->status === 'Dikirim' ? 'bg-yellow-500' : 'bg-blue-500') }}">
                    {{ ucfirst($pesanan->status) }}
                </span>
            </p>

            <p><strong>Total:</strong> Rp {{ number_format($pesanan->total, 0, ',', '.') }}</p>
            <p><strong>Tanggal:</strong> {{ $pesanan->created_at->format('d M Y H:i') }}</p>

            {{-- Tampilkan resi & ekspedisi jika tersedia --}}
            @if ($pesanan->no_resi && $pesanan->ekspedisi)
                <div class="mt-3 bg-purple-50 border-l-4 border-purple-400 p-3 rounded">
                    <p class="text-sm text-gray-700">
                        🚚 <strong>Nomor Resi:</strong> {{ $pesanan->no_resi }}
                    </p>
                    <p class="text-sm text-gray-700">
                        📦 <strong>Ekspedisi:</strong> {{ strtoupper($pesanan->ekspedisi) }}
                    </p>
                    <a href="https://cekresi.com/?noresi={{ $pesanan->no_resi }}" target="_blank"
                       class="text-purple-600 hover:underline text-sm">
                        🔍 Lacak Pengiriman
                    </a>
                </div>
            @endif
        </div>

        {{-- Daftar Produk --}}
        <h3 class="font-semibold text-lg mb-2">Daftar Produk</h3>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-purple-100 text-left">
                    <th class="p-2">Produk</th>
                    <th class="p-2">Jumlah</th>
                    <th class="p-2">Subtotal</th>
                    <th class="p-2">Lokasi Terakhir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesanan->items as $item)
                    <tr class="border-t">
                        <td class="p-2">{{ $item->produk->nama }}</td>
                        <td class="p-2">{{ $item->jumlah }}</td>
                        <td class="p-2">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        <td class="p-2 text-sm text-gray-600">
                            {{ $item->lokasi_terakhir ? $item->lokasi_terakhir : '-' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Tombol Kembali --}}
        <a href="{{ route('pesanan.saya') }}"
           class="mt-6 inline-block text-purple-600 hover:underline">
           ← Kembali ke Riwayat
        </a>
    </div>
@endsection
