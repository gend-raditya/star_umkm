<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = session()->get('keranjang', []);
        return view('pesanan.cek', compact('keranjang'));
    }

    public function tambah($id)
    {
        $produk = Produk::findOrFail($id);

        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah']++;
        } else {
            $keranjang[$id] = [
                "nama" => $produk->nama,
                "harga" => $produk->harga,
                "jumlah" => 1,
                "gambar" => $produk->gambar,
            ];
        }

        session()->put('keranjang', $keranjang);

        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function hapus($id)
    {
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
        }

        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil dihapus dari keranjang!');
    }
}
