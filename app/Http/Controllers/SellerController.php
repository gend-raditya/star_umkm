<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SellerController extends Controller
{
    // Halaman pengajuan seller
    // public function register(Request $request)
    // {
    //     /** @var \App\Models\User $user */
    //     $user = Auth::user();

    //     if ($user->is_seller && $user->seller_status === 'approved') {
    //         return redirect()->route('seller.dashboard')->with('info', 'Kamu sudah jadi seller.');
    //     }

    //     $user->seller_status = 'pending';
    //     $user->save();

    //     return back()->with('success', 'Pengajuan jadi seller telah dikirim. Tunggu persetujuan admin.');
    // }

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
    // Menampilkan form (jika diakses lewat URL /seller/register)
    public function create()
    {
        // Jika form Anda berbentuk Modal di Dashboard User,
        // function ini mungkin jarang dipakai, tapi biarkan saja.
        return view('seller.register');
    }

    // PROSES SIMPAN DATA (Ini yang dipanggil Modal)
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'nama_seller' => 'required|string|max:255',
            'foto_toko' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'nomor_hp' => 'required|string|max:20', // Pastikan HTML name="nomor_hp"
            'jenis_rekening' => 'required|string|max:50',
            'nomor_rekening' => 'required|string|max:50',
        ]);

        // 2. Upload Foto (Jika ada)
        $path = null;
        if ($request->hasFile('foto_toko')) {
            $path = $request->file('foto_toko')->store('foto_toko', 'public');
        }

        // 3. Simpan ke Tabel Sellers
        // Seller::create([
        //     'user_id' => Auth::id(),
        //     'nama_seller' => $validated['nama_seller'],
        //     'foto_toko' => $path,
        //     'nomor_hp' => $validated['nomor_hp'],
        //     'jenis_rekening' => $validated['jenis_rekening'],
        //     'nomor_rekening' => $validated['nomor_rekening'],
        // ]);


        Seller::updateOrCreate(
            ['user_id' => Auth::id()], // Kunci pencarian
            [
                'nama_seller' => $validated['nama_seller'],
                'foto_toko' => $path, // Hati-hati: kalau user tidak upload foto baru, logika ini perlu disesuaikan agar foto lama tidak hilang (opsional)
                'nomor_hp' => $validated['nomor_hp'],
                'jenis_rekening' => $validated['jenis_rekening'],
                'nomor_rekening' => $validated['nomor_rekening'],
            ]
        );

        // 4. Update Status User
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->seller_status = 'pending';
        $user->is_seller = false;
        $user->save();

        // 5. Redirect dengan Sukses
        return redirect()->route('user.dashboard')
            ->with('success', 'Pengajuan seller berhasil dikirim! Mohon tunggu persetujuan Admin.');
    }
}
