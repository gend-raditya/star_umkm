@extends('layouts.app')

@section('content')
    <div class="min-h-screen py-4 px-4 sm:px-6 lg:px-8 font-sans mt-8">
        <div class="max-w-4xl mx-auto">

            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 animate-fade-in-down gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Persetujuan Seller</h1>
                    <p class="mt-1 text-gray-500">Tinjau dan kelola pengajuan pendaftaran seller baru.</p>
                </div>

                <div class="flex items-center gap-3">
                    <span class="px-4 py-2 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-600 shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pending: <strong class="text-gray-900 ml-1">{{ $sellers->where('user.seller_status', 'pending')->count() }}</strong>
                    </span>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-in-up delay-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100 text-xs uppercase tracking-wider text-gray-500 font-semibold">
                                <th class="px-6 py-4">Seller</th>
                                <th class="px-6 py-4">Kontak</th>
                                <th class="px-6 py-4 text-center">Status Saat Ini</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($sellers as $seller)
                                <tr class="group hover:bg-gray-50 transition-colors duration-200">

                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="h-10 w-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-sm font-bold border border-purple-200">
                                                {{ substr($seller->nama_seller, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-900 text-sm">{{ $seller->nama_seller }}</p>
                                                <p class="text-xs text-gray-500">ID: #{{ $seller->id }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="text-sm">
                                            <div class="flex items-center gap-2 text-gray-700 mb-1">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                {{ optional($seller->user)->email }}
                                            </div>
                                            <div class="flex items-center gap-2 text-gray-500">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                                {{ $seller->nomor_hp }}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        @php
                                            $status = optional($seller->user)->seller_status;
                                            $badgeClass = match($status) {
                                                'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                                'rejected' => 'bg-red-50 text-red-700 border-red-100',
                                                default => 'bg-amber-50 text-amber-700 border-amber-100'
                                            };
                                            $statusLabel = match($status) {
                                                'approved' => 'Disetujui',
                                                'rejected' => 'Ditolak',
                                                default => 'Menunggu'
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $badgeClass }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">

                                            {{-- Tombol Setujui --}}
                                            <form action="{{ route('admin.sellers.approve', $seller->user->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menyetujui seller ini?')"
                                                    class="inline-flex items-center justify-center p-2 rounded-lg text-emerald-600 bg-emerald-50 hover:bg-emerald-100 border border-transparent hover:border-emerald-200 transition-all duration-200"
                                                    title="{{ optional($seller->user)->seller_status == 'rejected' ? 'Pulihkan Akun' : 'Setujui' }}">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                </button>
                                            </form>

                                            {{-- Tombol Tolak --}}
                                            @if(optional($seller->user)->seller_status !== 'rejected')
                                                <form action="{{ route('admin.sellers.reject', $seller->user->id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menolak pengajuan ini?')"
                                                        class="inline-flex items-center justify-center p-2 rounded-lg text-red-600 bg-red-50 hover:bg-red-100 border border-transparent hover:border-red-200 transition-all duration-200"
                                                        title="Tolak">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    </button>
                                                </form>
                                            @endif

                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="inline-block p-4 rounded-full bg-gray-50 mb-4">
                                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900">Tidak ada pengajuan</h3>
                                        <p class="text-gray-500 mt-1">Saat ini belum ada permintaan pendaftaran seller baru.</p>
                                    </td>
                                </tr>
                            @endforelse
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
