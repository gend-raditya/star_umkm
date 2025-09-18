@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Kelola Pesanan</h1>
    <table class="w-full mt-4 border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Nama Customer</th>
                <th class="p-2 border">Total</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanans as $pesanan)
            <tr>
                <td class="p-2 border">{{ $pesanan->id }}</td>
                <td class="p-2 border">{{ $pesanan->nama }}</td>
                <td class="p-2 border">Rp {{ number_format($pesanan->total) }}</td>
                <td class="p-2 border">{{ $pesanan->status }}</td>
                <td class="p-2 border">
                    <a href="{{ route('pesanan.show', $pesanan->id) }}" class="bg-blue-600 px-2 py-1 rounded text-white">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
