@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-teal-50/50 to-orange-50/50">

    <div class="relative overflow-hidden">
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-stone-800 tracking-tight mb-4 animate-fade-in-down">
                Karya & Rasa <span class="text-orange-600">Nusantara</span>
            </h1>
            <p class="mt-4 max-w-2xl mx-auto text-lg text-stone-600 animate-fade-in-up">
                Menjelajahi kekayaan produk UMKM lokal terbaik.
            </p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">

        <div class="flex flex-wrap justify-center gap-3 mb-10 animate-fade-in">
            <button onclick="filterGallery('all')" class="filter-btn active px-5 py-2 rounded-full text-sm font-semibold transition-all duration-300 bg-orange-600 text-white shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                Semua
            </button>
            <button onclick="filterGallery('makanan')" class="filter-btn px-5 py-2 rounded-full text-sm font-semibold transition-all duration-300 bg-white/60 backdrop-blur-sm text-stone-600 hover:bg-orange-50 hover:text-orange-600 shadow-sm border border-stone-200/50">
                Makanan
            </button>
            <button onclick="filterGallery('minuman')" class="filter-btn px-5 py-2 rounded-full text-sm font-semibold transition-all duration-300 bg-white/60 backdrop-blur-sm text-stone-600 hover:bg-orange-50 hover:text-orange-600 shadow-sm border border-stone-200/50">
                Minuman
            </button>
            <button onclick="filterGallery('kerajinan')" class="filter-btn px-5 py-2 rounded-full text-sm font-semibold transition-all duration-300 bg-white/60 backdrop-blur-sm text-stone-600 hover:bg-orange-50 hover:text-orange-600 shadow-sm border border-stone-200/50">
                Kerajinan
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6" id="gallery-grid">
            @php
                // Data Dummy
                $products = [
                    [
                        'category' => 'makanan',
                        'title' => 'Keripik Balado',
                        'desc' => 'Pedas manis khas Bukittinggi.',
                        'image' => 'https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?auto=format&fit=crop&q=80&w=600',
                    ],
                    [
                        'category' => 'kerajinan',
                        'title' => 'Tas Rotan',
                        'desc' => 'Anyaman presisi & estetik.',
                        'image' => 'https://images.unsplash.com/photo-1569388330292-79cc1ec67270?auto=format&fit=crop&q=80&w=600',
                    ],
                    [
                        'category' => 'minuman',
                        'title' => 'Kopi Gayo',
                        'desc' => 'Aroma kuat khas Aceh.',
                        'image' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&q=80&w=600',
                    ],
                    [
                        'category' => 'makanan',
                        'title' => 'Rendang Sapi',
                        'desc' => 'Bumbu rempah asli Padang.',
                        'image' => 'https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?auto=format&fit=crop&q=80&w=600',
                    ],
                    [
                        'category' => 'kerajinan',
                        'title' => 'Kain Tenun',
                        'desc' => 'Motif warisan budaya.',
                        'image' => 'https://images.unsplash.com/photo-1606293926075-69a00db75321?auto=format&fit=crop&q=80&w=600',
                    ],
                    [
                        'category' => 'minuman',
                        'title' => 'Jamu Herbal',
                        'desc' => 'Sehat dan menyegarkan.',
                        'image' => 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?auto=format&fit=crop&q=80&w=600',
                    ],
                ];
            @endphp

            @foreach($products as $index => $item)
                <div class="gallery-item group relative h-64 rounded-xl overflow-hidden cursor-pointer shadow-sm hover:shadow-xl transition-all duration-500" data-category="{{ $item['category'] }}">

                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-300"></div>

                    <div class="absolute top-3 left-3">
                        <span class="px-2 py-0.5 bg-white/20 backdrop-blur-md border border-white/30 text-white text-[10px] font-bold uppercase tracking-wider rounded-full">
                            {{ $item['category'] }}
                        </span>
                    </div>

                    <div class="absolute bottom-0 left-0 right-0 p-5 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                        <h3 class="text-lg font-bold text-white mb-1 leading-tight">{{ $item['title'] }}</h3>
                        <p class="text-gray-200 text-xs opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-75 line-clamp-1">
                            {{ $item['desc'] }}
                        </p>
                        <div class="mt-3 pt-3 border-t border-white/20 flex items-center justify-between opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-150">
                            <span class="text-orange-300 text-xs font-medium">Lihat Detail</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div id="empty-state" class="hidden text-center py-20">
            <p class="text-stone-500 text-lg">Tidak ada produk ditemukan.</p>
        </div>
    </div>
</div>

<script>
    function filterGallery(category) {
        const items = document.querySelectorAll('.gallery-item');
        const buttons = document.querySelectorAll('.filter-btn');
        const emptyState = document.getElementById('empty-state');
        let visibleCount = 0;

        buttons.forEach(btn => {
            if (btn.textContent.toLowerCase().includes(category === 'all' ? 'semua' : category)) {
                btn.classList.remove('bg-white/60', 'text-stone-600', 'shadow-sm', 'border');
                btn.classList.add('bg-orange-600', 'text-white', 'shadow-md');
            } else {
                btn.classList.add('bg-white/60', 'text-stone-600', 'shadow-sm', 'border');
                btn.classList.remove('bg-orange-600', 'text-white', 'shadow-md');
            }
        });

        items.forEach(item => {
            const itemCategory = item.getAttribute('data-category');
            item.style.opacity = '0';
            item.style.transform = 'scale(0.95)';
            setTimeout(() => {
                if (category === 'all' || itemCategory === category) {
                    item.style.display = 'block';
                    setTimeout(() => { item.style.opacity = '1'; item.style.transform = 'scale(1)'; }, 50);
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
                if (visibleCount === 0) emptyState.classList.remove('hidden');
                else emptyState.classList.add('hidden');
            }, 300);
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const items = document.querySelectorAll('.gallery-item');
        items.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(20px)';
            setTimeout(() => {
                item.style.transition = 'all 0.6s ease-out';
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>

<style>
    @keyframes fade-in-down { 0% { opacity: 0; transform: translateY(-20px); } 100% { opacity: 1; transform: translateY(0); } }
    @keyframes fade-in-up { 0% { opacity: 0; transform: translateY(20px); } 100% { opacity: 1; transform: translateY(0); } }
    .animate-fade-in-down { animation: fade-in-down 0.8s ease-out forwards; }
    .animate-fade-in-up { animation: fade-in-up 0.8s ease-out forwards; }
</style>
@endsection
