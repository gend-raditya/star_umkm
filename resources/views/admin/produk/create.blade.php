@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Produk</h1>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block">Nama Produk</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block">Harga</label>
            <input type="number" name="harga" value="{{ old('harga') }}" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block">Stok</label>
            <input type="number" name="stok" value="{{ old('stok') }}" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border rounded p-2">{{ old('deskripsi') }}</textarea>
        </div>
        <div>
            <label class="block">Kategori</label>
            <select name="kategori_id" class="w-full border rounded p-2">
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Input Foto Produk (ubah name menjadi 'foto' jika hanya 1 file) -->
        <div>
            <label class="block">Foto Produk</label>
            <input type="file" name="foto" class="w-full border rounded p-2" accept="image/*">
        </div>

        <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
