@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6 text-green-700">Riwayat Pesanan</h1>

    {{-- Cek apakah ada pesanan --}}
    @if ($pesanan->isEmpty())
        <div class="bg-white p-6 rounded shadow text-center text-gray-500">
            Belum ada pesanan yang selesai.
        </div>
    @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($pesanan as $item)
                <div class="bg-white p-5 rounded shadow hover:shadow-lg transition">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">
                        Pesanan #{{ $item->id }}
                    </h2>

                    <p class="text-sm text-gray-500 mb-1">
                        Tanggal: {{ $item->created_at->format('d M Y') }}
                    </p>
                    <p class="text-sm text-gray-500 mb-3">
                        Total: <span class="font-semibold text-green-700">Rp{{ number_format($item->total, 0, ',', '.') }}</span>
                    </p>

                    <p class="text-sm mb-3">
                        Ekspedisi: <span class="font-semibold text-gray-700">{{ $item->ekspedisi ?? 'Belum diisi' }}</span>
                    </p>

                    <p class="text-sm mb-4">
                        No. Resi: <span class="font-semibold text-gray-700">{{ $item->no_resi ?? 'Belum tersedia' }}</span>
                    </p>

                    <div class="flex justify-between items-center">
                        <a href="https://cekresi.com/?noresi={{ $item->no_resi }}"
                           target="_blank"
                           class="text-sm bg-green-600 text-white px-3 py-1.5 rounded hover:bg-green-700 transition {{ !$item->no_resi ? 'opacity-50 pointer-events-none' : '' }}">
                            Cek Resi
                        </a>

                        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded">
                            {{ ucfirst($item->status) }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
