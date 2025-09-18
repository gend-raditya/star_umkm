<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Star UMKM</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <nav class="bg-indigo-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            {{-- Logo / Home --}}
            <a href="{{ route('landing') }}" class="font-bold text-xl">⭐ Star UMKM</a>

            {{-- Menu --}}
            <div class="space-x-4">
                <a href="{{ route('landing') }}" class="hover:underline">Home</a>
                <a href="{{ route('produk.index') }}" class="hover:underline">Produk</a>
                <a href="{{ route('checkout') }}" class="hover:underline">Keranjang</a>
                <a href="{{ route('pesanan.cek') }}" class="hover:underline">Cek Pesanan</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-6">
        @yield('content')
    </div>
</body>
</html>
