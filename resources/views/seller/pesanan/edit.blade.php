@extends('layouts.app')

{{-- 🔔 NOTIFIKASI SUCCESS --}}
@if (session('success'))
    <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded shadow">
        {{ session('success') }}
    </div>
@endif

{{-- 🔔 NOTIFIKASI ERROR --}}
@if (session('error'))
    <div class="mb-4 p-3 bg-red-100 border border-red-300 text-red-700 rounded shadow">
        {{ session('error') }}
    </div>
@endif

{{-- 🔔 VALIDATION ERROR --}}
@if ($errors->any())
    <div class="mb-4 p-3 bg-yellow-100 border border-yellow-300 text-yellow-800 rounded shadow">
        <ul class="list-disc ms-5">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')
    <div x-data="{ status: '{{ $pesanan->status }}' }" class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6 mt-10">
        <h1 class="text-2xl font-bold mb-4">🧾 Detail Pesanan</h1>

        {{-- Informasi Pesanan --}}
        <div class="mb-4">
            <p><strong>Invoice:</strong> {{ $pesanan->invoice }}</p>
            <p><strong>Tanggal:</strong> {{ $pesanan->created_at->format('d M Y H:i') }}</p>
            <p><strong>Status Saat Ini:</strong>
                <span class="font-semibold {{ $pesanan->status === 'Dibatalkan' ? 'text-red-600' : 'text-blue-600' }}">
                    {{ ucfirst($pesanan->status) }}
                </span>
            </p>
        </div>

        {{-- Daftar Produk --}}
        <h2 class="text-lg font-semibold mb-2">📦 Produk dari Anda:</h2>
        <ul class="border rounded divide-y mb-6">
            @foreach ($sellerItems as $item)
                <li class="p-3 flex flex-col sm:flex-row sm:justify-between sm:items-center">
                    <div>
                        <span class="font-medium">{{ $item->produk->nama }}</span>
                        <p class="text-sm text-gray-500">Jumlah: {{ $item->jumlah }}</p>
                        <p class="text-sm text-gray-500">Subtotal: Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                        @if ($item->lokasi_terakhir)
                            <p class="text-sm text-green-600">📍 Lokasi Terakhir: {{ $item->lokasi_terakhir }}</p>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>

        {{-- Jika status dibatalkan --}}
        @if ($pesanan->status === 'Dibatalkan')
            <div class="mt-6 p-4 bg-red-50 border border-red-300 rounded text-red-700">
                ❗ Pesanan ini telah <strong>Dibatalkan oleh Pembeli</strong>.
                Anda tidak dapat mengubah status atau menambah informasi pengiriman.
            </div>
        @else
            {{-- FORM 1: Update Status --}}
            <form action="{{ route('seller.pesanan.update', $pesanan->id) }}" method="POST" class="mt-4 space-y-4">
                @csrf
                @method('POST')

                <label for="status" class="block font-semibold mb-2">Ubah Status Pesanan:</label>
                <select name="status" id="status" x-model="status" class="border rounded p-2 w-full mb-3">
                    <option value="Diproses" {{ $pesanan->status === 'Diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="Dikirim" {{ $pesanan->status === 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="Selesai" {{ $pesanan->status === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>

                <div class="mb-3">
                    <label for="lokasi_terakhir" class="block font-semibold mb-2">Lokasi Terakhir (opsional):</label>
                    <input type="text" name="lokasi_terakhir" id="lokasi_terakhir" class="border rounded p-2 w-full"
                        placeholder="Contoh: Gudang Jakarta Timur">
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Simpan Perubahan
                </button>
            </form>

            {{-- FORM 2: Input Nomor Resi --}}
            <div x-show="status === 'Dikirim'" x-transition class="mt-8">
                <h2 class="text-lg font-semibold mb-2">🚚 Informasi Pengiriman</h2>

                <form action="{{ route('seller.pesanan.updateResi', $pesanan->id) }}" method="POST"
                    class="flex flex-col sm:flex-row gap-2 bg-gray-50 p-3 rounded">
                    @csrf
                    @method('PATCH')

                    <input type="text" name="no_resi" placeholder="Nomor Resi"
                        value="{{ old('no_resi', $pesanan->no_resi ?? '') }}" class="border p-2 rounded text-sm flex-1"
                        required>

                    <select name="ekspedisi" class="border p-2 rounded text-sm" required>
                        <option value="">-- Pilih Ekspedisi --</option>
                        <option value="jne" {{ $pesanan->ekspedisi === 'jne' ? 'selected' : '' }}>JNE</option>
                        <option value="jnt" {{ $pesanan->ekspedisi === 'jnt' ? 'selected' : '' }}>J&T</option>
                        <option value="sicepat" {{ $pesanan->ekspedisi === 'sicepat' ? 'selected' : '' }}>SiCepat</option>
                        <option value="pos" {{ $pesanan->ekspedisi === 'pos' ? 'selected' : '' }}>POS</option>
                        <option value="tiki" {{ $pesanan->ekspedisi === 'tiki' ? 'selected' : '' }}>TIKI</option>
                        <option value="anteraja" {{ $pesanan->ekspedisi === 'anteraja' ? 'selected' : '' }}>AnterAja
                        </option>
                        <option value="ninja" {{ $pesanan->ekspedisi === 'ninja' ? 'selected' : '' }}>Ninja</option>
                    </select>

                    <button type="submit" class="bg-purple-600 text-white px-3 py-2 rounded text-sm hover:bg-purple-700">
                        Simpan
                    </button>
                </form>
            </div>
        @endif

        <a href="{{ route('seller.pesanan.index') }}" class="block mt-6 text-blue-600 hover:underline">
            ← Kembali ke Daftar Pesanan
        </a>
    </div>
@endsection
