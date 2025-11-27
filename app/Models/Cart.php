<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'product_id',
        'product_name',
        'price',
        'product_image',
        'quantity',
        'added_at',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
        'added_at' => 'datetime',
    ];

    /**
     * Get the user that owns this cart item
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product of this cart item
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id'); // Tambahkan foreign key
    }

    /**
     * Get subtotal for this cart item
     */
    public function getSubtotalAttribute(): float
    {
        return $this->price * $this->quantity;
    }

    /**
     * Add or update cart item
     */
    public static function addToCart($userId, $productId, $productName, $price, $productImage, $quantity = 1)
    {
        // Cek apakah produk sudah ada di cart
        $cartItem = self::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // Update quantity jika sudah ada
            $cartItem->quantity += $quantity;
            $cartItem->save();
            return $cartItem;
        }

        // Buat item cart baru
        return self::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'product_name' => $productName,
            'price' => $price,
            'product_image' => $productImage,
            'quantity' => $quantity,
            'added_at' => now(),
        ]);
    }

    /**
     * Get total price for user's cart
     */
    public static function getUserCartTotal($userId): float
    {
        return (float) self::where('user_id', $userId)
            ->sum(DB::raw('price * quantity'));
    }

    /**
     * Get cart item count for user
     */
    public static function getUserCartCount($userId): int
    {
        return self::where('user_id', $userId)->sum('quantity');
    }

    /**
     * Clear user's cart
     */
    public static function clearUserCart($userId): void
    {
        self::where('user_id', $userId)->delete();
    }

    /**
     * Get total quantity for current authenticated user
     */
    public static function getTotalQuantityForCurrentUser(): int
    {
        $userId = auth()->id();
        if (!$userId) {
            return 0;
        }
        return self::where('user_id', $userId)->sum('quantity');
    }

    /**
     * Get cart items with product information
     */
    public static function getUserCartItems($userId)
    {
        return self::with('product') // Eager load product relationship
            ->where('user_id', $userId)
            ->get();
    }
}
