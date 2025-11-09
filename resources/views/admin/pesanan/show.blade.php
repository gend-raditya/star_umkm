@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Detail Pesanan #{{ $pesanan->id }}</h1>

    <p><strong>Nama Customer:</strong> {{ $pesanan->nama }}</p>
    <p><strong>Email:</strong> {{ $pesanan->email }}</p>
    <p><strong>Total:</strong> Rp {{ number_format($pesanan->total) }}</p>
    <p><strong>Status:</strong> {{ $pesanan->status }}</p>

    <h2 class="text-xl font-bold mt-6">Daftar Item</h2>
    <table class="w-full mt-2 border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">Produk</th>
                <th class="p-2 border">Jumlah</th>
                <th class="p-2 border">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanan->items as $item)
            <tr>
                <td class="p-2 border">{{ $item->produk->nama }}</td>
                <td class="p-2 border">{{ $item->jumlah }}</td>
                <td class="p-2 border">Rp {{ number_format($item->subtotal) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

     {{-- ✅ Form Update Status --}}
    <h2 class="text-xl font-bold mb-3">Ubah Status Pesanan</h2>
    <form action="{{ route('admin.pesanan.update', $pesanan->id) }}" method="POST" class="flex items-center gap-3">
        @csrf
        @method('PUT')

        <select name="status" class="border px-3 py-2 rounded">
            <option value="Diproses" {{ $pesanan->status === 'Diproses' ? 'selected':'' }}>Diproses</option>
            <option value="Dikirim" {{ $pesanan->status === 'Dikirim' ? 'selected':'' }}>Dikirim</option>
            <option value="Selesai" {{ $pesanan->status === 'Selesai' ? 'selected':'' }}>Selesai</option>
            <option value="Dibatalkan" {{ $pesanan->status === 'Dibatalkan' ? 'selected':'' }}>Dibatalkan</option>
        </select>

        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Update
        </button>
    </form>

    <a href="{{ route('admin.pesanan.index') }}"
       class="inline-block mt-6 text-blue-600 hover:underline">
       ← Kembali ke daftar pesanan
    </a>
</div>
@endsection
