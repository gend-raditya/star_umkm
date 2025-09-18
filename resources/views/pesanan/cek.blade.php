@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">📦 Cek Pesanan</h1>
    <form action="" method="GET" class="mb-4">
        <input type="text" name="invoice" placeholder="Masukkan kode invoice"
               class="border p-2 rounded w-1/2">
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Cek</button>
    </form>

    @isset($pesanan)
        <div>
            <p><strong>Invoice:</strong> {{ $pesanan->invoice }}</p>
            <p><strong>Nama:</strong> {{ $pesanan->nama }}</p>
            <p><strong>Status:</strong> {{ $pesanan->status }}</p>
        </div>
    @endisset
</div>
@endsection
