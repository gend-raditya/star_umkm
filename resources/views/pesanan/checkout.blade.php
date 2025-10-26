@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mt-12 mb-6">Checkout</h1>

    @php $total = 0; @endphp

    <form id="checkout-form" action="{{ route('pesanan.prosesCheckout') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block">Nama Pemesan</label>
            <input type="text" name="nama_pemesan" id="nama_pemesan"
                class="w-full border rounded p-2" value="{{ Auth::user()->name ?? '' }}" required>
        </div>

        <div>
            <label class="block">Alamat</label>
            <textarea name="alamat" id="alamat"
                class="w-full border rounded p-2" required></textarea>
        </div>

        <div>
            <label class="block">Telepon</label>
            <input type="text" name="telepon" id="telepon"
                class="w-full border rounded p-2" required>
        </div>

        <h2 class="text-xl font-semibold mt-6 mb-2">Ringkasan Pesanan</h2>
        <ul class="space-y-2">
            @foreach($keranjang as $item)
                @php
                    $subtotal = $item->produk->harga * $item->jumlah;
                    $total += $subtotal;
                @endphp
                <li class="flex justify-between">
                    <span>{{ $item->produk->nama }} x {{ $item->jumlah }}</span>
                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </li>
            @endforeach
        </ul>

        <div class="font-bold text-right mt-4">
            Total: Rp {{ number_format($total, 0, ',', '.') }}
        </div>

        <input type="hidden" id="total-field" name="total" value="{{ $total }}">

        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded mt-4">
            Bayar Sekarang
        </button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
document.getElementById('checkout-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const url = e.target.action;

    const data = {
        nama_pemesan: document.getElementById('nama_pemesan').value,
        alamat: document.getElementById('alamat').value,
        telepon: document.getElementById('telepon').value,
        total: document.getElementById('total-field').value
    };

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(data => {
        if (data.snap_token) {
            snap.pay(data.snap_token, {
                onSuccess: function(result) {
                    window.location.href = "/pesanan/cek";
                },
                onPending: function(result) {
                    alert("Menunggu pembayaran...");
                },
                onError: function(result) {
                    console.error(result);
                    alert("Pembayaran gagal!");
                }
            });
        } else {
            alert("Error: " + data.error);
        }
    })
    .catch(err => {
        console.error(err);
        alert("Gagal menghubungi server.");
    });
});
</script>
@endsection
