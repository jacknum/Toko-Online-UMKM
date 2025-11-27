<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Tambahkan ini

class CartController extends Controller
{

    public function cart()
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();

        $cartData = $cartItems->map(function ($item) {
            return [
                'id' => $item->id,
                'product_id' => $item->product_id,
                'name' => $item->product_name,
                'price' => floatval($item->price),
                'image' => $item->product_image,
                'quantity' => $item->quantity,
                'subtotal' => floatval($item->price * $item->quantity),
            ];
        });

        return view('cart', [
            'cartItems' => $cartItems,
            'cartData' => $cartData,
            'cartCount' => $cartItems->count(),
            'banks' => $this->getBanks(),
            'ewallets' => $this->getEWallets()
        ]);
    }

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
                'image' => 'https://www.bca.co.id/-/media/Feature/Header/Logo/logo-bca.svg'
            ],
            [
                'name' => 'Mandiri',
                'account' => '1234567890',
                'image' => 'https://www.bankmandiri.co.id/resource/img/logo-mandiri.png'
            ],
            [
                'name' => 'BRI',
                'account' => '1234567890',
                'image' => 'https://www.bri.co.id/documents/20123/26921/Logo-BRI-325x200.png'
            ],
        ];

        $ewallets = [
            [
                'name' => 'GCash',
                'account' => null,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/GCash_Logo.svg/1200px-GCash_Logo.svg.png'
            ],
            [
                'name' => 'Dana',
                'account' => null,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0d/Logo_DANA_Indonesia.svg/1200px-Logo_DANA_Indonesia.svg.png'
            ],
            [
                'name' => 'OVO',
                'account' => null,
                'image' => 'https://www.ovo.id/assets/images/og-image.jpg'
            ],
            [
                'name' => 'QRIS',
                'account' => null,
                'image' => 'https://upload.wikimedia.org/wikipedia/id/thumb/8/8a/QRIS_logo.svg/512px-QRIS_logo.svg.png'
            ],
        ];

        return view('stores.cart', [
            'cartItems' => $cartItems,
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
            Log::error('Cart Add Error: ' . $e->getMessage()); // Gunakan Log bukan \Log
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
        $request->validate([
            'quantity' => 'required|integer|min:1',
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

            // Cek stok produk terkait
            $product = Product::find($cartItem->product_id);
            if (!$product || $product->stock < $request->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok produk tidak mencukupi. Stok tersedia: ' . ($product->stock ?? 0)
                ], 400);
            }

            $cartItem->quantity = $request->quantity;
            $cartItem->save();

            $userId = Auth::id();

            return response()->json([
                'success' => true,
                'message' => 'Keranjang berhasil diperbarui',
                'cartTotal' => Cart::getUserCartTotal($userId),
                'cartCount' => Cart::getUserCartCount($userId),
                'itemSubtotal' => $cartItem->subtotal,
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
}
