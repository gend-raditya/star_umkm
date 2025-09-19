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

        $item = Keranjang::firstOrCreate(
            ['user_id' => $user->id, 'produk_id' => $produk->id],
            ['jumlah' => 0]
        );

        $item->increment('jumlah'); // tambah qty
        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
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
}
