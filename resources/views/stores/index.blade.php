@extends('layouts.store')

@section('title', 'Home - Toko UMKM')

@section('content')

    <!-- Modals -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="mb-4">
                        <div class="success-animation">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <h4 class="modal-title mb-3 text-success">Berhasil Ditambahkan!</h4>
                    <p class="text-muted mb-4">Produk telah ditambahkan ke keranjang belanja Anda</p>
                    <div class="d-flex gap-3 justify-content-center">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Lanjut
                            Belanja</button>
                        <a href="{{ route('store.cart.index') }}" class="btn btn-primary">Lihat Keranjang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="wishlistModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <div class="heart-animation">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h5 class="mt-3">Ditambahkan ke Wishlist!</h5>
                    <p class="text-muted">Produk berhasil ditambahkan ke daftar keinginan Anda</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="wishlistRemoveModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <div class="heart-remove-animation">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h5 class="mt-3">Dihapus dari Wishlist</h5>
                    <p class="text-muted">Produk dihapus dari daftar keinginan Anda</p>
                </div>
            </div>
        </div>
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
                        <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=500&h=300&fit=crop"
                            alt="Toko UMKM" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="store-categories">
        <div class="container">
            <h2 class="store-section-title">Kategori Produk</h2>
            @if ($categories->count() > 0)
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-md-3 col-6 mb-4">
                            <a href="{{ route('store.category-products', $category->slug) }}" class="category-link">
                                <div class="store-category-card">
                                    <h5>{{ $category->name }}</h5>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('store.categories') }}" class="btn store-view-all">Lihat Semua Kategori</a>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="empty-state">
                        <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum Ada Kategori</h5>
                        <p class="text-muted">Kategori produk akan segera tersedia</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Trending Products -->
    <section class="store-trending" id="trending">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="store-section-title">Sedang Trend</h2>
                @if ($trendingProducts->count() > 0)
                    <a href="{{ route('store.category-products', 'trending') }}" class="store-view-all">Lihat Semua</a>
                @endif
            </div>
            @if ($trendingProducts->count() > 0)
                <div class="row">
                    @foreach ($trendingProducts as $product)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="store-product-card">
                                <a href="{{ route('store.product.detail', $product->id) }}" class="product-link">
                                    <div class="store-product-image">
                                        <img src="{{ $product->image ?: 'https://via.placeholder.com/300x300' }}"
                                            alt="{{ $product->name }}" class="img-fluid">
                                        @if ($product->discount_percent > 0)
                                            <div class="store-product-badge discount">-{{ $product->discount_percent }}%
                                            </div>
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
                                        <span class="store-price-current">Rp
                                            {{ number_format($product->price, 0, ',', '.') }}</span>
                                        @if ($product->original_price > $product->price)
                                            <span class="store-price-original">Rp
                                                {{ number_format($product->original_price, 0, ',', '.') }}</span>
                                        @endif
                                    </div>
                                    <div class="store-product-rating">
                                        @php
                                            $rating = $product->rating ?? 0;
                                            $fullStars = floor($rating);
                                            $halfStar = $rating - $fullStars >= 0.5;
                                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                        @endphp

                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor

                                        @if ($halfStar)
                                            <i class="fas fa-star-half-alt"></i>
                                        @endif

                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="far fa-star"></i>
                                        @endfor

                                        <span class="store-rating-count">({{ $product->review_count ?? 0 }})</span>
                                    </div>
                                    <button class="btn store-add-to-cart" data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->name }}"
                                        data-product-price="{{ $product->price }}"
                                        data-product-image="{{ $product->image }}"
                                        data-product-stock="{{ $product->stock }}">
                                        <i class="fas fa-shopping-cart me-2"></i>Tambah Keranjang
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <div class="empty-state">
                        <i class="fas fa-fire fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum Ada Produk Trending</h5>
                        <p class="text-muted">Produk trending akan segera tersedia</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Discount Products -->
    <section class="store-discount">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="store-section-title">Diskon Spesial</h2>
                @if ($discountProducts->count() > 0)
                    <a href="{{ route('store.category-products', 'discount') }}" class="store-view-all">Lihat Semua</a>
                @endif
            </div>
            @if ($discountProducts->count() > 0)
                <div class="row">
                    @foreach ($discountProducts as $product)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="store-product-card">
                                <a href="{{ route('store.product.detail', $product->id) }}" class="product-link">
                                    <div class="store-product-image">
                                        <img src="{{ $product->image ?: 'https://via.placeholder.com/300x300' }}"
                                            alt="{{ $product->name }}" class="img-fluid">
                                        @if ($product->discount_percent > 0)
                                            <div class="store-product-badge discount">-{{ $product->discount_percent }}%
                                            </div>
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
                                        <span class="store-price-current">Rp
                                            {{ number_format($product->price, 0, ',', '.') }}</span>
                                        @if ($product->original_price > $product->price)
                                            <span class="store-price-original">Rp
                                                {{ number_format($product->original_price, 0, ',', '.') }}</span>
                                        @endif
                                    </div>
                                    <div class="store-product-rating">
                                        @php
                                            $rating = $product->rating ?? 0;
                                            $fullStars = floor($rating);
                                            $halfStar = $rating - $fullStars >= 0.5;
                                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                        @endphp

                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor

                                        @if ($halfStar)
                                            <i class="fas fa-star-half-alt"></i>
                                        @endif

                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="far fa-star"></i>
                                        @endfor

                                        <span class="store-rating-count">({{ $product->review_count ?? 0 }})</span>
                                    </div>
                                    <button class="btn store-add-to-cart" data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->name }}"
                                        data-product-price="{{ $product->price }}"
                                        data-product-image="{{ $product->image }}"
                                        data-product-stock="{{ $product->stock }}">
                                        <i class="fas fa-shopping-cart me-2"></i>Tambah Keranjang
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <div class="empty-state">
                        <i class="fas fa-tag fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum Ada Produk Diskon</h5>
                        <p class="text-muted">Produk dengan diskon akan segera tersedia</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Features Section -->
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
        /* Your existing CSS styles remain the same */
        .success-animation,
        .remove-animation,
        .heart-animation,
        .heart-remove-animation {
            width: 80px;
            height: 80px;
            margin: 0 auto;
        }

        .success-animation i {
            font-size: 4rem;
            color: #28a745;
            animation: successPop 0.6s ease;
        }

        .heart-animation i {
            font-size: 4rem;
            color: #dc3545;
            animation: heartBeat 0.6s ease;
        }

        .heart-remove-animation i {
            font-size: 4rem;
            color: #6c757d;
            animation: heartBreak 0.8s ease;
        }

        @keyframes successPop {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }

            70% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes heartBeat {
            0% {
                transform: scale(1);
            }

            25% {
                transform: scale(1.3);
            }

            50% {
                transform: scale(1.1);
            }

            75% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes heartBreak {
            0% {
                transform: scale(1) rotate(0deg);
                color: #dc3545;
            }

            25% {
                transform: scale(1.2) rotate(-15deg);
                color: #ff6b7a;
            }

            50% {
                transform: scale(1.1) rotate(15deg);
                color: #ff6b7a;
            }

            75% {
                transform: scale(0.8) rotate(-10deg);
                color: #6c757d;
                opacity: 0.7;
            }

            100% {
                transform: scale(1) rotate(0deg);
                color: #6c757d;
                opacity: 1;
            }
        }

        .store-wishlist-btn.active i {
            color: #dc3545 !important;
            animation: heartPop 0.3s ease;
        }

        .store-add-to-cart.added {
            background: #28a745 !important;
            animation: cartPulse 0.5s ease;
        }

        .store-add-to-cart.loading {
            background: #6c757d !important;
            pointer-events: none;
        }

        @keyframes heartPop {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.3);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes cartPulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .empty-state {
            padding: 3rem 1rem;
        }

        .empty-state i {
            opacity: 0.5;
        }

        .empty-state h5 {
            margin-bottom: 1rem;
        }

        .empty-state p {
            margin-bottom: 0;
        }

        .modal-content {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .modal-body {
            padding: 2.5rem !important;
        }

        .btn {
            border-radius: 10px;
            font-weight: 600;
            padding: 12px 24px;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .store-product-card {
            transition: all 0.3s ease;
        }

        .store-product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .store-badge {
            animation: badgePulse 2s infinite;
        }

        @keyframes badgePulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
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
                this.bindProductCardHover();
                this.autoHideModals();
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
                        this.addToCart(btn);
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

            async toggleWishlist(productId, button) {
                try {
                    const response = await fetch('/store/wishlist/toggle', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    });

                    // Check if response is JSON
                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        const text = await response.text();
                        console.error('Non-JSON response:', text.substring(0, 200));
                        throw new Error('Server returned non-JSON response');
                    }

                    const data = await response.json();

                    if (!data.success) {
                        if (data.login_required) {
                            this.showLoginAlert();
                            return;
                        }
                        throw new Error(data.message);
                    }

                    this.updateWishlistUI(productId, button, data.in_wishlist);
                    this.updateWishlistBadge(data.wishlist_count);

                    if (data.in_wishlist) {
                        this.showModal('wishlistModal');
                    } else {
                        this.showModal('wishlistRemoveModal');
                    }

                } catch (error) {
                    console.error('Error toggling wishlist:', error);
                    this.showErrorAlert('Terjadi kesalahan saat memproses wishlist: ' + error.message);
                }
            }

            updateWishlistUI(productId, button, inWishlist) {
                const icon = button.querySelector('i');

                if (inWishlist) {
                    icon.classList.replace('far', 'fas');
                    button.classList.add('active');
                    icon.style.color = '#dc3545';
                } else {
                    icon.classList.replace('fas', 'far');
                    button.classList.remove('active');
                    icon.style.color = '';
                }
            }

            updateWishlistBadge(count) {
                const badge = document.querySelector('.store-nav-icon[href*="wishlist"] .store-badge');
                const navIcon = document.querySelector('.store-nav-icon[href*="wishlist"]');

                if (count > 0) {
                    if (!badge) {
                        const newBadge = document.createElement('span');
                        newBadge.className = 'store-badge';
                        newBadge.textContent = count;
                        navIcon.appendChild(newBadge);
                    } else {
                        badge.textContent = count;
                    }
                } else {
                    if (badge) {
                        badge.remove();
                    }
                }
            }

            async addToCart(button) {
                const productId = button.dataset.productId;
                const productName = button.dataset.productName;
                const productPrice = button.dataset.productPrice;
                const productImage = button.dataset.productImage;
                const productStock = button.dataset.productStock;

                try {
                    // Show loading state
                    this.setButtonLoading(button, true);

                    // Send request to add product to cart langsung tanpa auth check
                    // Biarkan backend yang handle authentication
                    const response = await fetch('/store/cart/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: parseInt(productId),
                            quantity: 1
                        })
                    });

                    // Check if response is JSON
                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        const text = await response.text();
                        console.error('Non-JSON response:', text.substring(0, 200));

                        // Jika response adalah HTML, kemungkinan redirect ke login page
                        if (text.includes('login') || response.redirected) {
                            this.showLoginAlert();
                            return;
                        }
                        throw new Error('Server returned non-JSON response');
                    }

                    const data = await response.json();

                    if (!data.success) {
                        if (data.login_required) {
                            this.showLoginAlert();
                            return;
                        }
                        throw new Error(data.message || 'Gagal menambahkan ke keranjang');
                    }

                    // Update UI
                    this.setButtonAdded(button);

                    // Update cart count badge
                    this.updateCartCount(data.cart_count);

                    // Show success modal
                    this.showModal('cartModal');

                } catch (error) {
                    console.error('Error adding to cart:', error);
                    this.showErrorAlert(error.message || 'Terjadi kesalahan saat menambahkan ke keranjang');
                    this.setButtonLoading(button, false);
                }
            }

            setButtonLoading(button, isLoading) {
                if (isLoading) {
                    button.classList.add('loading');
                    button.disabled = true;
                    button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menambahkan...';
                } else {
                    button.classList.remove('loading');
                    button.disabled = false;
                    button.innerHTML = '<i class="fas fa-shopping-cart me-2"></i>Tambah Keranjang';
                }
            }

            setButtonAdded(button) {
                button.classList.add('added');
                button.disabled = false;
                button.innerHTML = '<i class="fas fa-check me-2"></i>Dalam Keranjang';

                // Reset button after 3 seconds
                setTimeout(() => {
                    button.classList.remove('added');
                    button.innerHTML = '<i class="fas fa-shopping-cart me-2"></i>Tambah Keranjang';
                }, 3000);
            }

            showLoginAlert() {
                if (confirm('Anda perlu login untuk menambahkan produk ke keranjang. Apakah Anda ingin login?')) {
                    window.location.href = '/login';
                }
            }

            showErrorAlert(message) {
                alert(message);
            }

            showModal(modalId) {
                const modalElement = document.getElementById(modalId);
                if (modalElement) {
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                }
            }

            updateCartCount(count) {
                const badge = document.querySelector('.store-nav-icon[href*="cart"] .store-badge');
                const navIcon = document.querySelector('.store-nav-icon[href*="cart"]');

                if (count > 0) {
                    if (!badge) {
                        const newBadge = document.createElement('span');
                        newBadge.className = 'store-badge';
                        newBadge.textContent = count;
                        navIcon.appendChild(newBadge);
                    } else {
                        badge.textContent = count;
                    }
                } else {
                    if (badge) {
                        badge.remove();
                    }
                }
            }

            autoHideModals() {
                const modals = ['cartModal', 'wishlistModal', 'wishlistRemoveModal'];
                modals.forEach(id => {
                    const modalElement = document.getElementById(id);
                    if (modalElement) {
                        modalElement.addEventListener('shown.bs.modal', () => {
                            setTimeout(() => {
                                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                                if (modalInstance) modalInstance.hide();
                            }, 2000);
                        });
                    }
                });
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            new ProductManager();
        });
    </script>
@endsection
