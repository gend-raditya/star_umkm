@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-teal-50/50 to-orange-50/50 overflow-x-hidden">

    <div class="relative pt-20 pb-16 sm:pt-16 sm:pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-orange-600 font-semibold tracking-wider uppercase text-sm animate-fade-in-down">Tentang Kami</span>
            <h1 class="mt-3 text-4xl sm:text-5xl md:text-6xl font-extrabold text-stone-800 tracking-tight animate-fade-in-down" style="animation-delay: 100ms;">
                Menghubungkan <span class="text-teal-600">Karya</span>, <br class="hidden sm:block" />
                Merayakan <span class="text-orange-600">Rasa</span>.
            </h1>
            <p class="mt-6 max-w-2xl mx-auto text-lg text-stone-600 leading-relaxed animate-fade-in-up" style="animation-delay: 200ms;">
                Star UMKM hadir sebagai jembatan bagi para pengrajin dan pegiat kuliner lokal untuk memperkenalkan warisan nusantara ke panggung yang lebih luas.
            </p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-40">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <div class="relative animate-fade-in-right">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl transform rotate-2 hover:rotate-0 transition-transform duration-500">
                    <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?auto=format&fit=crop&q=80&w=800" alt="Kuliner Nusantara" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-white">
                        <p class="font-bold text-xl">Kuliner Otentik</p>
                        <p class="text-sm opacity-90">Resep turun temurun</p>
                    </div>
                </div>

                <div class="absolute -bottom-10 -right-10 w-48 h-48 sm:w-64 sm:h-64 rounded-2xl overflow-hidden shadow-xl border-4 border-white transform -rotate-3 hover:rotate-0 transition-transform duration-500 hidden sm:block">
                    <img src="https://images.unsplash.com/photo-1606293926075-69a00db75321?auto=format&fit=crop&q=80&w=600" alt="Kerajinan Tangan" class="w-full h-full object-cover">
                </div>
            </div>

            <div class="lg:pl-10 animate-fade-in-left">
                <h2 class="text-3xl font-bold text-stone-800 mb-6">Berawal dari Semangat Tetangga</h2>
                <div class="prose prose-stone text-stone-600 space-y-4">
                    <p>
                        Berdiri sejak tahun 2024, Star UMKM dimulai dari sebuah inisiatif sederhana: membantu tetangga sekitar yang memiliki produk luar biasa namun kesulitan menjangkau pasar.
                    </p>
                    <p>
                        Kami percaya bahwa di balik sepotong keripik singkong atau sehelai kain tenun, terdapat cerita perjuangan, tradisi, dan cinta yang mendalam. Misi kami bukan sekadar menjual produk, tetapi menceritakan kisah-kisah tersebut kepada Anda.
                    </p>
                    <p class="font-semibold text-teal-700 italic">
                        "Setiap produk yang Anda beli adalah dukungan langsung bagi keberlangsungan ekonomi keluarga lokal."
                    </p>
                </div>

                <div class="mt-8 grid grid-cols-3 gap-4 border-t border-stone-200 pt-8">
                    <div>
                        <span class="block text-3xl font-bold text-orange-600">50+</span>
                        <span class="text-sm text-stone-500">Mitra UMKM</span>
                    </div>
                    <div>
                        <span class="block text-3xl font-bold text-teal-600">100+</span>
                        <span class="text-sm text-stone-500">Jenis Produk</span>
                    </div>
                    <div>
                        <span class="block text-3xl font-bold text-stone-700">1k+</span>
                        <span class="text-sm text-stone-500">Pelanggan Puas</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    @keyframes fade-in-down {
        0% { opacity: 0; transform: translateY(-20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    @keyframes fade-in-up {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    @keyframes fade-in-right {
        0% { opacity: 0; transform: translateX(-30px); }
        100% { opacity: 1; transform: translateX(0); }
    }
    @keyframes fade-in-left {
        0% { opacity: 0; transform: translateX(30px); }
        100% { opacity: 1; transform: translateX(0); }
    }
    .animate-fade-in-down { animation: fade-in-down 0.8s ease-out forwards; }
    .animate-fade-in-up { animation: fade-in-up 0.8s ease-out forwards; }
    .animate-fade-in-right { animation: fade-in-right 0.8s ease-out forwards; }
    .animate-fade-in-left { animation: fade-in-left 0.8s ease-out forwards; }
</style>
@endsection
