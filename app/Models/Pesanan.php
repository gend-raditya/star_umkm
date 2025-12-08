<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanans';

    protected $fillable = [
        'user_id',
        'invoice',
        'nama',
        'no_hp',
        'alamat',
        'metode_pembayaran',
        'total',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(PesananItem::class);
    }

      // apakah pesanan ini punya minimal 1 item milik seller tertentu?
    public function hasSeller(int $sellerId): bool
    {
        return $this->items()->whereHas('produk', function($q) use ($sellerId) {
            $q->where('user_id', $sellerId);
        })->exists();
    }

    // helper: ambil hanya items milik seller tertentu
    public function itemsForSeller(int $sellerId)
    {
        return $this->items()->whereHas('produk', function($q) use ($sellerId) {
            $q->where('user_id', $sellerId);
        })->with('produk')->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
