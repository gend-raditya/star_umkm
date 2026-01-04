@extends('layouts.app')

@section('content')
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-3xl mx-auto">

            <div class="flex items-center justify-between mb-10 animate-fade-in-down">
                <div>
                    <a href="{{ route('seller.dashboard') }}" class="text-sm font-medium text-gray-500 hover:text-emerald-600 flex items-center gap-1 transition-colors mb-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Dashboard
                    </a>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Pesanan Masuk</h1>
                    <p class="mt-1 text-gray-500">Kelola pesanan pelanggan yang perlu diproses.</p>
                </div>
                <div class="hidden sm:block">
                    <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-white border border-gray-200 shadow-sm text-gray-700">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                        {{ $pesanans->count() }} Pesanan Aktif
                    </span>
                </div>
            </div>

            @if($pesanans->isEmpty())
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-12 text-center animate-fade-in-up">
                    <div class="mx-auto h-40 w-40 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                        <svg class="h-20 w-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Pesanan</h3>
                    <p class="text-gray-500 max-w-sm mx-auto">Saat ini belum ada pesanan baru yang masuk untuk toko Anda.</p>
                </div>
            @else
                <div class="space-y-4 animate-fade-in-up delay-100">
                    @foreach($pesanans as $p)
                        <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:border-emerald-100 transition-all duration-300 overflow-hidden relative">

                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-500 transform scale-y-0 group-hover:scale-y-100 transition-transform duration-300 origin-bottom"></div>

                            <div class="p-6 flex flex-col sm:flex-row gap-6 items-start sm:items-center justify-between">

                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="text-lg font-bold text-gray-900 font-mono">{{ $p->invoice }}</h3>
                                        @php
                                            $statusColor = match(strtolower($p->status)) {
                                                'diproses' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                'dikirim' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                'selesai' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                                                'dibatalkan' => 'bg-red-100 text-red-800 border-red-200',
                                                default => 'bg-gray-100 text-gray-800'
                                            };
                                        @endphp
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $statusColor }}">
                                            {{ ucfirst($p->status) }}
                                        </span>
                                    </div>

                                    <div class="text-sm text-gray-500 flex items-center gap-4">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ $p->created_at->format('d M Y, H:i') }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            {{ $p->user->name ?? 'Guest' }}
                                        </span>
                                    </div>

                                    <div class="mt-3 text-sm text-gray-600 bg-gray-50 rounded-lg px-3 py-2 border border-gray-100 inline-block">
                                        @php
                                            // Filter item milik seller ini
                                            $sellerItems = $p->items->filter(function($item) {
                                                return $item->produk->user_id === Auth::id();
                                            });
                                            $firstItem = $sellerItems->first();
                                            $count = $sellerItems->count();
                                        @endphp

                                        @if($firstItem)
                                            <span class="font-medium">{{ $firstItem->produk->nama }}</span>
                                            @if($count > 1)
                                                <span class="text-gray-400 text-xs ml-1">+{{ $count - 1 }} item lainnya</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>

                                <div>
                                    <a href="{{ route('seller.pesanan.edit', $p->id) }}"
                                       class="group/btn flex items-center justify-center gap-2 px-5 py-2.5 bg-white border-2 border-emerald-500 text-emerald-600 font-bold rounded-xl hover:bg-emerald-600 hover:text-white transition-all duration-200 shadow-sm hover:shadow-emerald-500/30">
                                        <span>Proses</span>
                                        <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <style>
        .animate-fade-in-down { animation: fadeInDown 0.6s ease-out; }
        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out; }
        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
@endsection
