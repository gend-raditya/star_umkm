<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    /**
     * Kolom yang bisa diisi mass-assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'harga',
        'stok',
        'deskripsi',
        'kategori_id',
        'foto',
        'user_id',
    ];

    /**
     * Relasi: Produk memiliki banyak foto.
     */
    public function fotos()
    {
        return $this->hasMany(FotoProduk::class);
    }

    /**
     * Relasi: Produk dimiliki oleh satu user (seller).
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
