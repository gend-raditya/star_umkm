@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Checkout</h1>

    <form id="checkoutForm" method="POST" action="{{ route('pesanan.prosesCheckout') }}">
        @csrf

        <div class="grid md:grid-cols-2 gap-6">
            {{-- 🔹 Kolom kiri: Data pemesan --}}
            <div>
                <label class="block mb-2 font-semibold">Nama Pemesan</label>
                <input type="text" name="nama_pemesan" value="{{ Auth::user()->name }}"
                       class="w-full border rounded p-2 mb-3" required>

                <label class="block mb-2 font-semibold">Alamat</label>
                <textarea name="alamat" class="w-full border rounded p-2 mb-3" required></textarea>

                <label class="block mb-2 font-semibold">Telepon</label>
                <input type="text" name="telepon" class="w-full border rounded p-2 mb-3" required>
            </div>

            {{-- 🔹 Kolom kanan: Ringkasan Pesanan --}}
            <div class="bg-gray-100 p-4 rounded">
                <h2 class="text-xl font-semibold mb-4">Ringkasan Pesanan</h2>

                @php $total = 0; @endphp

                @foreach ($keranjang as $item)
                    @php
                        $subtotal = $item->produk->harga * $item->jumlah;
                        $total += $subtotal;
                    @endphp

                    <div class="flex justify-between mb-2">
                        <div>{{ $item->produk->nama }} x {{ $item->jumlah }}</div>
                        <div>Rp {{ number_format($subtotal, 0, ',', '.') }}</div>
                    </div>

                    {{-- 🟩 Input tersembunyi untuk dikirim ke controller --}}
                    <input type="hidden" name="produk_id[]" value="{{ $item->produk->id }}">
                    <input type="hidden" name="jumlah[{{ $item->produk->id }}]" value="{{ $item->jumlah }}">
                @endforeach

                <hr class="my-2">
                <div class="flex justify-between font-bold text-lg">
                    <span>Total:</span>
                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                {{-- 🟩 Total juga dikirim ke backend untuk validasi --}}
                <input type="hidden" name="total" value="{{ $total }}">
            </div>
        </div>

        <div class="mt-6 text-center">
            <button type="button" id="btnBayar"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded">
                Bayar Sekarang
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
    {{-- 🟩 Script Snap Midtrans --}}
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script>
        document.getElementById('btnBayar').addEventListener('click', function (e) {
            e.preventDefault();

            let form = document.getElementById('checkoutForm');
            let formData = new FormData(form);

            fetch(form.action, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                console.log("Response dari server:", data);

                if (data.snap_token) {
                    // 🟩 Tampilkan popup pembayaran Midtrans langsung!
                    window.snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            console.log("Sukses:", result);
                            window.location.href = "/pesanan/success";
                        },
                        onPending: function(result) {
                            console.log("Pending:", result);
                            alert("Menunggu pembayaran...");
                            window.location.href = "/pesanan/success";
                        },
                        onError: function(result) {
                            console.error("Gagal:", result);
                            alert("Terjadi kesalahan dalam pembayaran.");
                        },
                        onClose: function() {
                            alert("Kamu menutup popup tanpa menyelesaikan pembayaran.");
                        }
                    });
                } else {
                    alert("Gagal mendapatkan token Midtrans!");
                    console.error(data);
                }
            })
            .catch(err => {
                console.error("Fetch error:", err);
                alert("Gagal menghubungi server!");
            });
        });
    </script>
@endsection
