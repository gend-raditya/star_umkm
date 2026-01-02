<div x-show="authOpen"
    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-[#2d3b34]/60 backdrop-blur-[4px]"
    style="display: none;" x-cloak>

    <div @click.outside="authOpen = false"
        class="bg-white rounded-[2rem] shadow-2xl w-full max-w-[850px] overflow-hidden relative flex flex-col transition-all duration-700 ease-in-out min-h-[500px] border border-white/20"
        :class="isLogin ? 'md:flex-row' : 'md:flex-row-reverse'"
        x-transition:enter="transition all ease-out duration-500 delay-100"
        x-transition:enter-start="opacity-0 scale-95 translate-y-8"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0">

        @if (session('success'))
        <div x-data="{ showSuccessMessage: true }"
             x-init="setTimeout(() => showSuccessMessage = false, 5000)"
             x-show="showSuccessMessage"
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 -translate-y-full"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-500"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-full"
             class="absolute top-0 left-0 w-35 z-[60] text-white px-1.5 py-1.5 flex items-center shadow-md backdrop-blur-md">

            <div class="bg-white/20 p-1.5 rounded-full mr-4 shadow-sm">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <div>
                <h4 class="font-bold text-[15px] tracking-wide leading-tight">Registrasi Berhasil!</h4>
                <p class="text-sm text-white/90 font-medium mt-0.5">
                    {{ session('success') }}
                </p>
            </div>

            <button @click="showSuccessMessage = false" class="ml-auto text-white/60 hover:text-white bg-white/10 hover:bg-white/20 rounded-full p-1 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    @endif

        <button @click="authOpen = false" class="absolute top-5 right-5 z-50 p-2 bg-black/10 hover:bg-black/20 md:bg-white/40 md:hover:bg-white/80 backdrop-blur-md rounded-full transition-all duration-300 text-stone-600 group">
            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <div class="hidden md:flex w-1/2 relative flex-col justify-between p-10 text-white overflow-hidden bg-[#557466] transition-all duration-700 z-10">

            <div class="absolute inset-y-0 bg-[#b8d1ae] w-18 transform transition-all duration-700 ease-in-out z-20"
                 :class="isLogin ? '-right-14 rotate-3 skew-x-3' : '-left-14 -rotate-3 -skew-x-3'">
            </div>

            <div x-show="isLogin"
                 x-transition:enter="transition ease-linear duration-700"
                 x-transition:enter-start="opacity-0 scale-110"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-linear duration-700"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-110"
                 class="absolute inset-0 z-0">
                <img src="{{ asset('images/auth/login-bg.jpg') }}" alt="Login Background" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-[#2d3b34]/90 via-[#557466]/60 to-[#557466]/30 mix-blend-multiply"></div>
            </div>

             <div x-show="!isLogin"
                 x-transition:enter="transition ease-linear duration-700"
                 x-transition:enter-start="opacity-0 scale-110"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-linear duration-700"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-110"
                 class="absolute inset-0 z-0"
                 style="display: none;">
                <img src="{{ asset('images/auth/register-bg.jpg') }}" alt="Register Background" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-[#2d3b34]/90 via-[#8db3a8]/60 to-[#c5d3cc]/30 mix-blend-multiply"></div>
            </div>

            <div class="relative z-30 ml-6 mt-8">
                <div class="flex items-center space-x-3 mb-8">
                    <div class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center border border-white/10">
                        <span class="text-xl">⭐</span>
                    </div>
                    <span class="text-lg font-bold tracking-wide drop-shadow-sm">Star UMKM</span>
                </div>

                <div class="space-y-4">
                     <h2 class="text-3xl font-extrabold leading-tight tracking-tight drop-shadow-lg transition-all duration-500" x-text="isLogin ? 'Selamat Datang Kembali!' : 'Mulai Perjalanan Anda.'"></h2>
                     <p class="text-base text-stone-100/90 font-medium leading-relaxed max-w-sm drop-shadow-md transition-all duration-500" x-text="isLogin ? 'Masuk untuk mengakses dasbor dan pesanan Anda.' : 'Bergabunglah dengan ribuan UMKM dan pembeli lokal.'"></p>
                </div>
            </div>

            <div class="relative z-30 flex items-center gap-2 text-sm text-white/70">
                <div class="h-px w-8 bg-white/40"></div>
                <p>Karya Asli Indonesia</p>
            </div>
        </div>


        <div class="w-full md:w-1/2 bg-[#dbe8d7]/70 relative overflow-hidden flex items-center z-0">

            <div class="w-full p-8 md:p-10 transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] absolute inset-0 flex flex-col justify-start overflow-y-auto custom-scrollbar"
                 x-show="isLogin"
                 x-transition:enter="transition all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] delay-200"
                 x-transition:enter-start="opacity-0 -translate-x-[100%] scale-95"
                 x-transition:enter-end="opacity-100 translate-x-0 scale-100"
                 x-transition:leave="transition all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)]"
                 x-transition:leave-start="opacity-100 translate-x-0 scale-100"
                 x-transition:leave-end="opacity-0 -translate-x-[100%] scale-95">

                <div class="mb-5 text-center md:text-left mt-6">
                    <h3 class="text-4xl font-bold text-[#2d3b34] mb-2 tracking-tight">Masuk Akun</h3>
                    <p class="text-stone-500 text-sm">Lanjutkan petualangan belanja Anda.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <div class="group">
                        <label class="block text-xs font-bold text-stone-600 uppercase tracking-wider mb-1.5 ml-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full h-10 px-5 py-3 rounded-xl bg-white border-2 border-transparent focus:border-[#8db3a8] focus:bg-white focus:ring-4 focus:ring-[#8db3a8]/10 outline-none transition-all font-medium text-[#2d3b34] placeholder-stone-400 text-sm" placeholder="nama@email.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-500 font-medium ml-1" />
                    </div>

                    <div class="group">
                        <label class="block text-xs font-bold text-stone-600 uppercase tracking-wider mb-1.5 ml-1">Password</label>
                        <input type="password" name="password" required
                            class="w-full h-10 px-5 py-3 rounded-xl bg-white border-2 border-transparent focus:border-[#8db3a8] focus:bg-white focus:ring-4 focus:ring-[#8db3a8]/10 outline-none transition-all font-medium text-[#2d3b34] text-sm" placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-red-500 font-medium ml-1" />
                    </div>

                    <div class="flex items-center justify-between text-sm pt-1">
                        <label class="flex items-center cursor-pointer group">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-stone-300 text-[#557466] focus:ring-[#557466] transition-all cursor-pointer">
                            <span class="ml-2 text-stone-600 font-medium group-hover:text-[#557466] transition-colors text-xs">Ingat Saya</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[#557466] hover:text-[#2d3b34] font-bold hover:underline transition-all text-xs">Lupa Password?</a>
                        @endif
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-[#8db3a8] to-[#557466] text-white font-bold py-3 rounded-xl hover:shadow-lg hover:shadow-[#8db3a8]/30 transition-all duration-300 transform hover:-translate-y-[2px] active:translate-y-[1px] text-sm tracking-wide mt-6">
                        Masuk Sekarang
                    </button>
                </form>
            </div>

            <div class="w-full p-8 md:p-10 transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] absolute inset-0 flex flex-col justify-start overflow-y-auto custom-scrollbar"
                 x-show="!isLogin"
                 x-transition:enter="transition all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)] delay-200"
                 x-transition:enter-start="opacity-0 translate-x-[100%] scale-95"
                 x-transition:enter-end="opacity-100 translate-x-0 scale-100"
                 x-transition:leave="transition all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)]"
                 x-transition:leave-start="opacity-100 translate-x-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-x-[100%] scale-95"
                 style="display: none;">

                <div class="mb-5 text-center md:text-left mt-2">
                    <h3 class="text-3xl font-bold text-[#2d3b34] mb-2 tracking-tight">Buat Akun Baru</h3>
                    <p class="text-stone-500 text-sm">Bergabunglah dengan komunitas kami.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-3">
                    @csrf
                    <div class="group">
                        <label class="block text-xs font-bold text-stone-600 uppercase tracking-wider mb-1.5 ml-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full h-10 px-5 py-3 rounded-xl bg-white border-transparent border-2 focus:border-[#8db3a8] focus:bg-white focus:ring-4 focus:ring-[#8db3a8]/20 outline-none transition-all font-medium text-[#2d3b34] text-sm" placeholder="Contoh: Budi Santoso">
                        <x-input-error :messages="$errors->get('name')" class="mt-1.5 text-xs text-red-500 font-medium ml-1" />
                    </div>

                    <div class="group">
                        <label class="block text-xs font-bold text-stone-600 uppercase tracking-wider mb-1.5 ml-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                        autocomplete="off"
                            class="w-full h-10 px-5 py-3 rounded-xl bg-white border-2 border-transparent focus:border-[#8db3a8] focus:bg-white focus:ring-4 focus:ring-[#8db3a8]/20 outline-none transition-all font-medium text-[#2d3b34] text-sm" placeholder="nama@email.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-500 font-medium ml-1" />
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="group">
                            <label class="block text-xs font-bold text-stone-600 uppercase tracking-wider mb-1.5 ml-1">Password</label>
                            <input type="password" name="password" required
                            autocomplete="new-password"
                                class="w-full h-10 px-5 py-3 rounded-xl bg-white border-2 border-transparent focus:border-[#8db3a8] focus:bg-white focus:ring-4 focus:ring-[#8db3a8]/20 outline-none transition-all font-medium text-[#2d3b34] text-sm">
                        </div>
                        <div class="group">
                            <label class="block text-xs font-bold text-stone-600 uppercase tracking-wider mb-1.5 ml-1">Konfirmasi</label>
                            <input type="password" name="password_confirmation" required
                                class="w-full h-10 px-5 py-3 rounded-xl bg-white border-2 border-transparent focus:border-[#8db3a8] focus:bg-white focus:ring-4 focus:ring-[#8db3a8]/20 outline-none transition-all font-medium text-[#2d3b34] text-sm">
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-500 font-medium ml-1" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-red-500 font-medium ml-1" />

                    <button type="submit" class="w-full bg-gradient-to-r from-[#8db3a8] to-[#557466] text-white font-bold py-3 rounded-xl hover:shadow-lg hover:shadow-[#8db3a8]/30 transition-all duration-300 transform hover:-translate-y-[2px] active:translate-y-[1px] text-sm tracking-wide mt-6">
                        Daftar Sekarang
                    </button>
                </form>
            </div>

            <div class="absolute bottom-0 mb-2 left-0 w-full p-3 bg-[#f4f7f5]/2 backdrop-blur-sm border-t border-stone-100 flex justify-center transition-all duration-500 z-20">
                 <div class="text-xs font-medium text-stone-600 bg-white px-5 py-2.5 rounded-full inline-flex items-center shadow-sm border border-stone-200/50">
                    <span x-text="isLogin ? 'Belum punya akun?' : 'Sudah punya akun?'"></span>
                    <button @click="isLogin = !isLogin"
                            class="ml-2 text-[#557466] font-extrabold hover:text-[#2d3b34] hover:underline transition-all focus:outline-none uppercase tracking-wide text-[10px]"
                            x-text="isLogin ? 'Daftar Disini' : 'Masuk Disini'"></button>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px; /* Scrollbar lebih tipis */
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: rgba(141, 179, 168, 0.5);
        border-radius: 10px;
    }
    .custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: rgba(141, 179, 168, 0.5) transparent;
    }
</style>
