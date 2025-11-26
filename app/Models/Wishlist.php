<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'product_name',
        'product_description',
        'product_price',
        'product_original_price',
        'product_discount_percent',
        'product_image',
        'product_category',
        'product_stock',
        'product_rating',
        'product_review_count',
        'product_is_trending',
        'added_at',
    ];

    protected $casts = [
        'added_at' => 'datetime',
        'product_price' => 'decimal:2',
        'product_original_price' => 'decimal:2',
        'product_rating' => 'decimal:2',
        'product_is_trending' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Accessor untuk mengecek apakah produk baru
     */
    public function getIsNewAttribute()
    {
        return $this->created_at->gt(now()->subDays(7));
    }

    /**
     * Accessor untuk gambar produk dengan fallback - PERBAIKAN
     */
    public function getProductImageAttribute($value)
    {
        // Jika value kosong, null, atau string 'null'
        if (empty($value) || $value === 'null' || $value === null) {
            return 'https://via.placeholder.com/300x300';
        }

        // Jika value sudah berupa URL lengkap, return langsung
        if (str_starts_with($value, 'http')) {
            return $value;
        }

        // Jika value adalah path relatif, tambahkan base URL
        return asset('storage/' . $value);
    }

    /**
     * Accessor untuk deskripsi produk dengan fallback
     */
    public function getProductDescriptionAttribute($value)
    {
        return $value ?? 'Deskripsi produk tidak tersedia';
    }

    public static function getCountForCurrentUser()
    {
        if (Auth::check()) {
            return static::where('user_id', Auth::id())->count();
        }
        return 0;
    }
}
