@extends('layouts.app')

@section('content')
    <div class="min-h-screen py-10 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-6xl mx-auto">

            <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 animate-fade-in-down gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Dashboard Seller</h1>
                    <p class="mt-2 text-gray-500">Kelola toko, produk, dan pesanan Anda dalam satu tempat.</p>
                </div>
                <a href="{{ route('seller.produk.create') }}"
                   class="inline-flex items-center px-5 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-emerald-600 hover:bg-emerald-700 shadow-lg hover:shadow-emerald-500/30 transition-all duration-200 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Produk Baru
                </a>
            </div>

            {{-- 🔔 Notifikasi Floating --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                     class="fixed top-24 right-5 z-50 flex items-center w-full max-w-sm p-4 text-emerald-800 bg-emerald-50 rounded-xl shadow-lg border border-emerald-100 animate-fade-in-up">
                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-emerald-500 bg-emerald-100 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div class="ml-3 text-sm font-semibold">{{ session('success') }}</div>
                </div>
            @endif

            @if (session('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                     class="fixed top-24 right-5 z-50 flex items-center w-full max-w-sm p-4 text-red-800 bg-red-50 rounded-xl shadow-lg border border-red-100 animate-fade-in-up">
                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </div>
                    <div class="ml-3 text-sm font-semibold">{{ session('error') }}</div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10 animate-fade-in-up delay-100">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition-all">
                    <div class="absolute right-0 top-0 h-24 w-24 bg-blue-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-blue-100 text-blue-600 rounded-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Produk</p>
                                <h3 class="text-2xl font-bold text-gray-900">{{ count($produk) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition-all">
                    <div class="absolute right-0 top-0 h-24 w-24 bg-purple-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-purple-100 text-purple-600 rounded-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Pesanan Masuk</p>
                                <h3 class="text-2xl font-bold text-gray-900">{{ count($pesanans) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-md transition-all">
                    <div class="absolute right-0 top-0 h-24 w-24 bg-emerald-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-emerald-100 text-emerald-600 rounded-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Unit Stok</p>
                                <h3 class="text-2xl font-bold text-gray-900">{{ $produk->sum('stok') }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-fade-in-up delay-200">

                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                            <h3 class="font-bold text-gray-800 text-lg">Inventaris Produk</h3>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50 text-xs uppercase tracking-wider text-gray-500 font-semibold border-b border-gray-100">
                                        <th class="px-6 py-4 rounded-tl-lg">Produk</th>
                                        <th class="px-6 py-4">Harga</th>
                                        <th class="px-6 py-4">Stok</th>
                                        <th class="px-6 py-4 text-center rounded-tr-lg">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse ($produk as $item)
                                        <tr class="group hover:bg-emerald-50/30 transition-colors duration-200">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="h-12 w-12 rounded-lg bg-gray-100 border border-gray-200 overflow-hidden flex-shrink-0">
                                                        @if ($item->fotos && $item->fotos->count() > 0)
                                                            <img src="{{ asset('storage/' . $item->fotos->first()->path) }}" class="h-full w-full object-cover">
                                                        @else
                                                            <div class="flex h-full w-full items-center justify-center text-gray-400">
                                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12z"></path></svg>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <span class="font-semibold text-gray-800 text-sm">{{ $item->nama }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium text-emerald-600">
                                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <form action="{{ route('seller.produk.updateStok', $item->id) }}" method="POST" class="flex items-center gap-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="number" name="stok" value="{{ $item->stok }}" min="0"
                                                        class="w-16 px-2 py-1 text-sm text-center border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none transition-all">
                                                    <button type="submit" class="p-1.5 bg-emerald-100 text-emerald-600 rounded-lg hover:bg-emerald-200 transition-colors" title="Update Stok">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div class="flex items-center justify-center gap-3">
                                                    <a href="{{ route('seller.produk.edit', $item->id) }}" class="text-blue-500 hover:text-blue-700 transition-colors text-sm font-medium">Edit</a>
                                                    <span class="text-gray-300">|</span>
                                                    <form action="{{ route('seller.produk.destroy', $item->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-500 hover:text-red-700 transition-colors text-sm font-medium" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                                <div class="flex flex-col items-center justify-center">
                                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                                    </div>
                                                    <p class="font-medium">Belum ada produk.</p>
                                                    <p class="text-sm mt-1">Tambahkan produk pertama Anda sekarang.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-8">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
                            <h3 class="font-bold text-gray-800 text-lg">Pesanan Masuk</h3>
                        </div>

                        <div class="max-h-[600px] overflow-y-auto divide-y divide-gray-100">
                            @forelse ($pesanans as $p)
                                <div class="p-5 hover:bg-gray-50 transition-colors block group">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <p class="font-bold text-gray-900 text-sm">{{ $p->invoice }}</p>
                                            <p class="text-xs text-gray-500 mt-0.5">{{ $p->created_at->format('d M, H:i') }}</p>
                                        </div>
                                        @php
                                            $statusColor = match(strtolower($p->status)) {
                                                'diproses' => 'bg-yellow-100 text-yellow-800',
                                                'dikirim' => 'bg-blue-100 text-blue-800',
                                                'selesai' => 'bg-emerald-100 text-emerald-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                        @endphp
                                        <span class="px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wide {{ $statusColor }}">
                                            {{ $p->status }}
                                        </span>
                                    </div>

                                    <div class="space-y-2 mb-4">
                                        @foreach ($p->items as $item)
                                            @if ($item->produk->user_id === Auth::id())
                                                <div class="flex items-center justify-between text-sm">
                                                    <span class="text-gray-600 truncate max-w-[150px]">{{ $item->produk->nama }}</span>
                                                    <span class="font-medium text-gray-900">x{{ $item->jumlah }}</span>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                    <a href="{{ route('seller.pesanan.edit', $p->id) }}"
                                       class="block w-full text-center px-4 py-2 border border-gray-200 rounded-lg text-sm font-semibold text-gray-600 hover:text-emerald-600 hover:border-emerald-200 hover:bg-emerald-50 transition-all">
                                        Proses Pesanan
                                    </a>
                                </div>
                            @empty
                                <div class="p-8 text-center">
                                    <p class="text-gray-500 text-sm">Belum ada pesanan masuk.</p>
                                </div>
                            @endforelse
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
