@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">
        <h2 class="text-2xl font-bold text-purple-700 mb-4">Riwayat Pesanan Saya</h2>

        @if ($pesanans->isEmpty())
            <p class="text-gray-500 text-center">Belum ada pesanan.</p>
        @else
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-purple-100 text-left">
                        <th class="p-2">No Pesanan</th>
                        <th class="p-2">Total</th>
                        <th class="p-2">Status</th>
                        <th class="p-2">Tanggal</th>
                        <th class="p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesanans as $pesanan)
                        <tr class="border-t">
                            <td class="p-2">{{ $pesanan->invoice }}</td>
                            <td class="p-2">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</td>
                            <td class="p-2">{{ $pesanan->status }}</td>
                            <td class="p-2">{{ $pesanan->created_at->format('d M Y H:i') }}</td>
                            <td class="p-2">
                                <a href="{{ route('pesanan.detail', $pesanan->id) }}"
                                    class="text-white bg-purple-600 hover:bg-purple-700 px-3 py-1 rounded-lg text-sm">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    @endsection
