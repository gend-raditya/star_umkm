<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\PesananItem;
// Hapus atau abaikan use App\Services\MidtransService;
use App\Notifications\PesananPaidNotification;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Log;


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
    // public function prosesCheckout(Request $request, MidtransService $midtrans)
    // {
    //     $user = Auth::user();
    //     $invoice = 'INV-' . strtoupper(uniqid());

    //     // 🟢 CASE 1: Checkout langsung 1 produk
    //     if ($request->has('produk_id') && !is_array($request->produk_id)) {
    //         $produk = Produk::findOrFail($request->produk_id);
    //         $jumlah = (int)$request->jumlah;
    //         $total = $produk->harga * $jumlah;
    //     }

    //     // 🟢 CASE 2: Checkout beberapa produk dari keranjang (checkbox)
    //     elseif (is_array($request->produk_id)) {
    //         $produkIds = $request->input('produk_id', []);
    //         $jumlahs = $request->input('jumlah', []);

    //         $total = 0;
    //         $produkList = [];

    //         foreach ($produkIds as $id) {
    //             $produk = Produk::findOrFail($id);
    //             $jumlah = $jumlahs[$id] ?? 1;
    //             $subtotal = $produk->harga * $jumlah;
    //             $total += $subtotal;

    //             $produkList[] = [
    //                 'produk' => $produk,
    //                 'jumlah' => $jumlah,
    //                 'subtotal' => $subtotal,
    //             ];
    //         }
    //     }

    //     // 🟢 CASE 3: Checkout semua isi keranjang
    //     else {
    //         $keranjang = Keranjang::with('produk')->where('user_id', $user->id)->get();
    //         if ($keranjang->isEmpty()) {
    //             return response()->json(['error' => 'Keranjang kosong!'], 400);
    //         }

    //         $total = $keranjang->sum(fn($item) => $item->produk->harga * $item->jumlah);
    //         $produkList = $keranjang->map(function ($item) {
    //             return [
    //                 'produk' => $item->produk,
    //                 'jumlah' => $item->jumlah,
    //                 'subtotal' => $item->produk->harga * $item->jumlah,
    //             ];
    //         })->toArray();
    //     }

    //     // 🧮 Validasi total
    //     if ((int)$request->total !== (int)$total) {
    //         return response()->json(['error' => 'Total tidak sesuai!'], 400);
    //     }

    //     // 🧾 Buat pesanan
    //     $pesanan = Pesanan::create([
    //         'user_id' => $user->id,
    //         'invoice' => $invoice,
    //         'nama' => $request->nama_pemesan ?? $user->name,
    //         'no_hp' => $request->telepon,
    //         'alamat' => $request->alamat,
    //         'total' => $total,
    //         'status' => 'Diproses',
    //     ]);

    //     // 💾 Simpan item pesanan
    //     foreach ($produkList ?? [compact('produk', 'jumlah', 'subtotal')] as $item) {
    //         PesananItem::create([
    //             'pesanan_id' => $pesanan->id,
    //             'produk_id'  => $item['produk']->id,
    //             'jumlah'     => $item['jumlah'],
    //             'subtotal'   => $item['subtotal'],
    //         ]);
    //     }

    //     // 🧹 Hapus dari keranjang setelah checkout
    //     Keranjang::where('user_id', $user->id)
    //         ->whereIn('produk_id', $request->produk_id ?? [])
    //         ->delete();

    //     // 💳 Buat transaksi Midtrans
    //     $snapToken = $midtrans->createTransaction(
    //         $invoice,
    //         $total,
    //         [
    //             'first_name' => $request->nama_pemesan ?? $user->name ?? 'Guest',
    //             'email'      => $user->email ?? 'guest@example.com',
    //         ]
    //     );

    //     return response()->json(['snap_token' => $snapToken]);
    // }


    public function prosesCheckout(Request $request) // Hapus parameter MidtransService $midtrans
    {
        try { // 🟢 Tambahkan Try-Catch agar error tidak jadi HTML
            $user = Auth::user();
            $invoice = 'INV-' . strtoupper(uniqid());

            // --- BAGIAN LOGIKA PRODUK/KERANJANG (SAMA SEPERTI ASLIMU) ---
            if ($request->has('produk_id') && !is_array($request->produk_id)) {
                $produk = Produk::findOrFail($request->produk_id);
                $jumlah = (int)$request->jumlah;
                $total = $produk->harga * $jumlah;
            } elseif (is_array($request->produk_id)) {
                $produkIds = $request->input('produk_id', []);
                $jumlahs = $request->input('jumlah', []);
                $total = 0;
                $produkList = [];
                foreach ($produkIds as $id) {
                    $produk = Produk::findOrFail($id);
                    $jumlah = $jumlahs[$id] ?? 1;
                    $subtotal = $produk->harga * $jumlah;
                    $total += $subtotal;
                    $produkList[] = ['produk' => $produk, 'jumlah' => $jumlah, 'subtotal' => $subtotal];
                }
            } else {
                $keranjang = Keranjang::with('produk')->where('user_id', $user->id)->get();
                if ($keranjang->isEmpty()) {
                    return response()->json(['error' => 'Keranjang kosong!'], 400);
                }
                $total = $keranjang->sum(fn($item) => $item->produk->harga * $item->jumlah);
                $produkList = $keranjang->map(function ($item) {
                    return ['produk' => $item->produk, 'jumlah' => $item->jumlah, 'subtotal' => $item->produk->harga * $item->jumlah];
                })->toArray();
            }

            if ((int)$request->total !== (int)$total) {
                return response()->json(['error' => 'Total tidak sesuai!'], 400);
            }

            // --- BUAT PESANAN (SAMA SEPERTI ASLIMU) ---
            $pesanan = Pesanan::create([
                'user_id' => $user->id,
                'invoice' => $invoice,
                'nama' => $request->nama_pemesan ?? $user->name,
                'no_hp' => $request->telepon,
                'alamat' => $request->alamat,
                'total' => $total,
                'status' => 'Diproses',
            ]);

            foreach ($produkList ?? [compact('produk', 'jumlah', 'subtotal')] as $item) {
                PesananItem::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id'  => $item['produk']->id,
                    'jumlah'     => $item['jumlah'],
                    'subtotal'   => $item['subtotal'],
                ]);
            }

            // Hapus Keranjang
            Keranjang::where('user_id', $user->id)
                ->whereIn('produk_id', $request->produk_id ?? [])
                ->delete();

            // 🟢 2. CONFIG MIDTRANS MANUAL (Solusi Error 401)
            // Kita panggil langsung dari config/midtrans.php tanpa lewat Service
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');

            // Cek Server Key (Debugging)
            if (empty(Config::$serverKey)) {
                return response()->json(['error' => 'Server Key Midtrans Kosong! Cek .env'], 500);
            }

            // Buat Params
            $params = [
                'transaction_details' => [
                    'order_id' => $invoice,
                    'gross_amount' => (int) $total,
                ],
                'customer_details' => [
                    'first_name' => $request->nama_pemesan ?? $user->name,
                    'email' => $user->email,
                    'phone' => $request->telepon,
                ]
            ];

            // Minta Snap Token
            $snapToken = Snap::getSnapToken($params);

            return response()->json(['snap_token' => $snapToken]);

        } catch (\Exception $e) {
            // 🟢 Tangkap error dan kirim JSON (Bukan HTML)
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
        // $pesanan = Pesanan::where('status', 'selesai')->get();
        // return view('user.riwayat', compact('pesanan'));

        // Gunakan auth()->id() tanpa tanda panah tambahan setelah kurung
    $pesanan = \App\Models\Pesanan::where('user_id', Auth::id())
                ->where('status', 'Selesai')
                ->latest()
                ->get();

    return view('user.riwayat', compact('pesanan'));
    }

    //notif ke wa
    private function kirimWaSeller($no, $pesanan)
    {
        $token = env('FONNTE_TOKEN');
        $pesan = "
🔔 *Pesanan Baru Dibayar!*

ID Pesanan: {$pesanan->id}
Total: Rp " . number_format($pesanan->total, 0, ',', '.') . "
Nama Pemesan: {$pesanan->nama_pemesan}

Silakan segera proses ya.
    ";

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'target' => $no,
                'message' => $pesan,
            ],
            CURLOPT_HTTPHEADER => [
                "Authorization: $token"
            ]
        ]);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }

    public function callback(Request $request)
    {
        $notif = $request->all();

        $order_id = $notif['order_id'];
        $status = $notif['transaction_status'];

        $pesanan = Pesanan::where('kode_pesanan', $order_id)->first();

        if (!$pesanan) {
            Log::error("⚠ PESANAN TIDAK DITEMUKAN: $order_id");
            return response()->json(['message' => 'Pesanan tidak ditemukan'], 404);
        }

        Log::info("Pesanan:", [$pesanan]);
        Log::info("Items:", $pesanan->items->toArray());

        $item = $pesanan->items->first();

        if (!$item) {
            Log::error("⚠ PESANAN TIDAK PUNYA ITEM!");
            return;
        }

        if (!$item->produk) {
            Log::error("⚠ PRODUK ITEM TIDAK DITEMUKAN!");
            return;
        }

        if (!$item->produk->seller) {
            Log::error("⚠ PRODUK TIDAK PUNYA SELLER!");
            return;
        }

        $seller = $item->produk->seller;

        if ($status == 'capture' || $status == 'settlement') {
            $pesanan->status = 'paid';
            $pesanan->save();

            $seller->notify(new PesananPaidNotification($pesanan));
            $this->kirimWaSeller($seller->telepon, $pesanan);
        }

        return response()->json(['message' => 'OK']);
    }

    /**
     * ✅ Batalkan pesanan
     */
    public function batalkan($id)
    {
        $pesanan = Pesanan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Hanya bisa dibatalkan kalau status masih Diproses
        if ($pesanan->status !== 'Diproses') {
            return redirect()->back()->with('error', 'Pesanan tidak dapat dibatalkan.');
        }

        $pesanan->update([
            'status' => 'Dibatalkan'
        ]);

        return redirect()->route('pesanan.saya')->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
