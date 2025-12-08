@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10">
    <div class="bg-white shadow-lg rounded-xl p-8 text-center">
        <h1 class="text-3xl font-bold text-green-600 mb-4">
            Pembayaran Berhasil 🎉
        </h1>
        <p class="text-gray-700 mb-6">
            Terima kasih telah melakukan pembayaran. Berikut adalah detail pesanan Anda.
        </p>

        @if($pesanan->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 border">Invoice</th>
                            <th class="py-2 px-4 border">Nama</th>
                            <th class="py-2 px-4 border">No HP</th>
                            <th class="py-2 px-4 border">Total</th>
                            <th class="py-2 px-4 border">Status</th>
                            <th class="py-2 px-4 border">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanan as $p)
                            <tr class="text-center">
                                <td class="py-2 px-4 border">{{ $p->invoice }}</td>
                                <td class="py-2 px-4 border">{{ $p->nama }}</td>
                                <td class="py-2 px-4 border">{{ $p->no_hp }}</td>
                                <td class="py-2 px-4 border">Rp {{ number_format($p->total, 0, ',', '.') }}</td>
                                <td class="py-2 px-4 border">
                                    @if($p->status == 'Diproses')
                                        <span class="text-yellow-600 font-semibold">{{ $p->status }}</span>
                                    @elseif($p->status == 'Dikirim')
                                        <span class="text-blue-600 font-semibold">{{ $p->status }}</span>
                                    @else
                                        <span class="text-green-600 font-semibold">{{ $p->status }}</span>
                                    @endif
                                </td>
                                <td class="py-2 px-4 border">{{ $p->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-600 mt-6">Belum ada pesanan yang tercatat.</p>
        @endif

        <div class="mt-8">
            <a href="/" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
