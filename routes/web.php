<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\Admin\AdminProdukController;
use App\Http\Controllers\Admin\AdminKategoriController;
use App\Http\Controllers\Admin\AdminPesananController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Auth\AdminLoginController;


Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('produk', AdminProdukController::class);
    Route::resource('kategori', AdminKategoriController::class);
    Route::resource('pesanan', AdminPesananController::class);
});

// Landing Page
Route::get('/', [LandingPageController::class, 'index'])->name('landing');

// alias ke landing, biar 'home' tetap ada
Route::get('/home', [LandingPageController::class, 'index'])->name('home');

// User - Produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/kategori/{id}', [ProdukController::class, 'byKategori'])->name('produk.kategori');
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');

// User - Pesanan
Route::post('/keranjang/tambah', [PesananController::class, 'tambahKeranjang'])->name('keranjang.tambah');
Route::get('/checkout', [PesananController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [PesananController::class, 'prosesCheckout'])->name('checkout.proses');
Route::get('/pesanan/cek', [PesananController::class, 'cekPesanan'])->name('pesanan.cek');

// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('produk', AdminProdukController::class);
    Route::resource('kategori', AdminKategoriController::class);
    Route::resource('pesanan', AdminPesananController::class);
});
