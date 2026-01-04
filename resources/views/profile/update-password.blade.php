@extends('layouts.app')

@section('content')
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute top-[10%] left-[20%] w-[30%] h-[30%] rounded-full bg-emerald-400/20 blur-3xl animate-pulse"></div>
        <div class="absolute bottom-[20%] right-[10%] w-[40%] h-[40%] rounded-full bg-teal-400/20 blur-3xl animate-pulse delay-1000"></div>
    </div>

    <div class="py-12 flex items-center justify-center min-h-[80vh]">
        <div class="max-w-2xl w-full mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white/80 dark:bg-teal-800/60 backdrop-blur-xl border border-white/20 shadow-2xl rounded-3xl overflow-hidden relative animate-fade-in-up">

                <div class="h-2 bg-gradient-to-r from-emerald-400 to-teal-500 w-full"></div>

                <div class="p-8 md:p-10">

                    <div class="text-center mb-10">
                        <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-inner">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">
                            {{ __('Update Password') }}
                        </h2>
                        <p class="text-white-500 dark:text-white-400 text-sm max-w-md mx-auto">
                            {{ __('Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.') }}
                        </p>
                    </div>

                    @if (session('status') === 'password-updated')
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform scale-90"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-90"
                             class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-center justify-center shadow-sm">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span class="font-medium">{{ __('Password berhasil disimpan.') }}</span>
                        </div>
                    @endif

                    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                        @csrf
                        @method('put')

                        <div class="group">
                            <label for="current_password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 ml-1">
                                {{ __('Password Saat Ini') }}
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                                </div>
                                <input id="current_password" name="current_password" type="password" autocomplete="current-password"
                                    class="pl-11 block w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 transition-all duration-300 py-3.5 text-gray-700 dark:bg-gray-900/50 dark:border-gray-700 dark:text-gray-300"
                                    placeholder="Masukkan password lama">
                            </div>
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>

                        <div class="group">
                            <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 ml-1">
                                {{ __('Password Baru') }}
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </div>
                                <input id="password" name="password" type="password" autocomplete="new-password"
                                    class="pl-11 block w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 transition-all duration-300 py-3.5 text-gray-700 dark:bg-gray-900/50 dark:border-gray-700 dark:text-gray-300"
                                    placeholder="Minimal 8 karakter">
                            </div>
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>

                        <div class="group">
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 ml-1">
                                {{ __('Konfirmasi Password') }}
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                                    class="pl-11 block w-full rounded-xl border-gray-200 bg-gray-50/50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 transition-all duration-300 py-3.5 text-gray-700 dark:bg-gray-900/50 dark:border-gray-700 dark:text-gray-300"
                                    placeholder="Ulangi password baru">
                            </div>
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="pt-4">
                            <button type="submit"
                                class="w-full inline-flex justify-center items-center px-6 py-4 bg-gradient-to-r from-emerald-500 to-teal-500 border border-transparent rounded-xl font-bold text-white tracking-widest hover:from-emerald-600 hover:to-teal-600 active:scale-95 focus:outline-none focus:ring-4 focus:ring-emerald-500/30 transition-all duration-200 shadow-lg hover:shadow-emerald-500/30">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                {{ __('Simpan Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
