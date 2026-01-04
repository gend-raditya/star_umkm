<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Star UMKM') }}</title>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Inter', system-ui, sans-serif;
        }

        /* Custom gradient backgrounds using the reference image colors */
        .bg-sage-gradient {
            background: linear-gradient(135deg, #c4a7b1 0%, #8db3a8 50%, #7ba394 100%);
        }

        .bg-peach-gradient {
            background: linear-gradient(135deg, #f4e4d1 0%, #f0dac7 50%, #ecd1bd 100%);
        }

        .bg-mint-gradient {
            background: linear-gradient(135deg, #c8e6dc 0%, #b8ddd1 50%, #a8d4c6 100%);
        }

        .bg-main-gradient {
            background: linear-gradient(135deg, #a7c4bc 0%, #f4e4d1 50%, #c8e6dc 100%);
        }

        /* Glassmorphism effects */
        .glass {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            /* border: 1px solid rgba(255, 255, 255, 0.2); */
        }
    </style>
</head>

{{-- <body class="font-sans antialiased bg-main-gradient min-h-screen text-stone-800">
    <div x-data="{
        open: false,
        openSellerModal: false,
        authOpen: {{ $errors->any() ? 'true' : 'false' }},
        isLogin: {{ $errors->has('name') ? 'false' : 'true' }}
    }"> --}}

<body class="font-sans antialiased bg-main-gradient min-h-screen text-stone-800">
    <div x-data="{
        open: false,
        openSellerModal: false,

        @guest
            authOpen: {{ $errors->any() || session('success') ? 'true' : 'false' }},
        @else
            authOpen: false, {{-- Kalau sudah login, modal auth tutup --}}
        @endguest

        isLogin: {{ session('success') || !$errors->has('name') ? 'true' : 'false' }}
    }">


        <div class="min-h-screen flex flex-col">
            <!-- Modern Header -->
            <header class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
                <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between bg-white/10 glass rounded-full px-6 py-3 shadow-lg">

                        <!-- Logo -->
                        <div class="flex items-center">
                            <a href="{{ url('/admin/login') }}" class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                                    <span class="text-black text-lg font-bold">⭐</span>
                                </div>
                                <span class="text-xl font-bold text-black hidden sm:block">Star UMKM</span>
                            </a>
                        </div>

                        <!-- Desktop Navigation -->
                        <div class="hidden lg:flex items-center space-x-8">
                            <a href="{{ url('/') }}"
                                class="text-black/90 hover:text-black font-medium transition-colors duration-200">Beranda</a>
                            <a href="{{ route('produk.index') }}"
                                class="text-black/90 hover:text-black font-medium transition-colors duration-200">Produk</a>
                            {{-- <a href="#"
                            class="text-black/90 hover:text-black font-medium transition-colors duration-200">Promo</a> --}}
                            <a href="{{ route('tentang') }}"
                                class="text-black/90 hover:text-black font-medium transition-colors duration-200">Tentang
                                Kami</a>
                            <a href="{{ route('galeri') }}"
                                class="text-black/90 hover:text-black font-medium transition-colors duration-200">Galeri</a>
                            {{-- <a href="{{ route('produk.index') }}"
                                class="text-black/90 hover:text-black font-medium transition-colors duration-200">Produk</a> --}}
                        </div>

                        <!-- Right Side -->
                        <div class="flex items-center space-x-4">

                            <!-- 🛒 Cart Icon (hanya muncul kalau user login) -->
                            @auth
                                <a href="{{ route('keranjang.index') }}"
                                    class="relative p-2 text-black/90 hover:text-black transition-colors duration-200">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.8-5M7 13v6a2 2 0 002 2h6a2 2 0 002-2v-6">
                                        </path>
                                    </svg>
                                    @php
                                        $count = \App\Models\Keranjang::where('user_id', Auth::id())->sum('jumlah');
                                    @endphp
                                    <span
                                        class="absolute -top-1 -right-1 bg-orange-400 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold">
                                        {{ $count }}
                                    </span>
                                </a>
                            @endauth

                            <!-- 🔽 User Menu -->
                            @auth
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                                        <img src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : asset('images/default.png') }}"
                                            alt="{{ Auth::user()->name }}"
                                            class="w-8 h-8 rounded-full object-cover border-2 border-white/30">
                                        <span class="text-black/90 text-sm font-medium">{{ Auth::user()->name }}</span>
                                        <svg class="w-4 h-4 text-black/60" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>

                                    <div x-show="open"
                                        @click.outside="open = false"
                                        x-cloak {{-- <--- TAMBAHKAN INI --}}
                                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
                                        <a href="{{ route('user.dashboard') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Saya</a>
                                        <a href="{{ route('pesanan.saya') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pesanan Saya</a>

                                        @if (Auth::user()->seller_status === null)
                                            <button @click="openSellerModal = true"
                                                class="w-full text-left px-4 py-2 text-sm text-blue-700 hover:bg-blue-100 font-semibold">
                                                💼 Ajukan Jadi Seller
                                            </button>
                                        @elseif(Auth::user()->seller_status === 'pending')
                                            <span class="block px-4 py-2 text-sm text-yellow-600 font-semibold">
                                                ⏳ Menunggu Persetujuan
                                            </span>
                                        @elseif(Auth::user()->seller_status === 'approved')
                                            <a href="{{ route('seller.dashboard') }}"
                                                class="block px-4 py-2 text-sm text-green-700 hover:bg-green-100 font-semibold">
                                                🏪 Dashboard Seller
                                            </a>
                                        @endif


                                        <div class="py-1 border-t border-sage-50">
                                        <form method="POST" action="{{ route('logout') }}"
                                        onsubmit="return confirm('Apakah Anda yakin ingin keluar?');">
                                            @csrf
                                            <button type="submit"
                                            class="w-full group flex items-center gap-3 px-5 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors text-left">
                                                <div class="w-8 h-8 rounded-lg bg-red-50 text-red-500 flex items-center justify-center group-hover:bg-red-100 transition-colors">
                                                    🔚
                                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                                </div>
                                                <span class="font-medium">Logout</span>
                                            </button>
                                        </form>
                                    </div>




                                    </div>
                                </div>
                            @endauth

                            <!-- 🔑 Guest -->
                            @guest
                                <div class="hidden sm:flex items-center space-x-3 mr-12">
                                    <button @click="authOpen = true; isLogin = true"
                                    class="text-black font-medium px-4 py-2 rounded-full hover:bg-white/100 transition-all duration-200 text-sm">
                                        Login
                                    </button>

                                    <button @click="authOpen = true; isLogin = false"
                                    class="text-black px-4 py-2 rounded-full hover:bg-white/100 transition-all duration-200 text-sm font-medium border border-white/100">
                                        Register
                                    </button>
                                </div>
                            @endguest

                            <!-- Mobile Menu Button -->
                            <button class="lg:hidden p-2 text-black/90 hover:text-black">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>

                        </div>
                    </div>
                </nav>
            </header>

            <!-- Page Heading (optional) -->
            @isset($header)
                <div class="pt-20">
                    <div class="bg-white/10 glass shadow-lg border-b border-white/20">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </div>
                </div>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 mt-20">
                @yield('content')
            </main>


            {{-- Flash Message --}}
            {{-- @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
                    class="fixed top-24 right-5 z-50 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
                    {{ session('success') }}
                </div>
            @endif --}}

            @if (session('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
                    class="fixed top-24 right-5 z-50 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('info'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
                    class="fixed top-24 right-5 z-50 bg-blue-500 text-white px-6 py-3 rounded-lg shadow-lg">
                    {{ session('info') }}
                </div>
            @endif



            <!-- Modern Footer -->

            <footer id="tentang-kami"
                class="bg-[rgba(167,196,188,0.95)] backdrop-blur-xl border-t border-white/20 shadow-lg mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <!-- Main Footer Content -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                        <!-- Brand Section -->
                        <div class="lg:col-span-2">
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xl font-bold">⭐</span>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-white">Star UMKM</h3>
                                    {{-- <p class="text-white/70 text-sm">Studio Shodwe</p> --}}
                                </div>
                            </div>
                            <p class="text-white/80 mb-6 leading-relaxed max-w-md">
                                Setiap produk UMKM punya cerita. Kami menghadirkan makanan dan kerajinan lokal
                                berkualitas
                                yang otentik, penuh rasa, dan bernilai budaya.
                            </p>
                            <!-- Social Media -->
                            <div class="flex space-x-4">
                                <a href="#"
                                    class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition-all duration-200">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                    </svg>
                                </a>
                                <a href="#"
                                    class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition-all duration-200">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                    </svg>
                                </a>
                                <a href="#"
                                    class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition-all duration-200">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <!-- Quick Links -->
                        <div>
                            <h4 class="text-white font-semibold text-lg mb-4">Kategori</h4>
                            <ul class="space-y-3">
                                <li><a href="#"
                                        class="text-white/80 hover:text-white transition-colors duration-200 flex items-center space-x-2">
                                        <span class="w-2 h-2 bg-orange-400 rounded-full"></span>
                                        <span>Makanan</span>
                                    </a></li>
                                <li><a href="#"
                                        class="text-white/80 hover:text-white transition-colors duration-200 flex items-center space-x-2">
                                        <span class="w-2 h-2 bg-blue-400 rounded-full"></span>
                                        <span>Minuman</span>
                                    </a></li>
                                <li><a href="#"
                                        class="text-white/80 hover:text-white transition-colors duration-200 flex items-center space-x-2">
                                        <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                                        <span>Kerajinan</span>
                                    </a></li>

                            </ul>
                        </div>

                        <!-- Contact Info -->
                        <div>
                            <h4 class="text-white font-semibold text-lg mb-4">Kontak</h4>
                            <ul class="space-y-3">
                                <li class="flex items-center space-x-3 text-white/80">
                                    <div
                                        class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <span class="text-sm">info@starumkm.com</span>
                                </li>
                                <li class="flex items-center space-x-3 text-white/80">
                                    <div
                                        class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                            </path>
                                        </svg>
                                    </div>
                                    <span class="text-sm">+62 812-3456-7890</span>
                                </li>
                                <li class="flex items-center space-x-3 text-white/80">
                                    <div
                                        class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm">Padang, West Sumatra</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Bottom Footer -->
                    <div class="border-t border-white/20 pt-8">
                        <div class="flex flex-col md:flex-row justify-between items-center">
                            <p class="text-white/40 text-sm text-center md:text-left mb-4 md:mb-0">
                                &copy; {{ date('Y') }} Star UMKM. All rights reserved. | Memberdayakan UMKM lokal
                                dengan teknologi modern.
                            </p>
                            <div class="flex items-center space-x-6 text-sm">
                                <a href="#"
                                    class="text-white/60 hover:text-white transition-colors duration-200">Privacy
                                    Policy</a>
                                <a href="#"
                                    class="text-white/60 hover:text-white transition-colors duration-200">Terms of
                                    Service</a>
                                <a href="#"
                                    class="text-white/60 hover:text-white transition-colors duration-200">Support</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        @include('layouts.partials.auth-modal')

        <!-- Scripts -->
        <script>
            // Header scroll effect
            window.addEventListener('scroll', function() {
                const header = document.querySelector('header');
                if (window.scrollY > 100) {
                    header.style.background = 'rgba(167, 196, 188, 0.95)';
                    header.style.backdropFilter = 'blur(20px)';
                } else {
                    header.style.background = 'transparent';
                    header.style.backdropFilter = 'none';
                }
            });
        </script>
        @yield('scripts')

        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
        <script>
            const swiper = new Swiper(".swiper-main", {
                spaceBetween: 10,
                slidesPerView: 1,
                loop: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                thumbs: {
                    swiper: {
                        el: ".swiper-thumbs",
                        slidesPerView: 5,
                        spaceBetween: 10,
                    }
                }
            });
        </script>

        <!-- Modal Seller -->
        <!-- Modal Seller -->
        <div x-show="openSellerModal" x-cloak
            class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
            <div @click.outside="openSellerModal = false" class="bg-white w-full max-w-lg p-6 rounded shadow-lg">

                <h2 class="text-xl font-bold mb-4">Form Pendaftaran Seller</h2>

                <form action="{{ route('seller.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Nama Seller -->
                    <label class="block mb-3">
                        <span class="text-gray-700">Nama Seller</span>
                        <input type="text" name="nama_seller" class="w-full mt-1 p-2 border rounded" required>
                    </label>

                    <!-- Foto Toko -->
                    <label class="block mb-3">
                        <span class="text-gray-700">Foto Toko / Banner (Opsional)</span>
                        <input type="file" name="foto_toko" class="w-full mt-1 p-2 border rounded">
                    </label>

                    <!-- Nomor HP -->
                    <label class="block mb-3">
                        <span class="text-gray-700">Nomor HP Seller</span>
                        <input type="text" name="nomor_hp" class="w-full mt-1 p-2 border rounded" required>
                    </label>

                    <!-- Jenis Rekening -->
                    <label class="block mb-3">
                        <span class="text-gray-700">Jenis Rekening</span>
                        <select name="jenis_rekening" class="w-full mt-1 p-2 border rounded" required>
                            <option value="" disabled selected>Pilih jenis rekening</option>
                            <option value="BCA">BCA</option>
                            <option value="BNI">BNI</option>
                            <option value="BRI">BRI</option>
                            <option value="Mandiri">Mandiri</option>
                            <option value="CIMB">CIMB Niaga</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </label>

                    <!-- Nomor Rekening -->
                    <label class="block mb-3">
                        <span class="text-gray-700">Nomor Rekening</span>
                        <input type="text" name="nomor_rekening" class="w-full mt-1 p-2 border rounded" required>
                    </label>

                    <div class="flex justify-end gap-3 mt-4">
                        <button type="button" @click="openSellerModal = false"
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">
                            Kirim
                        </button>
                    </div>
                </form>
            </div>
        </div>


</body>

</html>
