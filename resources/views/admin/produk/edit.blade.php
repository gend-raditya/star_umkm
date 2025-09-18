@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Produk</h1>

    <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block">Nama Produk</label>
            <input type="text" name="nama" value="{{ $produk->nama }}" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block">Harga</label>
            <input type="number" name="harga" value="{{ $produk->harga }}" class="w-full border rounded p-2" required>
        </div>

       <div>
    <label class="block">Stok</label>
    <input type="number" name="stok" value="{{ old('stok', $produk->stok) }}" class="w-full border rounded p-2" required>
</div>


        <div>
            <label class="block">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border rounded p-2">{{ $produk->deskripsi }}</textarea>
        </div>
        <div>
            <label class="block">Kategori</label>
            <select name="kategori_id" class="w-full border rounded p-2">
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" @if($produk->kategori_id == $kategori->id) selected @endif>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <button class="bg-yellow-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
