@extends('layouts.app')

@section('content')
<div class="min-h-screen py-4 px-4 sm:px-6 lg:px-8 font-sans mt-6 mb-12 text-gray-800">
    <div class="max-w-3xl mx-auto">

        <div class="flex items-center justify-between mb-8 animate-fade-in-down">
            <div>
                <a href="{{ route('admin.transaksi.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 flex items-center gap-1 transition-colors group">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar
                </a>
                <h1 class="text-3xl font-extrabold text-gray-900 mt-2 tracking-tight">Detail Transaksi</h1>
            </div>
            <div class="text-right">
                <span class="text-xs text-gray-400 font-bold uppercase tracking-widest">Status Pesanan</span>
                <div class="mt-1">
                    @php
                        $statusColors = match(strtolower($pesanan->status)) {
                            'selesai' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                            'dibatalkan' => 'bg-red-100 text-red-800 border-red-200',
                            default => 'bg-blue-100 text-blue-800 border-blue-200'
                        };
                    @endphp
                    <span class="px-4 py-1.5 rounded-full text-sm font-bold border {{ $statusColors }}">
                        {{ ucfirst($pesanan->status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 animate-fade-in-up delay-100">

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 grid md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Nomor Invoice</span>
                            <span class="text-xl font-mono font-bold text-indigo-600">{{ $pesanan->invoice }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Nama Pelanggan</span>
                            <span class="text-lg font-semibold">{{ $pesanan->user->name ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Waktu Transaksi</span>
                            <span class="text-lg font-semibold">{{ $pesanan->created_at->format('d F Y, H:i') }} WIB</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Pembayaran</span>
                            <span class="text-2xl font-black text-gray-900 leading-none mt-1">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50/50 border-t border-gray-100 p-8">
                    <h2 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        Informasi Pembayaran
                    </h2>

                    {{-- Kita langsung cek kolom metode_pembayaran di tabel pesanans --}}
                    @if($pesanan->metode_pembayaran)
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-gray-400 uppercase">Metode</span>
                            <span class="font-bold text-gray-700">{{ $pesanan->metode_pembayaran }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-gray-400 uppercase">Status Bayar</span>
                            {{-- Jika status pesanan 'Selesai' atau 'Diproses', asumsikan sudah bayar --}}
                            <span class="font-bold text-emerald-600">
                                {{ $pesanan->status === 'Batal' ? 'Gagal' : 'Berhasil (Settlement)' }}
                            </span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-gray-400 uppercase">Jumlah Terbayar</span>
                            <span class="font-bold text-gray-700">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    @else
                    <div class="p-4 bg-amber-50 rounded-xl border border-amber-100 text-amber-700 flex items-center gap-2 text-sm font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Metode pembayaran belum ditentukan.
                    </div>
                    @endif
                </div>

                <div class="p-8">
                    <h2 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Rincian Produk
                    </h2>
                    <ul class="space-y-3">
                        @foreach ($pesanan->items as $item)
                        <li class="flex items-center justify-between p-4 rounded-2xl bg-white border border-gray-100 shadow-sm hover:border-indigo-200 transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center font-bold text-indigo-600">
                                    {{ $item->jumlah }}x
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-bold text-gray-900">{{ $item->produk->nama }}</span>
                                    <span class="text-xs text-gray-500 font-medium">Harga Satuan: Rp {{ number_format($item->subtotal / $item->jumlah, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <span class="font-black text-gray-900 tracking-tight">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </li>
                        @endforeach
                    </ul>
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
