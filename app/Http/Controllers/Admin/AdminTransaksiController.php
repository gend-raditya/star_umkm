<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class AdminTransaksiController extends Controller
{
    // Menampilkan semua transaksi
    public function index()
    {
        $transaksi = Pesanan::with(['user'])->latest()->get();
        return view('admin.transaksi.index', compact('transaksi'));
    }

    // Menampilkan detail transaksi
    public function show($id)
    {
        $pesanan = Pesanan::with(['items.produk', 'user'])->findOrFail($id);
        return view('admin.transaksi.show', compact('pesanan'));
    }
}
