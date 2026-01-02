<x-guest-layout>
    <!-- Overlay Background -->
    <div class="fixed inset-0 bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50 flex items-center justify-center p-4">

        <!-- Modal Container with Slide Animation -->
        <div x-data="{ show: false }"
             x-init="setTimeout(() => show = true, 100)"
             x-show="show"
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 translate-y-8"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="w-full max-w-5xl">

            <!-- Card Container -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <div class="grid md:grid-cols-2">

                    <!-- Left Side - Illustration -->
                    <div class="hidden md:block relative bg-gradient-to-br from-emerald-400 via-teal-400 to-cyan-500 p-12">
                        <div class="h-full flex flex-col justify-between">
                            <!-- Logo/Brand -->
                            <div class="flex items-center space-x-3 mb-8">
                                <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                                    <span class="text-white text-2xl font-bold">⭐</span>
                                </div>
                                <span class="text-2xl font-bold text-white">Star UMKM</span>
                            </div>

                            <!-- Illustration Area -->
                            <div class="flex-1 flex items-center justify-center">
                                <div class="relative w-full max-w-sm">
                                    <!-- Decorative circles -->
                                    <div class="absolute top-0 left-0 w-32 h-32 bg-white/10 rounded-full animate-pulse"></div>
                                    <div class="absolute bottom-0 right-0 w-40 h-40 bg-white/10 rounded-full animate-pulse" style="animation-delay: 1s;"></div>

                                    <!-- Main illustration placeholder -->
                                    <div class="relative z-10 bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20">
                                        <svg class="w-full h-64" viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="50" y="80" width="120" height="180" rx="10" fill="white" opacity="0.3"/>
                                            <rect x="190" y="60" width="120" height="200" rx="10" fill="white" opacity="0.5"/>
                                            <circle cx="250" cy="40" r="25" fill="white" opacity="0.4"/>
                                            <path d="M80 220 L140 180 L180 200 L220 160" stroke="white" stroke-width="3" stroke-linecap="round" opacity="0.6"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Bottom Text -->
                            <div class="mt-8">
                                <h3 class="text-2xl font-bold text-white mb-2">Bergabunglah dengan Kami</h3>
                                <p class="text-white/80 text-sm leading-relaxed">
                                    Temukan produk UMKM lokal berkualitas dan dukung pengrajin Indonesia
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Form -->
                    <div class="p-8 md:p-12">
                        <!-- Header -->
                        <div class="mb-8">
                            <h2 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang Kembali</h2>
                            <p class="text-gray-500">Masuk ke akun Anda untuk melanjutkan</p>
                        </div>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Form -->
                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf

                            <!-- Email -->
                            <div class="space-y-2">
                                <label for="email" class="block text-sm font-semibold text-gray-700">
                                    Email
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                        </svg>
                                    </div>
                                    <input id="email"
                                           type="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           required
                                           autofocus
                                           class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200 placeholder-gray-400"
                                           placeholder="nama@email.com">
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="space-y-2">
                                <label for="password" class="block text-sm font-semibold text-gray-700">
                                    Password
                                </label>
                                <div class="relative" x-data="{ showPassword: false }">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </div>
                                    <input :type="showPassword ? 'text' : 'password'"
                                           id="password"
                                           name="password"
                                           required
                                           class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200 placeholder-gray-400"
                                           placeholder="••••••••">
                                    <button type="button"
                                            @click="showPassword = !showPassword"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg x-show="!showPassword" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg x-show="showPassword" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                        </svg>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Remember & Forgot -->
                            <div class="flex items-center justify-between">
                                <label class="flex items-center">
                                    <input type="checkbox"
                                           name="remember"
                                           class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500 transition-all duration-200">
                                    <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                                </label>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                       class="text-sm font-medium text-emerald-600 hover:text-emerald-500 transition-colors duration-200">
                                        Lupa password?
                                    </a>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                    class="w-full bg-gradient-to-r from-emerald-500 to-teal-500 text-white py-3 px-4 rounded-xl font-semibold hover:from-emerald-600 hover:to-teal-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] shadow-lg">
                                Masuk
                            </button>

                            <!-- Divider -->
                            <div class="relative my-6">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white text-gray-500">Atau</span>
                                </div>
                            </div>

                            <!-- Register Link -->
                            <div class="text-center">
                                <p class="text-sm text-gray-600">
                                    Belum punya akun?
                                    <a href="{{ route('register') }}"
                                       class="font-semibold text-emerald-600 hover:text-emerald-500 transition-colors duration-200">
                                        Daftar sekarang
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
