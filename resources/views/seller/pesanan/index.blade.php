@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Pesanan untuk Toko Saya</h2>

    @foreach($pesanans as $p)
        <div class="border p-4 mb-3">
            <div class="flex justify-between">
                <div>
                    <div class="font-semibold">Invoice: {{ $p->invoice }}</div>
                    <div class="text-sm text-gray-600">Tanggal: {{ $p->created_at }}</div>
                </div>
                <div class="text-right">
                    <div>Status: <span class="font-bold">{{ $p->status }}</span></div>
                    <a href="{{ route('seller.pesanan.edit', $p->id) }}" class="text-blue-600">Lihat detail</a>
                </div>

                
            </div>
        </div>
    @endforeach
</div>
@endsection
