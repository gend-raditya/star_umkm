@extends('layouts.app')

@section('content')
    <div class="min-h-screen mb-12 py-12 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-5xl mx-auto">

            <div class="mb-10 text-center sm:text-left animate-fade-in-down">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Checkout Pengiriman</h1>
                <p class="mt-2 text-gray-500">Lengkapi detail pengiriman Anda untuk menyelesaikan pesanan.</p>
            </div>

            <form id="checkoutForm" method="POST" action="{{ route('pesanan.prosesCheckout') }}" class="animate-fade-in-up">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-4">

                    {{-- 🔹 KOLOM KIRI: Form Pengiriman (Span 7) --}}
                    <div class="lg:col-span-8 space-y-6">

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="p-6 sm:p-8 space-y-6">
                                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                                    <div class="p-2 bg-emerald-100 rounded-lg text-emerald-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </div>
                                    <h2 class="text-xl font-bold text-gray-800">Alamat Pengiriman</h2>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="group">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Penerima</label>
                                        <input type="text" name="nama_pemesan" value="{{ Auth::user()->name }}"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200 outline-none" required placeholder="Nama Lengkap">
                                    </div>
                                    <div class="group">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                                        <input type="text" name="telepon"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200 outline-none" required placeholder="08xxxxxxxxxx">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Provinsi</label>
                                        <div class="relative">
                                            <select id="provinsi" name="provinsi" class="appearance-none w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200 outline-none cursor-pointer" required>
                                                <option value="">Pilih Provinsi</option>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kota / Kabupaten</label>
                                        <div class="relative">
                                            <select id="kota" name="kota" class="appearance-none w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200 outline-none cursor-pointer" required>
                                                <option value="">Pilih Kota / Kabupaten</option>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kecamatan</label>
                                        <div class="relative">
                                            <select id="kecamatan" name="kecamatan" class="appearance-none w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200 outline-none cursor-pointer" required>
                                                <option value="">Pilih Kecamatan</option>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kelurahan</label>
                                        <div class="relative">
                                            <select id="kelurahan" name="kelurahan" class="appearance-none w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200 outline-none cursor-pointer" required>
                                                <option value="">Pilih Kelurahan</option>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Detail Alamat</label>
                                    <textarea name="alamat" rows="3"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200 outline-none resize-none"
                                        placeholder="Nama Jalan, Nomor Rumah, RT/RW, Patokan..." required></textarea>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- 🔹 KOLOM KANAN: Ringkasan Pesanan (Span 5) --}}
                    <div class="lg:col-span-4">
                        <div class="sticky top-8 space-y-6">

                            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center gap-3">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                    <h2 class="text-lg font-bold text-gray-800">Ringkasan Pesanan</h2>
                                </div>

                                <div class="p-6">
                                    <div class="space-y-4 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                                        @php $total = 0; @endphp
                                        @foreach ($keranjang as $item)
                                            @php
                                                $subtotal = $item->produk->harga * $item->jumlah;
                                                $total += $subtotal;
                                            @endphp

                                            <div class="flex items-start justify-between gap-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 flex-shrink-0">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12z"></path></svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-semibold text-gray-800 line-clamp-1">{{ $item->produk->nama }}</p>
                                                        <p class="text-xs text-gray-500">x {{ $item->jumlah }}</p>
                                                    </div>
                                                </div>
                                                <p class="text-sm font-medium text-gray-700">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                                            </div>

                                            {{-- Input Hidden --}}
                                            <input type="hidden" name="produk_id[]" value="{{ $item->produk->id }}">
                                            <input type="hidden" name="jumlah[{{ $item->produk->id }}]" value="{{ $item->jumlah }}">
                                        @endforeach
                                    </div>

                                    <div class="border-t border-dashed border-gray-200 my-6"></div>

                                    <div class="space-y-2">
                                        <div class="flex justify-between text-sm text-gray-600">
                                            <span>Subtotal Produk</span>
                                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex justify-between text-sm text-gray-600">
                                            <span>Biaya Pengiriman</span>
                                            <span class="text-emerald-600 font-medium">Gratis</span>
                                        </div>
                                        <div class="flex justify-between items-end pt-4">
                                            <span class="text-base font-bold text-gray-800">Total Pembayaran</span>
                                            <span class="text-xl font-bold text-emerald-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                        </div>
                                    </div>

                                    {{-- Input Hidden Total --}}
                                    <input type="hidden" name="total" value="{{ $total }}">

                                    <button type="button" id="btnBayar"
                                        class="mt-8 w-full bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-emerald-500/30 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                        Bayar Sekarang
                                    </button>

                                    <p class="mt-4 text-xs text-center text-gray-400 flex items-center justify-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                        Transaksi Aman & Terenkripsi oleh Midtrans
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        .animate-fade-in-down { animation: fadeInDown 0.6s ease-out; }
        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out; }
        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        /* Custom Scrollbar for Items List */
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
    </style>
@endsection

@section('scripts')
    {{-- Script Wilayah Indonesia --}}
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
                            kecamatanSelect.innerHTML += `<option value="${kec.id}">${kec.name}</option>`;
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
                            kelurahanSelect.innerHTML += `<option value="${kel.id}">${kel.name}</option>`;
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

            // Animasi Loading Tombol
            const btn = this;
            const originalText = btn.innerHTML;
            btn.innerHTML = `<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...`;
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');

            let form = document.getElementById('checkoutForm');
            let formData = new FormData(form);

            fetch(form.action, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    },
                    body: formData
                })
                .then(async res => {
                    if (!res.ok) {
                        const text = await res.text();
                        try {
                            const json = JSON.parse(text);
                            throw new Error(json.error || json.message || res.statusText);
                        } catch (e) {
                            throw new Error(text);
                        }
                    }
                    return res.json();
                })
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
                                resetBtn();
                            },
                            onClose: function() {
                                alert("Kamu menutup popup tanpa menyelesaikan pembayaran.");
                                resetBtn();
                            }
                        });
                    } else {
                        alert("Gagal mendapatkan token Midtrans!");
                        resetBtn();
                    }
                })
                .catch(err => {
                    console.error("Fetch error:", err);
                    alert("Gagal: " + err.message);
                    resetBtn();
                });

            function resetBtn() {
                btn.innerHTML = originalText;
                btn.disabled = false;
                btn.classList.remove('opacity-75', 'cursor-not-allowed');
            }
        });
    </script>
@endsection
