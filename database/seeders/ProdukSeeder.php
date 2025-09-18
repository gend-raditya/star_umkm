<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        Produk::create([
            'nama' => 'Keripik Singkong',
            'deskripsi' => 'Keripik singkong pedas khas UMKM lokal',
            'harga' => 15000,
            'kategori_id' => 1,
        ]);

        Produk::create([
            'nama' => 'Tas Anyaman',
            'deskripsi' => 'Tas anyaman tangan ramah lingkungan',
            'harga' => 75000,
            'kategori_id' => 2,
        ]);
    }
}

