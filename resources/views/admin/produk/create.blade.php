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

        {{-- Nama Produk --}}
        <div>
            <label class="block font-semibold">Nama Produk</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border rounded p-2" required>
            @error('nama')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Harga --}}
        <div>
            <label class="block font-semibold">Harga</label>
            <input type="number" name="harga" value="{{ old('harga') }}" class="w-full border rounded p-2" required>
            @error('harga')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Stok --}}
        <div>
            <label class="block font-semibold">Stok</label>
            <input type="number" name="stok" value="{{ old('stok') }}" class="w-full border rounded p-2" required>
            @error('stok')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div>
            <label class="block font-semibold">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border rounded p-2">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Kategori --}}
        <div>
            <label class="block font-semibold">Kategori</label>
            <select name="kategori_id" class="w-full border rounded p-2" required>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Foto Produk Multiple --}}
        <div>
            <label class="block font-semibold">Foto Produk</label>
            <input type="file" name="foto[]" class="w-full border rounded p-2" accept="image/*" multiple>
            <p class="text-sm text-gray-500 mt-1">Pilih lebih dari 1 foto (format: JPG, PNG, GIF, maksimal 2MB per foto).</p>
            @error('foto.*')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        {{-- Submit --}}
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            Simpan Produk
        </button>
    </form>
</div>
@endsection
