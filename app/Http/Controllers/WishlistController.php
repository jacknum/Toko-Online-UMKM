<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        // Data dummy wishlist items
        $allWishlistItems = [
            ['id' => 1, 'name' => 'Kemeja Flanel Pria', 'image' => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=300&h=300&fit=crop', 'price' => 150000, 'discount' => 10, 'discounted_price' => 135000, 'rating' => 4.5, 'review_count' => 25, 'stock' => 10, 'store_name' => 'Fashion Store', 'is_new' => true],
            ['id' => 2, 'name' => 'Sepatu Sneakers Wanita', 'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=300&h=300&fit=crop', 'price' => 200000, 'discount' => 0, 'discounted_price' => 200000, 'rating' => 4.0, 'review_count' => 18, 'stock' => 0, 'store_name' => 'Shoe Gallery', 'is_new' => false],
            ['id' => 3, 'name' => 'Tas Ransel Kulit', 'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=300&h=300&fit=crop', 'price' => 175000, 'discount' => 15, 'discounted_price' => 148750, 'rating' => 5.0, 'review_count' => 30, 'stock' => 5, 'store_name' => 'Leather Craft', 'is_new' => true],
            ['id' => 4, 'name' => 'Gelang Silver Handmade', 'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=300&h=300&fit=crop', 'price' => 120000, 'discount' => 0, 'discounted_price' => 120000, 'rating' => 3.5, 'review_count' => 12, 'stock' => 15, 'store_name' => 'Silver Art', 'is_new' => false],
            ['id' => 5, 'name' => 'Jam Tangan Classic', 'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=300&h=300&fit=crop', 'price' => 250000, 'discount' => 20, 'discounted_price' => 200000, 'rating' => 4.8, 'review_count' => 45, 'stock' => 8, 'store_name' => 'Time Master', 'is_new' => true],
            ['id' => 6, 'name' => 'Kaos Polo Cotton', 'image' => 'https://images.unsplash.com/photo-1586790170083-2f9ceadc732d?w=300&h=300&fit=crop', 'price' => 180000, 'discount' => 5, 'discounted_price' => 171000, 'rating' => 4.2, 'review_count' => 22, 'stock' => 12, 'store_name' => 'Cotton Wear', 'is_new' => false],
            ['id' => 7, 'name' => 'Celana Jeans Slim Fit', 'image' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=300&h=300&fit=crop', 'price' => 220000, 'discount' => 0, 'discounted_price' => 220000, 'rating' => 4.7, 'review_count' => 38, 'stock' => 3, 'store_name' => 'Denim Studio', 'is_new' => true],
            ['id' => 8, 'name' => 'Topi Baseball', 'image' => 'https://images.unsplash.com/photo-1588850561407-ed78c282e89b?w=300&h=300&fit=crop', 'price' => 190000, 'discount' => 10, 'discounted_price' => 171000, 'rating' => 4.1, 'review_count' => 19, 'stock' => 0, 'store_name' => 'Cap Factory', 'is_new' => false],
            ['id' => 9, 'name' => 'Scarf Sutra Premium', 'image' => 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=300&h=300&fit=crop', 'price' => 160000, 'discount' => 0, 'discounted_price' => 160000, 'rating' => 4.3, 'review_count' => 27, 'stock' => 7, 'store_name' => 'Silk Paradise', 'is_new' => true],
            ['id' => 10, 'name' => 'Dompet Kulit Asli', 'image' => 'https://images.unsplash.com/photo-1627123424574-724758594e93?w=300&h=300&fit=crop', 'price' => 210000, 'discount' => 15, 'discounted_price' => 178500, 'rating' => 4.9, 'review_count' => 52, 'stock' => 20, 'store_name' => 'Leather Goods', 'is_new' => false],
            ['id' => 11, 'name' => 'Kacamata Rayban', 'image' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=300&h=300&fit=crop', 'price' => 300000, 'discount' => 25, 'discounted_price' => 225000, 'rating' => 4.6, 'review_count' => 67, 'stock' => 6, 'store_name' => 'Optik Modern', 'is_new' => true],
            ['id' => 12, 'name' => 'Baju Batik Modern', 'image' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=300&h=300&fit=crop', 'price' => 275000, 'discount' => 10, 'discounted_price' => 247500, 'rating' => 4.4, 'review_count' => 41, 'stock' => 9, 'store_name' => 'Batik Nusantara', 'is_new' => false],
            ['id' => 13, 'name' => 'Tas Tote Bag Wanita', 'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=300&h=300&fit=crop', 'price' => 145000, 'discount' => 10, 'discounted_price' => 130500, 'rating' => 4.6, 'review_count' => 33, 'stock' => 6, 'store_name' => 'Bag Store', 'is_new' => true],
            ['id' => 14, 'name' => 'Sepatu Formal Pria', 'image' => 'https://images.unsplash.com/photo-1460353581641-37baddab0fa2?w=300&h=300&fit=crop', 'price' => 195000, 'discount' => 0, 'discounted_price' => 195000, 'rating' => 4.4, 'review_count' => 28, 'stock' => 14, 'store_name' => 'Shoe Palace', 'is_new' => false],
            ['id' => 15, 'name' => 'Jaket Denim Pria', 'image' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=300&h=300&fit=crop', 'price' => 225000, 'discount' => 25, 'discounted_price' => 168750, 'rating' => 4.8, 'review_count' => 41, 'stock' => 9, 'store_name' => 'Denim Works', 'is_new' => true],
            ['id' => 16, 'name' => 'Kalung Emas 18K', 'image' => 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?w=300&h=300&fit=crop', 'price' => 125000, 'discount' => 5, 'discounted_price' => 118750, 'rating' => 4.0, 'review_count' => 16, 'stock' => 0, 'store_name' => 'Gold Jewelry', 'is_new' => false],
        ];

        // Data produk rekomendasi
        $recommendedProducts = [
            ['id' => 17, 'name' => 'Headphone Wireless', 'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=300&h=300&fit=crop', 'price' => 350000, 'discount' => 15, 'discounted_price' => 297500, 'rating' => 4.7, 'review_count' => 89, 'stock' => 12, 'store_name' => 'Audio Tech', 'is_new' => true],
            ['id' => 18, 'name' => 'Smart Watch', 'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=300&h=300&fit=crop', 'price' => 450000, 'discount' => 20, 'discounted_price' => 360000, 'rating' => 4.5, 'review_count' => 67, 'stock' => 8, 'store_name' => 'Tech Wear', 'is_new' => false],
            ['id' => 19, 'name' => 'Koper Travel', 'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=300&h=300&fit=crop', 'price' => 550000, 'discount' => 10, 'discounted_price' => 495000, 'rating' => 4.8, 'review_count' => 45, 'stock' => 5, 'store_name' => 'Travel Gear', 'is_new' => true],
            ['id' => 20, 'name' => 'Kamera Digital', 'image' => 'https://images.unsplash.com/photo-1502920917128-1aa500764cbd?w=300&h=300&fit=crop', 'price' => 1200000, 'discount' => 5, 'discounted_price' => 1140000, 'rating' => 4.9, 'review_count' => 123, 'stock' => 3, 'store_name' => 'Photo Studio', 'is_new' => false],
        ];

        // Pagination logic - 8 items per page
        $perPage = 8;
        $currentPage = $request->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;

        // Get items for current page
        $wishlistItems = array_slice($allWishlistItems, $offset, $perPage);

        // Pagination info
        $totalItems = count($allWishlistItems);
        $totalPages = ceil($totalItems / $perPage);

        return view('stores.wishlist', compact(
            'wishlistItems',
            'recommendedProducts',
            'currentPage',
            'totalPages',
            'totalItems'
        ));
    }
}
