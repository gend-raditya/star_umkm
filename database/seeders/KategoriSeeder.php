<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::create(['nama' => 'Makanan']);
        Kategori::create(['nama' => 'Kerajinan']);
        Kategori::create(['nama' => 'Minuman']);
    }
}

