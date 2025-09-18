<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\Admin\AdminProdukController;
use App\Http\Controllers\Admin\AdminKategoriController;
use App\Http\Controllers\Admin\AdminPesananController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\ProfileController;

// ==================== Landing Page ====================
Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::get('/home', [LandingPageController::class, 'index'])->name('home');

// ==================== Produk & Kategori ====================
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
Route::get('/kategori/{id}', [ProdukController::class, 'byKategori'])->name('produk.kategori');

// ==================== Keranjang ====================
Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
Route::post('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');

// ==================== Pesanan / Checkout ====================
Route::get('/checkout', [PesananController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [PesananController::class, 'prosesCheckout'])->name('checkout.proses');
Route::get('/pesanan/cek', [PesananController::class, 'cekPesanan'])->name('pesanan.cek');

// ==================== Admin Auth ====================
Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// ==================== Admin Panel ====================
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('produk', AdminProdukController::class);
    Route::resource('kategori', AdminKategoriController::class);
    Route::resource('pesanan', AdminPesananController::class);
});

// ==================== Authenticated User Routes (Breeze) ====================
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==================== Breeze Auth ====================
require __DIR__.'/auth.php';
