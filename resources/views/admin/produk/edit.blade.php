@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Produk</h1>

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

    <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block">Nama Produk</label>
            <input type="text" name="nama" value="{{ old('nama', $produk->nama) }}" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block">Harga</label>
            <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block">Stok</label>
            <input type="number" name="stok" value="{{ old('stok', $produk->stok) }}" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border rounded p-2">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
        </div>
        <div>
            <label class="block">Kategori</label>
            <select name="kategori_id" class="w-full border rounded p-2">
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id', $produk->kategori_id) == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Input Foto Produk -->
        <div>
            <label class="block">Foto Produk</label>
            <input type="file" name="foto" class="w-full border rounded p-2" accept="image/*">
            @if($produk->foto)
                <img src="{{ asset('storage/' . $produk->foto) }}" class="w-32 h-32 object-cover rounded mt-2">
            @endif
        </div>

        <button class="bg-yellow-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
