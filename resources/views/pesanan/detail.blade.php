@extends('layouts.app')

@section('content')
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-4xl mx-auto">

            <div class="flex items-center justify-between mb-8 animate-fade-in-down">
                <div>
                    <a href="{{ route('pesanan.saya') }}" class="text-sm font-medium text-gray-500 hover:text-emerald-600 flex items-center gap-1 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Riwayat
                    </a>
                    <h1 class="text-3xl font-extrabold text-gray-900 mt-2">Detail Pesanan</h1>
                    <p class="text-gray-500">Invoice: <span class="font-mono font-medium text-gray-700 select-all">{{ $pesanan->invoice }}</span></p>
                </div>

                <div>
                    @php
                        $statusColors = [
                            'Diproses' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                            'Dikirim' => 'bg-blue-100 text-blue-800 border-blue-200',
                            'Selesai' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                            'Dibatalkan' => 'bg-red-100 text-red-800 border-red-200',
                        ];
                        $colorClass = $statusColors[$pesanan->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                    @endphp
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold border shadow-sm {{ $colorClass }}">
                        @if($pesanan->status == 'Diproses') <span class="w-2 h-2 rounded-full bg-yellow-500 mr-2 animate-pulse"></span>
                        @elseif($pesanan->status == 'Dikirim') <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        @elseif($pesanan->status == 'Selesai') <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        @endif
                        {{ ucfirst($pesanan->status) }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-fade-in-up">

                <div class="lg:col-span-2 space-y-6">

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                Daftar Produk
                            </h3>
                            <span class="text-xs font-medium text-gray-500">{{ $pesanan->items->count() }} Item</span>
                        </div>
                        <div class="divide-y divide-gray-100">
                            @foreach ($pesanan->items as $item)
                                <div class="p-6 flex flex-col sm:flex-row gap-4 hover:bg-gray-50 transition-colors">
                                    <div class="w-16 h-16 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center flex-shrink-0">
                                        @if($item->produk->fotos && $item->produk->fotos->count())
                                            <img src="{{ asset('storage/' . $item->produk->fotos->first()->path) }}" class="w-full h-full object-cover rounded-xl">
                                        @else
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12z"></path></svg>
                                        @endif
                                    </div>

                                    <div class="flex-1">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-bold text-gray-900">{{ $item->produk->nama }}</h4>
                                                <p class="text-sm text-gray-500 mt-1">Jumlah: {{ $item->jumlah }} x Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</p>
                                            </div>
                                            <p class="font-bold text-emerald-600">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                        </div>

                                        @if($item->lokasi_terakhir)
                                            <div class="mt-3 flex items-center text-xs text-gray-500 bg-blue-50 px-3 py-1.5 rounded-lg border border-blue-100 w-fit">
                                                <svg class="w-3 h-3 text-blue-500 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                Posisi Terakhir: <span class="font-semibold text-blue-700 ml-1">{{ $item->lokasi_terakhir }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if ($pesanan->status === 'Diproses')
                        <div class="bg-red-50 border border-red-100 rounded-xl p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div>
                                <h4 class="font-bold text-red-800">Ingin membatalkan pesanan?</h4>
                                <p class="text-sm text-red-600 mt-1">Pesanan hanya dapat dibatalkan selama status masih "Diproses".</p>
                            </div>
                            <form action="{{ route('pesanan.batalkan', $pesanan->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" onclick="return confirm('Yakin ingin membatalkan pesanan ini? Aksi ini tidak dapat dibatalkan.');"
                                    class="px-5 py-2.5 bg-white text-red-600 font-semibold rounded-lg border border-red-200 shadow-sm hover:bg-red-600 hover:text-white hover:border-transparent transition-all duration-200 text-sm">
                                    Batalkan Pesanan
                                </button>
                            </form>
                        </div>
                    @endif

                </div>

                <div class="space-y-6">

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="font-bold text-gray-900 mb-4 pb-4 border-b border-gray-100">Ringkasan Pembayaran</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between text-gray-600">
                                <span>Total Harga Produk</span>
                                <span>Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Biaya Pengiriman</span>
                                <span class="text-emerald-600 font-medium">Gratis</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Biaya Layanan</span>
                                <span class="text-emerald-600 font-medium">Gratis</span>
                            </div>
                            <div class="border-t border-dashed border-gray-200 pt-3 mt-3 flex justify-between items-end">
                                <span class="font-bold text-gray-900 text-base">Total Bayar</span>
                                <span class="font-bold text-emerald-600 text-xl">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    @if ($pesanan->no_resi)
                        <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl shadow-lg p-6 text-white relative overflow-hidden">
                            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white opacity-10 rounded-full blur-xl"></div>

                            <h3 class="font-bold text-white mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Info Pengiriman
                            </h3>

                            <div class="space-y-3">
                                <div>
                                    <p class="text-emerald-100 text-xs uppercase tracking-wider">Ekspedisi</p>
                                    <p class="font-bold text-lg">{{ strtoupper($pesanan->ekspedisi ?? 'Kurir Toko') }}</p>
                                </div>
                                <div>
                                    <p class="text-emerald-100 text-xs uppercase tracking-wider">Nomor Resi</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <p class="font-mono font-medium text-lg tracking-wide select-all">{{ $pesanan->no_resi }}</p>
                                        <button onclick="navigator.clipboard.writeText('{{ $pesanan->no_resi }}')" class="p-1 hover:bg-white/20 rounded transition" title="Salin Resi">
                                            <svg class="w-4 h-4 text-emerald-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <a href="https://cekresi.com/?noresi={{ $pesanan->no_resi }}" target="_blank"
                                class="mt-6 block w-full text-center px-4 py-2.5 bg-white text-emerald-600 font-bold rounded-xl shadow-sm hover:bg-gray-50 transition-colors">
                                Lacak Paket
                            </a>
                        </div>
                    @else
                        <div class="bg-gray-50 rounded-2xl border border-gray-200 p-6 text-center">
                            <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                            </div>
                            <h4 class="font-bold text-gray-700">Resi Belum Tersedia</h4>
                            <p class="text-sm text-gray-500 mt-1">Nomor resi akan muncul setelah pesanan dikirim oleh penjual.</p>
                        </div>
                    @endif

                    <div class="text-xs text-gray-400 text-center">
                        Pesanan dibuat pada: {{ $pesanan->created_at->format('d F Y, H:i') }} WIB
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
