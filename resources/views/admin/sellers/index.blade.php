@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Persetujuan Seller</h1>

        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr class="bg-gray-100 text-left text-gray-600">
                    <th class="p-3">Nama Seller</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Nomor HP</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Gunakan @forelse untuk menangani jika data kosong --}}
                @forelse ($sellers as $seller)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3 font-medium">{{ $seller->nama_seller }}</td>
                        {{-- Menggunakan optional() jaga-jaga jika user terhapus --}}
                        <td class="p-3">{{ optional($seller->user)->email }}</td>
                        <td class="p-3">{{ $seller->nomor_hp }}</td>

                        {{-- BAGIAN 1: STATUS DENGAN WARNA --}}
                        {{-- <td class="p-3">
                            @if($seller->user->seller_status == 'pending')
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                    ⏳ Pending
                                </span>
                            @elseif($seller->user->seller_status == 'approved')
                                <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                    ✅ Disetujui
                                </span>
                            @elseif($seller->user->seller_status == 'rejected')
                                <span class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                    ❌ Ditolak
                                </span>
                            @endif
                        </td> --}}
                        <td class="p-3 flex gap-2">

                        {{-- Tombol Setujui (Selalu Muncul, siapa tau Admin berubah pikiran) --}}
                        <form action="{{ route('admin.sellers.approve', $seller->user->id) }}" method="POST"
                            onsubmit="return confirm('Setujui seller ini?');">
                            @csrf
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm transition-colors">
                                @if($seller->user->seller_status == 'rejected')
                                    Pulihkan / Setujui
                                @else
                                    Setujui
                                @endif
                            </button>
                        </form>

                        {{-- Tombol Tolak (Hanya Muncul jika statusnya BELUM Ditolak) --}}
                        @if($seller->user->seller_status !== 'rejected')
                            <form action="{{ route('admin.sellers.reject', $seller->user->id) }}" method="POST"
                                onsubmit="return confirm('Tolak pengajuan ini?');">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition-colors">
                                    Tolak
                                </button>
                            </form>
                        @else
                            {{-- Jika sudah ditolak, tampilkan teks info saja --}}
                            <span class="text-gray-400 text-sm italic py-1">Sudah Ditolak</span>
                        @endif

                    </td>

                        <td class="p-3 flex gap-2">
                            {{-- BAGIAN 2: TOMBOL DENGAN KONFIRMASI --}}

                            {{-- Tombol Setujui --}}
                            <form action="{{ route('admin.sellers.approve', $seller->user->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menyetujui seller ini?');">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm transition-colors">
                                    Setujui
                                </button>
                            </form>

                            {{-- Tombol Tolak --}}
                            <form action="{{ route('admin.sellers.reject', $seller->user->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menolak pengajuan ini?');">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition-colors">
                                    Tolak
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    {{-- TAMPILAN JIKA KOSONG --}}
                    <tr>
                        <td colspan="5" class="p-6 text-center text-gray-500">
                            Tidak ada pengajuan seller baru saat ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
