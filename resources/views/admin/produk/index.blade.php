@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Kelola Produk</h1>

{{-- Pesan sukses --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

<a href="{{ route('admin.produk.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">Tambah Produk</a>

<table class="w-full mt-4 border">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2">Nama</th>
            <th class="p-2">Harga</th>
            <th class="p-2">Stok</th>
            <th class="p-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produk as $p)
        <tr>
            <td class="p-2">{{ $p->nama }}</td>
            <td class="p-2">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
            <td class="p-2">{{ $p->stok }}</td>
            <td class="p-2">
                <a href="{{ route('admin.produk.edit', $p->id) }}" class="text-blue-600">Edit</a> |
                <form action="{{ route('admin.produk.destroy', $p->id) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Yakin hapus?')" class="text-red-600">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
