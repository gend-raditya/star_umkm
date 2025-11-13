@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded shadow mt-6 w-full md:w-1/2 mx-auto">
        <h2 class="text-2xl font-bold mb-4">Edit Produk</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('seller.produk.update', $produk->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1">Nama Produk</label>
                <input type="text" name="nama" class="w-full border p-2 rounded" value="{{ $produk->nama }}" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Harga</label>
                <input type="number" name="harga" class="w-full border p-2 rounded" value="{{ $produk->harga }}"
                    required>
            </div>

            <div class="mb-4">
                <label class="block mb-1">Deskripsi</label>
                <textarea name="deskripsi" class="w-full border p-2 rounded">{{ $produk->deskripsi }}</textarea>
            </div>

            {{-- Tambahkan kategori --}}
            <div class="mb-4">
                <label class="block mb-1">Kategori</label>
                <select name="kategori_id" class="w-full border p-2 rounded" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategori as $item)
                        <option value="{{ $item->id }}" {{ $produk->kategori_id == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if ($produk->foto)
                <img src="{{ asset('storage/' . $produk->foto) }}" width="100" class="mb-4 rounded">
            @endif

            <div class="mb-4">
                <label class="block mb-1">Ganti Foto</label>
                <input type="file" name="foto" accept="image/*">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Update Produk
            </button>
        </form>

    </div>
@endsection
