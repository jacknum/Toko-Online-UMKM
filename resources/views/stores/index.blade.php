@extends('layouts.store')

@section('title', 'Home - Toko UMKM')

@section('content')

<!-- Modals (tetap sama) -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
    <!-- Modal content tetap sama -->
</div>

<!-- Hero Section -->
<section class="store-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="store-hero-title">Temukan Produk UMKM Terbaik</h1>
                <p class="store-hero-subtitle">Dukung produk lokal dengan kualitas terbaik dan harga terjangkau</p>
                <a href="#trending" class="btn store-hero-btn">Belanja Sekarang</a>
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
                <a href="{{ route('stores.category-products', $category->id) }}" class="category-link">
                    <div class="store-category-card">
                        <div class="store-category-icon">
                            <i class="{{ $category->icon }}"></i>
                        </div>
                        <h5>{{ $category->name }}</h5>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('stores.categories') }}" class="btn store-view-all">Lihat Semua Kategori</a>
        </div>
    </div>
</section>

<!-- Trending Products -->
<section class="store-trending" id="trending">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="store-section-title">Sedang Trend</h2>
            <a href="{{ route('stores.category-products', 'trending') }}" class="store-view-all">Lihat Semua</a>
        </div>
        <div class="row">
            @foreach($trendingProducts as $product)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="store-product-card">
                    <a href="{{ route('store.product.detail', $product->id) }}" class="product-link">
                        <div class="store-product-image">
                            <img src="{{ $product->image ?: 'https://via.placeholder.com/300x300' }}" alt="{{ $product->name }}" class="img-fluid">
                            @if($product->discount_percent > 0)
                            <div class="store-product-badge discount">-{{ $product->discount_percent }}%</div>
                            @elseif($product->is_trending)
                            <div class="store-product-badge">Trending</div>
                            @endif
                        </div>
                    </a>
                    <button class="store-wishlist-btn" data-product-id="{{ $product->id }}">
                        <i class="far fa-heart"></i>
                    </button>
                    <div class="store-product-info">
                        <a href="{{ route('store.product.detail', $product->id) }}" class="product-link">
                            <h5 class="store-product-title">{{ $product->name }}</h5>
                            <p class="store-product-desc">{{ Str::limit($product->description, 60) }}</p>
                        </a>
                        <div class="store-product-price">
                            <span class="store-price-current">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @if($product->original_price > $product->price)
                            <span class="store-price-original">Rp {{ number_format($product->original_price, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        <div class="store-product-rating">
                            @php
                                $rating = $product->rating ?? 0;
                                $fullStars = floor($rating);
                                $halfStar = $rating - $fullStars >= 0.5;
                                $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                            @endphp
                            
                            @for($i = 0; $i < $fullStars; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                            
                            @if($halfStar)
                                <i class="fas fa-star-half-alt"></i>
                            @endif
                            
                            @for($i = 0; $i < $emptyStars; $i++)
                                <i class="far fa-star"></i>
                            @endfor
                            
                            <span class="store-rating-count">({{ $product->review_count ?? 0 }})</span>
                        </div>
                        <button class="btn store-add-to-cart" data-product-id="{{ $product->id }}">
                            <i class="fas fa-shopping-cart me-2"></i>Tambah Keranjang
                        </button>
                    </div>
                </div>
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
            <a href="{{ route('stores.category.products', 'discount') }}" class="store-view-all">Lihat Semua</a>
        </div>
        <div class="row">
            @foreach($discountProducts as $product)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="store-product-card">
                    <a href="{{ route('store.product.detail', $product->id) }}" class="product-link">
                        <div class="store-product-image">
                            <img src="{{ $product->image ?: 'https://via.placeholder.com/300x300' }}" alt="{{ $product->name }}" class="img-fluid">
                            @if($product->discount_percent > 0)
                            <div class="store-product-badge discount">-{{ $product->discount_percent }}%</div>
                            @endif
                        </div>
                    </a>
                    <button class="store-wishlist-btn" data-product-id="{{ $product->id }}">
                        <i class="far fa-heart"></i>
                    </button>
                    <div class="store-product-info">
                        <a href="{{ route('store.product.detail', $product->id) }}" class="product-link">
                            <h5 class="store-product-title">{{ $product->name }}</h5>
                            <p class="store-product-desc">{{ Str::limit($product->description, 60) }}</p>
                        </a>
                        <div class="store-product-price">
                            <span class="store-price-current">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @if($product->original_price > $product->price)
                            <span class="store-price-original">Rp {{ number_format($product->original_price, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        <div class="store-product-rating">
                            @php
                                $rating = $product->rating ?? 0;
                                $fullStars = floor($rating);
                                $halfStar = $rating - $fullStars >= 0.5;
                                $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                            @endphp
                            
                            @for($i = 0; $i < $fullStars; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                            
                            @if($halfStar)
                                <i class="fas fa-star-half-alt"></i>
                            @endif
                            
                            @for($i = 0; $i < $emptyStars; $i++)
                                <i class="far fa-star"></i>
                            @endfor
                            
                            <span class="store-rating-count">({{ $product->review_count ?? 0 }})</span>
                        </div>
                        <button class="btn store-add-to-cart" data-product-id="{{ $product->id }}">
                            <i class="fas fa-shopping-cart me-2"></i>Tambah Keranjang
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Features Section (tetap sama) -->
<section class="store-features">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="store-feature-card">
                    <div class="store-feature-icon"><i class="fas fa-shipping-fast"></i></div>
                    <h5>Gratis Ongkir</h5>
                    <p>Gratis ongkir untuk pembelian di atas Rp 200.000</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="store-feature-card">
                    <div class="store-feature-icon"><i class="fas fa-shield-alt"></i></div>
                    <h5>Garansi</h5>
                    <p>Garansi 30 hari untuk semua produk</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="store-feature-card">
                    <div class="store-feature-icon"><i class="fas fa-headset"></i></div>
                    <h5>Support 24/7</h5>
                    <p>Customer service siap membantu kapan saja</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Animation Base */
.success-animation, .remove-animation, .heart-animation, .heart-remove-animation {
    width: 80px; height: 80px; margin: 0 auto;
}

.success-animation i { font-size: 4rem; color: #28a745; animation: successPop 0.6s ease; }
.remove-animation i { font-size: 4rem; color: #dc3545; animation: removePop 0.6s ease; }
.heart-animation i { font-size: 4rem; color: #dc3545; animation: heartBeat 0.6s ease; }
.heart-remove-animation i { font-size: 4rem; color: #6c757d; animation: heartBreak 0.8s ease; }

@keyframes successPop {
    0% { transform: scale(0.5); opacity: 0; }
    70% { transform: scale(1.2); }
    100% { transform: scale(1); opacity: 1; }
}

@keyframes removePop {
    0% { transform: scale(0.5) rotate(0deg); opacity: 0; }
    50% { transform: scale(1.3) rotate(180deg); }
    100% { transform: scale(1) rotate(360deg); opacity: 1; }
}

@keyframes heartBeat {
    0% { transform: scale(1); }
    25% { transform: scale(1.3); }
    50% { transform: scale(1.1); }
    75% { transform: scale(1.2); }
    100% { transform: scale(1); }
}

@keyframes heartBreak {
    0% { transform: scale(1) rotate(0deg); color: #dc3545; }
    25% { transform: scale(1.2) rotate(-15deg); color: #ff6b7a; }
    50% { transform: scale(1.1) rotate(15deg); color: #ff6b7a; }
    75% { transform: scale(0.8) rotate(-10deg); color: #6c757d; opacity: 0.7; }
    100% { transform: scale(1) rotate(0deg); color: #6c757d; opacity: 1; }
}

/* Button States */
.store-wishlist-btn.active i { color: #dc3545 !important; animation: heartPop 0.3s ease; }
.store-add-to-cart.added { background: #28a745 !important; animation: cartPulse 0.5s ease; }
.store-add-to-cart.removing { background: #6c757d !important; animation: cartShrink 0.3s ease; }

@keyframes heartPop { 0% { transform: scale(1); } 50% { transform: scale(1.3); } 100% { transform: scale(1); } }
@keyframes cartPulse { 0% { transform: scale(1); } 50% { transform: scale(1.05); } 100% { transform: scale(1); } }
@keyframes cartShrink { 0% { transform: scale(1); } 50% { transform: scale(0.95); } 100% { transform: scale(1); } }

/* Modal & UI Enhancements */
.modal-content { border: none; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.2); }
.modal-body { padding: 2.5rem !important; }
.btn { border-radius: 10px; font-weight: 600; padding: 12px 24px; transition: all 0.3s ease; }
.btn:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.2); }

.store-product-card { transition: all 0.3s ease; }
.store-product-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.15); }

.store-badge { animation: badgePulse 2s infinite; }
@keyframes badgePulse { 0%,100% { transform: scale(1); } 50% { transform: scale(1.1); } }
</style>

<script>
class ProductManager {
    constructor() {
        this.wishlistState = new Map();
        this.cartState = new Map();
        this.init();
    }

    init() {
        this.bindWishlistEvents();
        this.bindCartEvents();
        this.bindProductCardHover();
        this.autoHideModals();
    }

    bindWishlistEvents() {
        document.querySelectorAll('.store-wishlist-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault(); e.stopPropagation();
                this.toggleWishlist(btn.dataset.productId, btn);
            });
        });
    }

    bindCartEvents() {
        document.querySelectorAll('.store-add-to-cart').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault(); e.stopPropagation();
                this.toggleCart(btn.dataset.productId, btn);
            });
        });
    }

    bindProductCardHover() {
        document.querySelectorAll('.store-product-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-5px)';
                card.style.boxShadow = '0 15px 30px rgba(0,0,0,0.15)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
                card.style.boxShadow = '0 5px 15px rgba(0,0,0,0.08)';
            });
        });
    }

    toggleWishlist(productId, button) {
        const isInWishlist = this.wishlistState.get(productId) || false;
        const icon = button.querySelector('i');

        if (!isInWishlist) {
            this.addToWishlist(productId, button, icon);
        } else {
            this.removeFromWishlist(productId, button, icon);
        }
    }

    addToWishlist(productId, button, icon) {
        this.wishlistState.set(productId, true);
        icon.classList.replace('far', 'fas');
        button.classList.add('active');
        this.showModal('wishlistModal');
        this.updateWishlistCount(1);
    }

    removeFromWishlist(productId, button, icon) {
        this.wishlistState.set(productId, false);
        icon.classList.replace('fas', 'far');
        button.classList.remove('active');
        button.classList.add('removing');
        this.showModal('wishlistRemoveModal');
        this.updateWishlistCount(-1);
        setTimeout(() => button.classList.remove('removing'), 300);
    }

    toggleCart(productId, button) {
        const isInCart = this.cartState.get(productId) || false;

        if (!isInCart) {
            this.addToCart(productId, button);
        } else {
            this.removeFromCart(productId, button);
        }
    }

    addToCart(productId, button) {
        this.cartState.set(productId, true);
        button.classList.add('added');
        button.innerHTML = '<i class="fas fa-check me-2"></i>Dalam Keranjang';
        this.showModal('cartModal');
        this.updateCartCount(1);
    }

    removeFromCart(productId, button) {
        this.cartState.set(productId, false);
        button.classList.remove('added');
        button.classList.add('removing');
        button.innerHTML = '<i class="fas fa-shopping-cart me-2"></i>Tambah Keranjang';
        this.showModal('cartRemoveModal');
        this.updateCartCount(-1);
        setTimeout(() => button.classList.remove('removing'), 300);
    }

    showModal(modalId) {
        const modal = new bootstrap.Modal(document.getElementById(modalId));
        modal.show();
    }

    updateCartCount(increment) {
        this.updateBadgeCount('.store-nav-icon[href*="cart"] .store-badge', increment);
    }

        updateWishlistCount(increment) {
        this.updateBadgeCount('.store-nav-icon[href*="wishlist"] .store-badge', increment);
    }

    updateBadgeCount(selector, increment) {
        const badge = document.querySelector(selector);
        if (!badge) return;

        let current = parseInt(badge.textContent.trim()) || 0;
        let updated = current + increment;

        if (updated < 0) updated = 0;
        badge.textContent = updated;
    }

    autoHideModals() {
        const modals = ['cartModal', 'cartRemoveModal', 'wishlistModal', 'wishlistRemoveModal'];
        modals.forEach(id => {
            const modalElement = document.getElementById(id);
            modalElement.addEventListener('shown.bs.modal', () => {
                setTimeout(() => {
                    const modalInstance = bootstrap.Modal.getInstance(modalElement);
                    if (modalInstance) modalInstance.hide();
                }, 1500);
            });
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new ProductManager();
});
</script>
