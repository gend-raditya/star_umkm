<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class PesananController extends Controller
{
    // Tambah produk ke keranjang (pakai session)
    public function tambahKeranjang(Request $request)
    {
        $produk = Produk::findOrFail($request->produk_id);

        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$produk->id])) {
            $keranjang[$produk->id]['jumlah']++;
        } else {
            $keranjang[$produk->id] = [
                "nama" => $produk->nama,
                "harga" => $produk->harga,
                "jumlah" => 1,
            ];
        }

        session()->put('keranjang', $keranjang);

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    // Halaman checkout
    public function checkout()
    {
        $keranjang = session()->get('keranjang', []);
        return view('pesanan.checkout', compact('keranjang'));
    }

    // Proses checkout
    public function prosesCheckout(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        $keranjang = session()->get('keranjang', []);
        if (empty($keranjang)) {
            return redirect()->back()->with('error', 'Keranjang kosong');
        }

        $total = collect($keranjang)->sum(fn($item) => $item['harga'] * $item['jumlah']);
        $invoice = 'INV-' . strtoupper(Str::random(6));

        $pesanan = Pesanan::create([
            'invoice' => $invoice,
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'total' => $total,
            'status' => 'Diproses',
        ]);

        foreach ($keranjang as $id => $item) {
            DetailPesanan::create([
                'pesanan_id' => $pesanan->id,
                'produk_id' => $id,
                'jumlah' => $item['jumlah'],
                'subtotal' => $item['harga'] * $item['jumlah'],
            ]);
        }

        session()->forget('keranjang');

        return redirect()->route('pesanan.cek')->with('success', 'Pesanan berhasil dibuat! Invoice: ' . $invoice);
    }

    // Cek status pesanan
    public function cekPesanan(Request $request)
    {
        $pesanan = null;

        if ($request->has('invoice')) {
            $pesanan = Pesanan::where('invoice', $request->invoice)->with('details.produk')->first();
        }

        return view('pesanan.cek', compact('pesanan'));
    }

    // Admin - daftar pesanan
    public function index()
    {
        $pesanans = Pesanan::latest()->paginate(15);
        return view('admin.pesanan.index', compact('pesanans'));
    }

    // Admin - ubah status pesanan
    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status pesanan diperbarui!');
    }
}
