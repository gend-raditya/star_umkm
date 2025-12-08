@extends('layouts.app')

@section('content')
    <div class="p-6 bg-white rounded-lg shadow mt-20">
        <h1 class="text-2xl font-bold mb-4 pt-10">Dashboard Admin</h1>

        <p>Selamat datang di dashboard admin ⭐</p>

        <div class="grid grid-cols-3 gap-4 mt-6">
            <a href="{{ route('admin.produk.index') }}"
                class="p-4 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
                Kelola Produk
            </a>
            <a href="{{ route('admin.kategori.index') }}"
                class="p-4 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">
                Kelola Kategori
            </a>
            <a href="{{ route('admin.pesanan.index') }}"
                class="p-4 bg-yellow-600 text-white rounded-lg shadow hover:bg-yellow-700">
                Kelola Pesanan
            </a>
            <a href="{{ route('admin.sellers.index') }}"
                class="p-4 bg-purple-600 text-white rounded-lg shadow hover:bg-purple-700">
                Kelola Akun Seller
            </a>
            <a href="{{ route('admin.sellers.approved') }}"
                class="p-4 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                Daftar Seller Aktif
            </a>

            <a href="{{ route('admin.transaksi.index') }}"
                class="p-4 bg-red-600 text-white rounded-lg shadow hover:bg-red-700">
                Lihat Semua Transaksi
            </a>

        </div>
    </div>
@endsection
