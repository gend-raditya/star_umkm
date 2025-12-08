<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Foto extends Model
{
    protected $table = 'foto';
    protected $fillable = ['produk_id', 'path'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
