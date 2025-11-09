<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SellerController extends Controller
{
    // Halaman pengajuan seller
    public function register(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->is_seller && $user->seller_status === 'approved') {
            return redirect()->route('seller.dashboard')->with('info', 'Kamu sudah jadi seller.');
        }

        $user->seller_status = 'pending';
        $user->save();

        return back()->with('success', 'Pengajuan jadi seller telah dikirim. Tunggu persetujuan admin.');
    }

    // Dashboard seller (hanya bisa diakses kalau disetujui)
    public function index()
    {
        $user = Auth::user();

        if ($user->seller_status !== 'approved') {
            return redirect()->route('home')->with('error', 'Kamu belum disetujui jadi seller.');
        }

        // Produk milik seller
        $produk = $user->produk;

        // Ambil pesanan yang berisi produk dari seller ini
        $pesanans = \App\Models\Pesanan::whereHas('items.produk', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
            ->with(['items.produk'])
            ->latest()
            ->get();

        return view('seller.dashboard', compact('produk', 'pesanans'));
    }


    public function ajukan()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->seller_status === null || $user->seller_status === 'rejected') {
            $user->seller_status = 'pending';
            $user->save();

            return back()->with('success', 'Pengajuan seller berhasil dikirim!');
        }

        return back()->with('info', 'Anda sudah mengajukan sebelumnya.');
    }
}
