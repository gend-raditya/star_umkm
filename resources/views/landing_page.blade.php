@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center pt-20 bg-center bg-cover"
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
                <div class="space-y-4">
                    <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold text-white leading-tight">
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
                    <p class="text-xl sm:text-2xl text-white/90 max-w-4xl mx-auto leading-relaxed font-light">
                        Temukan aneka oleh-oleh khas UMKM lokal mulai dari <span
                            class="font-semibold text-yellow-300">camilan lezat</span> hingga <span
                            class="font-semibold text-emerald-300">kerajinan tangan</span> unik yang otentik dan berkualitas
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="#produk-terbaru"
                        class="group relative px-8 py-4 bg-white/20 glass rounded-full text-white font-semibold text-lg hover:bg-white/30 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl border border-white/80">
                        <span class="relative z-10">Jelajahi Produk</span>
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


    <!-- Studio Shodwe Section -->
    <section class="py-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-14">
                <h2 class="text-4xl sm:text-5xl font-bold text-[#6CACAB] mb-4">
                    Kategori Produk
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-teal-400 mx-auto rounded-full"></div>
            </div>

            <!-- Categories Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Makanan -->
                {{-- <div class="group relative bg-white/10 glass rounded-3xl p-8 text-center hover:bg-white/20 transition-all duration-300 transform hover:-translate-y-2"> --}}
                {{-- <div class="group relative bg-white/50 glass rounded-3xl p-8 text-center hover:bg-white/40 transition-all duration-300 transform hover:-translate-y-2 shadow-xl border border-white/30"> --}}
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
                        <p class="text-white/80 leading-relaxed">Serundeng dan makanan olahan berkualitas tinggi dari UMKM lokal terpercaya</p> --}}
                        <h3 class="text-2xl font-bold text-[#7FA9B0] mb-3">Makanan</h3>

                        <p class="text-[#767480] leading-relaxed">Serundeng dan makanan olahan berkualitas tinggi dari UMKM
                            lokal terpercaya</p>
                    </div>
                    <div class="mt-6">
                        {{-- <span class="inline-flex items-center px-4 py-2 bg-white/10 rounded-full text-white/90 text-sm font-medium"> --}}
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

                <!-- Minuman -->
                {{-- <div class="group relative bg-white/10 glass rounded-3xl p-8 text-center hover:bg-white/20 transition-all duration-300 transform hover:-translate-y-2"> --}}
                {{-- <div class="group relative bg-white/10 glass rounded-3xl p-8 text-center hover:bg-white/20 transition-all duration-300 transform hover:-translate-y-2 shadow-xl border border-white/20"> --}}
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

                <!-- Kerajinan -->
                {{-- <div class="group relative bg-white/10 glass rounded-3xl p-8 text-center hover:bg-white/20 transition-all duration-300 transform hover:-translate-y-2"> --}}
                {{-- <div class="group relative bg-white/10 glass rounded-3xl p-8 text-center hover:bg-white/20 transition-all duration-300 transform hover:-translate-y-2 shadow-xl border border-white/20"> --}}
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
    </section>

    <!-- Products Section -->
    <section id="produk-terbaru" class="py-20 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Header -->
            <div class="text-center mb-10">
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
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($produkTerbaru as $produk)
                    <div
                        class="group relative bg-white/60 glass rounded-2xl overflow-hidden hover:bg-emerald transition-all duration-300 transform hover:-translate-y-2 shadow-xl border-2 border-[rgba(167,196,188,0.95)]">

                        <!-- Product Image -->
                        <div class="relative overflow-hidden aspect-square">
                            @if (!empty($produk->foto))
                                <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama }}"
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
                                    Lihat Detail
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
                                Produk berkualitas tinggi dengan desain eksklusif untuk gaya hidup modern Anda.
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


    <!-- Newsletter Section -->
    <section class="mb-28 mt-12">
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
