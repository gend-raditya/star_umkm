@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center pb-4 bg-center bg-cover"
        style="background-image: url('{{ asset('images/bg-umkm.jpg') }}');">
        {{-- <div class="absolute top-0 left-0 w-full h-full bg-white opacity-20"></div> --}}
        <!-- Background overlay -->
        <div class="absolute inset-0 bg-white/10"></div>

        <!-- Floating decorative elements -->
        <div class="absolute top-1/4 right-1/4 w-32 h-32 bg-white/5 rounded-full animate-pulse"></div>
        <div class="absolute bottom-1/3 left-1/4 w-24 h-24 bg-white/5 rounded-full animate-pulse delay-700"></div>
        <div class="absolute top-1/2 left-1/3 w-16 h-16 bg-white/5 rounded-full animate-pulse delay-1000"></div>

        <!-- Hero Content -->
        <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="space-y-8">
                <div class="space-y-4 mb-20">
                    <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold text-white leading-tight mb-6">
                        Memberdayakan
                        <span
                            class="bg-gradient-to-r from-yellow-300 via-orange-300 to-red-300 bg-clip-text text-transparent">
                            Citra Rasa
                        </span>
                        <br class="hidden sm:block">
                        dan
                        <span
                            class="bg-gradient-to-r from-emerald-300 via-teal-300 to-cyan-300 bg-clip-text text-transparent">
                            Karya Lokal
                        </span>
                    </h1>
                    <p class="text-xl sm:text-2xl text-white/85 max-w-4xl mx-auto leading-relaxed font-light opacity-100">
                        Temukan aneka oleh-oleh khas UMKM lokal mulai dari <span
                            class="font-semibold text-yellow-300">camilan lezat</span> hingga <span
                            class="font-semibold text-emerald-300">kerajinan tangan</span> unik yang otentik dan berkualitas
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="#produk-terbaru"
                        class="group relative px-8 py-3 bg-white/20 glass rounded-full text-white font-semibold text-lg hover:bg-white/30 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl border border-white/80">
                        <span class="relative z-10">Jelajahi Produk →</span>
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-emerald-400/20 to-teal-400/20 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </a>
                    {{-- <a href="{{ route('produk.index') }}" class="group relative px-8 py-4 bg-white/20 glass rounded-full text-white font-semibold text-lg hover:bg-white/30 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                    <span class="relative z-10">Selengkapnya</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/20 to-teal-400/20 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="produk-terbaru" class="py-20 relative">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Header -->
            {{-- <div class="text-center mb-10">
                <h2 class="text-4xl sm:text-5xl font-bold text-[#78B7B6] mb-6">
                    Temukan Produk UMKM Terbaik
                </h2>
                <p class="text-xl text-[#767480] max-w-3xl mx-auto leading-relaxed">
                    Setiap produk UMKM memiliki cerita — rasakan cita rasa, kualitas, dan keunikan karya anak bangsa di
                    sini.
                    Pilihan makanan, minuman, dan kerajinan lokal berkualitas yang siap mendukung gaya hidup Anda setiap
                    hari.
                </p>
                <div class="w-24 h-1 bg-gradient-to-r from-purple-400 to-pink-400 mx-auto mt-4 rounded-full"></div>
            </div> --}}
            <div
                class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-10 animate-fade-in mt-0">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-sage-900 mb-2">Koleksi Kami</h2>
                    <p class="text-stone-600">Produk pilihan khusus untuk Anda</p>
                    {{-- <div class="mt-4 w-24 h-1 bg-gradient-to-r from-emerald-400 to-teal-400 mx-auto rounded-full"></div> --}}
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($produkTerbaru as $produk)
                    <div
                        class="group relative bg-white/60 glass rounded-2xl overflow-hidden hover:bg-emerald transition-all duration-300 transform hover:-translate-y-2 shadow-xl border-2 border-[rgba(167,196,188,0.95)]">

                        <!-- Product Image -->
                        <div class="relative overflow-hidden aspect-square">
                            @if ($produk->fotos->count() > 0)
                                <img src="{{ asset('storage/' . $produk->fotos->first()->path) }}" alt="{{ $produk->nama }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2
                                                  l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2
                                                  2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2
                                                  2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif

                            <!-- Badges -->
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-emerald-500 text-white text-xs font-bold rounded-full">
                                    NEW
                                </span>
                            </div>

                            <!-- Quick Action Overlay -->
                            <div
                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <a href="{{ route('produk.show', $produk->id) }}"
                                    class="px-6 py-3 bg-white text-gray-900 rounded-full font-semibold hover:bg-gray-100 transition-colors duration-200 transform scale-95 group-hover:scale-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    {{-- Lihat Detail --}}
                                </a>
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="p-6">
                            <div class="mb-2">
                                <span class="text-emerald-400 text-sm font-medium uppercase tracking-wider">
                                    Premium Collection
                                </span>
                            </div>

                            <h3 class="text-xl font-bold text-[#69B9B7] mb-2 line-clamp-1">
                                {{ $produk->nama }}
                            </h3>

                            <p class="text-[#767480] text-sm mb-4 line-clamp-2">
                                {{ Str::limit($produk->deskripsi ?? 'Produk berkualitas tinggi dengan desain eksklusif.', 80) }}
                            </p>

                            <!-- Price and Action -->
                            <div class="flex items-center justify-between">
                                <div class="space-y-1">
                                    <div
                                        class="text-2xl font-bold bg-gradient-to-r from-emerald-400 to-cyan-400 bg-clip-text text-transparent">
                                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                    </div>
                                </div>

                                <a href="{{ route('produk.show', $produk->id) }}"
                                    class="px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-xl font-medium hover:from-emerald-600 hover:to-teal-600 transition-all duration-200 transform hover:scale-105 shadow-lg">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="col-span-full flex flex-col items-center justify-center py-20">
                        <div class="w-32 h-32 bg-white/10 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16
                                          0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16
                                          0h-2.586a1 1 0 00-.707.293l-2.414
                                          2.414a1 1 0 01-.707.293h-3.172a1
                                          1 0 01-.707-.293l-2.414-2.414A1
                                          1 0 006.586 13H4">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Belum Ada Produk</h3>
                        <p class="text-[#767480] text-center max-w-md leading-relaxed">
                            Produk amazing sedang dalam persiapan. Nantikan koleksi terbaru yang akan segera hadir!
                        </p>
                    </div>
                @endforelse
            </div>

            <!-- View All Button -->
            @if ($produkTerbaru->count() > 0)
                <div class="text-center mt-14">
                    <a href="{{ route('produk.index') }}"
                        class="group inline-flex items-center px-8 py-4 bg-[#85B6A8]/80 glass rounded-full text-white font-semibold text-lg hover:bg-[#7BB8A7] transition-all duration-300 transform hover:scale-105 border border-black/20">
                        Lihat Semua Produk
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-200"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3">
                            </path>
                        </svg>
                    </a>
                </div>
            @endif

        </div>
    </section>





    {{-- <section class="py-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-14">
                <h2 class="text-5xl font-semibold text-stone-800 mb-4">
                    Kategori Produk
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-teal-400 mx-auto rounded-full"></div>
            </div>

            <!-- Categories Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Makanan -->
                {{-- <div class="group relative bg-white/10 glass rounded-3xl p-8 text-center hover:bg-white/20 transition-all duration-300 transform hover:-translate-y-2"> --}}
                {{-- <div class="group relative bg-white/50 glass rounded-3xl p-8 text-center hover:bg-white/40 transition-all duration-300 transform hover:-translate-y-2 shadow-xl border border-white/30"> --
                <div
                    class="group relative bg-white/50 glass rounded-3xl p-8 text-center
            hover:bg-white/70 transition-all duration-300 transform hover:-translate-y-2
            shadow-xl border border-white/20 ring-1 ring-white/40">

                    <div class="mb-6">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-orange-400 to-red-400 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            <img src="{{ asset('images/icons/ikon-makanan.png') }}" alt="Ikon Makanan" class="w-12 h-12">
                        </div>
                        {{-- <h3 class="text-2xl font-bold text-white mb-3">Makanan</h3>
                        <p class="text-white/80 leading-relaxed">Serundeng dan makanan olahan berkualitas tinggi dari UMKM lokal terpercaya</p> --
                        <h3 class="text-2xl font-bold text-[#7FA9B0] mb-3">Makanan</h3>

                        <p class="text-[#767480] leading-relaxed">Serundeng dan makanan olahan berkualitas tinggi dari UMKM
                            lokal terpercaya</p>
                    </div>
                    <div class="mt-6">
                        {{-- <span class="inline-flex items-center px-4 py-2 bg-white/10 rounded-full text-white/90 text-sm font-medium"> --
                        <span
                            class="inline-flex items-center px-4 py-2 bg-[#7FA9B0] rounded-full text-white text-sm font-medium">
                            Lihat Produk
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </span>
                    </div>
                </div>


                <div
                    class="group relative bg-white/50 glass rounded-3xl p-8 text-center
            hover:bg-white/70 transition-all duration-300 transform hover:-translate-y-2
            shadow-xl border border-white/20 ring-1 ring-white/40">

                    <div class="mb-6">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-blue-400 to-cyan-400 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            <img src="{{ asset('images/icons/ikon-minuman.png') }}" alt="Ikon Minuman" class="w-12 h-12">
                        </div>
                        <h3 class="text-2xl font-bold text-[#7FA9B0] mb-3">Minuman</h3>
                        <p class="text-[#767480] leading-relaxed">Minuman segar dan tradisional pilihan dari berbagai daerah
                            Indonesia</p>
                    </div>
                    <div class="mt-6">
                        <span
                            class="inline-flex items-center px-4 py-2 bg-[#7FA9B0] rounded-full text-white text-sm font-medium">
                            Lihat Produk
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </span>
                    </div>
                </div>


                <div
                    class="group relative bg-white/50 glass rounded-3xl p-8 text-center
            hover:bg-white/70 transition-all duration-300 transform hover:-translate-y-2
            shadow-xl border border-white/20 ring-1 ring-white/40">


                    <div class="mb-6">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-emerald-400 to-teal-400 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            <img src="{{ asset('images/icons/ikon-kerajinan.png') }}" alt="Ikon Kerajinan"
                                class="w-12 h-12">
                        </div>
                        <h3 class="text-2xl font-bold text-[#7FA9B0] mb-3">Kerajinan</h3>
                        <p class="text-[#767480] leading-relaxed">Tas anyaman dan kerajinan tangan unik dengan sentuhan
                            budaya lokal</p>
                    </div>
                    <div class="mt-6">
                        <span
                            class="inline-flex items-center px-4 py-2 bg-[#7FA9B0] rounded-full text-white text-sm font-medium">
                            Lihat Produk
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}







    {{-- <div class="bg-white/40 backdrop-blur-md py-20"> --}}
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 mb-24">
            <div class="text-center mb-10">
                <h2 class="text-4xl font-bold text-stone-800">Kenapa Memilih Kami?</h2>
                <p class="mt-2 mb-5 text-stone-600">Komitmen kami untuk menjaga kualitas dan kepercayaan.</p>
                {{-- <div class="mt-4 w-24 h-1 bg-gradient-to-r from-emerald-400 to-teal-400 mx-auto rounded-full"></div> --}}
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group bg-white/85 p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-stone-100">
                    <div class="w-14 h-14 bg-orange-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-orange-600 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-stone-800 mb-3">Tercurasi & Higienis</h3>
                    <p class="text-stone-600 text-sm leading-relaxed">
                        Khusus untuk makanan dan minuman, kami memastikan setiap produk diproses dengan standar kebersihan tinggi dan bahan-bahan alami tanpa pengawet berbahaya.
                    </p>
                </div>

                <div class="group bg-white/85 p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-stone-100">
                    <div class="w-14 h-14 bg-teal-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-teal-600 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-stone-800 mb-3">Keaslian Kerajinan</h3>
                    <p class="text-stone-600 text-sm leading-relaxed">
                        Produk kerajinan tangan kami dibuat langsung oleh pengrajin lokal, bukan hasil pabrikasi massal, menjadikannya unik dan bernilai seni tinggi.
                    </p>
                </div>

                <div class="group bg-white/85 p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-stone-100">
                    <div class="w-14 h-14 bg-teal-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-teal-600 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-stone-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-stone-800 mb-3">Dampak Sosial</h3>
                    <p class="text-stone-600 text-sm leading-relaxed">
                        Sebagian keuntungan dialokasikan untuk pelatihan digital marketing bagi para pelaku UMKM agar usaha mereka dapat terus berkembang.
                    </p>
                </div>
            </div>
        </div>
    {{-- </div> --}}


    <!-- Newsletter Section -->
    {{-- <section class="mb-28 mt-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div
                class="bg-[rgba(167,196,188,0.95)]/40 glass rounded-3xl p-8 lg:p-12 text-center border-2 border-[rgba(167,196,188,0.95)]">
                <div class="max-w-2xl mx-auto">
                    <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
                        Tetap Terhubung dengan Kami
                    </h2>
                    <p class="text-[#767480] text-lg mb-8 leading-relaxed">
                        Dapatkan update terbaru tentang produk dan penawaran eksklusif langsung ke email Anda
                    </p>

                    <!-- Newsletter Form -->
                    <div class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto">
                        <div class="flex-1">
                            <input type="email" placeholder="Masukkan email Anda"
                                class="w-full px-6 py-4 bg-white/50 glass rounded-2xl text-[#767480] placeholder-black/30 focus:bg-white/20 focus:outline-none focus:ring-2 focus:ring-[rgba(167,196,188,0.95)] transition-all duration-300">
                        </div>
                        <button
                            class="px-8 py-4 bg-gradient-to-r from-[#7BB8A7] to-[#7BB8A7] text-white rounded-2xl font-semibold hover:from-[#67B29D] hover:to-[#67B29D] transition-all duration-300 transform hover:scale-105 shadow-lg">
                            Subscribe
                        </button>
                    </div>

                    <p class="text-white/90 text-sm mt-4">
                        Kami menghargai privasi Anda. Unsubscribe kapan saja.
                    </p>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- ============================================ --}}
    {{-- LOKASI TOKO SECTION --}}
    {{-- ============================================ --}}
    <section id="lokasi" class="mb-8 sm:mb-4 p-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 mb-20">
            <div class="max-w-3xl mx-auto text-center mb-10 mt-0">
                <h2 class="text-3xl sm:text-4xl font-bold text-stone-900 mb-3">
                    Kunjungi Toko Kami
                </h2>
                <p class="text-lg text-stone-600">
                    Kami siap menyambut Anda dan membantu menemukan produk yang tepat.
                </p>
            </div>

            <div class="bg-white rounded-2xl border-2 border-[#AED3BE] shadow-xl overflow-hidden animate-fade-in-up">
                <div class="grid grid-cols-1 lg:grid-cols-3">
                    {{-- Store Info --}}
                    <div class="lg:col-span-1 p-8 bg-[#f3f7f2] flex flex-col justify-center">
                        <h3 class="text-2xl font-bold text-stone-900 mb-6">Star UMKM</h3>
                        <div class="space-y-5">
                            {{-- Address --}}
                            <div class="flex items-start gap-4">
                                <svg class="w-6 h-6 text-stone-600 mt-1 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-stone-800">Alamat</h4>
                                    <p class="text-sage-700">
                                        Jl. Mega Permai I No.6 blok H, Padang Sarai, Koto Tangah, Padang City, West Sumatra 25586
                                    </p>
                                </div>
                            </div>

                            {{-- Operating Hours --}}
                            <div class="flex items-start gap-4">
                                <svg class="w-6 h-6 text-sage-600 mt-1 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-sage-800">Jam Operasional</h4>
                                    <p class="text-sage-700">Senin - Sabtu: 08:00 - 16:00 WIB</p>
                                    <p class="text-sage-700">Minggu: Tutup</p>
                                </div>
                            </div>
                        </div>

                        {{-- Direction Button --}}
                        <div class="mt-8">
                            <a href="https://maps.app.goo.gl/uYfCRs9VSNi2qvd69" target="_blank"
                                class="inline-flex items-center justify-center gap-2 w-full px-6 py-3.5 bg-[#3a5a4a] text-white font-semibold rounded-lg hover:bg-[#2c4438] transition-all duration-300 shadow-lg transform hover:-translate-y-0.5">
                                Dapatkan Arah
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Map --}}
                    <div class="lg:col-span-2 h-80 lg:h-full">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15957.677061777153!2d100.3145516167492!3d-0.8103656305448704!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4c3d09cf5bef3%3A0x93a0d216c4d46915!2sKOMPLEK.%20MEGA%20PERMAI%201!5e0!3m2!1sid!2sid!4v1767560503762!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop"
        class="fixed bottom-8 right-8 w-12 h-12 bg-emerald-500 hover:bg-emerald-600 text-white rounded-full shadow-lg opacity-0 invisible transition-all duration-300 transform hover:scale-110 z-40">
        <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Scroll to top button
        const scrollToTopBtn = document.getElementById('scrollToTop');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.style.opacity = '1';
                scrollToTopBtn.style.visibility = 'visible';
            } else {
                scrollToTopBtn.style.opacity = '0';
                scrollToTopBtn.style.visibility = 'invisible';
            }
        });

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Add intersection observer for fade animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('section > div').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    </script>
@endsection
