<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use App\Models\Kategori;

class SellerProdukController extends Controller
{
    // Tampilkan semua produk milik seller
    public function index()
    {
        $user = Auth::user();

        // tambahkan 'with' untuk load relasi fotos
        $produk = Produk::with('fotos')
            ->where('user_id', $user->id)
            ->get();

        return view('seller.dashboard', compact('produk'));
    }


    // Form tambah produk
    public function create()
    {
        $kategori = Kategori::all();
        return view('seller.produk.create', compact('kategori'));
    }

    // Simpan produk baru

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'foto.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan data produk utama
        $produk = Produk::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'user_id' => Auth::id(),
        ]);

        // Simpan foto ke tabel fotos (bisa lebih dari 1)
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $path = $file->store('produk', 'public');
                $produk->fotos()->create(['path' => $path]);
            }
        }

        return redirect()->route('seller.dashboard')
            ->with('success', 'Produk berhasil ditambahkan.');
    }



    // Form edit produk
    public function edit($id)
    {
        $produk = Produk::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $kategori = Kategori::all();
         $user = Auth::user();
        return view('seller.produk.edit', compact('produk', 'kategori','user'));
    }

    // Update produk
    public function update(Request $request, $id)
    {
        // Cari produk dan pastikan milik user yang sedang login
        $produk = Produk::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 1. Update data text (nama, harga, deskripsi, kategori) ke tabel produk
        $produk->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
        ]);

        // 2. Logic Foto: Karena menggunakan tabel terpisah (relasi)
        if ($request->hasFile('foto')) {

            // Ambil data foto lama dari tabel relasi 'fotos'
            $fotoLama = $produk->fotos()->first();

            // Jika ada foto lama, hapus filenya dari storage & database
            if ($fotoLama) {
                Storage::disk('public')->delete($fotoLama->path); // Hapus file fisik
                $fotoLama->delete(); // Hapus record di db
            }

            // Upload foto baru
            $path = $request->file('foto')->store('produk', 'public');

            // Simpan path baru ke tabel relasi 'fotos'
            $produk->fotos()->create(['path' => $path]);
        }

        return redirect()->route('seller.dashboard')->with('success', 'Produk berhasil diperbarui.');
    }

    // Hapus produk
    public function destroy($id)
    {
        $produk = Produk::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $produk->delete();

        return redirect()->route('seller.dashboard')->with('success', 'Produk berhasil dihapus.');
    }

    public function updateStok(Request $request, $id)
    {
        $request->validate([
            'stok' => 'required|integer|min:0',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->stok = $request->stok;
        $produk->save();

        return redirect()->back()->with('success', 'Stok berhasil diperbarui!');
    }
}
