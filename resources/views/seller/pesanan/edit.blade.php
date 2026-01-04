@extends('layouts.app')

@section('content')
    <div x-data="{ status: '{{ $pesanan->status }}' }" class="min-h-screen py-10 px-4 sm:px-6 lg:px-8 font-sans">

        {{-- 🔔 Flash Messages --}}
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                 class="fixed top-6 right-6 z-50 flex items-center w-full max-w-sm p-4 text-emerald-800 bg-emerald-50 rounded-xl shadow-lg border border-emerald-100 animate-fade-in-down">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-emerald-500 bg-emerald-100 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div class="ml-3 text-sm font-semibold">{{ session('success') }}</div>
            </div>
        @endif

        @if ($errors->any())
            <div class="fixed top-6 right-6 z-50 w-full max-w-sm bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-lg animate-fade-in-down">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan</h3>
                        <ul class="mt-1 list-disc list-inside text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="max-w-5xl mx-auto">

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 animate-fade-in-down">
                <div>
                    <a href="{{ route('seller.pesanan.index') }}" class="text-sm font-medium text-gray-500 hover:text-emerald-600 flex items-center gap-1 transition-colors mb-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Daftar Pesanan
                    </a>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Detail Pesanan Masuk</h1>
                </div>

                {{-- Status Badge (Besar) --}}
                @php
                    $statusColor = match($pesanan->status) {
                        'Diproses' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                        'Dikirim' => 'bg-blue-100 text-blue-800 border-blue-200',
                        'Selesai' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                        'Dibatalkan' => 'bg-red-100 text-red-800 border-red-200',
                        default => 'bg-gray-100 text-gray-800'
                    };
                @endphp
                <div class="px-4 py-2 rounded-xl border {{ $statusColor }} flex items-center gap-2 shadow-sm">
                    <span class="text-sm font-bold uppercase tracking-wide">{{ ucfirst($pesanan->status) }}</span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-fade-in-up delay-100">

                <div class="lg:col-span-2 space-y-6">

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 012 2"></path></svg>
                                Data Pesanan
                            </h3>
                            <span class="text-xs font-mono text-gray-500">{{ $pesanan->invoice }}</span>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Tanggal Pemesanan</p>
                                    <p class="text-gray-900 font-medium mt-1">{{ $pesanan->created_at->format('d F Y') }}</p>
                                    <p class="text-xs text-gray-400">{{ $pesanan->created_at->format('H:i') }} WIB</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Pembeli</p>
                                    <p class="text-gray-900 font-medium mt-1">{{ $pesanan->user->name ?? 'Guest' }}</p> </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                Produk yang Dipesan
                            </h3>
                        </div>
                        <div class="divide-y divide-gray-100">
                            @foreach ($sellerItems as $item)
                                <div class="p-5 flex flex-col sm:flex-row justify-between items-start sm:items-center hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center gap-4">
                                        <div class="h-12 w-12 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center text-xs text-gray-400 font-bold">
                                            {{ substr($item->produk->nama, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900 text-sm">{{ $item->produk->nama }}</p>
                                            <p class="text-xs text-gray-500 mt-0.5">Qty: <span class="font-bold text-gray-800">{{ $item->jumlah }}</span> x Rp{{ number_format($item->produk->harga, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-3 sm:mt-0 text-right">
                                        <p class="font-bold text-emerald-600 text-sm">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                        @if ($item->lokasi_terakhir)
                                            <div class="flex items-center gap-1 mt-1 justify-end text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md w-fit ml-auto">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                {{ $item->lokasi_terakhir }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="px-6 py-4 bg-gray-50 text-right">
                            <span class="text-sm text-gray-500 mr-2">Total Pendapatan:</span>
                            <span class="text-lg font-bold text-gray-900">Rp {{ number_format($sellerItems->sum('subtotal'), 0, ',', '.') }}</span>
                        </div>
                    </div>

                </div>

                <div class="lg:col-span-1 space-y-6">

                    @if ($pesanan->status === 'Dibatalkan')
                        <div class="bg-red-50 border border-red-200 rounded-2xl p-6 text-center animate-pulse">
                            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3 text-red-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-red-800">Pesanan Dibatalkan</h3>
                            <p class="text-sm text-red-600 mt-1">Pembeli telah membatalkan pesanan ini. Tidak ada tindakan yang diperlukan.</p>
                        </div>
                    @else

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                            <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Update Status
                            </h3>

                            <form action="{{ route('seller.pesanan.update', $pesanan->id) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('POST')

                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Status Pesanan</label>
                                    <div class="relative">
                                        <select name="status" id="status" x-model="status"
                                            class="appearance-none w-full px-4 py-2.5 rounded-xl border border-gray-300 bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200 outline-none cursor-pointer text-sm font-medium text-gray-700">
                                            <option value="Diproses" {{ $pesanan->status === 'Diproses' ? 'selected' : '' }}>🟡 Diproses</option>
                                            <option value="Dikirim" {{ $pesanan->status === 'Dikirim' ? 'selected' : '' }}>🔵 Dikirim</option>
                                            <option value="Selesai" {{ $pesanan->status === 'Selesai' ? 'selected' : '' }}>🟢 Selesai</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Lokasi Terakhir <span class="text-gray-400 font-normal normal-case">(Opsional)</span></label>
                                    <input type="text" name="lokasi_terakhir"
                                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-sm placeholder-gray-400"
                                        placeholder="Misal: Gudang Sortir JKT">
                                </div>

                                <button type="submit" class="w-full py-2.5 rounded-xl bg-blue-600 text-white text-sm font-bold shadow-md hover:bg-blue-700 hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                                    Simpan Perubahan
                                </button>
                            </form>
                        </div>

                        <div x-show="status === 'Dikirim'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
                             class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl shadow-sm border border-indigo-100 p-6">

                            <h3 class="font-bold text-indigo-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Input Nomor Resi
                            </h3>

                            <form action="{{ route('seller.pesanan.updateResi', $pesanan->id) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PATCH')

                                <div>
                                    <input type="text" name="no_resi" placeholder="Masukkan Nomor Resi"
                                        value="{{ old('no_resi', $pesanan->no_resi ?? '') }}"
                                        class="w-full px-4 py-2.5 rounded-xl border border-indigo-200 bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all outline-none text-sm font-mono placeholder-gray-400" required>
                                </div>

                                <div class="relative">
                                    <select name="ekspedisi" class="appearance-none w-full px-4 py-2.5 rounded-xl border border-indigo-200 bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all outline-none cursor-pointer text-sm text-gray-700" required>
                                        <option value="">-- Pilih Kurir --</option>
                                        <option value="jne" {{ $pesanan->ekspedisi === 'jne' ? 'selected' : '' }}>JNE</option>
                                        <option value="jnt" {{ $pesanan->ekspedisi === 'jnt' ? 'selected' : '' }}>J&T</option>
                                        <option value="sicepat" {{ $pesanan->ekspedisi === 'sicepat' ? 'selected' : '' }}>SiCepat</option>
                                        <option value="pos" {{ $pesanan->ekspedisi === 'pos' ? 'selected' : '' }}>POS Indonesia</option>
                                        <option value="anteraja" {{ $pesanan->ekspedisi === 'anteraja' ? 'selected' : '' }}>AnterAja</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-indigo-400">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>

                                <button type="submit" class="w-full py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-bold shadow-md hover:bg-indigo-700 hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                                    Simpan Resi
                                </button>
                            </form>
                        </div>

                    @endif

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
