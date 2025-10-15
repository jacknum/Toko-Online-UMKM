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
                    <img src="https://via.placeholder.com/500x300" alt="Hero Image" class="img-fluid">
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
            <div class="col-md-3 col-6 mb-4">
                <div class="store-category-card">
                    <div class="store-category-icon">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <h5>Fashion</h5>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="store-category-card">
                    <div class="store-category-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h5>Makanan</h5>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="store-category-card">
                    <div class="store-category-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h5>Dekorasi</h5>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <div class="store-category-card">
                    <div class="store-category-icon">
                        <i class="fas fa-hand-sparkles"></i>
                    </div>
                    <h5>Kecantikan</h5>
                </div>
            </div>
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
            @for($i = 0; $i < 4; $i++)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="store-product-card">
                    <div class="store-product-image">
                        <img src="https://via.placeholder.com/250x200" alt="Product Image">
                        <div class="store-product-badge">Trending</div>
                        <button class="store-wishlist-btn">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                    <div class="store-product-info">
                        <h5 class="store-product-title">Nama Produk {{ $i + 1 }}</h5>
                        <p class="store-product-desc">Deskripsi singkat produk yang menarik</p>
                        <div class="store-product-price">
                            <span class="store-price-current">Rp 150.000</span>
                            <span class="store-price-original">Rp 200.000</span>
                        </div>
                        <div class="store-product-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span class="store-rating-count">(128)</span>
                        </div>
                        <button class="btn store-add-to-cart">
                            <i class="fas fa-shopping-cart me-2"></i>
                            Tambah Keranjang
                        </button>
                    </div>
                </div>
            </div>
            @endfor
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
            @for($i = 0; $i < 4; $i++)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="store-product-card">
                    <div class="store-product-image">
                        <img src="https://via.placeholder.com/250x200" alt="Product Image">
                        <div class="store-product-badge discount">-30%</div>
                        <button class="store-wishlist-btn">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                    <div class="store-product-info">
                        <h5 class="store-product-title">Produk Diskon {{ $i + 1 }}</h5>
                        <p class="store-product-desc">Produk dengan diskon menarik</p>
                        <div class="store-product-price">
                            <span class="store-price-current">Rp 120.000</span>
                            <span class="store-price-original">Rp 170.000</span>
                        </div>
                        <div class="store-product-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <span class="store-rating-count">(95)</span>
                        </div>
                        <button class="btn store-add-to-cart">
                            <i class="fas fa-shopping-cart me-2"></i>
                            Tambah Keranjang
                        </button>
                    </div>
                </div>
            </div>
            @endfor
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
@endsection
