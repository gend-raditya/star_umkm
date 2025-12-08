<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',

        // tambahkan ini bila ada di database
        'is_seller',
        'seller_status',
        'no_waSeller',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_seller' => 'boolean',
        ];
    }

    public function produk()
    {
        return $this->hasMany(\App\Models\Produk::class, 'user_id');
    }

    public function seller()
    {
        return $this->hasOne(Seller::class);
    }
}
