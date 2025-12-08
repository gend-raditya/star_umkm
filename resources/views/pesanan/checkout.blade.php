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

                    {{-- 🔹 Provinsi --}}
                    <label class="block mb-2 font-semibold">Provinsi</label>
                    <select id="provinsi" name="provinsi" class="w-full border rounded p-2 mb-3" required>
                        <option value="">Pilih Provinsi</option>
                    </select>

                    {{-- 🔹 Kota / Kabupaten --}}
                    <label class="block mb-2 font-semibold">Kota / Kabupaten</label>
                    <select id="kota" name="kota" class="w-full border rounded p-2 mb-3" required>
                        <option value="">Pilih Kota / Kabupaten</option>
                    </select>

                    {{-- 🔹 Kecamatan --}}
                    <label class="block mb-2 font-semibold">Kecamatan</label>
                    <select id="kecamatan" name="kecamatan" class="w-full border rounded p-2 mb-3" required>
                        <option value="">Pilih Kecamatan</option>
                    </select>

                    {{-- 🔹 Kelurahan --}}
                    <label class="block mb-2 font-semibold">Kelurahan</label>
                    <select id="kelurahan" name="kelurahan" class="w-full border rounded p-2 mb-3" required>
                        <option value="">Pilih Kelurahan</option>
                    </select>

                    {{-- 🔹 Alamat lengkap --}}
                    <label class="block mb-2 font-semibold">Alamat Lengkap</label>
                    <textarea name="alamat" class="w-full border rounded p-2 mb-3" placeholder="Nama jalan, RT/RW, kode pos" required></textarea>

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
@section('scripts')
    <script>
        const provinsiSelect = document.getElementById('provinsi');
        const kotaSelect = document.getElementById('kota');
        const kecamatanSelect = document.getElementById('kecamatan');
        const kelurahanSelect = document.getElementById('kelurahan');

        // 🔹 Ambil daftar provinsi
        fetch('/alamat/provinsi')
            .then(res => res.json())
            .then(data => {
                if (data.success && data.provinsi.length > 0) {
                    data.provinsi.forEach(p => {
                        provinsiSelect.innerHTML += `<option value="${p.id}">${p.name}</option>`;
                    });
                }
            })
            .catch(err => console.error("Error fetch provinsi:", err));

        // 🔹 Saat provinsi dipilih -> ambil kota
        provinsiSelect.addEventListener('change', function() {
            kotaSelect.innerHTML = '<option value="">Memuat kota...</option>';
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';

            fetch(`/alamat/kota/${this.value}`)
                .then(res => res.json())
                .then(data => {
                    kotaSelect.innerHTML = '<option value="">Pilih Kota / Kabupaten</option>';
                    if (data.success && data.kota.length > 0) {
                        data.kota.forEach(k => {
                            kotaSelect.innerHTML += `<option value="${k.id}">${k.name}</option>`;
                        });
                    }
                })
                .catch(err => console.error("Error fetch kota:", err));
        });

        // 🔹 Saat kota dipilih -> ambil kecamatan
        kotaSelect.addEventListener('change', function() {
            kecamatanSelect.innerHTML = '<option value="">Memuat kecamatan...</option>';
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';

            fetch(`/alamat/kecamatan/${this.value}`)
                .then(res => res.json())
                .then(data => {
                    kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    if (data.success && data.kecamatan.length > 0) {
                        data.kecamatan.forEach(kec => {
                            kecamatanSelect.innerHTML +=
                                `<option value="${kec.id}">${kec.name}</option>`;
                        });
                    }
                })
                .catch(err => console.error("Error fetch kecamatan:", err));
        });

        // 🔹 Saat kecamatan dipilih -> ambil kelurahan
        kecamatanSelect.addEventListener('change', function() {
            kelurahanSelect.innerHTML = '<option value="">Memuat kelurahan...</option>';

            fetch(`/alamat/kelurahan/${this.value}`)
                .then(res => res.json())
                .then(data => {
                    kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                    if (data.success && data.kelurahan.length > 0) {
                        data.kelurahan.forEach(kel => {
                            kelurahanSelect.innerHTML +=
                                `<option value="${kel.id}">${kel.name}</option>`;
                        });
                    }
                })
                .catch(err => console.error("Error fetch kelurahan:", err));
        });
    </script>


{{-- 🟩 Script Snap Midtrans --}}
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    document.getElementById('btnBayar').addEventListener('click', function(e) {
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
