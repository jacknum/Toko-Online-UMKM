<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'user_id', // PASTIKAN INI ADA
        'name',
        'description',
        'price',
        'stock',
        'category',
        'image',
        'status',
        'sku',
        'weight',
        'dimensions',
        'tags'
    ];

    protected $casts = [
        'tags' => 'array'
    ];

    /**
     * Boot method untuk auto-set status berdasarkan stock
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            // Auto-set status berdasarkan stock
            if ($product->stock == 0) {
                $product->status = 'out_of_stock';
            } elseif ($product->stock <= 10) { // <= 5 untuk stock menipis
                $product->status = 'low_stock';
            } else {
                $product->status = 'active';
            }
        });
    }

    /**
     * Relationship dengan User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
