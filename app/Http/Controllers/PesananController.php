<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use App\Models\Keranjang;
use App\Services\MidtransService;

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

        // Cek kalau keranjang kosong
        if ($keranjang->isEmpty()) {
            return response()->json(['error' => 'Keranjang kosong!'], 400);
        }

        // Hitung total dari database (bukan dari input user)
        $totalDatabase = $keranjang->sum(function ($item) {
            return $item->produk->harga * $item->jumlah;
        });

        // Pastikan request mengirim total
        if (!$request->filled('total')) {
            return response()->json(['error' => 'Total tidak ditemukan dalam request'], 400);
        }

        // Cek validasi total form vs total dari database
        if ((int)$request->total !== (int)$totalDatabase) {
            return response()->json([
                'error' => 'Total tidak sesuai!',
                'total_dari_form' => $request->total,
                'total_hitung_db' => $totalDatabase,
            ], 400);
        }

        // ✅ Buat Snap Token Midtrans
        $snapToken = $midtrans->createTransaction(
            'ORDER-' . time(),
            $totalDatabase,
            [
                'first_name' => $request->nama_pemesan ?? $user->name ?? 'Guest',
                'email'      => $user->email ?? 'guest@example.com',
            ]
        );


        return response()->json(['snap_token' => $snapToken]);
    }

    // ✅ Checkout satu produk langsung dari halaman detail
    // ✅ Checkout satu produk - tampilkan halaman checkout
    // ✅ Checkout satu produk → tampilkan halaman form checkout
    public function checkoutSinglePage($id, $jumlah = 1)
    {
        $produk = Produk::findOrFail($id);
        return view('pesanan.checkout_single', compact('produk', 'jumlah'));
    }

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
}
