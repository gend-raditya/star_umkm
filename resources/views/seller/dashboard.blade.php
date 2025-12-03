@extends('layouts.app')

@section('content')
    {{-- 🔔 Notifikasi (kalau ada) --}}
    @if (session('success'))
        <div id="flash-message"
            class="fixed top-20 left-1/2 transform -translate-x-1/2
                bg-green-100 text-green-700 p-3 rounded shadow-lg
                z-[9999] w-[90%] max-w-md text-center transition-opacity duration-500">
            {{ session('success') }}
        </div>
    @endif
    @foreach (auth()->user()->notifications as $notif)
        <div class="p-3 mb-2 bg-green-100 border-l-4 border-green-600 rounded">
            {{ $notif->data['message'] }}
        </div>
    @endforeach


    @if (session('error'))
        <div id="flash-message"
            class="fixed top-20 left-1/2 transform -translate-x-1/2
                bg-red-100 text-red-700 p-3 rounded shadow-lg
                z-[9999] w-[90%] max-w-md text-center transition-opacity duration-500">
            {{ session('error') }}
        </div>
    @endif

    <script>
        // 🔔 Hapus notifikasi otomatis setelah 3 detik
        setTimeout(() => {
            const flash = document.getElementById('flash-message');
            if (flash) {
                flash.style.transition = 'opacity 0.5s ease';
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 500);
            }
        }, 3000);
    </script>




    <div class="bg-white p-6 rounded shadow mt-6">
        <h2 class="text-2xl font-bold mb-4">Produk Saya</h2>

        {{-- Tombol tambah produk --}}
        <a href="{{ route('seller.produk.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            + Tambah Produk
        </a>

        {{-- Tabel produk --}}
        <table class="w-full mt-4 border">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2 border">Nama</th>
                    <th class="p-2 border">Harga</th>
                    <th class="p-2 border">Stok</th>
                    <th class="p-2 border">Foto</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produk as $item)
                    <tr>
                        <td class="p-2 border">{{ $item->nama }}</td>
                        <td class="p-2 border">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>

                        {{-- Update stok --}}
                        <td class="p-2 border">
                            <form action="{{ route('seller.produk.updateStok', $item->id) }}" method="POST"
                                class="flex items-center space-x-2">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="stok" value="{{ $item->stok }}" min="0"
                                    class="w-20 border rounded p-1 text-center">
                                <button type="submit"
                                    class="bg-green-600 text-white px-2 py-1 rounded text-sm hover:bg-green-700">
                                    Update
                                </button>
                            </form>
                        </td>

                        <td class="p-2 border">
                            @if ($item->fotos && $item->fotos->count() > 0)
                                <img src="{{ asset('storage/' . $item->fotos->first()->path) }}" width="60"
                                    class="rounded shadow">
                            @else
                                <span class="text-gray-400 italic">Tidak ada foto</span>
                            @endif
                        </td>

                        <td class="p-2 border">
                            <a href="{{ route('seller.produk.edit', $item->id) }}" class="text-blue-600 hover:underline">
                                Edit
                            </a> |
                            <form action="{{ route('seller.produk.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline" onclick="return confirm('Hapus produk ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-2 text-center text-gray-500">Belum ada produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Daftar Pesanan --}}
        <div class="mt-10">
            <h2 class="text-lg font-semibold mb-4">🛒 Pesanan untuk Produk Saya</h2>
            @forelse ($pesanans as $p)
                <div class="border rounded p-4 mb-3">
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="font-semibold">Invoice: {{ $p->invoice }}</div>
                            <div class="text-sm text-gray-600">Tanggal: {{ $p->created_at->format('d M Y H:i') }}</div>
                            <div class="text-sm text-gray-600">
                                Status: <span class="font-semibold">{{ ucfirst($p->status) }}</span>
                            </div>
                        </div>
                        <a href="{{ route('seller.pesanan.edit', $p->id) }}" class="text-blue-600 hover:underline">
                            Lihat Detail
                        </a>
                    </div>

                    {{-- Item produk milik seller --}}
                    <ul class="mt-3 text-sm text-gray-700">
                        @foreach ($p->items as $item)
                            @if ($item->produk->user_id === Auth::id())
                                <li>• {{ $item->produk->nama }} ({{ $item->jumlah }}x)</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @empty
                <p class="text-gray-500 text-center">Belum ada pesanan untuk produk Anda.</p>
            @endforelse
        </div>
    </div>

@endsection
