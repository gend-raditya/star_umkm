@extends('layouts.app')

@section('content')
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] rounded-full bg-emerald-400/20 blur-3xl animate-pulse"></div>
        <div class="absolute top-[20%] -right-[10%] w-[30%] h-[30%] rounded-full bg-teal-400/20 blur-3xl animate-pulse delay-1000"></div>
    </div>

    <div class="py-12 relative">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header Section --}}
            <div class="mb-8 animate-fade-in-down">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-700">
                    Pengaturan Profil
                </h2>
                <p class="text-gray-500 dark:text-gray-600 mt-1">Kelola informasi pribadi dan keamanan akun Anda.</p>
            </div>

            {{-- Notifications --}}
            @if (session('status') === 'profile-updated' || session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0" x-init="setTimeout(() => show = false, 4000)"
                    class="mb-6 bg-emerald-100/90 backdrop-blur border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-r shadow-md flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <div>
                        <span class="font-bold">Berhasil!</span> {{ session('success') ?? 'Profil berhasil diperbarui.' }}
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- LEFT COLUMN: Profile Card & Actions --}}
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white/80 dark:bg-[#7FA9B0]/80 backdrop-blur-xl border border-white/20 shadow-xl rounded-3xl p-8 text-center relative overflow-hidden group">
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-teal-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        <div class="relative inline-block mb-4">
                            @if ($user->foto)
                                <img src="{{ asset('storage/' . $user->foto) }}" alt="Avatar"
                                     class="w-32 h-32 rounded-full object-cover border-4 border-white dark:border-gray-700 shadow-lg transform transition duration-500 group-hover:scale-105">
                            @else
                                <div class="w-32 h-32 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-white text-4xl font-bold border-4 border-white shadow-lg">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                            <div class="absolute bottom-2 right-2 bg-emerald-500 text-white p-2 rounded-full shadow-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </div>
                        </div>

                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-1">{{ $user->name }}</h3>
                        <p class="text-sm text-emerald-800 font-medium mb-6">{{ $user->email }}</p>

                        <div class="border-t border-gray-100 dark:border-gray-700 pt-6">
                            <a href="{{ route('profile.password') }}"
                               class="flex items-center justify-center w-full px-4 py-3 bg-white border-2 border-gray-100 text-gray-700 rounded-xl hover:border-emerald-500 hover:text-emerald-600 transition-all duration-300 font-semibold group">
                                <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Update Password
                            </a>
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN: Edit Form --}}
                <div class="lg:col-span-2">
                    <div class="bg-white/80 dark:bg-[#7FA9B0]/80 backdrop-blur-xl border border-white/20 shadow-xl rounded-3xl p-8">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Edit Informasi
                        </h3>

                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            @method('PATCH')

                            <div class="group">
                                <x-input-label for="name" :value="__('Nama Lengkap')" class="text-gray-900 font-semibold ml-1 mb-2" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-500 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                                        class="pl-10 block w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 transition-all duration-300 py-3 text-gray-700" placeholder="Nama Lengkap Anda">
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="group">
                                <x-input-label for="email" :value="__('Email Address')" class="text-gray-600 font-semibold ml-1 mb-2" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                                        class="pl-10 block w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 transition-all duration-300 py-3 text-gray-700" placeholder="email@contoh.com">
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="group">
                                <x-input-label for="no_waSeller" :value="__('Nomor WhatsApp')" class="text-gray-600 font-semibold ml-1 mb-2" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </div>
                                    <input id="no_waSeller" name="no_waSeller" type="text" value="{{ old('no_waSeller', $user->no_waSeller) }}"
                                        class="pl-10 block w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 transition-all duration-300 py-3 text-gray-700" placeholder="Contoh: 62812345678">
                                </div>
                                <p class="text-xs text-gray-500 mt-1 ml-1 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Gunakan format 62 (contoh: 628123...)
                                </p>
                                <x-input-error class="mt-2" :messages="$errors->get('no_waSeller')" />
                            </div>

                            <div class="group">
                                <x-input-label for="foto" :value="__('Ganti Foto Profil')" class="text-gray-600 font-semibold ml-1 mb-2" />
                                <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-4 hover:border-emerald-500 transition-colors bg-gray-50/50">
                                    <input id="foto" name="foto" type="file" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="previewImage(event)">
                                    <div class="flex flex-col items-center justify-center space-y-2 text-center" id="upload-placeholder">
                                        <div class="p-3 bg-emerald-100 text-emerald-600 rounded-full">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                        </div>
                                        <p class="text-sm text-gray-600 font-medium">Klik untuk upload atau drag & drop</p>
                                        <p class="text-xs text-gray-400">PNG, JPG, JPEG (Max. 2MB)</p>
                                    </div>
                                    <div id="image-preview" class="hidden flex items-center gap-4">
                                        <img id="preview-img" src="#" alt="Preview" class="w-16 h-16 rounded-full object-cover border-2 border-emerald-500">
                                        <span id="file-name" class="text-sm text-gray-600 truncate"></span>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                            </div>

                            <div class="pt-4">
                                <button type="submit"
                                    class="w-full inline-flex justify-center items-center px-6 py-4 bg-gradient-to-r from-emerald-500 to-teal-500 border border-transparent rounded-xl font-bold text-white tracking-widest hover:from-emerald-600 hover:to-teal-600 active:scale-95 focus:outline-none focus:ring-4 focus:ring-emerald-500/30 transition-all duration-200 shadow-lg hover:shadow-emerald-500/30">
                                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                    {{ __('Simpan Perubahan') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk Preview Image --}}
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const placeholder = document.getElementById('upload-placeholder');
            const preview = document.getElementById('image-preview');
            const previewImg = document.getElementById('preview-img');
            const fileName = document.getElementById('file-name');
            const file = event.target.files[0];

            reader.onload = function(){
                previewImg.src = reader.result;
                placeholder.classList.add('hidden');
                preview.classList.remove('hidden');
                fileName.textContent = file.name;
            }

            if(file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

    <style>
        .animate-fade-in-down {
            animation: fadeInDown 0.8s ease-out;
        }
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
