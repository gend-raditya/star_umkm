@extends('layouts.app')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">

                <!-- Kolom Kiri: Galeri Foto -->
                <div class="space-y-4">
                    @if ($produk->fotos->count() > 0)
                        <!-- Main Slider dengan border yang lebih halus -->
                        <div class="swiper swiper-main rounded-xl overflow-hidden shadow-lg border-4 border-gray-100">
                            <div class="swiper-wrapper">
                                @foreach ($produk->fotos as $foto)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/' . $foto->path) }}"
                                             class="w-full h-96 object-cover"
                                             alt="Foto {{ $produk->nama }}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next bg-white/90 rounded-full w-10 h-10 shadow-lg after:text-sm after:font-bold after:text-gray-800"></div>
                            <div class="swiper-button-prev bg-white/90 rounded-full w-10 h-10 shadow-lg after:text-sm after:font-bold after:text-gray-800"></div>
                        </div>

                        <!-- Thumbnail Slider dengan hover effect -->
                        <div class="swiper swiper-thumbs">
                            <div class="swiper-wrapper">
                                @foreach ($produk->fotos as $foto)
                                    <div class="swiper-slide cursor-pointer">
                                        <img src="{{ asset('storage/' . $foto->path) }}"
                                             class="w-full h-24 object-cover rounded-lg border-2 border-gray-200 hover:border-indigo-500 transition-all duration-300 hover:shadow-md"
                                             alt="Thumbnail {{ $produk->nama }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="rounded-xl overflow-hidden shadow-lg">
                            <img src="{{ asset('images/default.png') }}"
                                 class="w-full h-96 object-cover"
                                 alt="Default">
                        </div>
                    @endif
                </div>

                <!-- Kolom Kanan: Info Produk -->
                <div class="flex flex-col justify-between">
                    <div class="space-y-6">
                        <!-- Header Produk -->
                        <div class="space-y-3">
                            <div class="flex items-start justify-between">
                                <h1 class="text-4xl font-bold text-gray-900 leading-tight">
                                    {{ $produk->nama }}
                                </h1>
                                <button class="text-gray-400 hover:text-red-500 transition-colors duration-200">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Rating (opsional) -->
                            <div class="flex items-center space-x-2">
                                <div class="flex text-yellow-400">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-600">(4.8 / 150 ulasan)</span>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <p class="text-gray-700 leading-relaxed">{{ $produk->deskripsi }}</p>
                        </div>

                        <!-- Harga dengan styling lebih menarik -->
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border-2 border-green-200">
                            <div class="flex items-end space-x-3">
                                <p class="text-4xl font-bold text-green-600">
                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </p>
                                <p class="text-lg text-gray-500 line-through mb-1">
                                    Rp 199.000
                                </p>
                            </div>
                            <div class="mt-3 flex items-center space-x-2">
                                <span class="inline-flex items-center bg-red-500 text-white text-sm font-bold px-3 py-1 rounded-full shadow-md">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    Hemat 57%
                                </span>
                                <span class="text-sm text-gray-600 font-medium">
                                    Diskon Terbatas!
                                </span>
                            </div>
                        </div>

                        <!-- Fitur Produk -->
                        <div class="grid grid-cols-2 gap-3">
                            <div class="flex items-center space-x-2 bg-blue-50 rounded-lg p-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Original 100%</span>
                            </div>
                            <div class="flex items-center space-x-2 bg-purple-50 rounded-lg p-3">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">Gratis Ongkir</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi dengan styling yang lebih modern -->
                    <div class="mt-8 space-y-4">
                        <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                            @auth
                                <form action="{{ route('keranjang.tambah', $produk->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center space-x-2">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <span>Tambah ke Keranjang</span>
                                    </button>
                                </form>
                                <a href="{{ route('checkout') }}?id={{ $produk->id }}&jumlah=1"
                                   class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center space-x-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    <span>Beli Sekarang</span>
                                </a>
                            @endauth
                            @guest
                                <a href="{{ route('register') }}"
                                   class="flex-1 bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center space-x-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span>Tambah ke Keranjang</span>
                                </a>
                                <a href="{{ route('register') }}"
                                   class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center space-x-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    <span>Beli Sekarang</span>
                                </a>
                            @endguest
                        </div>

                        <!-- Info tambahan -->
                        <div class="flex items-center justify-center space-x-6 text-sm text-gray-600 pt-2">
                            <div class="flex items-center space-x-1">
                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Secure Payment</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"></path>
                                </svg>
                                <span>Fast Delivery</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
