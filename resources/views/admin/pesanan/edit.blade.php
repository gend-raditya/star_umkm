@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Pesanan #{{ $pesanan->id }}</h1>

    <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-2">Nama Customer</label>
            <input type="text" value="{{ $pesanan->nama }}" class="w-full border rounded p-2 bg-gray-100" disabled>
        </div>

        <div>
            <label class="block mb-2">Total</label>
            <input type="text" value="Rp {{ number_format($pesanan->total) }}" class="w-full border rounded p-2 bg-gray-100" disabled>
        </div>

        <div>
            <label class="block mb-2">Status Pesanan</label>
            <select name="status" class="w-full border rounded p-2">
                <option value="Diproses" @if($pesanan->status == 'Diproses') selected @endif>Diproses</option>
                <option value="Dikirim" @if($pesanan->status == 'Dikirim') selected @endif>Dikirim</option>
                <option value="Selesai" @if($pesanan->status == 'Selesai') selected @endif>Selesai</option>
            </select>
        </div>

        <button class="bg-yellow-600 text-white px-4 py-2 rounded">Update Status</button>
    </form>
</div>
@endsection
