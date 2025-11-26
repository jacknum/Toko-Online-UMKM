<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu',
                'login_required' => true
            ], 401);
        }

        $userId = Auth::id();
        $productId = $request->product_id;

        try {
            // Cek apakah produk sudah ada di wishlist
            $existingWishlist = Wishlist::where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();

            if ($existingWishlist) {
                // Hapus dari wishlist
                $existingWishlist->delete();

                return response()->json([
                    'success' => true,
                    'in_wishlist' => false,
                    'message' => 'Produk dihapus dari wishlist',
                    'wishlist_count' => Wishlist::getCountForCurrentUser()
                ]);
            } else {
                // Dapatkan data produk terbaru
                $product = Product::findOrFail($productId);

                // Handle gambar - pastikan tidak null
                $productImage = $product->image;
                if (empty($productImage) || $productImage === 'null' || $productImage === null) {
                    $productImage = 'https://via.placeholder.com/300x300';
                }

                // Tambah ke wishlist dengan data produk termasuk description
                Wishlist::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'product_name' => $product->name,
                    'product_description' => $product->description,
                    'product_price' => $product->price,
                    'product_original_price' => $product->original_price,
                    'product_discount_percent' => $product->discount_percent,
                    'product_image' => $product->image, // Gunakan yang sudah di-handle
                    'product_category' => $product->category,
                    'product_stock' => $product->stock,
                    'product_rating' => $product->rating,
                    'product_review_count' => $product->review_count,
                    'product_is_trending' => $product->is_trending,
                    'added_at' => now()
                ]);

                return response()->json([
                    'success' => true,
                    'in_wishlist' => true,
                    'message' => 'Produk ditambahkan ke wishlist',
                    'wishlist_count' => Wishlist::getCountForCurrentUser()
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getCount()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0]);
        }

        try {
            return response()->json([
                'count' => Wishlist::getCountForCurrentUser()
            ]);
        } catch (\Exception $e) {
            return response()->json(['count' => 0]);
        }
    }

    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat wishlist Anda.');
        }

        $userId = Auth::id();

        try {
            // Ambil data wishlist dari database langsung
            $wishlistItems = Wishlist::where('user_id', $userId)
                ->latest()
                ->paginate(8);

            // Data produk rekomendasi
            $recommendedProducts = [
                ['id' => 17, 'name' => 'Headphone Wireless', 'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=300&h=300&fit=crop', 'price' => 350000, 'discount' => 15, 'discounted_price' => 297500, 'rating' => 4.7, 'review_count' => 89, 'stock' => 12, 'store_name' => 'Audio Tech', 'is_new' => true],
                ['id' => 18, 'name' => 'Smart Watch', 'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=300&h=300&fit=crop', 'price' => 450000, 'discount' => 20, 'discounted_price' => 360000, 'rating' => 4.5, 'review_count' => 67, 'stock' => 8, 'store_name' => 'Tech Wear', 'is_new' => false],
                ['id' => 19, 'name' => 'Koper Travel', 'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=300&h=300&fit=crop', 'price' => 550000, 'discount' => 10, 'discounted_price' => 495000, 'rating' => 4.8, 'review_count' => 45, 'stock' => 5, 'store_name' => 'Travel Gear', 'is_new' => true],
                ['id' => 20, 'name' => 'Kamera Digital', 'image' => 'https://images.unsplash.com/photo-1502920917128-1aa500764cbd?w=300&h=300&fit=crop', 'price' => 1200000, 'discount' => 5, 'discounted_price' => 1140000, 'rating' => 4.9, 'review_count' => 123, 'stock' => 3, 'store_name' => 'Photo Studio', 'is_new' => false],
            ];

            return view('stores.wishlist', compact(
                'wishlistItems',
                'recommendedProducts'
            ));
        } catch (\Exception $e) {
            return redirect()->route('store.index')->with('error', 'Terjadi kesalahan saat memuat wishlist: ' . $e->getMessage());
        }
    }

    public function remove(Request $request, $id)
    {
        if (!Auth::check()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Silakan login terlebih dahulu'
                ], 401);
            }
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = Auth::id();

        try {
            $wishlistItem = Wishlist::where('user_id', $userId)
                ->where('id', $id)
                ->first();

            if ($wishlistItem) {
                $wishlistItem->delete();

                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Produk dihapus dari wishlist',
                        'wishlist_count' => Wishlist::getCountForCurrentUser()
                    ]);
                }

                return redirect()->route('store.wishlist')->with('success', 'Produk dihapus dari wishlist');
            }

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak ditemukan di wishlist'
                ], 404);
            }

            return redirect()->route('store.wishlist')->with('error', 'Produk tidak ditemukan di wishlist');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('store.wishlist')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function clear()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $userId = Auth::id();

        try {
            Wishlist::where('user_id', $userId)->delete();

            return redirect()->route('store.wishlist')->with('success', 'Semua produk telah dihapus dari wishlist');
        } catch (\Exception $e) {
            return redirect()->route('store.wishlist')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
