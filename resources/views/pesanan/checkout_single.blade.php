@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mt-12 mb-6">Checkout Produk</h1>

    <form id="checkoutForm" action="{{ route('checkout.single.process') }}" method="POST">
        @csrf
        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
        <input type="hidden" name="jumlah" value="{{ $jumlah }}">

        <div class="mb-4">
            <label class="block">Nama Pemesan</label>
            <input type="text" name="nama_pemesan" value="{{ Auth::user()->name }}" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block">Alamat</label>
            <textarea name="alamat" class="w-full border p-2 rounded"></textarea>
        </div>

        <div class="mb-4">
            <label class="block">Telepon</label>
            <input type="text" name="telepon" class="w-full border p-2 rounded">
        </div>

        <div class="mb-4 font-bold">
            Total: Rp {{ number_format($produk->harga * $jumlah, 0, ',', '.') }}
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
            Bayar Sekarang
        </button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
document.getElementById('checkoutForm').addEventListener('submit', function (e) {
    e.preventDefault();

    fetch(this.action, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            produk_id: "{{ $produk->id }}",
            jumlah: "{{ $jumlah }}",
            nama_pemesan: document.querySelector('[name="nama_pemesan"]').value,
            alamat: document.querySelector('[name="alamat"]').value,
            telepon: document.querySelector('[name="telepon"]').value
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.snap_token) {
            snap.pay(data.snap_token, {
                onSuccess: function(result) {
                    window.location.href = "{{ route('pesanan.cek') }}";
                },
                onError: function(result) {
                    alert("Pembayaran gagal!");
                    console.error(result);
                }
            });
        } else {
            alert("Gagal mendapatkan Snap Token!");
            console.error(data);
        }
    })
    .catch(error => {
        console.error(error);
        alert("Terjadi kesalahan pada server!");
    });
});
</script>
@endsection
