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
use App\Http\Controllers\Admin\AdminSellerController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SellerProdukController;
use App\Http\Controllers\SellerPesananController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Admin\AdminTransaksiController;
use App\Http\Controllers\AlamatController;



// ==================== Landing Page ====================
Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::get('/home', [LandingPageController::class, 'index'])->name('home');
Route::get('/galeri', [LandingPageController::class, 'galeri'])->name('galeri');
Route::get('/tentang-kami', [LandingPageController::class, 'tentang'])->name('tentang');

// ==================== Produk & Kategori ====================
//cari produk
Route::get('/produk/search', [ProdukController::class, 'search'])->name('produk.search');

Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
Route::get('/kategori/{id}', [ProdukController::class, 'byKategori'])->name('produk.kategori');

// ==================== Keranjang ====================
Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
Route::post('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');

// ==================== Pesanan & Checkout ====================
Route::middleware(['auth'])->group(function () {
    // Halaman checkout (isi keranjang)
    Route::get('/checkout', [PesananController::class, 'checkout'])->name('checkout');
    // Proses pembayaran Midtrans
    Route::post('/checkout/proses', [PesananController::class, 'prosesCheckout'])->name('pesanan.prosesCheckout');
    // Halaman sukses setelah bayar
    Route::get('/pesanan/success', [PesananController::class, 'success'])->name('pesanan.success');
    // Lihat semua pesanan user
    Route::get('/pesanan/saya', [PesananController::class, 'pesananSaya'])->name('pesanan.saya');
    Route::get('/pesanan/{id}/detail', [PesananController::class, 'detailPesanan'])->name('pesanan.detail');

    //riwayat pesanan
    Route::get('/riwayat-pesanan', [PesananController::class, 'riwayat'])
        ->name('user.riwayat.pesanan');


    //seller
    // Route::post('/seller/register', [SellerController::class, 'register'])->name('seller.register');

    Route::patch('/seller/produk/{id}/stok', [SellerProdukController::class, 'updateStok'])
        ->name('seller.produk.updateStok');





    // ==================== Seller Routes ====================
    Route::prefix('seller')->name('seller.')->middleware(['auth'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [SellerController::class, 'index'])->name('dashboard');

        // Produk Seller
        Route::get('/produk', [SellerProdukController::class, 'index'])->name('produk.index');
        Route::get('/produk/create', [SellerProdukController::class, 'create'])->name('produk.create');
        Route::post('/produk', [SellerProdukController::class, 'store'])->name('produk.store');
        Route::get('/produk/{id}/edit', [SellerProdukController::class, 'edit'])->name('produk.edit');
        Route::put('/produk/{id}', [SellerProdukController::class, 'update'])->name('produk.update');
        Route::delete('/produk/{id}', [SellerProdukController::class, 'destroy'])->name('produk.destroy');

        // Pesanan Seller
        Route::get('/pesanan', [SellerPesananController::class, 'index'])->name('pesanan.index');
        Route::get('/pesanan/{id}/edit', [SellerPesananController::class, 'edit'])->name('pesanan.edit'); // ← untuk view edit.blade.php
        Route::post('/pesanan/{id}/update', [SellerPesananController::class, 'update'])->name('pesanan.update'); // ← untuk update status + lokasi terakhir

        Route::patch('/pesanan/{id}/update-resi', [SellerPesananController::class, 'updateResi'])
            ->name('pesanan.updateResi');
    });
});
//isi data seller
Route::middleware(['auth'])->group(function () {

    // 2. Route untuk menampilkan form
    Route::get('/seller/register', [SellerController::class, 'create'])->name('seller.create');

    // 3. Route untuk memproses form (Simpan Data)
    // Pastikan ini satu-satunya POST ke /seller/register
    Route::post('/seller/register', [SellerController::class, 'store'])->name('seller.store');
});

// Cek status pesanan (tanpa login)
Route::get('/pesanan/cek', [PesananController::class, 'cekPesanan'])->name('pesanan.cek');

// Midtrans callback (notifikasi server)
Route::post('/midtrans/callback', [PesananController::class, 'callback'])->name('midtrans.callback');

// ==================== Checkout Satu Produk ====================
Route::get('/checkout/single', [PesananController::class, 'checkoutSinglePage'])->name('checkout.single');
Route::post('/checkout/single/process', [PesananController::class, 'checkoutSingleProcess'])->name('checkout.single.process');

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



// ==================== Breeze Auth (User) ====================
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.password');

// Halaman Update Password
Route::middleware(['auth'])->get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.password');


//Mengurangi Produk dari Keranjang
Route::post('/keranjang/kurangi/{id}', [KeranjangController::class, 'kurangi'])->name('keranjang.kurangi');
Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
Route::post('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');

Route::post('/pesanan/proses', [PesananController::class, 'prosesCheckout'])->name('pesanan.proses');

//pilih produk yg akan dicheckout
Route::post('/checkout/pilih', [KeranjangController::class, 'checkoutPilih'])->name('checkout.pilih');

//seller routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/sellers', [AdminSellerController::class, 'index'])->name('admin.sellers.index');
    Route::post('/admin/sellers/{id}/approve', [AdminSellerController::class, 'approve'])->name('admin.sellers.approve');
    Route::post('/admin/sellers/{id}/reject', [AdminSellerController::class, 'reject'])->name('admin.sellers.reject');
    // Menampilkan daftar transaksi
    Route::get('/admin/transaksi', [AdminTransaksiController::class, 'index'])
        ->name('admin.transaksi.index');

    // Menampilkan detail transaksi
    Route::get('/admin/transaksi/{id}', [AdminTransaksiController::class, 'show'])
        ->name('admin.transaksi.show');
});

//dashboar user
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});



Route::get('/alamat/provinsi', [AlamatController::class, 'getProvinsi']);
Route::get('/alamat/kota/{idProvinsi}', [AlamatController::class, 'getKota']);
Route::get('/alamat/kecamatan/{idKota}', [AlamatController::class, 'getKecamatan']);
Route::get('/alamat/kelurahan/{idKecamatan}', [AlamatController::class, 'getKelurahan']);

//melihat daftar seller
Route::get('/admin/sellers/approved', [AdminSellerController::class, 'approved'])
    ->name('admin.sellers.approved')
    ->middleware('admin');


//notif ke midtrans
Route::post('/midtrans/callback', [PesananController::class, 'callback']);


//batalkan pesanan
Route::put('/pesanan/{id}/batalkan', [PesananController::class, 'batalkan'])
    ->name('pesanan.batalkan');



// ==================== Auth Routes (Breeze Default) ====================
require __DIR__ . '/auth.php';


Route::post('/notif/hide-pending', function () {
    session(['hide_pending_notif' => true]);
    return response()->json(['success' => true]);
})->name('notif.hidePending')->middleware('auth');
