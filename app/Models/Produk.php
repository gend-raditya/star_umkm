<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'deskripsi','stok', 'foto','harga', 'kategori_id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

     public function fotos()
    {
        return $this->hasMany(Foto::class);
    }
}

