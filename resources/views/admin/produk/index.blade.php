@extends('layouts.app')

@section('content')
    <div class="min-h-screen py-4 px-4 sm:px-6 lg:px-8 font-sans mt-16">
        <div class="max-w-5xl mx-auto">

            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 animate-fade-in-down gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Kelola Produk</h1>
                    <p class="mt-1 text-gray-500">Daftar semua produk yang terdaftar di platform.</p>
                </div>

                <div class="flex items-center gap-3">
                    <span class="px-4 py-2 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-600 shadow-sm">
                        Total: <strong class="text-indigo-600">{{ $produk->count() }}</strong> Produk
                    </span>
                </div>
            </div>

            {{-- 🔔 Notifikasi Sukses --}}
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                     class="fixed top-24 right-5 z-50 flex items-center w-full max-w-sm p-4 text-emerald-800 bg-emerald-50 rounded-xl shadow-lg border border-emerald-100 animate-fade-in-up">
                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-emerald-500 bg-emerald-100 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div class="ml-3 text-sm font-semibold">{{ session('success') }}</div>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-fade-in-up delay-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100 text-xs uppercase tracking-wider text-gray-500 font-semibold">
                                <th class="px-6 py-4">Produk</th>
                                <th class="px-6 py-4">Penjual (Seller)</th>
                                <th class="px-6 py-4">Harga</th>
                                <th class="px-6 py-4 text-center">Stok</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($produk as $p)
                                <tr class="group hover:bg-gray-50 transition-colors duration-200">

                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="h-14 w-14 rounded-xl bg-gray-100 border border-gray-200 overflow-hidden flex-shrink-0 relative">
                                                @if($p->fotos->count() > 0)
                                                    <img src="{{ asset('storage/' . $p->fotos->first()->path) }}" class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-500">
                                                @else
                                                    <div class="flex h-full w-full items-center justify-center text-gray-400">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12z"></path></svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-900 text-sm line-clamp-1">{{ $p->nama }}</p>
                                                @if($p->fotos->count() > 1)
                                                    <span class="text-[10px] text-gray-500 bg-gray-100 px-1.5 py-0.5 rounded border border-gray-200">+{{ $p->fotos->count() - 1 }} foto lain</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-bold border border-indigo-200">
                                                {{ substr($p->user->name ?? '?', 0, 1) }}
                                            </div>
                                            <span class="text-sm font-medium text-gray-700">{{ $p->user->name ?? 'Tidak Ada' }}</span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="text-sm font-bold text-emerald-600">Rp {{ number_format($p->harga, 0, ',', '.') }}</span>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $p->stok > 0 ? 'bg-blue-50 text-blue-700 border border-blue-100' : 'bg-red-50 text-red-700 border border-red-100' }}">
                                            {{ $p->stok }} Unit
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('admin.produk.destroy', $p->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.')"
                                                class="group/btn relative p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200" title="Hapus Produk">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($produk->isEmpty())
                    <div class="p-12 text-center">
                        <div class="inline-block p-4 rounded-full bg-gray-50 mb-4">
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Belum ada produk</h3>
                        <p class="text-gray-500 mt-1">Daftar produk akan muncul di sini setelah seller menambahkannya.</p>
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
