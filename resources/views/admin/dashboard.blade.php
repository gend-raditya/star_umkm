@extends('layouts.app')

@section('content')
    <div class="min-h-screen py-4 px-4 sm:px-6 lg:px-8 font-sans mt-16">
        <div class="max-w-5xl mx-auto">

            <div class="flex items-center justify-between mb-10 animate-fade-in-down">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Dashboard Admin</h1>
                    <p class="mt-2 text-gray-500 text-lg">Selamat datang kembali, Administrator! 👋</p>
                </div>
                <div class="hidden sm:block">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-white border border-gray-200 shadow-sm text-gray-600">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                        Sistem Online
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 animate-fade-in-up delay-100">

                <a href="{{ route('admin.produk.index') }}"
                   class="group relative overflow-hidden bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl border border-indigo-100 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="absolute right-0 top-0 h-24 w-24 bg-indigo-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10 flex items-center gap-4">
                        <div class="p-4 bg-indigo-100 text-indigo-600 rounded-xl group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 group-hover:text-indigo-600 transition-colors">Produk</h3>
                            <p class="text-sm text-gray-500 mt-1">Kelola katalog produk</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.kategori.index') }}"
                   class="group relative overflow-hidden bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl border border-emerald-100 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="absolute right-0 top-0 h-24 w-24 bg-emerald-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10 flex items-center gap-4">
                        <div class="p-4 bg-emerald-100 text-emerald-600 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 group-hover:text-emerald-600 transition-colors">Kategori</h3>
                            <p class="text-sm text-gray-500 mt-1">Atur kategori & label</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.pesanan.index') }}"
                   class="group relative overflow-hidden bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl border border-amber-100 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="absolute right-0 top-0 h-24 w-24 bg-amber-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10 flex items-center gap-4">
                        <div class="p-4 bg-amber-100 text-amber-600 rounded-xl group-hover:bg-amber-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 group-hover:text-amber-600 transition-colors">Pesanan</h3>
                            <p class="text-sm text-gray-500 mt-1">Pantau pesanan masuk</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.sellers.index') }}"
                   class="group relative overflow-hidden bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl border border-purple-100 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="absolute right-0 top-0 h-24 w-24 bg-purple-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10 flex items-center gap-4">
                        <div class="p-4 bg-purple-100 text-purple-600 rounded-xl group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 group-hover:text-purple-600 transition-colors">Akun Seller</h3>
                            <p class="text-sm text-gray-500 mt-1">Verifikasi pendaftaran</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.sellers.approved') }}"
                   class="group relative overflow-hidden bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl border border-blue-100 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="absolute right-0 top-0 h-24 w-24 bg-blue-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10 flex items-center gap-4">
                        <div class="p-4 bg-blue-100 text-blue-600 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors">Seller Aktif</h3>
                            <p class="text-sm text-gray-500 mt-1">List mitra terdaftar</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.transaksi.index') }}"
                   class="group relative overflow-hidden bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl border border-red-100 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="absolute right-0 top-0 h-24 w-24 bg-red-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10 flex items-center gap-4">
                        <div class="p-4 bg-red-100 text-red-600 rounded-xl group-hover:bg-red-600 group-hover:text-white transition-colors duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 group-hover:text-red-600 transition-colors">Transaksi</h3>
                            <p class="text-sm text-gray-500 mt-1">Laporan keuangan</p>
                        </div>
                    </div>
                </a>

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
