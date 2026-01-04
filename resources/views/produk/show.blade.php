@extends('layouts.app')

@section('content')
<section class="py-10 relative">

        <div class="max-w-4xl mx-auto">
            <div class="bg-white/80 rounded-2xl shadow-xl overflow-hidden border border-gray-200/50 mt-8 mb-12">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">

                    <!-- Kolom Kiri: Galeri Foto -->
                    <div class="space-y-4">
                        @if ($produk->fotos->count() > 0)
                            <!-- Main Slider dengan efek modern -->
                            <div
                                class="swiper swiper-main rounded-xl overflow-hidden shadow-xl border-4 border-white/80 backdrop-blur-sm">
                                <div class="swiper-wrapper">
                                    @foreach ($produk->fotos as $foto)
                                        <div class="swiper-slide">
                                            <img src="{{ asset('storage/' . $foto->path) }}"
                                                class="w-full h-80 object-cover transition-transform duration-500 hover:scale-105"
                                                alt="Foto {{ $produk->nama }}">
                                        </div>
                                    @endforeach
                                </div>
                                <div
                                    class="swiper-button-next bg-white/95 backdrop-blur-md rounded-full w-10 h-10 shadow-lg after:text-sm after:font-bold after:text-gray-800 hover:bg-white transition-all duration-300">
                                </div>
                                <div
                                    class="swiper-button-prev bg-white/95 backdrop-blur-md rounded-full w-10 h-10 shadow-lg after:text-sm after:font-bold after:text-gray-800 hover:bg-white transition-all duration-300">
                                </div>
                            </div>

                            <!-- Thumbnail Slider dengan efek hover yang lebih smooth -->
                            <div class="swiper swiper-thumbs">
                                <div class="swiper-wrapper">
                                    @foreach ($produk->fotos as $foto)
                                        <div
                                            class="swiper-slide cursor-pointer transform transition-all duration-300 hover:scale-110">
                                            <img src="{{ asset('storage/' . $foto->path) }}"
                                                class="w-full h-24 object-cover rounded-lg border-2 border-gray-200 hover:border-indigo-400 hover:shadow-md transition-all duration-300"
                                                alt="Thumbnail {{ $produk->nama }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="rounded-xl overflow-hidden shadow-xl border-4 border-white/80">
                                <img src="{{ asset('images/default.png') }}" class="w-full h-80 object-cover"
                                    alt="Default">
                            </div>
                        @endif
                    </div>

                    <!-- Kolom Kanan: Info Produk -->
                    <div class="flex flex-col justify-between space-y-6">
                        <div class="space-y-6">
                            <!-- Header Produk -->
                            <div class="space-y-3">
                                <div class="flex items-start justify-between">
                                    <h1
                                        class="text-4xl font-bold text-gray-900 leading-tight bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent">
                                        {{ $produk->nama }}
                                    </h1>

                                    <!-- Tombol Share Produk dengan efek hover -->
                                    <button
                                        onclick="shareProduct('{{ $produk->nama }}', '{{ url('/produk/' . $produk->id) }}')"
                                        class="p-2 rounded-full text-gray-400 hover:text-white hover:bg-gradient-to-r hover:from-blue-500 hover:to-indigo-600 transition-all duration-300 transform hover:scale-110 shadow-lg hover:shadow-xl"
                                        title="Bagikan produk ini">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M14 3l7 7-7 7v-4.586C7 12 3 17 3 17c1.5-6 5.5-9.5 11-10.414V3z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <script>
                                function shareProduct(nama, link) {
                                    if (navigator.share) {
                                        navigator.share({
                                                title: nama,
                                                text: `Lihat produk menarik ini: ${nama}`,
                                                url: link,
                                            })
                                            .then(() => console.log('✅ Produk dibagikan!'))
                                            .catch((error) => console.log('❌ Gagal membagikan:', error));
                                    } else {
                                        navigator.clipboard.writeText(link);
                                        alert('📋 Link produk telah disalin ke clipboard!');
                                    }
                                }
                            </script>

                            <!-- Rating dengan animasi -->
                            {{-- <div class="flex items-center space-x-2">
                                <div class="flex text-yellow-400 animate-pulse">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 fill-current transition-all duration-200 hover:scale-125"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-sm text-gray-600 font-medium">(4.8 / 150 ulasan)</span>
                            </div> --}}

                            <!-- Deskripsi dengan card style -->
                            <div
                                class="bg-gradient-to-r from-gray-50 to-slate-50 rounded-xl p-2.5 border border-gray-200/60 shadow-inner">
                                <p class="text-gray-700 leading-relaxed">{{ $produk->deskripsi }}</p>
                            </div>

                            <!-- Harga dengan efek premium -->
                            <div
                                class="bg-gradient-to-r from-emerald-50 via-green-50 to-teal-50 rounded-xl p-4 border-2 border-emerald-200/70 shadow-lg">
                                <div class="flex items-end space-x-3">
                                    <p class="text-3xl font-bold text-emerald-600 drop-shadow-sm">
                                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                    </p>
                                    <p class="text-lg text-gray-500 line-through mb-1 font-semibold">
                                        Rp 59.000
                                    </p>
                                </div>
                                <div class="mt-3 flex items-center space-x-2">
                                    <span
                                        class="inline-flex items-center bg-gradient-to-r from-red-500 to-pink-500 text-white text-sm font-bold px-3 py-1 rounded-full shadow-lg animate-bounce">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        Hemat 37%
                                    </span>
                                    <span class="text-sm text-gray-600 font-semibold animate-pulse">
                                        Diskon Terbatas!
                                    </span>
                                </div>
                            </div>

                            <!-- Fitur Produk dengan grid yang lebih rapi -->
                            <div class="grid grid-cols-2 gap-3">
                                <div
                                    class="flex items-center space-x-3 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-1 border border-blue-200/50 shadow-md hover:shadow-lg transition-all duration-300">
                                    <svg class="w-6 h-6 ml-6 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-sm font-semibold text-gray-700">Original 100%</span>
                                </div>
                                <div
                                    class="flex items-center space-x-2 bg-gradient-to-r from-purple-50 to-violet-50 rounded-lg p-3 border border-purple-200/50 shadow-md hover:shadow-lg transition-all duration-300">
                                    <svg class="w-6 h-6 ml-6 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm font-semibold text-gray-700">Gratis Ongkir</span>
                                </div>
                            </div>

                            <!-- Tombol Aksi dengan efek premium -->
                            <div class="space-y-3">
                                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                                    @auth
                                        <form action="{{ route('keranjang.tambah', $produk->id) }}" method="POST"
                                            class="flex-1">
                                            @csrf
                                            <button type="submit"
                                                class="w-full bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-white px-6 py-3 rounded-lg font-semibold text-base shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center space-x-2 group">
                                                <svg class="w-5 h-5 group-hover:animate-bounce" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                                    </path>
                                                </svg>
                                                <span>Tambah ke Keranjang</span>
                                            </button>
                                        </form>
                                        <a href="{{ route('checkout') }}?id={{ $produk->id }}&jumlah=1"
                                            class="flex-1 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 text-white px-4 py-2 rounded-lg font-semibold text-base shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center space-x-2 group">
                                            <svg class="w-5 h-5 group-hover:animate-pulse" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                            </svg>
                                            <span>Beli Sekarang</span>
                                        </a>
                                    @endauth
                                    @guest
                                        <button @click="authOpen = true; isLogin = true"
                                            class="flex-1 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-white px-6 py-3 rounded-lg font-semibold text-base shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center space-x-2 group">
                                            <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                            <span>Tambah ke Keranjang</span>
                                        </button>

                                        <button @click="authOpen = true; isLogin = true"
                                            class="flex-1 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 text-white px-6 py-3 rounded-lg font-semibold text-base shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center space-x-2 group">
                                            <svg class="w-5 h-5 group-hover:animate-pulse" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                            </svg>
                                            <span>Beli Sekarang</span>
                                        </button>
                                    @endguest

                                </div>
                                @if ($produk->user && $produk->user->no_waSeller)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $produk->user->no_waSeller) }}?text=Halo%20{{ urlencode($produk->user->name) }},%20saya%20tertarik%20dengan%20produk%20{{ urlencode($produk->nama) }}%20yang%20Anda%20jual."
                                        target="_blank"
                                        class="block w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white px-6 py-3 rounded-lg font-semibold text-base text-center shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center space-x-2 group mt-2">
                                        <svg class="w-5 h-5 group-hover:animate-bounce" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 2a10 10 0 00-8.94 13.89L2 22l6.22-1.63A9.96 9.96 0 0012 22a10 10 0 000-20zm5.2 14.41c-.22.62-1.26 1.17-1.73 1.24-.47.07-1.06.1-1.71-.11a8.7 8.7 0 01-3.04-1.75A10.83 10.83 0 017.3 12a5.57 5.57 0 01-.83-2.86c0-.76.24-1.49.56-2.1.13-.24.27-.47.43-.7.26-.34.52-.41.7-.41h.52c.17 0 .39 0 .6.46.21.46.72 1.8.79 1.93.07.13.12.28.02.45-.1.17-.15.28-.29.43-.13.15-.28.34-.4.46-.13.15-.27.3-.12.56.15.26.67 1.1 1.43 1.77a9.06 9.06 0 002.2 1.38c.26.13.42.11.58-.07.17-.18.67-.79.85-1.06.18-.28.36-.23.6-.14.24.09 1.56.73 1.83.86.26.13.43.2.49.31.07.11.07.64-.15 1.26z" />
                                        </svg>
                                        <span>Chat Seller</span>
                                    </a>
                                @else
                                    <button disabled
                                        class="block w-full bg-gray-400 text-white px-6 py-3 rounded-lg font-semibold text-base text-center shadow cursor-not-allowed mt-2">
                                        Nomor WhatsApp belum tersedia
                                    </button>
                                @endif



                            </div>
                        </div>

                        <!-- Info tambahan dengan ikon yang lebih besar -->
                        <div
                            class="flex items-center justify-center space-x-6 text-sm text-gray-600 pt-2 border-t border-gray-200">
                            <div
                                class="flex items-center space-x-1 bg-green-50 rounded-full px-3 py-1 border border-green-200">
                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-semibold">Secure Payment</span>
                            </div>
                            <div
                                class="flex items-center space-x-1 bg-blue-50 rounded-full px-3 py-1 border border-blue-200">
                                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z">
                                    </path>
                                    <path
                                        d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z">
                                    </path>
                                </svg>
                                <span class="font-semibold">Fast Delivery</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
