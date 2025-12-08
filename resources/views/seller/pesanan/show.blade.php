    @extends('layouts.app')

    @section('content')
        <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6 mt-10">
            <h1 class="text-2xl font-bold mb-4">🧾 Detail Pesanan</h1>

            <div class="mb-4">
                <p><strong>Invoice:</strong> {{ $pesanan->invoice }}</p>
                <p><strong>Tanggal:</strong> {{ $pesanan->created_at->format('d M Y H:i') }}</p>
                <p><strong>Status:</strong>
                    <span class="font-semibold">{{ ucfirst($pesanan->status) }}</span>
                </p>
            </div>

            {{-- Daftar Produk Seller --}}
            <h2 class="text-lg font-semibold mb-2">📦 Produk Anda dalam Pesanan Ini:</h2>
            <ul class="border rounded divide-y">
                @foreach ($sellerItems as $item)
                    <li class="p-3">
                        <div class="flex justify-between">
                            <span>{{ $item->produk->nama }} ({{ $item->jumlah }}x)</span>
                            <span>Rp {{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}</span>
                        </div>

                        {{-- Lokasi terakhir paket --}}
                        <p class="text-sm text-gray-600 mt-1">
                            <strong>Lokasi Terakhir:</strong> {{ $item->lokasi_terakhir ?? '-' }}
                        </p>
                       
                    </li>
                @endforeach
            </ul>

            {{-- Form Update Status --}}
            <form action="{{ route('seller.pesanan.update', $pesanan->id) }}" method="POST" class="mt-6">
                @csrf

                <label for="status" class="block font-semibold mb-2">Ubah Status Pesanan:</label>
                <select name="status" id="status" class="border rounded p-2 w-full mb-3">
                    <option value="Diproses" {{ $pesanan->status === 'Diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="Dikirim" {{ $pesanan->status === 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="Selesai" {{ $pesanan->status === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Simpan Perubahan
                </button>
            </form>

            <a href="{{ route('seller.pesanan.index') }}" class="block mt-6 text-blue-600 hover:underline">
                ← Kembali ke Daftar Pesanan
            </a>
        </div>
    @endsection
