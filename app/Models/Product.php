<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id', // Tambahkan ini agar bisa disimpan ke database
        'name',
        'sku',
        'category',
        'stock',
        'sold',
        'price',
        'status',
    ];

    // Relasi: Produk ini milik satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}