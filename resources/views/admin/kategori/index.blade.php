@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Kelola Kategori</h1>
    <a href="{{ route('admin.kategori.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">+ Tambah Kategori</a>
    <table class="w-full mt-4 border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">Nama</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kategoris as $kategori)
            <tr>
                <td class="p-2 border">{{ $kategori->nama }}</td>
                <td class="p-2 border">
                    <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="bg-yellow-500 px-2 py-1 rounded text-white">Edit</a>
                    <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Hapus kategori ini?')" class="bg-red-600 px-2 py-1 rounded text-white">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
