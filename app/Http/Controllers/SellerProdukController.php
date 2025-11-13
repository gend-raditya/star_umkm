<?php

namespace App\Http\Controllers;

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
        $produk = Produk::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('nama', 'harga', 'deskripsi', 'kategori_id');

        // Upload foto baru kalau ada
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('produk', 'public');
            $data['foto'] = $path;
        }

        $produk->update($data);

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
