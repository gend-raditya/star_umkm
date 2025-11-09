@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow mt-6 w-full md:w-1/2 mx-auto">
    <h2 class="text-2xl font-bold mb-4">Edit Produk</h2>

    <form method="POST" action="{{ route('seller.produk.update', $produk->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1">Nama Produk</label>
            <input type="text" name="nama" class="w-full border p-2 rounded" value="{{ $produk->nama }}" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Harga</label>
            <input type="number" name="harga" class="w-full border p-2 rounded" value="{{ $produk->harga }}" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border p-2 rounded">{{ $produk->deskripsi }}</textarea>
        </div>

        @if($produk->foto)
            <img src="{{ asset('storage/' . $produk->foto) }}" width="100" class="mb-4 rounded">
        @endif

        <div class="mb-4">
            <label class="block mb-1">Ganti Foto</label>
            <input type="file" name="foto" accept="image/*">
        </div>

        <form action="{{ route('seller.pesanan.update', $pesanan->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-primary">Update</button>
</form>

    </form>
</div>
@endsection
