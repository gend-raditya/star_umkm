@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow mt-6 w-full md:w-1/2 mx-auto">
    <h2 class="text-2xl font-bold mb-4">Tambah Produk Baru</h2>

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

    <form method="POST" action="{{ route('seller.produk.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- Nama Produk --}}
        <div class="mb-4">
            <label class="block mb-1 font-medium">Nama Produk</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border p-2 rounded" required>
            @error('nama') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Harga --}}
        <div class="mb-4">
            <label class="block mb-1 font-medium">Harga</label>
            <input type="number" name="harga" value="{{ old('harga') }}" class="w-full border p-2 rounded" required>
            @error('harga') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label class="block mb-1 font-medium">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border p-2 rounded">{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Kategori --}}
        <div class="mb-4">
            <label class="block mb-1 font-medium">Kategori</label>
            <select name="kategori_id" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategori as $k)
                    <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Foto Produk Multiple --}}
        <div class="mb-4">
            <label class="block mb-1 font-medium">Foto Produk</label>
            <input type="file" name="foto[]" multiple accept="image/*" class="w-full border p-2 rounded">
            <p class="text-sm text-gray-500 mt-1">
                Pilih lebih dari 1 foto (format: JPG, PNG, maksimal 2MB per foto)
            </p>
            @error('foto.*') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Tombol Submit --}}
        <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            Simpan
        </button>
    </form>
</div>
@endsection
