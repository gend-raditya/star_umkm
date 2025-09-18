<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Star UMKM') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
                <a href="{{ url('/') }}" class="text-lg font-bold text-indigo-600">⭐ Star UMKM</a>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('produk.index') }}" class="hover:underline">Produk</a>

                    @auth
                        <a href="{{ route('checkout') }}" class="hover:underline">Keranjang</a>
                        <span class="text-gray-700">Halo, {{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-500 hover:underline">Logout</button>
                        </form>
                    @else
                        <!-- Guest -->
                        <a href="{{ route('checkout') }}" class="hover:underline">Keranjang</a>
                        <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Login</a>
                        <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Register</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Page Heading (optional) -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-800 shadow mt-auto">
            <div class="max-w-7xl mx-auto px-4 py-4 text-center text-gray-600 dark:text-gray-300">
                &copy; {{ date('Y') }} Star UMKM. All rights reserved.
            </div>
        </footer>
    </div>
</body>
</html>
