@extends('layouts.app')

@section('content')
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-4xl mx-auto">

            <div class="flex items-center justify-between mb-8 animate-fade-in-down">
                <div>
                    <a href="{{ route('seller.dashboard') }}" class="text-sm font-medium text-gray-500 hover:text-emerald-600 flex items-center gap-1 transition-colors mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Dashboard
                    </a>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Edit Produk</h1>
                </div>
                <div class="text-right hidden sm:block">
                    <p class="text-sm text-gray-500">Terakhir diupdate</p>
                    <p class="text-sm font-semibold text-gray-800">{{ $produk->updated_at->format('d M Y') }}</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl shadow-sm animate-fade-in-up">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Gagal menyimpan perubahan</h3>
                            <ul class="mt-1 list-disc list-inside text-sm text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('seller.produk.update', $produk->id) }}" enctype="multipart/form-data" class="animate-fade-in-up delay-100">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <div class="lg:col-span-1 space-y-6">
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                            <label class="block text-sm font-bold text-gray-700 mb-4">Foto Produk Saat Ini</label>

                            <div class="relative group rounded-xl overflow-hidden border-2 border-gray-100 bg-gray-50 aspect-square flex items-center justify-center">
                                @if ($produk->foto)
                                    <img src="{{ asset('storage/' . $produk->foto) }}"
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                         id="current-image-preview">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <span class="text-white text-sm font-medium">Foto Aktif</span>
                                    </div>
                                @else
                                    <div class="text-center p-4">
                                        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12z"></path></svg>
                                        <p class="mt-1 text-xs text-gray-500">Tidak ada foto</p>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-6">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Upload Foto Baru</label>
                                <div class="relative">
                                    <input type="file" name="foto" id="foto-input" accept="image/*" class="hidden" onchange="previewNewImage(this)">
                                    <label for="foto-input"
                                        class="flex items-center justify-center w-full px-4 py-3 border-2 border-dashed border-emerald-300 rounded-xl cursor-pointer hover:bg-emerald-50 hover:border-emerald-500 transition-all duration-300 group">
                                        <svg class="w-5 h-5 text-emerald-500 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                        <span class="text-sm font-medium text-emerald-600 group-hover:text-emerald-700">Pilih File Baru</span>
                                    </label>
                                    <p class="mt-2 text-xs text-center text-gray-400" id="file-name-display">JPG, PNG (Max 2MB)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 space-y-6">

                            <div class="border-b border-gray-100 pb-4 mb-4">
                                <h3 class="text-lg font-bold text-gray-800">Informasi Produk</h3>
                                <p class="text-sm text-gray-500">Perbarui detail produk Anda di bawah ini.</p>
                            </div>

                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Produk</label>
                                <input type="text" name="nama" value="{{ $produk->nama }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200 outline-none text-gray-800 placeholder-gray-400" required>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Harga</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 font-bold">Rp</span>
                                        <input type="number" name="harga" value="{{ $produk->harga }}"
                                            class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200 outline-none text-gray-800" required>
                                    </div>
                                </div>

                                <div class="group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                                    <div class="relative">
                                        <select name="kategori_id" class="appearance-none w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200 outline-none cursor-pointer text-gray-800" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->id }}" {{ $produk->kategori_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Produk</label>
                                <textarea name="deskripsi" rows="6"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition-all duration-200 outline-none text-gray-800 resize-none">{{ $produk->deskripsi }}</textarea>
                            </div>

                            <div class="pt-6 border-t border-gray-100 flex items-center justify-end gap-4">
                                <a href="{{ route('seller.dashboard') }}" class="px-6 py-3 rounded-xl text-sm font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-colors">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="px-8 py-3 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 shadow-lg hover:shadow-emerald-500/30 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Simpan Perubahan
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Script Preview Nama File --}}
    <script>
        function previewNewImage(input) {
            const fileNameDisplay = document.getElementById('file-name-display');
            if (input.files && input.files[0]) {
                const file = input.files[0];
                fileNameDisplay.textContent = 'File terpilih: ' + file.name;
                fileNameDisplay.classList.add('text-emerald-600', 'font-medium');

                // Optional: Preview image update (Visual feedback)
                // Note: Ini hanya preview sisi client, tidak mengubah file asli sebelum submit
                const reader = new FileReader();
                reader.onload = function(e) {
                    const currentImg = document.getElementById('current-image-preview');
                    if(currentImg) currentImg.src = e.target.result;
                }
                reader.readAsDataURL(file);
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
