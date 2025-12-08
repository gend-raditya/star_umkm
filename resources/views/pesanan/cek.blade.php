@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4">
    <div class="container mx-auto max-w-7xl">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">🛒 Keranjang Belanja</h1>
            <p class="text-gray-600">Kelola produk yang ingin Anda beli</p>
        </div>

        @if (session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 rounded-lg mb-6 shadow-md flex items-center space-x-3">
            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
        @endif

        @if (count($keranjang))
        <form id="checkout-form" action="{{ route('checkout.pilih') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-4">
                    <!-- Pilih Semua -->
                    <div class="bg-white rounded-xl shadow-md p-4 border-2 border-gray-200 hover:border-indigo-300 transition">
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" id="select-all" class="w-5 h-5 text-indigo-600 rounded focus:ring-indigo-500 cursor-pointer">
                            <span class="font-semibold text-gray-800">Pilih Semua Produk</span>
                        </label>
                    </div>

                    <!-- Daftar Produk -->
                    @foreach ($keranjang as $item)
                    @php $subtotal = $item->produk->harga * $item->jumlah; @endphp
                    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition border border-gray-200 p-5 flex items-start space-x-4">
                        <!-- Checkbox -->
                        <input type="checkbox" name="produk_id[]" value="{{ $item->produk->id }}"
                            class="item-checkbox w-5 h-5 text-indigo-600 rounded cursor-pointer"
                            data-subtotal="{{ $subtotal }}">
                        <input type="hidden" name="jumlah[{{ $item->produk->id }}]" value="{{ $item->jumlah }}">

                        <!-- Gambar -->
                        <div class="flex-shrink-0">
                            @if ($item->produk->fotos->count())
                                <img src="{{ asset('storage/' . $item->produk->fotos->first()->path) }}" class="w-24 h-24 object-cover rounded-lg border-2 border-gray-100">
                            @else
                                <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Info Produk -->
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $item->produk->nama }}</h3>
                            <div class="flex items-baseline space-x-2 mb-3">
                                <span class="text-2xl font-bold text-indigo-600">Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</span>
                                <span class="text-sm text-gray-500">/item</span>
                            </div>

                            <div class="flex justify-between items-center">
                                <!-- Jumlah -->
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm text-gray-600">Jumlah:</span>
                                    <div class="flex items-center bg-gray-100 rounded-lg">
                                        <button type="button" class="px-2" onclick="updateJumlah('{{ route('keranjang.kurangi', $item->produk->id) }}')">-</button>
                                        <span class="px-3 font-bold text-gray-800">{{ $item->jumlah }}</span>
                                        <button type="button" class="px-2" onclick="updateJumlah('{{ route('keranjang.tambah', $item->produk->id) }}')">+</button>
                                    </div>
                                </div>

                                <!-- Subtotal -->
                                <div class="text-right">
                                    <p class="text-xs text-gray-500">Subtotal</p>
                                    <p class="text-xl font-bold text-green-600">Rp {{ number_format($subtotal, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Hapus -->
                        <button type="submit" formaction="{{ route('keranjang.hapus', $item->produk->id) }}" formmethod="POST"
                            class="text-red-500 hover:text-red-700 p-2 rounded-lg transition">
                            @csrf
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1
                                    1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                    @endforeach
                </div>

                <!-- Ringkasan -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg p-6 sticky top-6 border-2 border-gray-200">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0
                                    00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" />
                            </svg> Ringkasan Belanja
                        </h2>

                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-gray-700"><span>Subtotal Produk</span><span id="total-harga" class="font-semibold">Rp 0</span></div>
                            <div class="flex justify-between text-gray-700"><span>Biaya Pengiriman</span><span class="font-semibold text-green-600">GRATIS</span></div>
                            <div class="border-t-2 border-dashed pt-4 flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-900">Total</span>
                                <span id="total-harga-besar" class="text-2xl font-bold text-indigo-600">Rp 0</span>
                            </div>
                        </div>

                        <input type="hidden" id="total-hidden" name="total" value="0">

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6 text-sm text-blue-800">
                            <svg class="w-5 h-5 inline mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2
                                0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0
                                001 1h1a1 1 0 100-2v-3a1 1 0-1-1H9z"
                                clip-rule="evenodd"/></svg>
                            Pilih produk yang ingin dibeli
                        </div>

                        <button type="submit" id="checkout-btn"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-xl font-bold text-lg shadow-lg transition disabled:bg-gray-300 disabled:cursor-not-allowed flex items-center justify-center space-x-2"
                            disabled>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0
                                    003-3V8a3 3 0 00-3-3H6a3 3 0
                                    00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            <span>Lanjut ke Pembayaran</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
        @else
        <!-- Kosong -->
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
            <div class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7
                        13L5.4 5M7 13l-2.293 2.293c-.63.63-.184
                        1.707.707 1.707H17m0 0a2 2 0 100
                        4 2 2 0 000-4zm-8 2a2 2 0
                        11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Keranjang Kosong</h2>
            <p class="text-gray-600 mb-8">Yuk, mulai belanja dan tambahkan produk favoritmu!</p>
            <a href="{{ route('home') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-xl font-bold shadow-lg">Mulai Belanja</a>
        </div>
        @endif
    </div>
</div>

<script>
const cbAll = document.getElementById('select-all'),
      cbs = document.querySelectorAll('.item-checkbox'),
      totalEl = document.getElementById('total-harga'),
      totalBig = document.getElementById('total-harga-besar'),
      totalHidden = document.getElementById('total-hidden'),
      btn = document.getElementById('checkout-btn');

const updateTotal = () => {
    let total = [...cbs].filter(c => c.checked).reduce((t, c) => t + +c.dataset.subtotal, 0);
    const f = t => 'Rp ' + t.toLocaleString('id-ID');
    totalEl.textContent = totalBig.textContent = f(total);
    totalHidden.value = total; btn.disabled = total === 0;
};
cbAll?.addEventListener('change', e => { cbs.forEach(c => c.checked = e.target.checked); updateTotal(); });
cbs.forEach(c => c.addEventListener('change', updateTotal));

async function updateJumlah(url) {
    const res = await fetch(url, { method: "POST", headers: { "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value } });
    res.ok ? location.reload() : alert("Gagal update jumlah!");
}
</script>
@endsection
