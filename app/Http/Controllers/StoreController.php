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
        $trendingProducts = Product::with('category')
            ->where('is_trending', true)
            ->limit(8)
            ->get();

        $newArrivals = Product::with('category')
            ->latest()
            ->limit(8)
            ->get();

        return view('stores.index', compact('trendingProducts', 'newArrivals'));
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
