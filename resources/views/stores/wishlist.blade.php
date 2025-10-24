@extends('layouts.store')

@section('title', 'Wishlist Saya - Toko UMKM')

@section('content')
<div class="container-fluid bg-light py-4">
    <div class="container">
        <!-- Header -->
        <div class="row align-items-center mb-4">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/" class="text-decoration-none">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                    </ol>
                </nav>
            </div>
            <div class="col-auto">
                <div class="d-flex align-items-center text-muted">
                    <i class="fas fa-heart me-2 text-danger"></i>
                    <span class="fw-medium">{{ count($wishlistItems) }} Item</span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 fw-semibold">Wishlist Saya</h1>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-sort me-1"></i>Urutkan
                        </button>
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-filter me-1"></i>Filter
                        </button>
                    </div>
                </div>

                @if(count($wishlistItems) > 0)
                <!-- Wishlist Items Grid -->
                <div class="row g-4">
                    @foreach($wishlistItems as $item)
                    <div class="col-6 col-md-4 col-lg-3">
                        <!-- Product Card - Now clickable for product detail -->
                        <div class="card product-card h-100 border-0 shadow-sm position-relative" 
                             onclick="window.location.href='/store/product/{{ $item['id'] }}'" 
                             style="cursor: pointer;">
                            <!-- Wishlist Button -->
                            <button class="btn-wishlist active" data-product-id="{{ $item['id'] }}" onclick="event.stopPropagation()">
                                <i class="fas fa-heart"></i>
                            </button>

                            <!-- Product Image -->
                            <div class="product-image-wrapper">
                                <img src="{{ $item['image'] }}" class="card-img-top" alt="{{ $item['name'] }}" style="height: 200px; object-fit: cover;">
                                
                                <!-- Product Badges Container -->
                                <div class="product-badges">
                                    @if($item['discount'])
                                    <span class="product-badge discount">-{{ $item['discount'] }}%</span>
                                    @endif
                                    @if($item['is_new'])
                                    <span class="product-badge new">Baru</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="card-body d-flex flex-column p-3">
                                <h6 class="card-title fw-semibold mb-2 line-clamp-2" style="min-height: 48px;">{{ $item['name'] }}</h6>
                                
                                <div class="mb-2">
                                    @if($item['discount'])
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="text-danger fw-bold fs-6">Rp {{ number_format($item['discounted_price'], 0, ',', '.') }}</span>
                                        <span class="text-muted text-decoration-line-through small">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                                    </div>
                                    @else
                                    <span class="text-primary fw-bold fs-6">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                                    @endif
                                </div>

                                <!-- Rating -->
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rating-stars me-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $item['rating'])
                                            <i class="fas fa-star text-warning small"></i>
                                            @else
                                            <i class="far fa-star text-muted small"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <small class="text-muted">({{ $item['review_count'] }})</small>
                                </div>

                                <!-- Stock & Store -->
                                <div class="mb-3">
                                    @if($item['stock'] > 0)
                                    <span class="badge bg-success bg-opacity-10 text-success small">
                                        <i class="fas fa-check-circle me-1"></i>Tersedia
                                    </span>
                                    @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger small">
                                        <i class="fas fa-times-circle me-1"></i>Habis
                                    </span>
                                    @endif
                                    <small class="text-muted d-block mt-1">{{ $item['store_name'] }}</small>
                                </div>

                                <!-- Action Buttons -->
                                <div class="mt-auto" onclick="event.stopPropagation()">
                                    @if($item['stock'] > 0)
                                    <button class="btn btn-primary btn-sm w-100 mb-2 add-to-cart" 
                                            data-product-id="{{ $item['id'] }}"
                                            data-in-cart="false">
                                        <i class="fas fa-cart-plus me-1"></i>Tambah ke Keranjang
                                    </button>
                                    @else
                                    <button class="btn btn-outline-secondary btn-sm w-100 mb-2" disabled>
                                        <i class="fas fa-bell me-1"></i>Notifikasi Stok
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Load More -->
                <div class="text-center mt-5">
                    <button class="btn btn-outline-primary">
                        <i class="fas fa-redo me-2"></i>Muat Lebih Banyak
                    </button>
                </div>

                @else
                <!-- Empty Wishlist State -->
                <div class="text-center py-5 my-5">
                    <div class="empty-wishlist-icon mb-4">
                        <i class="fas fa-heart fa-4x text-muted opacity-25"></i>
                    </div>
                    <h3 class="fw-semibold mb-3">Wishlist Kosong</h3>
                    <p class="text-muted mb-4">Belum ada produk yang disimpan di wishlist Anda.</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="/" class="btn btn-primary btn-lg">
                            <i class="fas fa-shopping-bag me-2"></i>Jelajahi Produk
                        </a>
                        <a href="/store" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-search me-2"></i>Cari Produk
                        </a>
                    </div>
                </div>
                @endif

                <!-- Recommended Products -->
                <div class="mt-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-semibold mb-0">Rekomendasi Untuk Anda</h5>
                        <a href="/store" class="btn btn-link text-decoration-none p-0">
                            Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="row g-3">
                        @foreach($recommendedProducts as $product)
                        <div class="col-6 col-md-3">
                            <div class="card product-card h-100 border-0 shadow-sm position-relative">
                                <!-- Wishlist Button for Recommended -->
                                <button class="btn-wishlist" data-product-id="{{ $product['id'] }}">
                                    <i class="far fa-heart"></i>
                                </button>

                                <div class="product-image-wrapper">
                                    <img src="{{ $product['image'] }}" class="card-img-top" alt="{{ $product['name'] }}" style="height: 160px; object-fit: cover;">
                                    
                                    <!-- Badges for Recommended Products -->
                                    <div class="product-badges">
                                        @if(isset($product['discount']) && $product['discount'])
                                        <span class="product-badge discount">-{{ $product['discount'] }}%</span>
                                        @endif
                                        @if(isset($product['is_new']) && $product['is_new'])
                                        <span class="product-badge new">Baru</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body p-3 d-flex flex-column">
                                    <h6 class="card-title small line-clamp-2 mb-2" style="min-height: 40px;">{{ $product['name'] }}</h6>
                                    
                                    <!-- Price Section -->
                                    <div class="mb-2">
                                        @if(isset($product['discount']) && $product['discount'])
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="text-danger fw-bold small">Rp {{ number_format($product['discounted_price'] ?? $product['price'] * (1 - $product['discount']/100), 0, ',', '.') }}</span>
                                            <span class="text-muted text-decoration-line-through smaller">Rp {{ number_format($product['price'], 0, ',', '.') }}</span>
                                        </div>
                                        @else
                                        <span class="text-primary fw-bold small">Rp {{ number_format($product['price'], 0, ',', '.') }}</span>
                                        @endif
                                    </div>

                                    <!-- Rating for Recommended -->
                                    @if(isset($product['rating']))
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="rating-stars me-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $product['rating'])
                                                <i class="fas fa-star text-warning" style="font-size: 0.7rem;"></i>
                                                @else
                                                <i class="far fa-star text-muted" style="font-size: 0.7rem;"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <small class="text-muted">({{ $product['review_count'] ?? 0 }})</small>
                                    </div>
                                    @endif

                                    <!-- Stock Status -->
                                    @if(isset($product['stock']))
                                    <div class="mb-2">
                                        @if($product['stock'] > 0)
                                        <span class="badge bg-success bg-opacity-10 text-success smaller">
                                            <i class="fas fa-check-circle me-1"></i>Tersedia
                                        </span>
                                        @else
                                        <span class="badge bg-danger bg-opacity-10 text-danger smaller">
                                            <i class="fas fa-times-circle me-1"></i>Habis
                                        </span>
                                        @endif
                                    </div>
                                    @endif

                                    <!-- Action Buttons - Removed wishlist button, only cart button -->
                                    <div class="mt-auto">
                                        <button class="btn btn-primary btn-sm w-100 add-to-cart" 
                                                data-product-id="{{ $product['id'] }}"
                                                data-in-cart="false">
                                            <i class="fas fa-cart-plus me-1"></i>Tambah ke Keranjang
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Wishlist functionality
    document.querySelectorAll('.btn-wishlist').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const isActive = this.classList.contains('active');
            
            // Toggle wishlist state
            if (isActive) {
                this.classList.remove('active');
                this.innerHTML = '<i class="far fa-heart"></i>';
                showToast('Produk dihapus dari wishlist', 'info');
            } else {
                this.classList.add('active');
                this.innerHTML = '<i class="fas fa-heart"></i>';
                showToast('Produk ditambahkan ke wishlist', 'success');
            }
            
            // Add animation
            this.classList.add('heart-beat');
            setTimeout(() => {
                this.classList.remove('heart-beat');
            }, 600);
        });
    });

    // Add to cart functionality
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent card click event
            
            const productId = this.getAttribute('data-product-id');
            const isInCart = this.getAttribute('data-in-cart') === 'true';
            
            if (isInCart) {
                // Remove from cart
                removeFromCart(this, productId);
            } else {
                // Add to cart
                addToCart(this, productId);
            }
        });
    });

    // View product detail - now handled by card click
    document.querySelectorAll('.view-product').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent card click event
            const productId = this.getAttribute('data-product-id');
            // Redirect to product detail page
            window.location.href = `/store/product/${productId}`;
        });
    });

    // Function to add to cart
    function addToCart(button, productId) {
        // Show loading state
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menambahkan...';
        button.disabled = true;
        
        // Simulate API call
        setTimeout(() => {
            // Update button state
            button.innerHTML = '<i class="fas fa-shopping-cart me-1"></i>Dalam Keranjang';
            button.setAttribute('data-in-cart', 'true');
            button.classList.add('btn-cart-added', 'cart-pulse');
            
            // Remove animation class after animation completes
            setTimeout(() => {
                button.classList.remove('cart-pulse');
            }, 500);
            
            // Re-enable button
            button.disabled = false;
            
            showToast('Produk berhasil ditambahkan ke keranjang', 'success');
        }, 1000);
    }

    // Function to remove from cart
    function removeFromCart(button, productId) {
        // Show loading state
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menghapus...';
        button.disabled = true;
        
        // Simulate API call
        setTimeout(() => {
            // Update button state
            button.innerHTML = '<i class="fas fa-cart-plus me-1"></i>Tambah ke Keranjang';
            button.setAttribute('data-in-cart', 'false');
            button.classList.remove('btn-cart-added');
            button.classList.add('btn-cart-removed', 'cart-pulse');
            
            // Remove animation class after animation completes
            setTimeout(() => {
                button.classList.remove('cart-pulse', 'btn-cart-removed');
            }, 500);
            
            // Re-enable button
            button.disabled = false;
            
            showToast('Produk dihapus dari keranjang', 'info');
        }, 1000);
    }

    // Toast notification function
    function showToast(message, type = 'info') {
        // Create toast element
        const toast = document.createElement('div');
        toast.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        toast.style.cssText = `
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        `;
        toast.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(toast);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 3000);
    }
});
</script>
@endsection