<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category',  // kategori static (string)
        'image',
        'status',
    ];

    // Tidak ada relasi kategori karena kamu pakai kategori statis (bukan tabel)
}
