@extends('layouts.app')

@section('content')
    <div class="min-h-screen py-4 px-4 sm:px-6 lg:px-8 font-sans mt-8 mb-12">
        <div class="max-w-5xl mx-auto">

            <div class="mb-8 animate-fade-in-down">
                <a href="{{ route('admin.pesanan.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-indigo-600 transition-colors mb-3 group">
                    <svg class="w-4 h-4 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Kembali ke Daftar Pesanan
                </a>
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Detail Pesanan <span class="text-indigo-600">#{{ $pesanan->id }}</span></h1>
                        <p class="mt-1 text-gray-500">Informasi lengkap transaksi dan status pengiriman.</p>
                    </div>

                    {{-- Status Badge Besar --}}
                    @php
                        $statusColors = match(strtolower($pesanan->status)) {
                            'selesai' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                            'dikirim' => 'bg-blue-100 text-blue-800 border-blue-200',
                            'diproses' => 'bg-amber-100 text-amber-800 border-amber-200',
                            'dibatalkan' => 'bg-red-100 text-red-800 border-red-200',
                            default => 'bg-gray-100 text-gray-800 border-gray-200'
                        };
                    @endphp
                    <span class="px-4 py-2 rounded-xl text-sm font-bold border shadow-sm {{ $statusColors }}">
                        {{ ucfirst($pesanan->status) }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-fade-in-up delay-100">

                <div class="lg:col-span-1 space-y-6">

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Informasi Pelanggan
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Nama Lengkap</p>
                                <p class="text-gray-900 font-medium">{{ $pesanan->nama }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Email</p>
                                {{-- Memanggil email dari relasi user --}}
                                <p class="text-gray-900 font-medium">{{ $pesanan->user->email ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Total Pembayaran</p>
                                <p class="text-xl font-bold text-emerald-600">Rp {{ number_format($pesanan->total) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            Update Status
                        </h3>

                        <form action="{{ route('admin.pesanan.update', $pesanan->id) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <div class="relative">
                                <select name="status" class="appearance-none w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-200 outline-none cursor-pointer text-gray-700">
                                    <option value="Diproses" {{ $pesanan->status === 'Diproses' ? 'selected':'' }}>🟡 Diproses</option>
                                    <option value="Dikirim" {{ $pesanan->status === 'Dikirim' ? 'selected':'' }}>🔵 Dikirim</option>
                                    <option value="Selesai" {{ $pesanan->status === 'Selesai' ? 'selected':'' }}>🟢 Selesai</option>
                                    <option value="Dibatalkan" {{ $pesanan->status === 'Dibatalkan' ? 'selected':'' }}>🔴 Dibatalkan</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>

                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 transform hover:-translate-y-0.5">
                                Simpan Perubahan
                            </button>
                        </form>
                    </div>

                </div>

                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
                            <h3 class="font-bold text-gray-800 text-lg">Rincian Item Pesanan</h3>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50/30 text-xs uppercase tracking-wider text-gray-500 font-semibold border-b border-gray-100">
                                        <th class="px-6 py-4">Produk</th>
                                        <th class="px-6 py-4 text-center">Jumlah</th>
                                        <th class="px-6 py-4 text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($pesanan->items as $item)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-4">
                                                    <div class="h-12 w-12 rounded-lg bg-indigo-50 text-indigo-600 border border-indigo-100 flex items-center justify-center font-bold text-lg">
                                                        {{ substr($item->produk->nama, 0, 1) }}
                                                    </div>
                                                    <span class="font-semibold text-gray-800">{{ $item->produk->nama }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    x {{ $item->jumlah }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-right font-medium text-emerald-600">
                                                Rp {{ number_format($item->subtotal) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="bg-gray-50">
                                        <td colspan="2" class="px-6 py-4 text-right font-bold text-gray-600">Total Akhir</td>
                                        <td class="px-6 py-4 text-right font-bold text-gray-900 text-lg">Rp {{ number_format($pesanan->total) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        .animate-fade-in-down { animation: fadeInDown 0.6s ease-out; }
        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out; }
        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
@endsection
