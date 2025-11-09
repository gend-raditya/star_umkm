<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $keranjang = Keranjang::with('produk')->where('user_id', $user->id)->get();
        return view('pesanan.cek', compact('keranjang'));
    }

    public function tambah($id)
    {
        $user = Auth::user();
        $produk = Produk::findOrFail($id);

        // Cek apakah produk sudah ada di keranjang
        $item = Keranjang::firstOrCreate(
            ['user_id' => $user->id, 'produk_id' => $produk->id],
            ['jumlah' => 0]
        );

        // Tambah jumlah produk
        $item->increment('jumlah');

        // Hitung ulang jumlah total item di keranjang
        $count = Keranjang::where('user_id', $user->id)->sum('jumlah');
        session(['keranjang_count' => $count]);

        return redirect()->route('keranjang.index')
            ->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function hapus($id)
    {
        $user = Auth::user();
        $item = Keranjang::where('user_id', $user->id)
            ->where('produk_id', $id)
            ->first();

        if ($item) $item->delete();

        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    public function kurangi($id)
    {
        $user = Auth::user();

        $item = Keranjang::where('user_id', $user->id)
            ->where('produk_id', $id)
            ->first();

        if ($item) {
            if ($item->jumlah > 1) {
                $item->decrement('jumlah');
            } else {
                $item->delete(); // kalau tinggal 1 dan dikurangi, otomatis dihapus
            }
        }

        // Update ulang jumlah di session
        $count = Keranjang::where('user_id', $user->id)->sum('jumlah');
        session(['keranjang_count' => $count]);

        return redirect()->route('keranjang.index')->with('success', 'Jumlah produk diperbarui!');
    }

    public function checkoutPilih(Request $request)
    {
        $user = Auth::user();
        $produkIds = $request->input('produk_id', []);

        if (empty($produkIds)) {
            return redirect()->route('keranjang.index')->with('error', 'Pilih minimal satu produk untuk checkout.');
        }

        $keranjang = Keranjang::with('produk')
            ->where('user_id', $user->id)
            ->whereIn('produk_id', $produkIds)
            ->get();

        return view('pesanan.checkout', compact('keranjang'));
    }
}
