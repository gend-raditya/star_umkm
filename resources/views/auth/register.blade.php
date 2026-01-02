<x-guest-layout>
    <!-- Overlay Background -->
    <div class="fixed inset-0 bg-gradient-to-br from-stone-100 via-amber-50 to-stone-50 flex items-center justify-center p-4 overflow-y-auto">

        <!-- Modal Container -->
        <div x-data="{
                show: false,
                isLogin: false,
                slideDirection: 'right'
             }"
             x-init="setTimeout(() => show = true, 100)"
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             class="w-full max-w-4xl my-8">

            <!-- Card Container -->
            <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-2xl overflow-hidden border border-stone-200/50">
                <div class="grid md:grid-cols-5">

                    <!-- Illustration Side -->
                    <div class="hidden md:block md:col-span-2 relative bg-gradient-to-br from-[#a8b5a0] via-[#b8c4b0] to-[#c4d0bc] p-8">
                        <div class="h-full flex flex-col justify-between">
                            <!-- Logo -->
                            <div class="flex items-center space-x-2 mb-6">
                                <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                                    <span class="text-white text-xl font-bold">⭐</span>
                                </div>
                                <span class="text-xl font-bold text-white">Star UMKM</span>
                            </div>

                            <!-- Illustration -->
                            <div class="flex-1 flex items-center justify-center">
                                <div class="relative w-full max-w-xs">
                                    <div class="absolute top-0 right-0 w-20 h-20 bg-white/10 rounded-full animate-pulse"></div>
                                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full animate-pulse" style="animation-delay: 1s;"></div>

                                    <div class="relative z-10 bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/20">
                                        <svg class="w-full h-48" viewBox="0 0 300 200" fill="none">
                                            <circle cx="150" cy="70" r="35" fill="white" opacity="0.4"/>
                                            <rect x="90" y="115" width="50" height="70" rx="6" fill="white" opacity="0.5"/>
                                            <rect x="160" y="115" width="50" height="70" rx="6" fill="white" opacity="0.3"/>
                                            <circle cx="115" cy="145" r="6" fill="white" opacity="0.5"/>
                                            <circle cx="185" cy="145" r="6" fill="white" opacity="0.5"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Bottom Text -->
                            <div>
                                <h3 class="text-xl font-bold text-white mb-2" x-text="isLogin ? 'Selamat Datang Kembali' : 'Mulai Petualangan'"></h3>
                                <p class="text-white/80 text-sm leading-relaxed" x-text="isLogin ? 'Temukan produk UMKM berkualitas dari seluruh Indonesia' : 'Bergabunglah dan dukung ekonomi kreatif lokal'"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Form Side -->
                    <div class="md:col-span-3 relative overflow-hidden">
                        <!-- Forms Container with Slide Animation -->
                        <div class="relative h-full">

                            <!-- Register Form -->
                            <div x-show="!isLogin"
                                 x-transition:enter="transition ease-out duration-400"
                                 x-transition:enter-start="opacity-0"
                                 x-transition:enter-end="opacity-100"
                                 x-transition:leave="transition ease-in duration-300"
                                 x-transition:leave-start="opacity-100"
                                 x-transition:leave-end="opacity-0"
                                 :class="isLogin ? 'translate-x-full' : 'translate-x-0'"
                                 class="p-8 transition-transform duration-500 ease-in-out">

                                <div class="mb-6">
                                    <h2 class="text-2xl font-bold text-stone-800 mb-1">Buat Akun Baru</h2>
                                    <p class="text-stone-500 text-sm">Bergabunglah dan mulai berbelanja produk UMKM</p>
                                </div>

                                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                                    @csrf

                                    <!-- Name -->
                                    <div class="space-y-1">
                                        <label for="name" class="block text-xs font-semibold text-stone-700">Nama Lengkap</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-4 w-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </div>
                                            <input type="text" name="name" value="{{ old('name') }}" required autofocus
                                                   class="block w-full pl-9 pr-3 py-2.5 text-sm border border-stone-300 rounded-lg focus:ring-2 focus:ring-[#a8b5a0] focus:border-transparent transition-all bg-white/50 placeholder-stone-400"
                                                   placeholder="John Doe">
                                        </div>
                                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                                    </div>

                                    <!-- Email -->
                                    <div class="space-y-1">
                                        <label for="email" class="block text-xs font-semibold text-stone-700">Email</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-4 w-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                                </svg>
                                            </div>
                                            <input type="email" name="email" value="{{ old('email') }}" required
                                                   class="block w-full pl-9 pr-3 py-2.5 text-sm border border-stone-300 rounded-lg focus:ring-2 focus:ring-[#a8b5a0] focus:border-transparent transition-all bg-white/50 placeholder-stone-400"
                                                   placeholder="nama@email.com">
                                        </div>
                                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                                    </div>

                                    <!-- Password -->
                                    <div class="space-y-1">
                                        <label for="password" class="block text-xs font-semibold text-stone-700">Password</label>
                                        <div class="relative" x-data="{ show: false }">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-4 w-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                                </svg>
                                            </div>
                                            <input :type="show ? 'text' : 'password'" name="password" required
                                                   class="block w-full pl-9 pr-9 py-2.5 text-sm border border-stone-300 rounded-lg focus:ring-2 focus:ring-[#a8b5a0] focus:border-transparent transition-all bg-white/50 placeholder-stone-400"
                                                   placeholder="••••••••">
                                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                                <svg x-show="!show" class="h-4 w-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                <svg x-show="show" class="h-4 w-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                                </svg>
                                            </button>
                                        </div>
                                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="space-y-1">
                                        <label for="password_confirmation" class="block text-xs font-semibold text-stone-700">Konfirmasi Password</label>
                                        <div class="relative" x-data="{ show: false }">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-4 w-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </div>
                                            <input :type="show ? 'text' : 'password'" name="password_confirmation" required
                                                   class="block w-full pl-9 pr-9 py-2.5 text-sm border border-stone-300 rounded-lg focus:ring-2 focus:ring-[#a8b5a0] focus:border-transparent transition-all bg-white/50 placeholder-stone-400"
                                                   placeholder="••••••••">
                                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                                <svg x-show="!show" class="h-4 w-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                <svg x-show="show" class="h-4 w-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                                </svg>
                                            </button>
                                        </div>
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                                    </div>

                                    <!-- Submit -->
                                    <button type="submit"
                                            class="w-full bg-gradient-to-r from-[#a8b5a0] to-[#b8c4b0] text-white py-2.5 px-4 rounded-lg font-semibold hover:from-[#98a590] hover:to-[#a8b4a0] focus:outline-none focus:ring-2 focus:ring-[#a8b5a0] focus:ring-offset-2 transform transition-all duration-200 hover:scale-[1.01] active:scale-[0.99] shadow-md text-sm">
                                        Daftar Sekarang
                                    </button>

                                    <!-- Toggle to Login -->
                                    <div class="text-center pt-2">
                                        <p class="text-xs text-stone-600">
                                            Sudah punya akun?
                                            <button type="button" @click="isLogin = true; slideDirection = 'left'"
                                                    class="font-semibold text-[#a8b5a0] hover:text-[#98a590] transition-colors duration-200">
                                                Masuk di sini
                                            </button>
                                        </p>
                                    </div>
                                </form>
                            </div>

                            <!-- Login Form -->
                            <div x-show="isLogin"
                                 x-transition:enter="transition ease-out duration-400"
                                 x-transition:enter-start="opacity-0"
                                 x-transition:enter-end="opacity-100"
                                 x-transition:leave="transition ease-in duration-300"
                                 x-transition:leave-start="opacity-100"
                                 x-transition:leave-end="opacity-0"
                                 :class="!isLogin ? '-translate-x-full' : 'translate-x-0'"
                                 class="absolute inset-0 p-8 transition-transform duration-500 ease-in-out">

                                <div class="mb-6">
                                    <h2 class="text-2xl font-bold text-stone-800 mb-1">Selamat Datang Kembali</h2>
                                    <p class="text-stone-500 text-sm">Masuk ke akun Anda untuk melanjutkan</p>
                                </div>

                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                                    @csrf

                                    <!-- Email -->
                                    <div class="space-y-1">
                                        <label for="login_email" class="block text-xs font-semibold text-stone-700">Email</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-4 w-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                                </svg>
                                            </div>
                                            <input id="login_email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                                   class="block w-full pl-9 pr-3 py-2.5 text-sm border border-stone-300 rounded-lg focus:ring-2 focus:ring-[#a8b5a0] focus:border-transparent transition-all bg-white/50 placeholder-stone-400"
                                                   placeholder="nama@email.com">
                                        </div>
                                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                                    </div>

                                    <!-- Password -->
                                    <div class="space-y-1">
                                        <label for="login_password" class="block text-xs font-semibold text-stone-700">Password</label>
                                        <div class="relative" x-data="{ show: false }">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-4 w-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                                </svg>
                                            </div>
                                            <input id="login_password" :type="show ? 'text' : 'password'" name="password" required
                                                   class="block w-full pl-9 pr-9 py-2.5 text-sm border border-stone-300 rounded-lg focus:ring-2 focus:ring-[#a8b5a0] focus:border-transparent transition-all bg-white/50 placeholder-stone-400"
                                                   placeholder="••••••••">
                                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                                <svg x-show="!show" class="h-4 w-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                <svg x-show="show" class="h-4 w-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                                </svg>
                                            </button>
                                        </div>
                                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                                    </div>

                                    <!-- Remember & Forgot -->
                                    <div class="flex items-center justify-between text-xs">
                                        <label class="flex items-center">
                                            <input type="checkbox" name="remember" class="rounded border-stone-300 text-[#a8b5a0] shadow-sm focus:ring-[#a8b5a0] transition-all">
                                            <span class="ml-2 text-stone-600">Ingat saya</span>
                                        </label>
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="font-medium text-[#a8b5a0] hover:text-[#98a590] transition-colors">
                                                Lupa password?
                                            </a>
                                        @endif
                                    </div>

                                    <!-- Submit -->
                                    <button type="submit"
                                            class="w-full bg-gradient-to-r from-[#a8b5a0] to-[#b8c4b0] text-white py-2.5 px-4 rounded-lg font-semibold hover:from-[#98a590] hover:to-[#a8b4a0] focus:outline-none focus:ring-2 focus:ring-[#a8b5a0] focus:ring-offset-2 transform transition-all duration-200 hover:scale-[1.01] active:scale-[0.99] shadow-md text-sm">
                                        Masuk
                                    </button>

                                    <!-- Toggle to Register -->
                                    <div class="text-center pt-2">
                                        <p class="text-xs text-stone-600">
                                            Belum punya akun?
                                            <button type="button" @click="isLogin = false; slideDirection = 'right'"
                                                    class="font-semibold text-[#a8b5a0] hover:text-[#98a590] transition-colors duration-200">
                                                Daftar sekarang
                                            </button>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
