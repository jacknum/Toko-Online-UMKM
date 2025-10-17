@extends('layouts.store')

@section('title', 'Pencarian - Toko UMKM')

@section('content')
<!-- Search Header -->
<section class="store-search-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="search-info mb-4">
                    <h1 class="search-title">Hasil Pencarian</h1>
                    @if(!empty($searchTerm))
                        <p class="search-subtitle">Menampilkan hasil untuk: <strong>"{{ $searchTerm }}"</strong></p>
                        <p class="search-count">{{ count($searchResults) }} produk ditemukan</p>
                    @else
                        <p class="search-subtitle">Silakan masukkan kata kunci pencarian</p>
                    @endif
                </div>

                <!-- Search Box -->
                <div class="search-box-container mb-5">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <form action="{{ route('store.search') }}" method="GET" class="search-form">
                                <div class="input-group">
                                    <input type="text"
                                           name="q"
                                           class="form-control search-input"
                                           placeholder="Cari produk, kategori, atau merek..."
                                           value="{{ $searchTerm }}"
                                           autocomplete="off">
                                    <button class="btn search-btn" type="submit">
                                        <i class="fas fa-search"></i>
                                        Cari
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Search Results -->
<section class="store-search-results">
    <div class="container">
        @if(empty($searchTerm))
            <!-- Empty State -->
            <div class="empty-search text-center py-5">
                <div class="empty-icon mb-4">
                    <i class="fas fa-search fa-4x text-muted"></i>
                </div>
                <h3 class="empty-title">Mulai Pencarian Anda</h3>
                <p class="empty-subtitle text-muted">Masukkan kata kunci di atas untuk menemukan produk yang Anda cari</p>
            </div>
        @elseif(count($searchResults) > 0)
            <!-- Results Found -->
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="results-title">Produk Ditemukan</h4>
                        <div class="sort-options">
                            <select class="form-select sort-select">
                                <option selected>Urutkan: Relevansi</option>
                                <option value="price_asc">Harga: Rendah ke Tinggi</option>
                                <option value="price_desc">Harga: Tinggi ke Rendah</option>
                                <option value="rating">Rating Tertinggi</option>
                                <option value="newest">Terbaru</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="row">
                    @foreach($searchResults as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="store-product-card">
                            <div class="store-product-image">
                                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="img-fluid">
                                @if(isset($product['badge']))
                                <div class="store-product-badge">{{ $product['badge'] }}</div>
                                @endif
                                <button class="store-wishlist-btn">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                            <div class="store-product-info">
                                <h5 class="store-product-title">{{ $product['name'] }}</h5>
                                <p class="store-product-desc">{{ $product['description'] }}</p>
                                <div class="store-product-price">
                                    <span class="store-price-current">Rp {{ number_format($product['price'], 0, ',', '.') }}</span>
                                    @if(isset($product['original_price']) && $product['original_price'] > $product['price'])
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
                                <button class="btn store-add-to-cart">
                                    <i class="fas fa-shopping-cart me-2"></i>
                                    Tambah Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Load More Button -->
                <div class="row">
                    <div class="col-12 text-center mt-4">
                        <button class="btn btn-outline-primary load-more-btn">
                            <i class="fas fa-refresh me-2"></i>
                            Muat Lebih Banyak
                        </button>
                    </div>
                </div>
            </div>
        @else
            <!-- No Results -->
            <div class="no-results text-center py-5">
                <div class="no-results-icon mb-4">
                    <i class="fas fa-search-minus fa-4x text-muted"></i>
                </div>
                <h3 class="no-results-title">Produk Tidak Ditemukan</h3>
                <p class="no-results-subtitle text-muted">
                    Maaf, tidak ada produk yang cocok dengan pencarian "<strong>{{ $searchTerm }}</strong>"
                </p>
                <div class="suggestions mt-4">
                    <p class="suggestions-title">Saran:</p>
                    <ul class="suggestions-list list-unstyled">
                        <li>• Periksa ejaan kata kunci</li>
                        <li>• Gunakan kata kunci yang lebih umum</li>
                        <li>• Coba kategori lain</li>
                    </ul>
                </div>
                <div class="mt-4">
                    <a href="{{ route('store.home') }}" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Popular Searches -->
@if(!empty($searchTerm) && count($searchResults) > 0)
<section class="popular-searches">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="popular-searches-card">
                    <h5 class="popular-title">Pencarian Populer</h5>
                    <div class="popular-tags">
                        <a href="{{ route('store.search', ['q' => 'kaos']) }}" class="tag">Kaos</a>
                        <a href="{{ route('store.search', ['q' => 'makanan']) }}" class="tag">Makanan</a>
                        <a href="{{ route('store.search', ['q' => 'kerajinan']) }}" class="tag">Kerajinan</a>
                        <a href="{{ route('store.search', ['q' => 'aksesoris']) }}" class="tag">Aksesoris</a>
                        <a href="{{ route('store.search', ['q' => 'herbal']) }}" class="tag">Herbal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search form enhancement
    const searchForm = document.querySelector('.search-form');
    const searchInput = document.querySelector('.search-input');

    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            const searchValue = searchInput.value.trim();
            if (!searchValue) {
                e.preventDefault();
                searchInput.focus();
            }
        });
    }

    // Sort functionality
    const sortSelect = document.querySelector('.sort-select');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            // Implement sorting logic here
            console.log('Sort by:', this.value);
            // You can add AJAX call or page reload with sort parameter
        });
    }

    // Load more functionality
    const loadMoreBtn = document.querySelector('.load-more-btn');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            // Implement load more logic here
            console.log('Load more products');
            // You can add AJAX call to load more products
        });
    }
});
</script>
@endsection
