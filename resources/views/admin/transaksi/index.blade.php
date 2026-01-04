@extends('layouts.app')

@section('content')
<div class="min-h-screen py-4 px-4 sm:px-6 lg:px-8 font-sans mt-10 mb-12">
    <div class="max-w-4xl mx-auto">

        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 animate-fade-in-down gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight flex items-center gap-3">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Daftar Transaksi
                </h1>
                <p class="mt-1 text-gray-500">Pantau seluruh arus masuk pembayaran dan status pesanan.</p>
            </div>
            <div class="flex gap-3">
                <span class="px-4 py-2 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-600 shadow-sm">
                    Total: <strong class="text-indigo-600">{{ $transaksi->count() }}</strong> Transaksi
                </span>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-in-up delay-100">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100 text-xs uppercase tracking-wider text-gray-500 font-semibold">
                            <th class="px-6 py-4">Invoice</th>
                            <th class="px-6 py-4">Pelanggan</th>
                            <th class="px-6 py-4 text-right">Total Tagihan</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4 text-right rounded-tr-lg">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach($transaksi as $t)
                        <tr class="group hover:bg-indigo-50/30 transition-colors duration-200">
                            <td class="px-6 py-4 font-mono font-medium text-indigo-600">
                                {{ $t->invoice }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $t->user->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-gray-900">
                                Rp {{ number_format($t->total, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $statusClasses = match(strtolower($t->status)) {
                                        'selesai' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                        'dikirim' => 'bg-blue-50 text-blue-700 border-blue-100',
                                        'diproses' => 'bg-amber-50 text-amber-700 border-amber-100',
                                        'dibatalkan' => 'bg-red-50 text-red-700 border-red-100',
                                        default => 'bg-gray-50 text-gray-600 border-gray-100'
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $statusClasses }}">
                                    {{ ucfirst($t->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500">
                                {{ $t->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.transaksi.show', $t->id) }}"
                                   class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg hover:bg-indigo-600 hover:text-white hover:border-indigo-600 transition-all duration-200 shadow-sm font-semibold text-xs group/btn">
                                   Detail
                                   <svg class="ml-2 w-3 h-3 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($transaksi->isEmpty())
            <div class="p-16 text-center">
                <p class="text-gray-400">Belum ada transaksi yang tercatat.</p>
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
