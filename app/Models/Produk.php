<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['nama', 'harga', 'stok', 'deskripsi', 'kategori_id', 'foto', 'user_id',]; // kalau mau tetap 1 foto default

    public function fotos()
    {
        return $this->hasMany(FotoProduk::class);
    }
}
