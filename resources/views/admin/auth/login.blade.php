@extends('layouts.app')

@section('content')
    <div class="min-h-[115vh] flex items-center justify-center px-4 sm:px-6 lg:px-8 relative overflow-hidden">

        <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-emerald-300/30 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
        <div class="absolute top-1/3 right-1/4 w-72 h-72 bg-teal-300/30 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-1/2 w-72 h-72 bg-indigo-300/30 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-4000"></div>

        <div class="max-w-md w-full space-y-8 bg-white/60 backdrop-blur-2xl p-10 rounded-3xl shadow-2xl border border-white/50 relative z-10 animate-fade-in-up">

            <div class="text-center">
                <div class="mx-auto h-16 w-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-lg transform rotate-3 hover:rotate-6 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900 tracking-tight">
                    Admin Portal
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Silakan masuk untuk mengelola sistem Star UMKM
                </p>
            </div>

            @if ($errors->any())
                <div class="rounded-xl bg-red-50 border border-red-200 p-4 flex items-start gap-3 animate-pulse">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium text-red-800">
                        {{ $errors->first() }}
                    </h3>
                </div>
            @endif

            <form class="mt-8 space-y-6" action="{{ route('admin.login.submit') }}" method="POST">
                @csrf
                <div class="space-y-5">

                    <div class="group relative">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1 ml-1">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-emerald-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="appearance-none block w-full pl-11 pr-3 py-3.5 border border-gray-200 rounded-xl leading-5 bg-white/50 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 sm:text-sm transition-all duration-300 shadow-sm"
                                placeholder="admin@starumkm.com">
                        </div>
                    </div>

                    <div class="group relative">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1 ml-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-emerald-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                class="appearance-none block w-full pl-11 pr-3 py-3.5 border border-gray-200 rounded-xl leading-5 bg-white/50 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 sm:text-sm transition-all duration-300 shadow-sm"
                                placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox"
                            class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded cursor-pointer">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700 cursor-pointer select-none">
                            Ingat saya
                        </label>
                    </div>
                </div>

                <button type="submit"
                    class="group relative w-full flex justify-center py-3.5 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 focus:outline-none focus:ring-4 focus:ring-emerald-500/30 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-emerald-200 group-hover:text-emerald-100 transition ease-in-out duration-150" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    Masuk Sekarang
                </button>
            </form>
        </div>
    </div>

    {{-- Custom Animation Styles --}}
    <style>
        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; opacity: 0; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
    </style>
@endsection
