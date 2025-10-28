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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
