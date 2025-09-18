@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Checkout</h1>

    <form action="{{ route('checkout.proses') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block">Nama Pemesan</label>
            <input type="text" name="nama_pemesan" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block">Alamat</label>
            <textarea name="alamat" class="w-full border rounded p-2" required></textarea>
        </div>
        <div>
            <label class="block">Telepon</label>
            <input type="text" name="telepon" class="w-full border rounded p-2" required>
        </div>

        <h2 class="text-xl font-semibold mt-6 mb-2">Ringkasan Pesanan</h2>
        <ul class="space-y-2">
            @php $total = 0; @endphp
            @foreach($keranjang as $item)
                @php $subtotal = $item['harga'] * $item['jumlah']; $total += $subtotal; @endphp
                <li class="flex justify-between">
                    <span>{{ $item['nama'] }} x {{ $item['jumlah'] }}</span>
                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </li>
            @endforeach
        </ul>

        <div class="font-bold text-right mt-4">
            Total: Rp {{ number_format($total, 0, ',', '.') }}
        </div>

        <button class="bg-green-600 text-white px-6 py-2 rounded mt-4">
            Proses Pesanan
        </button>
    </form>
</div>
@endsection
