<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{
    /**
     * Display store homepage
     */
    public function index()
    {
        // Ambil categories dari kolom category di tabel products (unique)
        $categories = $this->getCategories();

        // Trending Products - 8 produk terbaru dengan stock > 0
        // HAPUS filter user_id karena ini untuk PUBLIC store
        $trendingProducts = Product::where('status', '!=', 'out_of_stock') // Tampilkan semua produk kecuali out of stock
            ->where('stock', '>', 0)
            ->latest()
            ->take(8)
            ->get()
            ->map(function ($product) {
                return $this->enrichProductData($product);
            });

        // Discount Products - produk dengan diskon (original_price > price)
        $discountProducts = Product::where('status', '!=', 'out_of_stock')
            ->where('stock', '>', 0)
            ->whereNotNull('original_price')
            ->whereColumn('original_price', '>', 'price')
            ->take(8)
            ->get()
            ->map(function ($product) {
                return $this->enrichProductData($product);
            });

        return view('stores.index', compact('categories', 'trendingProducts', 'discountProducts'));
    }

    /**
     * Display all categories page
     */
    public function categories()
    {
        $categories = $this->getCategories();
        return view('stores.categories', compact('categories'));
    }

    /**
     * Display products by category or special filter
     */
    public function categoryProducts($categorySlug)
    {
        Log::info('=== CATEGORY PRODUCTS DEBUG ===');
        Log::info('Category Slug received: ' . $categorySlug);

        // Handle special categories
        if ($categorySlug === 'trending') {
            $products = Product::where('status', '!=', 'out_of_stock')
                ->where('stock', '>', 0)
                ->latest()
                ->paginate(12);
            $title = 'Sedang Trend';

            $category = (object)[
                'id' => 'trending',
                'name' => 'Sedang Trend',
                'icon' => 'fas fa-fire',
                'slug' => 'trending'
            ];
        } elseif ($categorySlug === 'discount') {
            $products = Product::where('status', '!=', 'out_of_stock')
                ->where('stock', '>', 0)
                ->whereNotNull('original_price')
                ->whereColumn('original_price', '>', 'price')
                ->paginate(12);
            $title = 'Diskon Spesial';

            $category = (object)[
                'id' => 'discount',
                'name' => 'Diskon Spesial',
                'icon' => 'fas fa-tags',
                'slug' => 'discount'
            ];
        } else {
            // Get all categories
            $categories = $this->getCategories();
            Log::info('Available categories:', $categories->toArray());

            // Find category by slug
            $category = $categories->first(function ($cat) use ($categorySlug) {
                return $cat->slug === $categorySlug;
            });

            // Jika tidak ketemu, abort
            if (!$category) {
                Log::error('Category not found for slug: ' . $categorySlug);
                abort(404, 'Kategori tidak ditemukan');
            }

            Log::info('Category found: ' . $category->name);

            // Query products berdasarkan nama kategori - HAPUS filter status 'active'
            $query = Product::where('category', $category->name)
                ->where('stock', '>', 0);

            Log::info('SQL Query: ' . $query->toSql());
            Log::info('Query Bindings: ', $query->getBindings());

            $products = $query->paginate(12);

            Log::info('Products found: ' . $products->total());

            if ($products->total() > 0) {
                Log::info('First product:', $products->first()->toArray());
            }

            $title = $category->name;
        }

        // Enrich product data
        $products->getCollection()->transform(function ($product) {
            return $this->enrichProductData($product);
        });

        Log::info('=== END DEBUG ===');

        return view('stores.category-products', compact('products', 'title', 'category'));
    }

    /**
     * Display product detail page
     */
    public function productDetail($id)
    {
        Log::info('=== PRODUCT DETAIL DEBUG ===');
        Log::info('Product ID: ' . $id);

        // Ambil produk dari database
        $product = Product::findOrFail($id);

        Log::info('Product found:', $product->toArray());

        // Enrich product data
        $product = $this->enrichProductData($product);

        // Setup product images (jika ada multiple images, pisahkan dengan koma)
        // Jika belum ada field images, gunakan image utama saja
        if (!isset($product->images) || empty($product->images)) {
            $product->images = [$product->image];
        } else {
            // Jika images disimpan sebagai string dengan separator koma
            $product->images = is_array($product->images)
                ? $product->images
                : explode(',', $product->images);
        }

        // Setup specifications (jika belum ada, buat default)
        if (!isset($product->specifications) || empty($product->specifications)) {
            $product->specifications = [
                'Kategori' => $product->category,
                'SKU' => $product->sku,
                'Berat' => $product->weight ?? '1 kg',
                'Kondisi' => 'Baru',
                'Stok' => $product->stock . ' unit'
            ];
        }

        // Setup seller info (ambil dari user yang memiliki produk)
        $seller = \App\Models\User::find($product->user_id);
        $product->seller = [
            'name' => $seller ? $seller->name : 'Toko UMKM',
            'rating' => 4.8,
            'location' => $seller->city ?? 'Jakarta'
        ];

        // Long description (jika belum ada, gunakan description)
        $product->long_description = $product->long_description ?? $product->description;

        // Related products from same category
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->where('stock', '>', 0)
            ->take(4)
            ->get()
            ->map(function ($prod) {
                return $this->enrichProductData($prod);
            });

        Log::info('Related products count: ' . $relatedProducts->count());
        Log::info('=== END DEBUG ===');

        return view('stores.detail', compact('product', 'relatedProducts'));
    }

    /**
     * Get categories dari database (kolom category di tabel products)
     */
    private function getCategories()
    {
        // Ambil semua category yang unique dari tabel products
        $categoryNames = Product::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->orderBy('category')
            ->pluck('category');

        Log::info('Category names from DB:', $categoryNames->toArray());

        // Mapping icon untuk setiap kategori
        $categoryIcons = [
            'Sepatu & Sandal' => 'fas fa-shoe-prints',
            'Pakaian' => 'fas fa-tshirt',
            'Elektronik' => 'fas fa-laptop',
            'Aksesoris' => 'fas fa-watch',
            'Makanan & Minuman' => 'fas fa-utensils',
            'Kesehatan & Kecantikan' => 'fas fa-heart',
            'Olahraga' => 'fas fa-basketball-ball',
            'Hobi & Gaming' => 'fas fa-gamepad',
        ];

        // Convert ke collection of objects
        $categories = collect();

        foreach ($categoryNames as $index => $name) {
            $slug = \Illuminate\Support\Str::slug($name);

            $categories->push((object)[
                'id' => $index + 1,
                'name' => $name,
                'icon' => $categoryIcons[$name] ?? 'fas fa-box',
                'slug' => $slug
            ]);
        }

        return $categories;
    }

    /**
     * Enrich product data with calculated fields
     */
    private function enrichProductData($product)
    {
        // Calculate discount percentage
        if ($product->original_price && $product->original_price > $product->price) {
            $product->discount_percent = round((($product->original_price - $product->price) / $product->original_price) * 100);
        } else {
            $product->discount_percent = 0;
        }

        // Set is_trending flag (produk baru 7 hari terakhir)
        $product->is_trending = $product->created_at->diffInDays(now()) <= 7;

        // Set default rating if not exists
        $product->rating = $product->rating ?? 4.5;
        $product->review_count = $product->review_count ?? rand(10, 100);

        // Format image path
        if ($product->image && !str_starts_with($product->image, 'http')) {
            $product->image = asset('storage/' . $product->image);
        }

        return $product;
    }

    /**
     * Display orders page with dummy data
     */
    public function orders()
    {
        // Generate dummy data for active orders
        $activeOrders = $this->generateDummyActiveOrders();

        // Generate dummy data for order history
        $orderHistory = $this->generateDummyOrderHistory();

        return view('stores.orders', compact('activeOrders', 'orderHistory'));
    }

    /**
     * Generate dummy data for active orders (shipped status)
     */
    private function generateDummyActiveOrders()
    {
        $products = Product::where('stock', '>', 0)
            ->take(3)
            ->get()
            ->map(function ($product) {
                return $this->enrichProductData($product);
            });

        if ($products->count() === 0) {
            return collect();
        }

        return collect([
            [
                'order_number' => 'ORD' . date('Ymd') . '001',
                'status' => 'shipped',
                'status_text' => 'Sedang Dikirim',
                'date' => now()->subDays(1)->format('Y-m-d H:i:s'),
                'estimated_delivery' => now()->addDays(2)->format('Y-m-d'),
                'shipping_method' => 'JNE Reguler',
                'tracking_number' => 'JNE' . rand(1000000000, 9999999999),
                'total' => 289000,
                'items' => [
                    [
                        'product_id' => $products[0]->id,
                        'name' => $products[0]->name,
                        'image' => $products[0]->image,
                        'price' => $products[0]->price,
                        'quantity' => 1,
                        'category' => $products[0]->category
                    ]
                ]
            ],
            [
                'order_number' => 'ORD' . date('Ymd') . '002',
                'status' => 'shipped',
                'status_text' => 'Sedang Dikirim',
                'date' => now()->subHours(6)->format('Y-m-d H:i:s'),
                'estimated_delivery' => now()->addDays(3)->format('Y-m-d'),
                'shipping_method' => 'J&T Express',
                'tracking_number' => 'JT' . rand(1000000000, 9999999999),
                'total' => 450000,
                'items' => [
                    [
                        'product_id' => $products->count() > 1 ? $products[1]->id : $products[0]->id,
                        'name' => $products->count() > 1 ? $products[1]->name : $products[0]->name,
                        'image' => $products->count() > 1 ? $products[1]->image : $products[0]->image,
                        'price' => $products->count() > 1 ? $products[1]->price : $products[0]->price,
                        'quantity' => 2,
                        'category' => $products->count() > 1 ? $products[1]->category : $products[0]->category
                    ]
                ]
            ]
        ]);
    }

    /**
     * Generate dummy data for order history (delivered and completed status)
     */
    private function generateDummyOrderHistory()
    {
        $products = Product::where('stock', '>', 0)
            ->take(4)
            ->get()
            ->map(function ($product) {
                return $this->enrichProductData($product);
            });

        if ($products->count() === 0) {
            return collect();
        }

        return collect([
            [
                'order_number' => 'ORD' . date('Ymd', strtotime('-5 days')) . '003',
                'status' => 'delivered',
                'status_text' => 'Terkirim',
                'date' => now()->subDays(5)->format('Y-m-d H:i:s'),
                'delivered_date' => now()->subDays(1)->format('Y-m-d H:i:s'),
                'shipping_method' => 'JNE Reguler',
                'tracking_number' => 'JNE' . rand(1000000000, 9999999999),
                'total' => 189000,
                'items' => [
                    [
                        'product_id' => $products[0]->id,
                        'name' => $products[0]->name,
                        'image' => $products[0]->image,
                        'price' => $products[0]->price,
                        'quantity' => 1,
                        'category' => $products[0]->category
                    ]
                ]
            ],
            [
                'order_number' => 'ORD' . date('Ymd', strtotime('-10 days')) . '004',
                'status' => 'completed',
                'status_text' => 'Selesai',
                'date' => now()->subDays(10)->format('Y-m-d H:i:s'),
                'delivered_date' => now()->subDays(7)->format('Y-m-d H:i:s'),
                'shipping_method' => 'J&T Express',
                'tracking_number' => 'JT' . rand(1000000000, 9999999999),
                'total' => 325000,
                'items' => [
                    [
                        'product_id' => $products->count() > 1 ? $products[1]->id : $products[0]->id,
                        'name' => $products->count() > 1 ? $products[1]->name : $products[0]->name,
                        'image' => $products->count() > 1 ? $products[1]->image : $products[0]->image,
                        'price' => $products->count() > 1 ? $products[1]->price : $products[0]->price,
                        'quantity' => 1,
                        'category' => $products->count() > 1 ? $products[1]->category : $products[0]->category
                    ]
                ],
                'review' => [
                    'rating' => 5,
                    'comment' => 'Produk sangat bagus, kualitas sesuai dengan harga. Pengiriman juga cepat!',
                    'created_at' => now()->subDays(6)->format('Y-m-d H:i:s')
                ]
            ],
            [
                'order_number' => 'ORD' . date('Ymd', strtotime('-15 days')) . '005',
                'status' => 'completed',
                'status_text' => 'Selesai',
                'date' => now()->subDays(15)->format('Y-m-d H:i:s'),
                'delivered_date' => now()->subDays(12)->format('Y-m-d H:i:s'),
                'shipping_method' => 'SiCepat',
                'tracking_number' => 'SC' . rand(1000000000, 9999999999),
                'total' => 542000,
                'items' => [
                    [
                        'product_id' => $products->count() > 2 ? $products[2]->id : $products[0]->id,
                        'name' => $products->count() > 2 ? $products[2]->name : $products[0]->name,
                        'image' => $products->count() > 2 ? $products[2]->image : $products[0]->image,
                        'price' => $products->count() > 2 ? $products[2]->price : $products[0]->price,
                        'quantity' => 1,
                        'category' => $products->count() > 2 ? $products[2]->category : $products[0]->category
                    ],
                    [
                        'product_id' => $products->count() > 3 ? $products[3]->id : $products[0]->id,
                        'name' => $products->count() > 3 ? $products[3]->name : $products[0]->name,
                        'image' => $products->count() > 3 ? $products[3]->image : $products[0]->image,
                        'price' => $products->count() > 3 ? $products[3]->price : $products[0]->price,
                        'quantity' => 1,
                        'category' => $products->count() > 3 ? $products[3]->category : $products[0]->category
                    ]
                ]
                // No review for this order (to show review button)
            ]
        ]);
    }
}
