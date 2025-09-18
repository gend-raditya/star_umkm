@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Produk</h1>

    <form action="{{ route('admin.produk.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block">Nama Produk</label>
            <input type="text" name="nama" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block">Harga</label>
            <input type="number" name="harga" class="w-full border rounded p-2" required>
        </div>
      <div>
    <label class="block">Stok</label>
    <input type="number" name="stok" class="w-full border rounded p-2" required>
</div>


        <div>
            <label class="block">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border rounded p-2"></textarea>
        </div>
        <div>
            <label class="block">Kategori</label>
            <select name="kategori_id" class="w-full border rounded p-2">
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                @endforeach
            </select>
        </div>
        <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
