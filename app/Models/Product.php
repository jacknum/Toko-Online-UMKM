<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'sku',
        'category',
        'price',
        'original_price',
        'stock',
        'status',
        'description',
        'image',
        'rating',
        'review_count',
        'discount_percent',
        'is_trending',
        'weight',
        'dimensions',
        'tags'
    ];

    protected $casts = [
        'tags' => 'array',
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'rating' => 'decimal:2',
        'is_trending' => 'boolean'
    ];

    // Relationship ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Boot method untuk auto status (jika ada di controller)
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            // Auto update status berdasarkan stock
            if ($product->stock == 0) {
                $product->status = 'out_of_stock';
            } elseif ($product->stock <= 10) {
                $product->status = 'low_stock';
            } else {
                $product->status = 'active';
            }
        });
    }
}
