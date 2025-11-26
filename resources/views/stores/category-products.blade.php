@extends('layouts.store')

@section('title', $category->name . ' - Toko UMKM')

@section('content')
<!-- Category Products Page -->
<section class="store-category-products">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/store') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('store.categories') }}">Kategori</a></li>
                        <li class="breadcrumb-item active">{{ $category->name }}</li>
                    </ol>
                </nav>

                <div class="store-category-header">
                    <div class="store-category-title-section">
                        <div>
                            <h1 class="store-page-title text-white">{{ $category->name }}</h1>
                            <p class="store-page-subtitle text-white">Temukan produk {{ ($category->name) }} terbaik dari UMKM lokal</p>
                        </div>
                    </div>
                    <div class="store-category-stats">
                        <span class="store-product-count">{{ $products->total() }} produk tersedia</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row">
            @forelse($products as $product)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="store-product-card">
                    <a href="{{ route('store.product.detail', $product->id) }}" class="product-link">
                        <div class="store-product-image">
                            <img src="{{ $product->image ?: 'https://via.placeholder.com/300x300' }}"
                                 alt="{{ $product->name }}"
                                 class="img-fluid"
                                 onerror="this.src='https://via.placeholder.com/300x300'">
                            @if($product->discount_percent > 0)
                            <div class="store-product-badge discount">-{{ $product->discount_percent }}%</div>
                            @elseif($product->is_trending)
                            <div class="store-product-badge">Trending</div>
                            @endif
                        </div>
                    </a>
                    <button class="store-wishlist-btn" data-product-id="{{ $product->id }}" onclick="event.preventDefault(); event.stopPropagation();">
                        <i class="far fa-heart"></i>
                    </button>
                    <div class="store-product-info">
                        <a href="{{ route('store.product.detail', $product->id) }}" class="product-link">
                            <h5 class="store-product-title">{{ $product->name }}</h5>
                            <p class="store-product-desc">{{ Str::limit($product->description ?? 'Produk berkualitas dari UMKM lokal', 60) }}</p>
                        </a>
                        <div class="store-product-price">
                            <span class="store-price-current">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @if($product->original_price && $product->original_price > $product->price)
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
                        <button class="btn store-add-to-cart" data-product-id="{{ $product->id }}" onclick="event.preventDefault(); event.stopPropagation();">
                            <i class="fas fa-shopping-cart me-2"></i>Tambah Keranjang
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-5">
                    <i class="fas fa-info-circle fa-3x mb-3"></i>
                    <h4>Belum ada produk dalam kategori ini</h4>
                    <p class="mb-3">Kategori {{ $category->name }} saat ini belum memiliki produk. Silakan cek kategori lainnya.</p>
                    <a href="{{ route('store.categories') }}" class="btn btn-primary">
                        <i class="fas fa-th me-2"></i>Lihat Semua Kategori
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
        <div class="row mt-5">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Include Modals from index -->
@include('stores.partials.modals')

<style>
/* Product Card Styles */
.store-product-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    position: relative;
}

.store-product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

.store-product-image {
    position: relative;
    overflow: hidden;
    height: 250px;
}

.store-product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.store-product-card:hover .store-product-image img {
    transform: scale(1.1);
}

.store-product-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #ff4757;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    z-index: 2;
}

.store-product-badge.discount {
    background: #ff6348;
}

.store-wishlist-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 2;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.store-wishlist-btn:hover {
    background: #ff4757;
    color: white;
}

.store-wishlist-btn.active i {
    color: #ff4757;
}

.store-product-info {
    padding: 20px;
}

.store-product-title {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 10px;
    color: #2d3436;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.store-product-desc {
    font-size: 14px;
    color: #636e72;
    margin-bottom: 15px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.store-product-price {
    margin-bottom: 10px;
}

.store-price-current {
    font-size: 20px;
    font-weight: 700;
    color: #ff6348;
}

.store-price-original {
    font-size: 14px;
    color: #b2bec3;
    text-decoration: line-through;
    margin-left: 8px;
}

.store-product-rating {
    margin-bottom: 15px;
}

.store-product-rating i {
    color: #ffd700;
    font-size: 14px;
}

.store-rating-count {
    font-size: 14px;
    color: #636e72;
    margin-left: 5px;
}

.store-add-to-cart {
    width: 100%;
    background: #0984e3;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.store-add-to-cart:hover {
    background: #0770c7;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(9, 132, 227, 0.3);
}

.store-add-to-cart.added {
    background: #28a745;
}

/* Category Header */
.store-category-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 40px;
    border-radius: 20px;
    margin-bottom: 40px;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.store-category-title-section {
    display: flex;
    align-items: center;
    gap: 20px;
}

.store-category-icon-large {
    width: 80px;
    height: 80px;
    background: rgba(255,255,255,0.2);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
}

.store-page-title {
    font-size: 32px;
    font-weight: 700;
    margin: 0;
}

.store-page-subtitle {
    font-size: 16px;
    opacity: 0.9;
    margin: 5px 0 0 0;
}

.store-product-count {
    background: rgba(255,255,255,0.2);
    padding: 10px 20px;
    border-radius: 30px;
    font-weight: 600;
}

.product-link {
    text-decoration: none;
    color: inherit;
}

.product-link:hover {
    color: inherit;
}
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
    }

    bindWishlistEvents() {
        document.querySelectorAll('.store-wishlist-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                this.toggleWishlist(btn.dataset.productId, btn);
            });
        });
    }

    bindCartEvents() {
        document.querySelectorAll('.store-add-to-cart').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                this.toggleCart(btn.dataset.productId, btn);
            });
        });
    }

    toggleWishlist(productId, button) {
        const isInWishlist = this.wishlistState.get(productId) || false;
        const icon = button.querySelector('i');

        if (!isInWishlist) {
            this.wishlistState.set(productId, true);
            icon.classList.replace('far', 'fas');
            button.classList.add('active');
            this.showToast('✓ Ditambahkan ke wishlist', 'success');
        } else {
            this.wishlistState.set(productId, false);
            icon.classList.replace('fas', 'far');
            button.classList.remove('active');
            this.showToast('✗ Dihapus dari wishlist', 'info');
        }
    }

    toggleCart(productId, button) {
        const isInCart = this.cartState.get(productId) || false;

        if (!isInCart) {
            this.cartState.set(productId, true);
            button.classList.add('added');
            button.innerHTML = '<i class="fas fa-check me-2"></i>Dalam Keranjang';
            this.showToast('✓ Ditambahkan ke keranjang', 'success');
        } else {
            this.cartState.set(productId, false);
            button.classList.remove('added');
            button.innerHTML = '<i class="fas fa-shopping-cart me-2"></i>Tambah Keranjang';
            this.showToast('✗ Dihapus dari keranjang', 'info');
        }
    }

    showToast(message, type) {
        const bgColor = type === 'success' ? '#28a745' : '#17a2b8';
        const toast = document.createElement('div');
        toast.className = 'position-fixed top-0 end-0 m-3';
        toast.style.zIndex = '9999';
        toast.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert" style="background: ${bgColor}; color: white; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.2);">
                <strong>${message}</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        `;
        document.body.appendChild(toast);

        setTimeout(() => toast.remove(), 3000);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new ProductManager();
});
</script>
@endsection
