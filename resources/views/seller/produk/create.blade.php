@extends('layouts.app')

@section('content')
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-2xl mx-auto mb-8">

            <div class="mb-10 animate-fade-in-down">
                <a href="{{ route('seller.dashboard') }}" class="text-sm font-medium text-gray-500 hover:text-emerald-600 flex items-center gap-1 transition-colors mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Dashboard
                </a>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Tambah Produk Baru</h1>
                <p class="mt-2 text-gray-500">Lengkapi informasi produk Anda untuk mulai berjualan.</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden animate-fade-in-up">

                {{-- Error Alert --}}
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 m-6 mb-0 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada input Anda</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('seller.produk.store') }}" enctype="multipart/form-data" class="p-8 space-y-8">
                    @csrf

                    <div class="space-y-6">
                        <div class="border-b border-gray-100 pb-2">
                            <h3 class="text-lg font-bold text-gray-800">Informasi Produk</h3>
                        </div>

                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Produk</label>
                            <input type="text" name="nama" value="{{ old('nama') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200 outline-none placeholder-gray-400"
                                placeholder="Contoh: Keripik Singkong Balado" required>
                            @error('nama') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Harga (Rp)</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 font-bold">Rp</span>
                                    <input type="number" name="harga" value="{{ old('harga') }}"
                                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200 outline-none placeholder-gray-400"
                                        placeholder="0" required>
                                </div>
                                @error('harga') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                                <div class="relative">
                                    <select name="kategori_id" class="appearance-none w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200 outline-none cursor-pointer text-gray-700" required>
                                        <option value="" disabled selected>-- Pilih Kategori --</option>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                                {{ $k->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                                @error('kategori_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Produk</label>
                            <textarea name="deskripsi" rows="4"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200 outline-none placeholder-gray-400 resize-none"
                                placeholder="Jelaskan detail produk, bahan, ukuran, dll...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="border-b border-gray-100 pb-2">
                            <h3 class="text-lg font-bold text-gray-800">Media Produk</h3>
                        </div>

                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Produk</label>

                            <div class="relative border-2 border-dashed border-gray-300 rounded-2xl p-8 hover:border-emerald-500 hover:bg-emerald-50/30 transition-all duration-300 group-hover:border-emerald-400 text-center cursor-pointer">
                                <input type="file" name="foto[]" multiple accept="image/*"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                    onchange="showFileCount(this)">

                                <div class="space-y-2 pointer-events-none">
                                    <div class="mx-auto h-12 w-12 text-gray-400 group-hover:text-emerald-500 transition-colors">
                                        <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12z"></path></svg>
                                    </div>
                                    <p class="text-sm text-gray-600 font-medium" id="file-label">
                                        Klik atau seret foto ke sini untuk upload
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        Format: JPG, PNG (Max 2MB per foto)
                                    </p>
                                </div>
                            </div>
                            @error('foto.*') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex items-center justify-end gap-4">
                        <a href="{{ route('seller.dashboard') }}" class="px-6 py-3 mb-6 rounded-xl text-sm font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-colors">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-8 py-3 rounded-xl text-sm mb-6 font-bold text-white bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 shadow-lg hover:shadow-emerald-500/30 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Simpan Produk
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- Simple Script for File Upload Interaction --}}
    <script>
        function showFileCount(input) {
            const label = document.getElementById('file-label');
            if (input.files && input.files.length > 0) {
                label.textContent = `${input.files.length} foto dipilih`;
                label.classList.add('text-emerald-600', 'font-bold');
            } else {
                label.textContent = 'Klik atau seret foto ke sini untuk upload';
                label.classList.remove('text-emerald-600', 'font-bold');
            }
        }
    </script>

    <style>
        .animate-fade-in-down { animation: fadeInDown 0.6s ease-out; }
        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out; }
        @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
@endsection
