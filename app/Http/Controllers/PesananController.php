<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Keranjang;

class PesananController extends Controller
{
    // 👉 Tambah ke Keranjang
    public function tambahKeranjang(Request $request, $id)
    {
        // Cari produk berdasarkan ID
        $produk = Produk::findOrFail($id);

        // Simpan ke keranjang (contoh pake session / tabel keranjang)
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            // kalau produk sudah ada, tambahkan qty
            $keranjang[$id]['qty']++;
        } else {
            // kalau produk belum ada, masukkan baru
            $keranjang[$id] = [
                "nama"   => $produk->nama,
                "harga"  => $produk->harga,
                "gambar" => $produk->gambar,
                "qty"    => 1
            ];
        }

        session()->put('keranjang', $keranjang);

        // Redirect ke halaman checkout
        return redirect()->route('checkout')
                         ->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // 👉 Halaman Checkout
    public function checkout()
    {
        $keranjang = session('keranjang', []);
        return view('pesanan.checkout', compact('keranjang'));
    }

    // 👉 Proses Checkout
    public function prosesCheckout(Request $request)
    {
        // proses simpan ke DB pesanan nanti di sini
        session()->forget('keranjang');

        return redirect()->route('checkout.index')
                         ->with('success', 'Pesanan berhasil dibuat!');
    }

    // 👉 Cek Pesanan
    public function cekPesanan()
    {
        return view('pesanan.cek');
    }
}
