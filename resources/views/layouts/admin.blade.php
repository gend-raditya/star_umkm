<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Star UMKM</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between">
            <span class="font-bold">Admin Star UMKM</span>
            <div>
                <a href="{{ route('admin.produk.index') }}" class="mr-4">Produk</a>
                <a href="{{ route('admin.kategori.index') }}" class="mr-4">Kategori</a>
                <a href="{{ route('admin.pesanan.index') }}">Pesanan</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto pt-20">
    @yield('content')
</div>

</body>
</html>
