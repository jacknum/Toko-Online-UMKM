<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Show cart page
     */
    public function index()
    {
        $userId = Auth::id();

        // Jika user belum login, redirect ke login
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk melihat keranjang.');
        }

        // Ambil data cart dari database dengan eager loading product
        $cartItems = Cart::with('product')
            ->where('user_id', $userId)
            ->get();

        // Format cartData untuk JavaScript
        $cartData = $cartItems->map(function ($item) {
            // Pastikan image menggunakan path yang benar
            $imagePath = $item->product_image;

            // Jika path tidak dimulai dengan http/https, tambahkan base URL
            if ($imagePath && !str_starts_with($imagePath, 'http')) {
                $imagePath = asset('storage/' . $imagePath);
            }

            // Fallback ke placeholder jika tidak ada gambar
            if (!$imagePath) {
                $imagePath = 'https://via.placeholder.com/400x300?text=No+Image';
            }

            return [
                'id' => $item->id,
                'product_id' => $item->product_id,
                'name' => $item->product_name,
                'price' => floatval($item->price),
                'quantity' => $item->quantity,
                'image' => $imagePath,
            ];
        })->toArray();

        // Hitung total dan jumlah item
        $cartTotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $cartCount = $cartItems->sum('quantity');

        // Data untuk payment methods
        $banks = [
            [
                'name' => 'BCA',
                'account' => '1234567890',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg'
            ],
            [
                'name' => 'Mandiri',
                'account' => '0987654321',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg'
            ],
            [
                'name' => 'BRI',
                'account' => '1122334455',
                'image' => 'https://upload.wikimedia.org/wikipedia/id/5/55/BNI_logo.svg'
            ],
        ];

        $ewallets = [
            [
                'name' => 'GoPay',
                'account' => null,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg'
            ],
            [
                'name' => 'Dana',
                'account' => null,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg'
            ],
            [
                'name' => 'OVO',
                'account' => null,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/e/eb/Logo_ovo_purple.svg'
            ],
            [
                'name' => 'QRIS',
                'account' => null,
                'image' => 'https://qris.id/homepage/assets/images/logo-qris.png'
            ],
        ];

        return view('stores.cart', [
            'cartItems' => $cartItems,
            'cartData' => $cartData,
            'cartTotal' => $cartTotal,
            'cartCount' => $cartCount,
            'banks' => $banks,
            'ewallets' => $ewallets,
        ]);
    }

    /**
     * Add product to cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $userId = Auth::id();
            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Silakan login terlebih dahulu untuk menambahkan ke keranjang',
                    'login_required' => true
                ], 401);
            }

            $product = Product::find($request->product_id);

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak ditemukan'
                ], 404);
            }

            // Cek stok produk
            if ($product->stock < $request->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok produk tidak mencukupi. Stok tersedia: ' . $product->stock
                ], 400);
            }

            // Add to cart menggunakan model method
            Cart::addToCart(
                $userId,
                $product->id,
                $product->name,
                $product->price,
                $product->image,
                $request->quantity
            );

            // Get updated cart count
            $cartCount = Cart::getUserCartCount($userId);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan ke keranjang',
                'cart_count' => $cartCount,
            ]);
        } catch (\Exception $e) {
            Log::error('Cart Add Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, $cartId)
    {
        // Validasi - terima quantity langsung (bukan change)
        $request->validate([
            'quantity' => 'required|integer|min:0', // min:0 untuk bisa hapus
        ]);

        try {
            $cartItem = Cart::find($cartId);

            if (!$cartItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Item keranjang tidak ditemukan'
                ], 404);
            }

            if ($cartItem->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            // Jika quantity 0, hapus item
            if ($request->quantity <= 0) {
                $cartItem->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Produk berhasil dihapus dari keranjang',
                    'deleted' => true
                ]);
            }

            // Cek stok produk terkait
            $product = Product::find($cartItem->product_id);
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak ditemukan'
                ], 404);
            }

            if ($product->stock < $request->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok produk tidak mencukupi. Stok tersedia: ' . $product->stock
                ], 400);
            }

            // Update quantity
            $cartItem->quantity = $request->quantity;
            $cartItem->save();

            $userId = Auth::id();

            return response()->json([
                'success' => true,
                'message' => 'Keranjang berhasil diperbarui',
                'cartTotal' => Cart::getUserCartTotal($userId),
                'cartCount' => Cart::getUserCartCount($userId),
                'itemSubtotal' => $cartItem->price * $cartItem->quantity,
            ]);
        } catch (\Exception $e) {
            Log::error('Cart Update Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove item from cart
     */
    public function remove($cartId)
    {
        try {
            $cartItem = Cart::find($cartId);

            if (!$cartItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Item keranjang tidak ditemukan'
                ], 404);
            }

            if ($cartItem->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            $cartItem->delete();
            $userId = Auth::id();

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil dihapus dari keranjang',
                'cartTotal' => Cart::getUserCartTotal($userId),
                'cartCount' => Cart::getUserCartCount($userId),
            ]);
        } catch (\Exception $e) {
            Log::error('Cart Remove Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Clear cart
     */
    public function clear()
    {
        try {
            $userId = Auth::id();
            Cart::clearUserCart($userId);

            return response()->json([
                'success' => true,
                'message' => 'Keranjang berhasil dikosongkan'
            ]);
        } catch (\Exception $e) {
            Log::error('Cart Clear Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get cart count for current user
     */
    public function getCount()
    {
        try {
            $userId = Auth::id();
            $count = $userId ? Cart::getUserCartCount($userId) : 0;

            return response()->json([
                'success' => true,
                'count' => $count
            ]);
        } catch (\Exception $e) {
            Log::error('Cart Count Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'count' => 0
            ]);
        }
    }

    /**
     * Get cart summary for navbar
     */
    public function getCartSummary()
    {
        try {
            $userId = Auth::id();

            if (!$userId) {
                return response()->json([
                    'success' => true,
                    'count' => 0,
                    'total' => 0
                ]);
            }

            $count = Cart::getUserCartCount($userId);
            $total = Cart::getUserCartTotal($userId);

            return response()->json([
                'success' => true,
                'count' => $count,
                'total' => $total
            ]);
        } catch (\Exception $e) {
            Log::error('Cart Summary Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'count' => 0,
                'total' => 0
            ]);
        }
    }

    /**
     * Add product to cart from wishlist
     * Menghandle perbedaan struktur kolom antara wishlist dan cart
     */
    public function addFromWishlist(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1',
        ]);

        try {
            $userId = Auth::id();
            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Silakan login terlebih dahulu untuk menambahkan ke keranjang',
                    'login_required' => true
                ], 401);
            }

            $quantity = $request->quantity ?? 1;
            $product = Product::find($request->product_id);

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak ditemukan'
                ], 404);
            }

            // Cek stok produk
            if ($product->stock < $quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok produk tidak mencukupi. Stok tersedia: ' . $product->stock
                ], 400);
            }

            // Cek apakah produk sudah ada di cart
            $existingCart = Cart::where('user_id', $userId)
                ->where('product_id', $product->id)
                ->first();

            if ($existingCart) {
                // Jika sudah ada, update quantity
                $newQuantity = $existingCart->quantity + $quantity;

                if ($product->stock < $newQuantity) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Stok tidak mencukupi. Produk ini sudah ada ' . $existingCart->quantity . ' di keranjang. Stok tersedia: ' . $product->stock
                    ], 400);
                }

                $existingCart->quantity = $newQuantity;
                $existingCart->save();

                $message = 'Jumlah produk di keranjang berhasil diperbarui';
            } else {
                // Jika belum ada, tambahkan baru
                Cart::addToCart(
                    $userId,
                    $product->id,
                    $product->name,
                    $product->price,
                    $product->image,
                    $quantity
                );

                $message = 'Produk berhasil ditambahkan ke keranjang';
            }

            // Get updated cart count
            $cartCount = Cart::getUserCartCount($userId);

            return response()->json([
                'success' => true,
                'message' => $message,
                'cart_count' => $cartCount,
            ]);
        } catch (\Exception $e) {
            Log::error('Cart Add From Wishlist Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ], 500);
        }
    }

    // Tambahkan di CartController.php

    /**
     * Remove item from cart by product_id
     */
    public function removeByProduct(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        try {
            $userId = Auth::id();

            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Silakan login terlebih dahulu',
                    'login_required' => true
                ], 401);
            }

            // Cari cart item berdasarkan user_id dan product_id
            $cartItem = Cart::where('user_id', $userId)
                ->where('product_id', $request->product_id)
                ->first();

            if (!$cartItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak ditemukan di keranjang'
                ], 404);
            }

            $cartItem->delete();

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil dihapus dari keranjang',
                'cart_count' => Cart::getUserCartCount($userId),
                'cart_total' => Cart::getUserCartTotal($userId),
            ]);
        } catch (\Exception $e) {
            Log::error('Cart Remove By Product Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get cart items for current user (untuk cek state button)
     */
    public function getItems()
    {
        try {
            $userId = Auth::id();

            if (!$userId) {
                return response()->json([
                    'success' => true,
                    'items' => []
                ]);
            }

            $cartItems = Cart::where('user_id', $userId)
                ->get(['product_id', 'quantity']);

            return response()->json([
                'success' => true,
                'items' => $cartItems
            ]);
        } catch (\Exception $e) {
            Log::error('Cart Items Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'items' => []
            ]);
        }
    }
}
