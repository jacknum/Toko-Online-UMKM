<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Menampilkan halaman utama store
     */
    public function index()
    {
        // Data dummy untuk demo dengan gambar yang sesuai nama produk
        $trendingProducts = [
            [
                'id' => 1,
                'name' => 'Kaos Lokal Premium',
                'description' => 'Kaos dengan bahan katun premium, nyaman dipakai sehari-hari',
                'price' => 150000,
                'original_price' => 200000,
                'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=250&h=200&fit=crop', // T-shirt
                'rating' => 4.5,
                'review_count' => 128,
                'badge' => 'Trending'
            ],
            [
                'id' => 2,
                'name' => 'Burger',
                'description' => 'Keripik singkong dengan bumbu pedas khas nusantara',
                'price' => 25000,
                'original_price' => 30000,
                'image' => 'https://images.unsplash.com/photo-1571091718767-18b5b1457add?w=250&h=200&fit=crop', // Snacks
                'rating' => 4.8,
                'review_count' => 95,
                'badge' => 'Trending'
            ],
            [
                'id' => 3,
                'name' => 'Tas Laptop',
                'description' => 'Tas anyaman tangan dengan bahan rotan pilihan',
                'price' => 180000,
                'original_price' => 220000,
                'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=250&h=200&fit=crop', // Bag
                'rating' => 4.3,
                'review_count' => 67,
                'badge' => 'Trending'
            ],
            [
                'id' => 4,
                'name' => 'Sabun Herbal Alami',
                'description' => 'Sabun dengan bahan herbal alami untuk kulit sehat',
                'price' => 45000,
                'original_price' => 55000,
                'image' => 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=250&h=200&fit=crop', // Soap - gambar sabun herbal
                'rating' => 4.6,
                'review_count' => 142,
                'badge' => 'Trending'
            ]
        ];

        $discountProducts = [
            [
                'id' => 5,
                'name' => 'Tas Kulit',
                'description' => 'Mukena dengan bahan katun jepang yang adem dan nyaman',
                'price' => 120000,
                'original_price' => 170000,
                'image' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=250&h=200&fit=crop', // Prayer wear
                'rating' => 4.7,
                'review_count' => 89,
                'badge' => 'discount',
                'discount_percent' => 30
            ],
            [
                'id' => 6,
                'name' => 'Kopi Arabika Gayo',
                'description' => 'Kopi arabika asal Gayo dengan aroma yang khas',
                'price' => 75000,
                'original_price' => 95000,
                'image' => 'https://images.unsplash.com/photo-1544787219-7f47ccb76574?w=250&h=200&fit=crop', // Coffee
                'rating' => 4.9,
                'review_count' => 156,
                'badge' => 'discount',
                'discount_percent' => 21
            ],
            [
                'id' => 7,
                'name' => 'Lilin Aromaterapi',
                'description' => 'Lilin dengan essential oil untuk relaksasi',
                'price' => 35000,
                'original_price' => 50000,
                'image' => 'https://images.unsplash.com/photo-1611930022073-b7a4ba5fcccd?w=250&h=200&fit=crop', // Candle - gambar lilin yang berfungsi
                'rating' => 4.4,
                'review_count' => 78,
                'badge' => 'discount',
                'discount_percent' => 30
            ],
            [
                'id' => 8,
                'name' => 'Gelang Emas',
                'description' => 'Gelang kayu dengan ukiran tradisional khas Indonesia',
                'price' => 65000,
                'original_price' => 85000,
                'image' => 'https://images.unsplash.com/photo-1611591437281-460bfbe1220a?w=250&h=200&fit=crop', // Wooden bracelet
                'rating' => 4.2,
                'review_count' => 54,
                'badge' => 'discount',
                'discount_percent' => 24
            ]
        ];

        // PERBAIKAN: Hanya 4 kategori sesuai urutan yang diminta
        $categories = [
            ['id' => 1, 'name' => 'Fashion', 'icon' => 'fas fa-tshirt'],
            ['id' => 2, 'name' => 'Makanan', 'icon' => 'fas fa-utensils'],
            ['id' => 3, 'name' => 'Dekorasi', 'icon' => 'fas fa-home'],
            ['id' => 4, 'name' => 'Kecantikan', 'icon' => 'fas fa-spa']
        ];

        return view('stores.index', compact('trendingProducts', 'discountProducts', 'categories'));
    }

    /**
     * Menampilkan halaman pencarian produk
     */
    public function search(Request $request)
    {
        $searchTerm = $request->query('q', '');

        // Data dummy hasil pencarian
        $searchResults = [];

        if (!empty($searchTerm)) {
            $searchResults = [
                [
                    'id' => 1,
                    'name' => 'Kaos ' . $searchTerm,
                    'description' => 'Hasil pencarian untuk ' . $searchTerm,
                    'price' => 150000,
                    'original_price' => 200000,
                    'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=250&h=200&fit=crop',
                    'rating' => 4.5,
                    'review_count' => 128
                ],
                [
                    'id' => 2,
                    'name' => 'Produk ' . $searchTerm . ' Special',
                    'description' => 'Deskripsi produk ' . $searchTerm,
                    'price' => 250000,
                    'original_price' => 300000,
                    'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=250&h=200&fit=crop',
                    'rating' => 4.2,
                    'review_count' => 95
                ]
            ];
        }

        return view('stores.search', compact('searchTerm', 'searchResults'));
    }

    /**
     * Menampilkan halaman detail produk
     */
    public function productDetail($id)
    {
        // Data dummy produk
        $product = [
            'id' => $id,
            'name' => 'Kaos Lokal Premium',
            'description' => 'Kaos dengan bahan katun premium yang nyaman dipakai sehari-hari. Bahan tidak mudah kusut dan menyerap keringat dengan baik.',
            'long_description' => 'Kaos ini dibuat dengan bahan katun combed 30s yang lembut dan nyaman. Proses produksi dilakukan oleh pengrajin lokal dengan standar kualitas tinggi. Tersedia dalam berbagai ukuran dan warna.',
            'price' => 150000,
            'original_price' => 200000,
            'discount_percent' => 25,
            'images' => [
                'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=400&h=400&fit=crop',
                'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?w=400&h=400&fit=crop',
                'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=400&h=400&fit=crop'
            ],
            'rating' => 4.5,
            'review_count' => 128,
            'stock' => 50,
            'seller' => [
                'name' => 'UMKM Fashion Lokal',
                'rating' => 4.8,
                'location' => 'Jakarta Selatan'
            ],
            'specifications' => [
                'Bahan' => 'Katun Combed 30s',
                'Ukuran' => 'S, M, L, XL',
                'Warna' => 'Hitam, Putih, Navy, Gray',
                'Perawatan' => 'Bisa dicuci mesin'
            ]
        ];

        $relatedProducts = [
            [
                'id' => 2,
                'name' => 'Kaos Basic Cotton',
                'price' => 120000,
                'image' => 'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?w=200&h=200&fit=crop',
                'rating' => 4.3
            ],
            [
                'id' => 3,
                'name' => 'Kaos Oversized',
                'price' => 180000,
                'image' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=200&h=200&fit=crop',
                'rating' => 4.6
            ]
        ];

        return view('stores.detail', compact('product', 'relatedProducts'));
    }

    /**
     * Menampilkan halaman keranjang belanja
     */
    public function cart()
    {
        // Data bank dengan link yang bekerja
        $banks = [
            ['name' => 'BCA', 'image' => 'https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg', 'account' => '123-456-7890'],
            ['name' => 'BNI', 'image' => 'https://wwf.id/sites/default/files/inline-images/BNI_logo.svg__1.png', 'account' => '987-654-3210'],
            ['name' => 'BRI', 'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2e/BRI_2020.svg/800px-BRI_2020.svg.png?20221123095928', 'account' => '456-789-0123'],
            ['name' => 'Mandiri', 'image' => 'https://upload.wikimedia.org/wikipedia/commons/a/ad/Bank_Mandiri_logo_2016.svg', 'account' => '111-222-3333'],
            ['name' => 'BTN', 'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/ca/BTN_2024.svg/250px-BTN_2024.svg.png', 'account' => '444-555-6666'],
            ['name' => 'BSI', 'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/Bank_Syariah_Indonesia.svg/512px-Bank_Syariah_Indonesia.svg.png', 'account' => '777-888-9999'],
        ];

        // Data e-wallet dengan link yang bekerja
        $ewallets = [
            ['name' => 'GoPay', 'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/00/Logo_Gopay.svg/512px-Logo_Gopay.svg.png'],
            ['name' => 'OVO', 'image' => 'https://bloguna.com/wp-content/uploads/2025/06/Logo-OVO-Format-PNG-CDR-EPS-SVG-Kualitas-HD-768x615.png'],
            ['name' => 'DANA', 'image' => 'https://career.amikom.ac.id/images/company/cover/1637497527.jpeg'],
            ['name' => 'LinkAja', 'image' => 'https://www.linkaja.id/assets/linkaja/ico/richlink.jpg'],
            ['name' => 'ShopeePay', 'image' => 'https://images.seeklogo.com/logo-png/50/1/shopeepay-logo-png_seeklogo-504055.png'],
            ['name' => 'QRIS', 'image' => 'https://pojoksiar.com/wp-content/uploads/2025/08/quick-response-code-indonesia-standard-qris-logo-png_seeklogo-391791.png'],
            ['name' => 'PayPal', 'image' => 'https://www.paypalobjects.com/webstatic/icon/pp258.png'],
            ['name' => 'Sakuku', 'image' => 'https://biller.id/assets/games/6362d15d74e1a.png'],
        ];

        return view('stores.cart', compact('banks', 'ewallets'));
    }

    /**
     * Menampilkan halaman wishlist dengan data dummy lengkap
     */
    public function wishlist()
    {
        // Data dummy wishlist items
        $wishlistItems = [
            [
                'id' => 1,
                'name' => 'Smartphone Samsung Galaxy A15 6/128GB - Garansi Resmi',
                'price' => 2499000,
                'discount' => 15,
                'discounted_price' => 2124150,
                'image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400&h=300&fit=crop',
                'rating' => 4.5,
                'review_count' => 128,
                'stock' => 25,
                'store_name' => 'Samsung Official Store',
                'is_new' => true
            ],
            [
                'id' => 2,
                'name' => 'Kemeja Flanel Pria Premium Cotton - Warna Navy',
                'price' => 189000,
                'discount' => 0,
                'discounted_price' => 189000,
                'image' => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=400&h=300&fit=crop',
                'rating' => 4.2,
                'review_count' => 89,
                'stock' => 0,
                'store_name' => 'Fashion Store',
                'is_new' => false
            ],
            [
                'id' => 3,
                'name' => 'Kopi Arabika Gayo Premium 250gr - Roasted Bean',
                'price' => 75000,
                'discount' => 10,
                'discounted_price' => 67500,
                'image' => 'https://images.unsplash.com/photo-1587734195503-904fca47e0e9?w=400&h=300&fit=crop',
                'rating' => 4.8,
                'review_count' => 256,
                'stock' => 150,
                'store_name' => 'Coffee Roastery',
                'is_new' => true
            ],
            [
                'id' => 4,
                'name' => 'Headphone Wireless Bluetooth dengan Noise Cancelling',
                'price' => 450000,
                'discount' => 20,
                'discounted_price' => 360000,
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=300&fit=crop',
                'rating' => 4.3,
                'review_count' => 67,
                'stock' => 12,
                'store_name' => 'Audio Tech Store',
                'is_new' => false
            ],
            [
                'id' => 5,
                'name' => 'Tas Ransel Outdoor Waterproof 30L - Black Edition',
                'price' => 299000,
                'discount' => 0,
                'discounted_price' => 299000,
                'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400&h=300&fit=crop',
                'rating' => 4.6,
                'review_count' => 42,
                'stock' => 8,
                'store_name' => 'Outdoor Gear',
                'is_new' => true
            ],
            [
                'id' => 6,
                'name' => 'Smart Watch Fitness Tracker dengan Heart Rate Monitor',
                'price' => 599000,
                'discount' => 25,
                'discounted_price' => 449250,
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400&h=300&fit=crop',
                'rating' => 4.4,
                'review_count' => 156,
                'stock' => 30,
                'store_name' => 'Tech Gadget Store',
                'is_new' => false
            ]
        ];

        // Recommended products
        $recommendedProducts = [
            [
                'id' => 7,
                'name' => 'Sepatu Sneakers Casual Pria - White',
                'price' => 329000,
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400&h=300&fit=crop'
            ],
            [
                'id' => 8,
                'name' => 'Mouse Wireless Ergonomic - Gaming Edition',
                'price' => 189000,
                'image' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=400&h=300&fit=crop'
            ],
            [
                'id' => 9,
                'name' => 'Buku Notebook Premium A5 - Hard Cover',
                'price' => 45000,
                'image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=300&fit=crop'
            ],
            [
                'id' => 10,
                'name' => 'Lampu Study LED dengan 3 Mode Pencahayaan',
                'price' => 129000,
                'image' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=400&h=300&fit=crop'
            ]
        ];

        return view('stores.wishlist', compact('wishlistItems', 'recommendedProducts'));
    }

    /**
     * Menampilkan halaman checkout
     */
    public function checkout()
    {
        $cartItems = [
            [
                'id' => 1,
                'name' => 'Kaos Lokal Premium',
                'price' => 150000,
                'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=80&h=80&fit=crop',
                'quantity' => 2,
                'size' => 'L',
                'color' => 'Hitam'
            ]
        ];

        $addresses = [
            [
                'id' => 1,
                'name' => 'Rumah',
                'recipient' => 'John Doe',
                'phone' => '081234567890',
                'address' => 'Jl. Contoh Alamat No. 123',
                'city' => 'Jakarta Selatan',
                'postal_code' => '12345',
                'is_primary' => true
            ],
            [
                'id' => 2,
                'name' => 'Kantor',
                'recipient' => 'John Doe',
                'phone' => '081234567891',
                'address' => 'Jl. Kantor No. 456',
                'city' => 'Jakarta Pusat',
                'postal_code' => '12346',
                'is_primary' => false
            ]
        ];

        $shippingMethods = [
            ['id' => 1, 'name' => 'Reguler', 'cost' => 15000, 'eta' => '3-5 hari'],
            ['id' => 2, 'name' => 'Express', 'cost' => 30000, 'eta' => '1-2 hari'],
            ['id' => 3, 'name' => 'Same Day', 'cost' => 50000, 'eta' => 'Hari ini']
        ];

        $paymentMethods = [
            ['id' => 1, 'name' => 'Bank Transfer', 'icon' => 'fas fa-university'],
            ['id' => 2, 'name' => 'E-Wallet', 'icon' => 'fas fa-wallet'],
            ['id' => 3, 'name' => 'COD', 'icon' => 'fas fa-money-bill-wave']
        ];

        $summary = [
            'subtotal' => 300000,
            'shipping' => 15000,
            'total' => 315000
        ];

        return view('stores.checkout', compact('cartItems', 'addresses', 'shippingMethods', 'paymentMethods', 'summary'));
    }

    public function categories()
    {
        // PERBAIKAN: Hanya 4 kategori sesuai urutan yang diminta
        $categories = [
            [
                'id' => 1,
                'name' => 'Fashion',
                'icon' => 'fas fa-tshirt',
                'description' => 'Pakaian dan aksesoris fashion lokal terbaik',
                'product_count' => 32
            ],
            [
                'id' => 2,
                'name' => 'Makanan',
                'icon' => 'fas fa-utensils',
                'description' => 'Berbagai makanan dan minuman khas UMKM',
                'product_count' => 45
            ],
            [
                'id' => 3,
                'name' => 'Dekorasi',
                'icon' => 'fas fa-home',
                'description' => 'Peralatan dan dekorasi rumah tangga',
                'product_count' => 23
            ],
            [
                'id' => 4,
                'name' => 'Kecantikan',
                'icon' => 'fas fa-spa',
                'description' => 'Produk kecantikan dan perawatan tubuh',
                'product_count' => 19
            ]
        ];

        return view('stores.categories', compact('categories'));
    }

    public function categoryProducts($categoryId)
    {
        // PERBAIKAN: Mapping untuk 4 kategori saja
        $categories = [
            1 => ['name' => 'Fashion', 'icon' => 'fas fa-tshirt'],
            2 => ['name' => 'Makanan', 'icon' => 'fas fa-utensils'],
            3 => ['name' => 'Dekorasi', 'icon' => 'fas fa-home'],
            4 => ['name' => 'Kecantikan', 'icon' => 'fas fa-spa']
        ];

        $category = $categories[$categoryId] ?? ['name' => 'Kategori', 'icon' => 'fas fa-box'];

        // Data dummy produk berdasarkan kategori
        $products = $this->generateCategoryProducts($categoryId, $category['name']);

        return view('stores.category-products', compact('category', 'products', 'categoryId'));
    }

    private function generateCategoryProducts($categoryId, $categoryName)
    {
        $products = [];

        // PERBAIKAN: Product names untuk 4 kategori saja
        $productNames = [
            1 => [ // Fashion
                'Kaos Batik Modern',
                'Kemeja Linen',
                'Celana Chino',
                'Dress Santai',
                'Jaket Denim',
                'Tas Kulit Sintetis',
                'Sepatu Sneakers',
                'Aksesoris Rajut'
            ],
            2 => [ // Makanan
                'Keripik Singkong Pedas',
                'Dodol Original',
                'Kopi Arabika',
                'Teh Herbal',
                'Kue Kering Tradisional',
                'Sambal Terasi',
                'Madu Murni',
                'Dendeng Sapi'
            ],
            3 => [ // Dekorasi
                'Vas Keramik Handmade',
                'Lampu Hias Bambu',
                'Bingkai Foto Kayu',
                'Karpet Rajut',
                'Pot Tanaman Keramik',
                'Lilin Aromaterapi',
                'Tatakan Gelas Rotan',
                'Hiasan Dinding'
            ],
            4 => [ // Kecantikan
                'Sabun Herbal Alami',
                'Lulur Mandi Tradisional',
                'Minyak Zaitun',
                'Lip Balm Organik',
                'Masker Wajah Alami',
                'Body Scrub Kopi',
                'Parfum Natural',
                'Hand Cream'
            ]
        ];

        $descriptions = [
            'Produk berkualitas tinggi dengan bahan terbaik',
            'Hasil karya tangan dengan sentuhan tradisional',
            'Inovasi terbaru dengan desain modern',
            'Produk ramah lingkungan dan sustainable',
            'Kualitas premium dengan harga terjangkau'
        ];

        for ($i = 1; $i <= 8; $i++) {
            $nameIndex = ($i - 1) % count($productNames[$categoryId]);
            $descIndex = ($i - 1) % count($descriptions);

            $originalPrice = rand(50000, 300000);
            $discount = rand(10, 30);
            $currentPrice = $originalPrice - ($originalPrice * $discount / 100);

            $products[] = [
                'id' => $categoryId * 10 + $i,
                'name' => $productNames[$categoryId][$nameIndex],
                'description' => $descriptions[$descIndex],
                'price' => $currentPrice,
                'original_price' => $originalPrice,
                'discount_percent' => $discount,
                'image' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=300&h=200&fit=crop&' . rand(1000, 9999),
                'rating' => rand(35, 50) / 10,
                'review_count' => rand(10, 150),
                'badge' => 'Trending',
                'category' => $categoryName
            ];
        }

        return $products;
    }

    /**
     * Menampilkan halaman pesanan saya
     */
    public function orders()
    {
        // Data dummy pesanan - hanya yang sudah dibayar/dikirim
        $orders = [
            [
                'id' => 'ORD-789003',
                'order_number' => 'ORD-789003',
                'date' => '2024-01-12 11:20:00',
                'status' => 'shipped',
                'status_text' => 'Dikirim',
                'total' => 450000,
                'items' => [
                    [
                        'name' => 'Headphone Wireless',
                        'price' => 450000,
                        'quantity' => 1,
                        'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=100&h=100&fit=crop',
                        'category' => 'Elektronik',
                        'product_id' => 1
                    ]
                ],
                'payment_method' => 'Bank Transfer BCA',
                'shipping_method' => 'JNE Reguler',
                'tracking_number' => 'JNE1234567890',
                'estimated_delivery' => '2024-01-16',
                'shipping_address' => [
                    'name' => 'John Doe',
                    'phone' => '+62 812-3456-7890',
                    'address' => 'Jl. Contoh Alamat No. 123, Kel. Contoh, Kec. Contoh',
                    'city' => 'Kota Contoh, Provinsi Contoh - 12345'
                ],
                'tracking_history' => [
                    [
                        'status' => 'Pesanan Diterima',
                        'description' => 'Pesanan telah diterima oleh sistem',
                        'date' => '2024-01-12 11:20:00',
                        'completed' => true
                    ],
                    [
                        'status' => 'Pesanan Diproses',
                        'description' => 'Pesanan sedang diproses oleh penjual',
                        'date' => '2024-01-12 14:30:00',
                        'completed' => true
                    ],
                    [
                        'status' => 'Pesanan Dikirim',
                        'description' => 'Pesanan telah dikirim melalui kurir',
                        'date' => '2024-01-13 09:15:00',
                        'completed' => true
                    ],
                    [
                        'status' => 'Dalam Perjalanan',
                        'description' => 'Pesanan sedang dalam perjalanan ke alamat tujuan',
                        'date' => '2024-01-14 08:00:00',
                        'completed' => false,
                        'current' => true
                    ],
                    [
                        'status' => 'Tiba di Tujuan',
                        'description' => 'Pesanan telah tiba di alamat tujuan',
                        'date' => null,
                        'completed' => false
                    ]
                ]
            ],
            [
                'id' => 'ORD-789007',
                'order_number' => 'ORD-789007',
                'date' => '2024-01-11 09:30:00',
                'status' => 'delivered',
                'status_text' => 'Terkirim',
                'total' => 275000,
                'items' => [
                    [
                        'name' => 'Smart Watch Fitness',
                        'price' => 275000,
                        'quantity' => 1,
                        'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=100&h=100&fit=crop',
                        'category' => 'Elektronik',
                        'product_id' => 2
                    ]
                ],
                'payment_method' => 'GoPay',
                'shipping_method' => 'JNE Express',
                'tracking_number' => 'JNE4455667788',
                'estimated_delivery' => '2024-01-13',
                'delivered_date' => '2024-01-13 15:20:00',
                'shipping_proof' => 'https://images.unsplash.com/photo-1556742044-3c52d6e88c62?w=400&h=300&fit=crop',
                'delivery_proof' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=400&h=300&fit=crop',
                'shipping_address' => [
                    'name' => 'John Doe',
                    'phone' => '+62 812-3456-7890',
                    'address' => 'Jl. Contoh Alamat No. 123, Kel. Contoh, Kec. Contoh',
                    'city' => 'Kota Contoh, Provinsi Contoh - 12345'
                ],
                'tracking_history' => [
                    [
                        'status' => 'Pesanan Diterima',
                        'description' => 'Pesanan telah diterima oleh sistem',
                        'date' => '2024-01-11 09:30:00',
                        'completed' => true
                    ],
                    [
                        'status' => 'Pesanan Diproses',
                        'description' => 'Pesanan sedang diproses oleh penjual',
                        'date' => '2024-01-11 14:15:00',
                        'completed' => true
                    ],
                    [
                        'status' => 'Pesanan Dikirim',
                        'description' => 'Pesanan telah dikirim melalui kurir',
                        'date' => '2024-01-12 10:00:00',
                        'completed' => true
                    ],
                    [
                        'status' => 'Dalam Perjalanan',
                        'description' => 'Pesanan sedang dalam perjalanan ke alamat tujuan',
                        'date' => '2024-01-13 08:30:00',
                        'completed' => true
                    ],
                    [
                        'status' => 'Tiba di Tujuan',
                        'description' => 'Pesanan telah tiba di alamat tujuan',
                        'date' => '2024-01-13 15:20:00',
                        'completed' => true
                    ]
                ]
            ],
            [
                'id' => 'ORD-789004',
                'order_number' => 'ORD-789004',
                'date' => '2024-01-10 16:45:00',
                'status' => 'completed',
                'status_text' => 'Selesai',
                'total' => 189000,
                'items' => [
                    [
                        'name' => 'Kemeja Flanel Pria',
                        'price' => 189000,
                        'quantity' => 1,
                        'image' => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=100&h=100&fit=crop',
                        'category' => 'Fashion',
                        'product_id' => 3
                    ]
                ],
                'payment_method' => 'Credit Card',
                'shipping_method' => 'JNE Reguler',
                'tracking_number' => 'JNE0987654321',
                'estimated_delivery' => '2024-01-12',
                'delivered_date' => '2024-01-12 14:20:00',
                'shipping_proof' => 'https://images.unsplash.com/photo-1556742044-3c52d6e88c62?w=400&h=300&fit=crop',
                'delivery_proof' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=400&h=300&fit=crop',
                'shipping_address' => [
                    'name' => 'John Doe',
                    'phone' => '+62 812-3456-7890',
                    'address' => 'Jl. Contoh Alamat No. 123, Kel. Contoh, Kec. Contoh',
                    'city' => 'Kota Contoh, Provinsi Contoh - 12345'
                ],
                'tracking_history' => [
                    [
                        'status' => 'Pesanan Diterima',
                        'description' => 'Pesanan telah diterima oleh sistem',
                        'date' => '2024-01-10 16:45:00',
                        'completed' => true
                    ],
                    [
                        'status' => 'Pesanan Diproses',
                        'description' => 'Pesanan sedang diproses oleh penjual',
                        'date' => '2024-01-11 09:30:00',
                        'completed' => true
                    ],
                    [
                        'status' => 'Pesanan Dikirim',
                        'description' => 'Pesanan telah dikirim melalui kurir',
                        'date' => '2024-01-11 14:15:00',
                        'completed' => true
                    ],
                    [
                        'status' => 'Dalam Perjalanan',
                        'description' => 'Pesanan sedang dalam perjalanan ke alamat tujuan',
                        'date' => '2024-01-12 10:00:00',
                        'completed' => true
                    ],
                    [
                        'status' => 'Tiba di Tujuan',
                        'description' => 'Pesanan telah tiba di alamat tujuan',
                        'date' => '2024-01-12 14:20:00',
                        'completed' => true
                    ]
                ],
                'review' => [
                    'rating' => 5,
                    'comment' => 'Kemeja sangat bagus, bahan nyaman dan sesuai dengan gambar. Pengiriman cepat!',
                    'created_at' => '2024-01-13 10:30:00'
                ]
            ],
            [
                'id' => 'ORD-789006',
                'order_number' => 'ORD-789006',
                'date' => '2024-01-08 14:20:00',
                'status' => 'completed',
                'status_text' => 'Selesai',
                'total' => 325000,
                'items' => [
                    [
                        'name' => 'Tas Ransel Outdoor',
                        'price' => 299000,
                        'quantity' => 1,
                        'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=100&h=100&fit=crop',
                        'category' => 'Fashion',
                        'product_id' => 4
                    ]
                ],
                'payment_method' => 'GoPay',
                'shipping_method' => 'JNE Express',
                'tracking_number' => 'JNE1122334455',
                'estimated_delivery' => '2024-01-10',
                'delivered_date' => '2024-01-09 16:45:00',
                'shipping_proof' => 'https://images.unsplash.com/photo-1556742044-3c52d6e88c62?w=400&h=300&fit=crop',
                'delivery_proof' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=400&h=300&fit=crop',
                'shipping_address' => [
                    'name' => 'John Doe',
                    'phone' => '+62 812-3456-7890',
                    'address' => 'Jl. Contoh Alamat No. 123, Kel. Contoh, Kec. Contoh',
                    'city' => 'Kota Contoh, Provinsi Contoh - 12345'
                ],
                'review' => [
                    'rating' => 4,
                    'comment' => 'Tasnya kokoh dan berkualitas, tapi pengiriman agak lama. Overall puas!',
                    'created_at' => '2024-01-10 09:15:00'
                ]
            ]
        ];

        // Pisahkan pesanan aktif (dikirim) dan riwayat (terkirim & selesai)
        $activeOrders = array_filter($orders, function ($order) {
            return $order['status'] === 'shipped';
        });

        $orderHistory = array_filter($orders, function ($order) {
            return in_array($order['status'], ['delivered', 'completed']);
        });

        return view('stores.orders', compact('activeOrders', 'orderHistory'));
    }

    // Fungsi untuk menyimpan ulasan
    public function submitReview(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|string',
            'product_id' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:500'
        ]);

        // Simpan ulasan ke database
        // $review = Review::create($validated);

        // Untuk demo, kita return success
        return response()->json([
            'success' => true,
            'message' => 'Ulasan berhasil dikirim!',
            'review' => [
                'rating' => $validated['rating'],
                'comment' => $validated['comment'],
                'created_at' => now()->toDateTimeString()
            ]
        ]);
    }
}
