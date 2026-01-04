@extends('layouts.app')

@section('content')
    <section class="py-10 relative">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header & Search Bar --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-20">
                <div>
                    <h1 class="text-3xl font-bold text-sage-900">Daftar Produk</h1>
                    <p class="text-stone-600 mt-1">Temukan koleksi terbaik kami di sini</p>
                </div>

                <form action="{{ route('produk.search') }}" method="GET" class="w-full md:w-96">
                    <div class="relative">
                        <input type="text" name="q" placeholder="Cari produk..." value="{{ request('q') }}"
                            class="w-full px-5 py-3 bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition-all shadow-sm">
                        <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-emerald-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18.5a7.5 7.5 0 006.15-3.85z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Products Grid (Style disamakan dengan Landing Page) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse ($produks as $produk)
                    <div class="group relative bg-white/60 glass rounded-2xl overflow-hidden hover:bg-emerald transition-all duration-300 transform hover:-translate-y-2 shadow-xl border-2 border-[rgba(167,196,188,0.95)]">

                        <div class="relative overflow-hidden aspect-square">
                            @if ($produk->fotos->count() > 0)
                                <img src="{{ asset('storage/' . $produk->fotos->first()->path) }}" alt="{{ $produk->nama }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2 l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif

                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <a href="{{ route('produk.show', $produk->id) }}"
                                    class="px-6 py-3 bg-white text-gray-900 rounded-full font-semibold hover:bg-gray-100 transition-colors duration-200 transform scale-95 group-hover:scale-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div class="p-6">
                            {{-- Kategori (Opsional, jika ingin ditampilkan) --}}
                            <div class="mb-2">
                                <span class="text-emerald-400 text-xs font-medium uppercase tracking-wider">
                                    {{ $produk->kategori ? $produk->kategori->nama : 'Produk' }}
                                </span>
                            </div>

                            <h3 class="text-xl font-bold text-[#69B9B7] mb-2 line-clamp-1">
                                {{ $produk->nama }}
                            </h3>

                            <p class="text-[#767480] text-sm mb-4 line-clamp-2">
                                {{ Str::limit($produk->deskripsi ?? 'Produk berkualitas tinggi dengan desain eksklusif.', 80) }}
                            </p>

                            <div class="flex items-center justify-between">
                                <div class="space-y-1">
                                    <div class="text-2xl font-bold bg-gradient-to-r from-emerald-400 to-cyan-400 bg-clip-text text-transparent">
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
                    <div class="col-span-full py-12 text-center">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Produk tidak ditemukan</h3>
                        <p class="text-gray-500">Coba kata kunci pencarian lain.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $produks->links() }}
            </div>

        </div>
    </section>
@endsection
