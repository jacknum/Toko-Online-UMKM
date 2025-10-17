@extends('layouts.store')

@section('title', 'Home - Toko UMKM')

@section('content')
<!-- Hero Section -->
<section class="store-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="store-hero-title">Temukan Produk UMKM Terbaik</h1>
                <p class="store-hero-subtitle">Dukung produk lokal dengan kualitas terbaik dan harga terjangkau</p>
                <button class="btn store-hero-btn">
                    <i class="fas fa-shopping-bag me-2"></i>
                    Belanja Sekarang
                </button>
            </div>
            <div class="col-lg-6">
                <div class="store-hero-image">
                    <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=500&h=300&fit=crop" alt="Toko UMKM" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="store-categories">
    <div class="container">
        <h2 class="store-section-title">Kategori Produk</h2>
        <div class="row">
            @foreach($categories as $category)
            <div class="col-md-3 col-6 mb-4">
                <div class="store-category-card">
                    <div class="store-category-icon">
                        <i class="{{ $category['icon'] }}"></i>
                    </div>
                    <h5>{{ $category['name'] }}</h5>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Trending Products -->
<section class="store-trending">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="store-section-title">Sedang Trend</h2>
            <a href="#" class="store-view-all">Lihat Semua <i class="fas fa-arrow-right ms-1"></i></a>
        </div>
        <div class="row">
            @foreach($trendingProducts as $product)
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="{{ route('store.product.detail', $product['id']) }}" class="product-link">
                    <div class="store-product-card">
                        <div class="store-product-image">
                            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="img-fluid">
                            <div class="store-product-badge">{{ $product['badge'] }}</div>
                            <button class="store-wishlist-btn" onclick="event.preventDefault(); addToWishlist({{ $product['id'] }})">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="store-product-info">
                            <h5 class="store-product-title">{{ $product['name'] }}</h5>
                            <p class="store-product-desc">{{ $product['description'] }}</p>
                            <div class="store-product-price">
                                <span class="store-price-current">Rp {{ number_format($product['price'], 0, ',', '.') }}</span>
                                @if($product['original_price'] > $product['price'])
                                <span class="store-price-original">Rp {{ number_format($product['original_price'], 0, ',', '.') }}</span>
                                @endif
                            </div>
                            <div class="store-product-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($product['rating']))
                                    <i class="fas fa-star"></i>
                                    @elseif($i == ceil($product['rating']) && !is_int($product['rating']))
                                    <i class="fas fa-star-half-alt"></i>
                                    @else
                                    <i class="far fa-star"></i>
                                    @endif
                                @endfor
                                <span class="store-rating-count">({{ $product['review_count'] }})</span>
                            </div>
                            <button class="btn store-add-to-cart" onclick="event.preventDefault(); addToCart({{ $product['id'] }})">
                                <i class="fas fa-shopping-cart me-2"></i>
                                Tambah Keranjang
                            </button>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Discount Products -->
<section class="store-discount">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="store-section-title">Diskon Spesial</h2>
            <a href="#" class="store-view-all">Lihat Semua <i class="fas fa-arrow-right ms-1"></i></a>
        </div>
        <div class="row">
            @foreach($discountProducts as $product)
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="{{ route('store.product.detail', $product['id']) }}" class="product-link">
                    <div class="store-product-card">
                        <div class="store-product-image">
                            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="img-fluid">
                            <div class="store-product-badge discount">-{{ $product['discount_percent'] }}%</div>
                            <button class="store-wishlist-btn" onclick="event.preventDefault(); addToWishlist({{ $product['id'] }})">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="store-product-info">
                            <h5 class="store-product-title">{{ $product['name'] }}</h5>
                            <p class="store-product-desc">{{ $product['description'] }}</p>
                            <div class="store-product-price">
                                <span class="store-price-current">Rp {{ number_format($product['price'], 0, ',', '.') }}</span>
                                <span class="store-price-original">Rp {{ number_format($product['original_price'], 0, ',', '.') }}</span>
                            </div>
                            <div class="store-product-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($product['rating']))
                                    <i class="fas fa-star"></i>
                                    @elseif($i == ceil($product['rating']) && !is_int($product['rating']))
                                    <i class="fas fa-star-half-alt"></i>
                                    @else
                                    <i class="far fa-star"></i>
                                    @endif
                                @endfor
                                <span class="store-rating-count">({{ $product['review_count'] }})</span>
                            </div>
                            <button class="btn store-add-to-cart" onclick="event.preventDefault(); addToCart({{ $product['id'] }})">
                                <i class="fas fa-shopping-cart me-2"></i>
                                Tambah Keranjang
                            </button>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="store-features">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="store-feature-card">
                    <div class="store-feature-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h5>Gratis Ongkir</h5>
                    <p>Gratis ongkir untuk pembelian di atas Rp 200.000</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="store-feature-card">
                    <div class="store-feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5>Garansi</h5>
                    <p>Garansi 30 hari untuk semua produk</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="store-feature-card">
                    <div class="store-feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h5>Support 24/7</h5>
                    <p>Customer service siap membantu kapan saja</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Function to handle add to cart
function addToCart(productId) {
    event.stopPropagation(); // Prevent navigation to product detail
    // Implement add to cart logic here
    console.log('Add to cart:', productId);
    alert('Produk ditambahkan ke keranjang!');
}

// Function to handle add to wishlist
function addToWishlist(productId) {
    event.stopPropagation(); // Prevent navigation to product detail
    // Implement add to wishlist logic here
    console.log('Add to wishlist:', productId);
    alert('Produk ditambahkan ke wishlist!');
}

// Add hover effects for product cards
document.addEventListener('DOMContentLoaded', function() {
    const productCards = document.querySelectorAll('.store-product-card');

    productCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 15px 30px rgba(0, 0, 0, 0.15)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.08)';
        });
    });
});
</script>
@endsection
