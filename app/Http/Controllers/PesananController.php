<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use App\Models\Keranjang;
use App\Services\MidtransService;
use App\Models\Pesanan;

class PesananController extends Controller
{
    // ✅ Checkout (tampilkan data keranjang dari database)
    public function checkout()
    {

        $user = Auth::user();
        $keranjang = Keranjang::with('produk')->where('user_id', $user->id)->get();

        return view('pesanan.checkout', compact('keranjang'));
    }

    // ✅ Proses checkout semua produk dalam keranjang
    public function prosesCheckout(Request $request, MidtransService $midtrans)
    {
        $user = Auth::user();
        $keranjang = Keranjang::with('produk')->where('user_id', $user->id)->get();

        if ($keranjang->isEmpty()) {
            return response()->json(['error' => 'Keranjang kosong!'], 400);
        }

        $totalDatabase = $keranjang->sum(fn($item) => $item->produk->harga * $item->jumlah);

        if ((int)$request->total !== (int)$totalDatabase) {
            return response()->json(['error' => 'Total tidak sesuai!'], 400);
        }

        // ✅ Buat kode invoice unik
        $invoice = 'INV-' . strtoupper(uniqid());

        // ✅ Simpan ke tabel pesanans
        $pesanan = Pesanan::create([
            'user_id' => $user->id,
            'invoice' => $invoice,
            'nama' => $request->nama_pemesan ?? $user->name,
            'no_hp' => $request->telepon,
            'alamat' => $request->alamat,
            'total' => $totalDatabase,
            'status' => 'Diproses',
        ]);

        // ✅ Simpan item ke tabel pesanan_items
        foreach ($keranjang as $item) {
            \App\Models\PesananItem::create([
                'pesanan_id' => $pesanan->id,
                'produk_id'  => $item->produk->id,
                'jumlah'     => $item->jumlah,
                'subtotal'   => $item->produk->harga * $item->jumlah,
            ]);
        }

        // ✅ Kosongkan keranjang user
        Keranjang::where('user_id', $user->id)->delete();

        // ✅ Buat Snap Token Midtrans
        $snapToken = $midtrans->createTransaction(
            $invoice,
            $totalDatabase,
            [
                'first_name' => $request->nama_pemesan ?? $user->name ?? 'Guest',
                'email'      => $user->email ?? 'guest@example.com',
            ]
        );

        return response()->json(['snap_token' => $snapToken]);
    }


    // ✅ Halaman setelah pembayaran berhasil
    public function success()
    {
        $pesanan = Pesanan::orderBy('created_at', 'desc')->get();

        return view('pesanan.success', compact('pesanan'));
    }

    // ✅ Checkout satu produk - tampilkan halaman checkout
    public function checkoutSinglePage($id, $jumlah = 1)
    {
        $produk = Produk::findOrFail($id);
        return view('pesanan.checkout_single', compact('produk', 'jumlah'));
    }

    // ✅ Proses checkout untuk satu produk
    public function checkoutSingleProcess(Request $request, MidtransService $midtrans)
    {
        $produk = Produk::findOrFail($request->produk_id);
        $jumlah = (int)$request->jumlah;
        $total = $produk->harga * $jumlah;

        // Buat Snap Token Midtrans
        $snapToken = $midtrans->createTransaction(
            'ORDER-' . time(),
            $total,
            [
                'first_name' => $request->nama_pemesan ?? 'Guest',
                'email'      => Auth::user()->email ?? 'guest@example.com',
            ]
        );

        return response()->json(['snap_token' => $snapToken]);
    }

    public function pesananSaya()
    {
        $user = Auth::user();

        $pesanans = \App\Models\Pesanan::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pesanan.saya', compact('pesanans'));
    }



    public function detailPesanan($id)
    {
        $pesanan = \App\Models\Pesanan::with(['items.produk'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('pesanan.detail', compact('pesanan'));
    }
}
