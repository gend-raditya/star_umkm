@extends('layouts.app')

@section('content')
    <div class="min-h-screen py-4 px-4 sm:px-6 lg:px-8 font-sans mt-12">
        <div class="max-w-5xl mx-auto">

            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 animate-fade-in-down gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Seller Aktif</h1>
                    <p class="mt-1 text-gray-500">Daftar mitra seller yang telah terverifikasi dan aktif berjualan.</p>
                </div>

                <div class="flex items-center gap-3">
                    <span class="px-4 py-2 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-600 shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Total: <strong class="text-gray-900 ml-1">{{ $sellers->count() }}</strong>
                    </span>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-in-up delay-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100 text-xs uppercase tracking-wider text-gray-500 font-semibold">
                                <th class="px-6 py-4">Nama Seller</th>
                                <th class="px-6 py-4">Kontak</th>
                                <th class="px-6 py-4">Rekening</th>
                                <th class="px-6 py-4 text-right">Bergabung Sejak</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($sellers as $seller)
                                <tr class="group hover:bg-gray-50 transition-colors duration-200">

                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-sm font-bold border border-blue-200">
                                                {{ substr($seller->nama_seller, 0, 1) }}
                                            </div>
                                            <span class="font-bold text-gray-900 text-sm">{{ $seller->nama_seller }}</span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="text-sm space-y-1">
                                            <div class="flex items-center gap-2 text-gray-700">
                                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                {{ $seller->user->email }}
                                            </div>
                                            <div class="flex items-center gap-2 text-gray-500">
                                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                                {{ $seller->nomor_hp }}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="text-sm font-mono text-gray-600 bg-gray-50 px-3 py-1 rounded border border-gray-200 w-fit">
                                            {{ $seller->nomor_rekening }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        <span class="text-sm font-medium text-gray-500">
                                            {{ $seller->created_at->format('d M Y') }}
                                        </span>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
