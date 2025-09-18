@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Kategori</h1>

    <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block">Nama Kategori</label>
            <input type="text" name="nama" value="{{ $kategori->nama }}" class="w-full border rounded p-2" required>
        </div>
        <button class="bg-yellow-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
