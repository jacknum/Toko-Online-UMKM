<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
        'added_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
        'added_at' => 'datetime',
    ];

    /**
     * Get the user that owns the cart item.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product that belongs to the cart item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Scope a query to only include cart items for a specific user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope a query to only include cart items for the authenticated user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForCurrentUser($query)
    {
        return $query->where('user_id', Auth::id());
    }

    /**
     * Calculate total quantity of items in cart for a user.
     *
     * @param  int  $userId
     * @return int
     */
    public static function getTotalQuantityForUser($userId)
    {
        return static::where('user_id', $userId)->sum('quantity');
    }

    /**
     * Calculate total quantity of items in cart for current authenticated user.
     *
     * @return int
     */
    public static function getTotalQuantityForCurrentUser()
    {
        if (Auth::check()) {
            return static::where('user_id', Auth::id())->sum('quantity');
        }

        return 0;
    }

    /**
     * Calculate total price of items in cart for a user.
     *
     * @param  int  $userId
     * @return float
     */
    public static function getTotalPriceForUser($userId)
    {
        return static::where('user_id', $userId)
            ->get()
            ->sum(function ($item) {
                return $item->quantity * $item->price;
            });
    }

    /**
     * Check if a product is already in user's cart.
     *
     * @param  int  $userId
     * @param  int  $productId
     * @return bool
     */
    public static function isProductInCart($userId, $productId)
    {
        return static::where('user_id', $userId)
            ->where('product_id', $productId)
            ->exists();
    }
}
