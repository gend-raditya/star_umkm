@extends('layouts.app')

@section('content')
<section class="py-10 relative">

        <div class="max-w-3xl mx-auto mb-12">

            <div class="flex items-center justify-between mb-8 animate-fade-in-down">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Riwayat Pesanan</h1>
                    <p class="mt-2 text-gray-500">Lacak dan kelola semua pesanan Anda di sini.</p>
                </div>
                <div class="hidden sm:block">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-white border border-gray-200 shadow-sm text-gray-600">
                        <svg class="mr-2 h-4 w-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Total: {{ $pesanans->count() }} Pesanan
                    </span>
                </div>
            </div>

            @if ($pesanans->isEmpty())
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-12 text-center animate-fade-in-up">
                    <div class="mx-auto h-40 w-40 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                        <svg class="h-20 w-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Pesanan</h3>
                    <p class="text-gray-500 mb-8 max-w-sm mx-auto">Sepertinya Anda belum pernah berbelanja. Yuk cari produk favoritmu sekarang!</p>
                    <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-emerald-600 hover:bg-emerald-700 shadow-lg hover:shadow-emerald-500/30 transition-all duration-200">
                        Mulai Belanja
                    </a>
                </div>
            @else
                <div class="space-y-6 animate-fade-in-up">
                    @foreach ($pesanans as $pesanan)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300">
                            <div class="bg-gray-50/50 px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-white border border-gray-200 rounded-lg">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">No. Invoice</p>
                                        <p class="text-sm font-bold text-gray-900 font-mono">{{ $pesanan->invoice }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-sm text-gray-600">{{ $pesanan->created_at->format('d M Y, H:i') }} WIB</span>
                                </div>
                            </div>

                            <div class="p-6">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">

                                    <div class="flex flex-col sm:flex-row gap-6 sm:gap-12 w-full sm:w-auto">
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold mb-1">Total Pembayaran</p>
                                            <p class="text-xl font-bold text-emerald-600">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold mb-1">Status Pesanan</p>
                                            @if(strtolower($pesanan->status) == 'diproses')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 mr-2 animate-pulse"></span> Diproses
                                                </span>
                                            @elseif(strtolower($pesanan->status) == 'dikirim')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Dikirim
                                                </span>
                                            @elseif(strtolower($pesanan->status) == 'selesai')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Selesai
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                                    {{ ucfirst($pesanan->status) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="w-full sm:w-auto">
                                        <a href="{{ route('pesanan.detail', $pesanan->id) }}"
                                           class="group w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-100 bg-[#88AEAE] hover:bg-gray-50 hover:text-emerald-600 hover:border-emerald-200 transition-all duration-200">
                                            Lihat Detail
                                            <svg class="ml-2 -mr-1 h-4 w-4 text-gray-400 group-hover:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </section>

    <style>
        .animate-fade-in-down { animation: fadeInDown 0.6s ease-out; }
        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out; }
        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>

@endsection
