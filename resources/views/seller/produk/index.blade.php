@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded shadow mt-6">
        <h2 class="text-2xl font-bold mb-4">Produk Saya</h2>

        <a href="{{ route('seller.produk.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Produk</a>

        <table class="w-full mt-4 border">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2 border">Nama</th>
                    <th class="p-2 border">Harga</th>
                    <th class="p-2 border">Foto</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produk as $item)
                    <tr>
                        <td class="p-2 border">{{ $item->nama }}</td>
                        <td class="p-2 border">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td class="p-2 border">
                            @if ($item->fotos && $item->fotos->count() > 0)
                                <img src="{{ asset('storage/' . $item->fotos->first()->path) }}" width="60"
                                    class="rounded">
                            @else
                                <span class="text-gray-400">Tidak ada foto</span>
                            @endif

                        </td>
                        <td class="p-2 border">
                            <a href="{{ route('seller.produk.edit', $item->id) }}" class="text-blue-600">Edit</a> |
                            <form action="{{ route('seller.produk.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button class="text-red-600" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-2 text-center">Belum ada produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
