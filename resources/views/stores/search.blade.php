@extends('layouts.store')

@section('title', 'Pencarian - Toko UMKM')

@section('content')
<div class="store-search-page">
    <!-- Search Header - Minimalis -->
    <section class="store-search-header">
        <div class="container">
            <div class="search-header-content">
                @if (!empty($searchTerm))
                    <nav class="search-breadcrumb">
                        <a href="{{ route('store.home') }}" class="breadcrumb-link">
                            <i class="fas fa-home"></i>
                            Beranda
                        </a>
                        <span class="breadcrumb-divider">/</span>
                        <span class="breadcrumb-current">Pencarian</span>
                    </nav>
                    
                    <div class="search-results-summary">
                        <h1 class="search-title">Hasil Pencarian</h1>
                        <p class="search-subtitle">
                            Menampilkan <strong>{{ count($searchResults) }} produk</strong> untuk 
                            "<span class="search-query">{{ $searchTerm }}</span>"
                        </p>
                    </div>
                @else
                    <div class="empty-search-header">
                        <div class="search-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h1 class="search-title">Cari Produk UMKM</h1>
                        <p class="search-subtitle">Temukan produk terbaik dari pelaku UMKM lokal</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Search Results -->
    <section class="store-search-results">
        <div class="container">
            @if (empty($searchTerm))
                <!-- Empty Search State -->
                <div class="empty-search-state">
                    <div class="empty-illustration">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="empty-title">Mulai Pencarian Anda</h3>
                    <p class="empty-text">Gunakan kolom pencarian di atas untuk menemukan produk yang Anda cari</p>
                </div>
            @elseif(count($searchResults) > 0)
                <!-- Results Found -->
                <div class="search-results-layout">
                    <!-- Sidebar Filters -->
                    <aside class="search-filters-sidebar">
                        <div class="filters-card">
                            <div class="filters-header">
                                <h3 class="filters-title">Filter</h3>
                                <button class="filters-clear">Bersihkan</button>
                            </div>

                            <!-- Price Filter -->
                            <div class="filter-group">
                                <h4 class="filter-label">Rentang Harga</h4>
                                <div class="price-inputs">
                                    <div class="price-field">
                                        <input type="number" id="priceMin" class="price-input" placeholder="Min">
                                        <span class="price-currency">Rp</span>
                                    </div>
                                    <div class="price-field">
                                        <input type="number" id="priceMax" class="price-input" placeholder="Max">
                                        <span class="price-currency">Rp</span>
                                    </div>
                                </div>
                                <button class="filter-apply-btn">Terapkan</button>
                            </div>

                            <!-- Category Filter -->
                            <div class="filter-group">
                                <h4 class="filter-label">Kategori</h4>
                                <div class="category-list">
                                    <label class="category-item">
                                        <input type="checkbox" class="category-checkbox">
                                        <span class="category-text">Pakaian & Fashion</span>
                                        <span class="category-count">(128)</span>
                                    </label>
                                    <label class="category-item">
                                        <input type="checkbox" class="category-checkbox">
                                        <span class="category-text">Makanan & Minuman</span>
                                        <span class="category-count">(64)</span>
                                    </label>
                                    <label class="category-item">
                                        <input type="checkbox" class="category-checkbox">
                                        <span class="category-text">Kerajinan Tangan</span>
                                        <span class="category-count">(42)</span>
                                    </label>
                                    <label class="category-item">
                                        <input type="checkbox" class="category-checkbox">
                                        <span class="category-text">Kesehatan & Kecantikan</span>
                                        <span class="category-count">(36)</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Rating Filter -->
                            <div class="filter-group">
                                <h4 class="filter-label">Rating</h4>
                                <div class="rating-options">
                                    @for($i = 5; $i >= 1; $i--)
                                        <label class="rating-item">
                                            <input type="radio" name="rating" class="rating-radio">
                                            <div class="stars">
                                                @for($j = 1; $j <= 5; $j++)
                                                    @if($j <= $i)
                                                        <i class="fas fa-star"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span class="rating-label">& above</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <!-- Similar Stores -->
                        <div class="similar-stores-card">
                            <h4 class="stores-title">Toko Serupa</h4>
                            <div class="stores-list">
                                <div class="store-item">
                                    <div class="store-avatar">
                                        <img src="https://via.placeholder.com/40x40" alt="Toko A" class="store-image">
                                    </div>
                                    <div class="store-info">
                                        <h5 class="store-name">Toko {{ $searchTerm }} Mandiri</h5>
                                        <div class="store-rating">
                                            <div class="stars small">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <span class="rating-value">4.2</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="store-item">
                                    <div class="store-avatar">
                                        <img src="https://via.placeholder.com/40x40" alt="Toko B" class="store-image">
                                    </div>
                                    <div class="store-info">
                                        <h5 class="store-name">{{ $searchTerm }} Collection</h5>
                                        <div class="store-rating">
                                            <div class="stars small">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <span class="rating-value">4.5</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="store-item">
                                    <div class="store-avatar">
                                        <img src="https://via.placeholder.com/40x40" alt="Toko C" class="store-image">
                                    </div>
                                    <div class="store-info">
                                        <h5 class="store-name">UMKM {{ $searchTerm }} Jaya</h5>
                                        <div class="store-rating">
                                            <div class="stars small">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <span class="rating-value">5.0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Popular Searches -->
                        <div class="popular-searches-card">
                            <h4 class="popular-title">Pencarian Populer</h4>
                            <div class="tags-list">
                                <a href="{{ route('store.search', ['q' => 'kaos']) }}" class="search-tag">Kaos</a>
                                <a href="{{ route('store.search', ['q' => 'makanan']) }}" class="search-tag">Makanan</a>
                                <a href="{{ route('store.search', ['q' => 'kerajinan']) }}" class="search-tag">Kerajinan</a>
                                <a href="{{ route('store.search', ['q' => 'aksesoris']) }}" class="search-tag">Aksesoris</a>
                                <a href="{{ route('store.search', ['q' => 'herbal']) }}" class="search-tag">Herbal</a>
                            </div>
                        </div>
                    </aside>

                    <!-- Main Results -->
                    <main class="search-results-main">
                        <!-- Results Header -->
                        <div class="results-header">
                            <div class="results-info">
                                <span class="results-count">{{ count($searchResults) }} produk ditemukan</span>
                            </div>
                            <div class="results-controls">
                                <div class="sort-wrapper">
                                    <span class="sort-label">Urutkan:</span>
                                    <select class="sort-select">
                                        <option value="relevance">Relevansi</option>
                                        <option value="newest">Terbaru</option>
                                        <option value="price_asc">Harga: Rendah ke Tinggi</option>
                                        <option value="price_desc">Harga: Tinggi ke Rendah</option>
                                        <option value="rating">Rating Tertinggi</option>
                                    </select>
                                </div>
                                <button class="mobile-filters-btn" id="mobileFiltersToggle">
                                    <i class="fas fa-sliders-h"></i>
                                    Filter
                                </button>
                            </div>
                        </div>

                        <!-- Products Grid -->
                        <div class="products-grid" id="productsGrid">
                            @foreach ($searchResults as $product)
                                <div class="product-card">
                                    <div class="product-image-wrapper">
                                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="product-image">
                                        @if (isset($product['badge']))
                                            <span class="product-badge">{{ $product['badge'] }}</span>
                                        @endif
                                        <button class="wishlist-btn">
                                            <i class="far fa-heart"></i>
                                        </button>
                                        @if (isset($product['original_price']) && $product['original_price'] > $product['price'])
                                            @php
                                                $discount = round((($product['original_price'] - $product['price']) / $product['original_price']) * 100);
                                            @endphp
                                            <span class="discount-tag">-{{ $discount }}%</span>
                                        @endif
                                    </div>
                                    
                                    <div class="product-details">
                                        <h3 class="product-name">{{ Str::limit($product['name'], 50) }}</h3>
                                        <p class="product-desc">{{ Str::limit($product['description'], 60) }}</p>
                                        
                                        <div class="product-rating">
                                            <div class="rating-stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= floor($product['rating']))
                                                        <i class="fas fa-star"></i>
                                                    @elseif($i == ceil($product['rating']) && !is_int($product['rating']))
                                                        <i class="fas fa-star-half-alt"></i>
                                                    @else
                                                        <i class="far fa-star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span class="review-count">({{ $product['review_count'] }})</span>
                                        </div>
                                        
                                        <div class="product-pricing">
                                            <span class="current-price">Rp {{ number_format($product['price'], 0, ',', '.') }}</span>
                                            @if (isset($product['original_price']) && $product['original_price'] > $product['price'])
                                                <span class="original-price">Rp {{ number_format($product['original_price'], 0, ',', '.') }}</span>
                                            @endif
                                        </div>
                                        
                                        <button class="cart-btn">
                                            <i class="fas fa-shopping-cart"></i>
                                            Tambah Keranjang
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Load More -->
                        <div class="load-more-section">
                            <button class="load-more-btn">
                                <i class="fas fa-chevron-down"></i>
                                Tampilkan Lebih Banyak
                            </button>
                        </div>
                    </main>
                </div>
            @else
                <!-- No Results -->
                <div class="no-results-state">
                    <div class="no-results-illustration">
                        <i class="fas fa-search"></i>
                    </div>
                    <h2 class="no-results-title">Tidak Ada Hasil Ditemukan</h2>
                    <p class="no-results-text">
                        Maaf, tidak ada produk yang cocok dengan "<strong>{{ $searchTerm }}</strong>"
                    </p>
                    
                    <div class="suggestions">
                        <h4 class="suggestions-title">Saran Pencarian:</h4>
                        <ul class="suggestions-list">
                            <li>Periksa ejaan kata kunci</li>
                            <li>Gunakan kata kunci yang lebih umum</li>
                            <li>Coba kategori lain</li>
                            <li>Gunakan filter yang lebih spesifik</li>
                        </ul>
                    </div>
                    
                    <div class="action-buttons">
                        <a href="{{ route('store.home') }}" class="primary-btn">
                            <i class="fas fa-home"></i>
                            Kembali ke Beranda
                        </a>
                        <a href="{{ route('store.categories') }}" class="secondary-btn">
                            <i class="fas fa-grid"></i>
                            Jelajahi Kategori
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Mobile Filter Modal -->
    <div class="mobile-filters-modal" id="mobileFiltersModal">
        <div class="modal-overlay"></div>
        <div class="modal-container">
            <div class="modal-header">
                <h3 class="modal-title">Filter Produk</h3>
                <button class="modal-close" id="closeMobileFilters">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- Mobile filter content -->
            </div>
            <div class="modal-footer">
                <button class="secondary-btn" id="resetMobileFilters">Reset</button>
                <button class="primary-btn" id="applyMobileFilters">Terapkan</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile filters functionality
        const mobileFiltersToggle = document.getElementById('mobileFiltersToggle');
        const mobileFiltersModal = document.getElementById('mobileFiltersModal');
        const closeMobileFilters = document.getElementById('closeMobileFilters');
        const modalOverlay = document.querySelector('.modal-overlay');

        function openMobileFilters() {
            mobileFiltersModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileFiltersModal() {
            mobileFiltersModal.classList.remove('active');
            document.body.style.overflow = '';
        }

        if (mobileFiltersToggle) {
            mobileFiltersToggle.addEventListener('click', openMobileFilters);
        }
        if (closeMobileFilters) {
            closeMobileFilters.addEventListener('click', closeMobileFiltersModal);
        }
        if (modalOverlay) {
            modalOverlay.addEventListener('click', closeMobileFiltersModal);
        }

        // Wishlist functionality
        const wishlistButtons = document.querySelectorAll('.wishlist-btn');
        wishlistButtons.forEach(button => {
            button.addEventListener('click', function() {
                const icon = this.querySelector('i');
                icon.classList.toggle('far');
                icon.classList.toggle('fas');
                
                // Add animation
                this.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 200);
            });
        });

        // Add to cart functionality
        const cartButtons = document.querySelectorAll('.cart-btn');
        cartButtons.forEach(button => {
            button.addEventListener('click', function() {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                this.disabled = true;
                
                setTimeout(() => {
                    this.innerHTML = '<i class="fas fa-check"></i> Ditambahkan';
                    this.style.background = '#10b981';
                    
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.disabled = false;
                        this.style.background = '';
                    }, 1500);
                }, 800);
            });
        });

        // Sort functionality
        const sortSelect = document.querySelector('.sort-select');
        if (sortSelect) {
            sortSelect.addEventListener('change', function() {
                const productsGrid = document.getElementById('productsGrid');
                productsGrid.style.opacity = '0.6';
                
                setTimeout(() => {
                    // Implement actual sorting logic here
                    console.log('Sorting by:', this.value);
                    productsGrid.style.opacity = '1';
                }, 500);
            });
        }

        // Load more functionality
        const loadMoreBtn = document.querySelector('.load-more-btn');
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', function() {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memuat...';
                this.disabled = true;
                
                setTimeout(() => {
                    // Implement load more logic here
                    this.innerHTML = originalText;
                    this.disabled = false;
                }, 1200);
            });
        }
    });
</script>
@endsection