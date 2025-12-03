@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Kelola Produk</h1>

{{-- Pesan sukses --}}
@if(session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

{{-- Hapus tombol tambah produk --}}
{{-- <a href="{{ route('admin.produk.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">Tambah Produk</a> --}}

<table class="w-full mt-4 border">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2">Nama</th>
            <th class="p-2">Nama Seller</th>
            <th class="p-2">Harga</th>
            <th class="p-2">Foto</th>
            <th class="p-2">Stok</th>
            <th class="p-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produk as $p)
        <tr>
            <td class="p-2">{{ $p->nama }}</td>

            {{-- Nama Seller --}}
            <td class="p-2">
                {{ $p->user->name ?? 'Tidak Ada' }}
            </td>

            <td class="p-2">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>

            {{-- Foto Produk --}}
            <td class="p-2">
                @if($p->fotos->count() > 0)
                    <div class="flex gap-1">
                        @foreach($p->fotos as $foto)
                            <img src="{{ asset('storage/' . $foto->path) }}" class="w-16 h-16 object-cover rounded">
                        @endforeach
                    </div>
                @else
                    <span class="text-gray-400">Tidak ada foto</span>
                @endif
            </td>

            <td class="p-2">{{ $p->stok }}</td>

            <td class="p-2">
                {{-- OPSI 1: ADMIN BOLEH EDIT & HAPUS --}}
                
                <form action="{{ route('admin.produk.destroy', $p->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin hapus?')" class="text-red-600">Hapus</button>
                </form>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
@endsection
