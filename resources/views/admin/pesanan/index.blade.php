@extends('layouts.app')

@section('content')
    <div class="min-h-screen py-4 px-4 sm:px-6 lg:px-8 font-sans mt-8">
        <div class="max-w-4xl mx-auto mb-12">

            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 animate-fade-in-down gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Kelola Pesanan</h1>
                    <p class="mt-1 text-gray-500">Pantau dan kelola semua transaksi pesanan masuk.</p>
                </div>

                <div class="flex items-center gap-3">
                    <span class="px-4 py-2 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-600 shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Total: <strong class="text-gray-900 ml-1">{{ $pesanans->count() }}</strong>
                    </span>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-in-up delay-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100 text-xs uppercase tracking-wider text-gray-500 font-semibold">
                                <th class="px-6 py-4 w-20 text-center">ID</th>
                                <th class="px-6 py-4">Pelanggan</th>
                                <th class="px-6 py-4">Total Pembayaran</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($pesanans as $pesanan)
                                <tr class="group hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 text-center text-gray-400 font-mono text-sm">
                                        #{{ $pesanan->id }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-9 w-9 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-sm border border-indigo-100">
                                                {{ substr($pesanan->nama, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-800 text-sm">{{ $pesanan->nama }}</p>
                                                <p class="text-xs text-gray-400">{{ $pesanan->created_at->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="text-sm font-bold text-gray-900">Rp {{ number_format($pesanan->total, 0, ',', '.') }}</span>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        @php
                                            $statusClasses = match(strtolower($pesanan->status)) {
                                                'selesai' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                                'dikirim' => 'bg-blue-50 text-blue-700 border-blue-100',
                                                'diproses' => 'bg-amber-50 text-amber-700 border-amber-100',
                                                'dibatalkan' => 'bg-red-50 text-red-700 border-red-100',
                                                default => 'bg-gray-50 text-gray-700 border-gray-100'
                                            };

                                            $statusLabel = ucfirst($pesanan->status);
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $statusClasses }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('admin.pesanan.show', $pesanan->id) }}"
                                           class="inline-flex items-center justify-center px-3 py-1.5 border border-indigo-200 rounded-lg text-xs font-medium text-indigo-600 bg-indigo-50 hover:bg-indigo-100 hover:border-indigo-300 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Lihat Detail
                                            <svg class="ml-1.5 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($pesanans->isEmpty())
                    <div class="p-12 text-center">
                        <div class="inline-block p-4 rounded-full bg-gray-50 mb-4">
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Belum ada pesanan</h3>
                        <p class="text-gray-500 mt-1">Daftar transaksi akan muncul di sini.</p>
                    </div>
                @endif
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
