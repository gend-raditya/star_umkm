@extends('layouts.app')

@section('content')
    <div class="min-h-screen py-4 px-4 sm:px-6 lg:px-8 font-sans mt-16">
        <div class="max-w-2xl mx-auto">

            <div class="mb-8 animate-fade-in-down">
                <a href="{{ route('admin.kategori.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-amber-600 transition-colors mb-3 group">
                    <svg class="w-4 h-4 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Kembali ke Daftar Kategori
                </a>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Edit Kategori</h1>
                <p class="mt-2 text-gray-500">Perbarui nama kategori produk.</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden animate-fade-in-up delay-100">
                <div class="p-8">

                    <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="group">
                            <label for="nama" class="block text-sm font-bold text-gray-700 mb-2">Nama Kategori</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    {{-- Ikon Tag --}}
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-amber-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                </div>
                                <input type="text" name="nama" id="nama"
                                    value="{{ $kategori->nama }}"
                                    class="block w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all duration-200"
                                    required autocomplete="off">
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-100 flex items-center justify-end gap-4">
                            <a href="{{ route('admin.kategori.index') }}" class="px-6 py-3 rounded-xl text-sm font-bold text-gray-600 bg-gray-50 hover:bg-gray-100 transition-colors">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 shadow-lg hover:shadow-amber-500/30 transform hover:-translate-y-0.5 transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Update Kategori
                            </button>
                        </div>

                    </form>
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
