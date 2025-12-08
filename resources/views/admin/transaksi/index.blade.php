@extends('layouts.app')

@section('content')
<div class="p-6 bg-white rounded-lg shadow mt-20">
    <h1 class="text-2xl font-bold mb-4">📊 Daftar Transaksi</h1>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-2 border">Invoice</th>
                <th class="p-2 border">User</th>
                <th class="p-2 border">Total</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Tanggal</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $t)
            <tr class="border-t">
                <td class="p-2">{{ $t->invoice }}</td>
                <td class="p-2">{{ $t->user->name ?? '-' }}</td>
                <td class="p-2">Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                <td class="p-2">{{ ucfirst($t->status) }}</td>
                <td class="p-2">{{ $t->created_at->format('d M Y') }}</td>
                <td class="p-2">
                    <a href="{{ route('admin.transaksi.show', $t->id) }}"
                       class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">
                       Detail
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
