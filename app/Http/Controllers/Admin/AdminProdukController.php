<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AdminProdukController extends Controller
{
    /**
     * Tampilkan daftar produk
     */
    public function index()
    {
        $produk = Produk::all();
        return view('admin.produk.index', compact('produk'));
    }

    /**
     * Tampilkan form tambah produk
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.produk.create', compact('kategoris'));
    }

    /**
     * Simpan produk baru
     */
   public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required|string',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
        'deskripsi' => 'nullable|string',
        'kategori_id' => 'required|integer',
        'foto.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    // Simpan produk dulu (kolom foto tetap boleh null)
    $produk = Produk::create([
        'nama' => $validated['nama'],
        'harga' => $validated['harga'],
        'stok' => $validated['stok'],
        'deskripsi' => $validated['deskripsi'] ?? null,
        'kategori_id' => $validated['kategori_id'],
        'foto' => null, // optional, bisa tetap null
    ]);

    // Simpan foto jika ada
    if ($request->hasFile('foto')) {
        foreach ($request->file('foto') as $file) {
            $path = $file->store('produk', 'public');
            $produk->fotos()->create(['path' => $path]);
        }
    }

    return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan!');
}



/**
     * Tampilkan form edit produk
     */
    public function edit(Produk $produk)
    {
        $kategoris = Kategori::all();
        return view('admin.produk.edit', compact('produk', 'kategoris'));
    }

    /**
     * Update produk
     */
    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'kategori_id' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        // Ambil data produk
        $data = $request->only(['nama', 'harga', 'stok', 'deskripsi', 'kategori_id']);

        // Update foto jika ada file baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($produk->foto && file_exists(storage_path('app/public/' . $produk->foto))) {
                unlink(storage_path('app/public/' . $produk->foto));
            }

            $path = $request->file('foto')->store('produk', 'public');
            $data['foto'] = $path;
        }

        $produk->update($data);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Hapus produk
     */
    public function destroy(Produk $produk)
    {
        // Hapus file foto jika ada
        if ($produk->foto && file_exists(storage_path('app/public/' . $produk->foto))) {
            unlink(storage_path('app/public/' . $produk->foto));
        }

        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus');
    }
}
