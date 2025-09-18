<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'no_hp', 'alamat',
        'metode_pembayaran', 'total', 'status'
    ];

    public function items()
    {
        return $this->hasMany(PesananItem::class);
    }
}
