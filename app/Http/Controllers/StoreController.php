<?php
// app/Http/Controllers/StoreController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $categories = Category::active()
            ->select('id', 'name', 'icon')
            ->limit(8)
            ->get();

        $trendingProducts = Product::with('category')
            ->trending()
            ->select('id', 'name', 'description', 'price', 'original_price', 'image', 'rating', 'review_count', 'discount_percent')
            ->limit(8)
            ->get();

        $discountProducts = Product::with('category')
            ->discount()
            ->select('id', 'name', 'description', 'price', 'original_price', 'image', 'rating', 'review_count', 'discount_percent')
            ->limit(8)
            ->get();

        return view('stores.index', compact('categories', 'trendingProducts', 'discountProducts'));
    }

    public function categoryProducts($categoryId)
    {
        $category = Category::active()->findOrFail($categoryId);
        $products = Product::with('category')
            ->where('category_id', $categoryId)
            ->active()
            ->paginate(12);

        return view('stores.category-products', compact('category', 'products'));
    }

    public function productDetail($productId)
    {
        $product = Product::with('category')
            ->active()
            ->findOrFail($productId);

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $productId)
            ->active()
            ->limit(4)
            ->get();

        return view('stores.detail', compact('product', 'relatedProducts'));
    }

    public function allCategories()
    {
        $categories = Category::active()->get();
        return view('stores.categories', compact('categories'));
    }
}
