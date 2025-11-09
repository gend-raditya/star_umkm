<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;

class SellerPesananController extends Controller
{
    // daftar pesanan yang berisi produk seller
    public function index()
    {
        $sellerId = Auth::id();

        // ambil pesanan yang punya paling tidak 1 item milik seller
        $pesanans = Pesanan::whereHas('items.produk', function ($q) use ($sellerId) {
            $q->where('user_id', $sellerId);
        })->orderBy('created_at', 'desc')->get();

        return view('seller.pesanan.index', compact('pesanans'));
    }

    // lihat detail (hanya items seller ditampilkan atau semua tapi ditandai)
    public function show($id)
    {
        $sellerId = Auth::id();
        $pesanan = Pesanan::with(['items.produk'])->findOrFail($id);

        if (! $pesanan->hasSeller($sellerId)) {
            return redirect()->route('seller.pesanan.index')->with('error', 'Pesanan ini bukan untuk toko Anda.');
        }

        // ambil items yang milik seller
        $sellerItems = $pesanan->itemsForSeller($sellerId);

        return view('seller.pesanan.show', compact('pesanan', 'sellerItems'));
    }

    // seller update status untuk pesanan yang terkait (mis. Diproses -> Dikirim)


    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'lokasi_terakhir' => 'nullable|string|max:255',
        ]);

        $sellerId = Auth::id();
        $pesanan = Pesanan::with('items.produk')->findOrFail($id);

        // Validasi kepemilikan pesanan
        if (!$pesanan->hasSeller($sellerId)) {
            return redirect()->route('seller.pesanan.index')->with('error', 'Anda tidak berhak mengubah pesanan ini.');
        }

        // Update status pesanan
        $pesanan->status = $request->status;
        $pesanan->save();

        // Update lokasi terakhir untuk item milik seller saja
        if ($request->filled('lokasi_terakhir')) {
            foreach ($pesanan->items as $item) {
                if ($item->produk->user_id == $sellerId) {
                    $item->lokasi_terakhir = $request->lokasi_terakhir;
                    $item->save();
                }
            }
        }

        return redirect()->route('seller.pesanan.index')->with('success', 'Status pesanan & lokasi berhasil diperbarui.');
    }

    public function edit($id)
    {
        $sellerId = Auth::id();

        // Ambil pesanan beserta items & produk
        $pesanan = Pesanan::with(['items.produk'])->findOrFail($id);

        // Cek apakah pesanan ini memang punya produk milik seller
        if (!$pesanan->hasSeller($sellerId)) {
            return redirect()->route('seller.pesanan.index')->with('error', 'Pesanan ini bukan milik toko Anda.');
        }

        // Ambil item-item yang milik seller saja
        $sellerItems = $pesanan->itemsForSeller($sellerId);

        return view('seller.pesanan.edit', compact('pesanan', 'sellerItems'));
    }

    public function updateResi(Request $request, $id)
    {
        $request->validate([
            'no_resi' => 'required|string|max:255',
            'ekspedisi' => 'required|string|max:255',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->no_resi = $request->no_resi;
        $pesanan->ekspedisi = $request->ekspedisi;
        $pesanan->save();

        return back()->with('success', 'Nomor resi dan ekspedisi berhasil disimpan!');
    }
}
