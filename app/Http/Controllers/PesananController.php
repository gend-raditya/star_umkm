<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\PesananItem;
use App\Services\MidtransService;

class PesananController extends Controller
{
    /**
     * ✅ Halaman checkout (menampilkan data dari keranjang atau single produk)
     */
    public function checkout(Request $request)
    {
        $user = Auth::user();

        // 🟢 Jika ada parameter id → checkout langsung 1 produk
        if ($request->has('id')) {
            $produk = Produk::findOrFail($request->id);
            $jumlah = $request->jumlah ?? 1;

            $keranjang = collect([
                (object)[
                    'produk' => $produk,
                    'jumlah' => $jumlah,
                    'subtotal' => $produk->harga * $jumlah,
                ]
            ]);
            $total = $produk->harga * $jumlah;
        }

        // 🟢 Jika checkout dari keranjang (pakai pilihan produk)
        elseif ($request->has('produk_id')) {
            $produkIds = $request->input('produk_id', []);
            $jumlahs = $request->input('jumlah', []);

            $keranjang = collect();
            $total = 0;

            foreach ($produkIds as $id) {
                $produk = Produk::findOrFail($id);
                $jumlah = $jumlahs[$id] ?? 1;
                $subtotal = $produk->harga * $jumlah;
                $total += $subtotal;

                $keranjang->push((object)[
                    'produk' => $produk,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal,
                ]);
            }
        }

        // 🟢 Default: tampilkan semua produk di keranjang
        else {
            $keranjang = Keranjang::with('produk')->where('user_id', $user->id)->get();
            $total = $keranjang->sum(fn($item) => $item->produk->harga * $item->jumlah);
        }

        return view('pesanan.checkout', compact('keranjang', 'total'));
    }

    /**
     * ✅ Proses checkout (buat pesanan dan kirim ke Midtrans)
     */
    public function prosesCheckout(Request $request, MidtransService $midtrans)
    {
        $user = Auth::user();
        $invoice = 'INV-' . strtoupper(uniqid());

        // 🟢 CASE 1: Checkout langsung 1 produk
        if ($request->has('produk_id') && !is_array($request->produk_id)) {
            $produk = Produk::findOrFail($request->produk_id);
            $jumlah = (int)$request->jumlah;
            $total = $produk->harga * $jumlah;
        }

        // 🟢 CASE 2: Checkout beberapa produk dari keranjang (checkbox)
        elseif (is_array($request->produk_id)) {
            $produkIds = $request->input('produk_id', []);
            $jumlahs = $request->input('jumlah', []);

            $total = 0;
            $produkList = [];

            foreach ($produkIds as $id) {
                $produk = Produk::findOrFail($id);
                $jumlah = $jumlahs[$id] ?? 1;
                $subtotal = $produk->harga * $jumlah;
                $total += $subtotal;

                $produkList[] = [
                    'produk' => $produk,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal,
                ];
            }
        }

        // 🟢 CASE 3: Checkout semua isi keranjang
        else {
            $keranjang = Keranjang::with('produk')->where('user_id', $user->id)->get();
            if ($keranjang->isEmpty()) {
                return response()->json(['error' => 'Keranjang kosong!'], 400);
            }

            $total = $keranjang->sum(fn($item) => $item->produk->harga * $item->jumlah);
            $produkList = $keranjang->map(function ($item) {
                return [
                    'produk' => $item->produk,
                    'jumlah' => $item->jumlah,
                    'subtotal' => $item->produk->harga * $item->jumlah,
                ];
            })->toArray();
        }

        // 🧮 Validasi total
        if ((int)$request->total !== (int)$total) {
            return response()->json(['error' => 'Total tidak sesuai!'], 400);
        }

        // 🧾 Buat pesanan
        $pesanan = Pesanan::create([
            'user_id' => $user->id,
            'invoice' => $invoice,
            'nama' => $request->nama_pemesan ?? $user->name,
            'no_hp' => $request->telepon,
            'alamat' => $request->alamat,
            'total' => $total,
            'status' => 'Diproses',
        ]);

        // 💾 Simpan item pesanan
        foreach ($produkList ?? [compact('produk', 'jumlah', 'subtotal')] as $item) {
            PesananItem::create([
                'pesanan_id' => $pesanan->id,
                'produk_id'  => $item['produk']->id,
                'jumlah'     => $item['jumlah'],
                'subtotal'   => $item['subtotal'],
            ]);
        }

        // 🧹 Hapus dari keranjang setelah checkout
        Keranjang::where('user_id', $user->id)
            ->whereIn('produk_id', $request->produk_id ?? [])
            ->delete();

        // 💳 Buat transaksi Midtrans
        $snapToken = $midtrans->createTransaction(
            $invoice,
            $total,
            [
                'first_name' => $request->nama_pemesan ?? $user->name ?? 'Guest',
                'email'      => $user->email ?? 'guest@example.com',
            ]
        );

        return response()->json(['snap_token' => $snapToken]);
    }

    /**
     * ✅ Halaman pesanan sukses
     */
    public function success()
    {
        $user = Auth::user();

        $pesanan = Pesanan::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pesanan.success', compact('pesanan'));
    }

    /**
     * ✅ Checkout satu produk (halaman manual)
     */
    public function checkoutSinglePage($id, $jumlah = 1)
    {
        $produk = Produk::findOrFail($id);
        return view('pesanan.checkout_single', compact('produk', 'jumlah'));
    }

    /**
     * ✅ Proses checkout satu produk manual
     */
    public function checkoutSingleProcess(Request $request, MidtransService $midtrans)
    {
        $produk = Produk::findOrFail($request->produk_id);
        $jumlah = (int)$request->jumlah;
        $total = $produk->harga * $jumlah;

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

    /**
     * ✅ Daftar semua pesanan user
     */
    public function pesananSaya()
    {
        $user = Auth::user();

        $pesanans = Pesanan::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pesanan.saya', compact('pesanans'));
    }

    /**
     * ✅ Detail pesanan
     */
    public function detailPesanan($id)
    {
        $pesanan = Pesanan::with(['items.produk'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('pesanan.detail', compact('pesanan'));
    }

    public function riwayat()
    {
        $pesanan = Pesanan::where('status', 'selesai')->get();
        return view('user.riwayat', compact('pesanan'));
    }
}
