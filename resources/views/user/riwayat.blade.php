@extends('layouts.app')

@section('content')
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute -top-[10%] left-[20%] w-[30%] h-[30%] rounded-full bg-emerald-400/20 blur-3xl animate-pulse"></div>
        <div class="absolute bottom-[20%] right-[10%] w-[40%] h-[40%] rounded-full bg-teal-400/20 blur-3xl animate-pulse delay-1000"></div>
    </div>

    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-5xl mx-auto">

            <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 animate-fade-in-down gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Pesanan Selesai</h1>
                    <p class="mt-2 text-gray-500">Daftar pesanan anda yang telah selesai.</p>
                </div>

                @if(!$pesanan->isEmpty())
                    <div class="bg-white px-4 py-2 rounded-xl shadow-sm border border-emerald-100 flex items-center gap-2">
                        <span class="relative flex h-3 w-3">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                        </span>
                        <span class="text-sm font-semibold text-gray-700">{{ $pesanan->count() }} Pesanan Selesai</span>
                    </div>
                @endif
            </div>

            @if ($pesanan->isEmpty())
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-sm border border-white/50 p-12 text-center animate-fade-in-up">
                    <div class="w-48 h-48 mx-auto mb-6 opacity-90">
                        <img src="https://illustrations.popsy.co/amber/delivery.svg" alt="No Orders" class="w-full h-full object-contain">
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Riwayat Pesanan</h3>
                    <p class="text-gray-500 mb-8">Pesanan yang telah Anda selesaikan pembayarannya akan muncul di sini.</p>
                    <a href="{{ url('/') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-bold rounded-xl text-white bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 shadow-lg hover:shadow-emerald-500/30 transition-all duration-200 transform hover:-translate-y-1">
                        Belanja Sekarang
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 animate-fade-in-up">
                    @foreach ($pesanan as $item)
                        <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-emerald-200 transition-all duration-300 relative overflow-hidden flex flex-col h-full">

                            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-400 to-teal-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>

                            <div class="p-6 pb-4 flex justify-between items-start">
                                <div>
                                    <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider mb-1">Order #{{ $item->id }}</p>
                                    <p class="text-xs text-gray-400">{{ $item->created_at->format('d M Y') }}</p>
                                </div>

                                {{-- Status Badge Logic --}}
                                @php
                                    $status = strtolower($item->status);
                                    $badgeColor = match($status) {
                                        'selesai' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                        'dikirim' => 'bg-blue-100 text-blue-700 border-blue-200',
                                        'diproses' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                        'dibatalkan' => 'bg-red-100 text-red-700 border-red-200',
                                        default => 'bg-gray-100 text-gray-700 border-gray-200'
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $badgeColor }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>

                            <div class="px-6 py-2 flex-grow">
                                <div class="flex items-baseline gap-1 mb-4">
                                    <span class="text-2xl font-bold text-gray-800">Rp{{ number_format($item->total, 0, ',', '.') }}</span>
                                </div>

                                <div class="space-y-3">
                                    <div class="flex items-center gap-3 text-sm text-gray-600">
                                        <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center text-gray-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs text-gray-400 uppercase">Ekspedisi</p>
                                            <p class="font-semibold text-gray-800">{{ $item->ekspedisi ?? 'Tanpa Ekspedisi' }}</p>
                                        </div>
                                    </div>

                                    <div class="bg-gray-50 rounded-xl p-3 border border-gray-100">
                                        <p class="text-xs text-gray-400 uppercase mb-1">Nomor Resi</p>
                                        <div class="flex items-center justify-between">
                                            <span class="font-mono font-medium text-gray-700 truncate select-all">
                                                {{ $item->no_resi ?? 'Belum tersedia' }}
                                            </span>
                                            @if($item->no_resi)
                                                <button onclick="copyToClipboard('{{ $item->no_resi }}')" class="text-gray-400 hover:text-emerald-600 transition-colors" title="Salin Resi">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 mt-2 pt-0">
                                <a href="https://cekresi.com/?noresi={{ $item->no_resi }}" target="_blank"
                                   class="flex items-center justify-center w-full px-4 py-3 rounded-xl text-sm font-bold transition-all duration-200 gap-2
                                   {{ $item->no_resi
                                        ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100 hover:text-emerald-800 border border-emerald-100'
                                        : 'bg-gray-50 text-gray-400 cursor-not-allowed' }}">
                                    @if($item->no_resi)
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        Cek Resi
                                    @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Menunggu Resi
                                    @endif
                                </a>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- Script untuk Copy Resi --}}
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                // Bisa tambahkan toast notifikasi disini jika mau
                alert("Resi disalin: " + text);
            }).catch(err => {
                console.error('Gagal menyalin: ', err);
            });
        }
    </script>

    <style>
        .animate-fade-in-down { animation: fadeInDown 0.6s ease-out; }
        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out; }
        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
@endsection
