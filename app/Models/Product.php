<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'category_id',
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeTrending(Builder $query)
    {
        return $query->where('is_trending', true)
            ->where('status', 'active')
            ->orderBy('created_at', 'desc');
    }

    public function scopeDiscount(Builder $query)
    {
        return $query->where('discount_percent', '>', 0)
            ->where('status', 'active')
            ->orderBy('discount_percent', 'desc');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('status', 'active');
    }
}
