@extends('layouts.store')

@section('title', 'Wishlist Saya - Toko UMKM')

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
                        <a href="{{ url('/store/cart') }}" class="btn btn-primary">Lihat Keranjang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cartRemoveModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="mb-4">
                        <div class="remove-animation">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                    <h4 class="modal-title mb-3 text-danger">Dihapus dari Keranjang!</h4>
                    <p class="text-muted mb-4">Produk telah dihapus dari keranjang belanja Anda</p>
                    <div class="d-flex gap-3 justify-content-center">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                        <a href="{{ url('/store/cart') }}" class="btn btn-danger">Lihat Keranjang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="wishlistModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="mb-4">
                        <div class="heart-animation">
                            <i class="fas fa-heart"></i>
                        </div>
                    </div>
                    <h4 class="modal-title mb-3 text-danger">Ditambahkan ke Wishlist!</h4>
                    <p class="text-muted mb-4">Produk telah disimpan ke daftar keinginan Anda</p>
                    <div class="d-flex gap-3 justify-content-center">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Lanjut
                            Belanja</button>
                        <a href="{{ url('/store/wishlist') }}" class="btn btn-danger">Lihat Wishlist</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="wishlistRemoveModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="mb-4">
                        <div class="heart-remove-animation">
                            <i class="fas fa-heart-broken"></i>
                        </div>
                    </div>
                    <h4 class="modal-title mb-3 text-secondary">Dihapus dari Wishlist!</h4>
                    <p class="text-muted mb-4">Produk telah dihapus dari daftar keinginan Anda</p>
                    <div class="d-flex gap-3 justify-content-center">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                        <a href="{{ url('/store/wishlist') }}" class="btn btn-secondary">Lihat Wishlist</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                        <span class="fw-medium" id="wishlist-count">{{ $wishlistItems->total() }} Item</span>
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

                    @if ($wishlistItems->count() > 0)
                        <!-- Wishlist Items Grid -->
                        <div class="row g-4" id="wishlist-items-container">
                            @foreach ($wishlistItems as $item)
                                <div class="col-lg-3 col-md-4 col-6 wishlist-item" data-product-id="{{ $item->product_id }}" data-wishlist-id="{{ $item->id }}">
                                    <div class="store-product-card">
                                        <a href="{{ route('store.product.detail', $item->product_id) }}" class="product-link">
                                            <div class="store-product-image">
                                                <img src="{{ $item->product_image ?: 'https://via.placeholder.com/300x300' }}"
                                                    alt="{{ $item->product_name }}"
                                                    class="img-fluid">
                                                @if($item->product_discount_percent > 0)
                                                    <div class="store-product-badge discount">-{{ $item->product_discount_percent }}%</div>
                                                @elseif($item->product_is_trending)
                                                    <div class="store-product-badge">Trending</div>
                                                @endif
                                            </div>
                                        </a>
                                        <button class="store-wishlist-btn active"
                                                data-product-id="{{ $item->product_id }}"
                                                data-wishlist-id="{{ $item->id }}">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                        <div class="store-product-info">
                                            <a href="{{ route('store.product.detail', $item->product_id) }}" class="product-link">
                                                <h5 class="store-product-title">{{ $item->product_name }}</h5>
                                                <p class="store-product-desc">{{ Str::limit($item->product_description ?? 'Deskripsi produk tidak tersedia', 60) }}</p>
                                            </a>
                                            <div class="store-product-price">
                                                <span class="store-price-current">Rp {{ number_format($item->product_price, 0, ',', '.') }}</span>
                                                @if($item->product_original_price > $item->product_price)
                                                    <span class="store-price-original">Rp {{ number_format($item->product_original_price, 0, ',', '.') }}</span>
                                                @endif
                                            </div>
                                            <div class="store-product-rating">
                                                @php
                                                    $rating = $item->product_rating ?? 0;
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

                                                <span class="store-rating-count">({{ $item->product_review_count ?? 0 }})</span>
                                            </div>
                                            <div class="store-product-meta">
                                                <span class="store-product-stock {{ $item->product_stock > 0 ? 'in-stock' : 'out-of-stock' }}">
                                                    {{ $item->product_stock > 0 ? 'Tersedia' : 'Habis' }}
                                                </span>
                                                <span class="store-product-category">{{ $item->product_category }}</span>
                                            </div>
                                            <button class="btn store-add-to-cart" data-product-id="{{ $item->product_id }}">
                                                <i class="fas fa-shopping-cart me-2"></i>Tambah Keranjang
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if ($wishlistItems->hasPages())
                            <div class="d-flex justify-content-center mt-5">
                                {{ $wishlistItems->links() }}
                            </div>

                            <div class="text-center mt-3">
                                <small class="text-muted">
                                    Menampilkan {{ $wishlistItems->firstItem() }}-{{ $wishlistItems->lastItem() }}
                                    dari {{ $wishlistItems->total() }} item
                                </small>
                            </div>
                        @endif
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
                            @foreach ($recommendedProducts as $product)
                                <div class="col-6 col-md-3">
                                    <div class="card product-card h-100 border-0 shadow-sm position-relative">
                                        <button class="btn-wishlist" data-product-id="{{ $product['id'] }}">
                                            <i class="far fa-heart"></i>
                                        </button>

                                        <div class="product-image-wrapper">
                                            <img src="{{ $product['image'] }}" class="card-img-top"
                                                alt="{{ $product['name'] }}" style="height: 160px; object-fit: cover;">

                                            <div class="product-badges">
                                                @if (isset($product['discount']) && $product['discount'])
                                                    <span
                                                        class="product-badge discount">-{{ $product['discount'] }}%</span>
                                                @endif
                                                @if (isset($product['is_new']) && $product['is_new'])
                                                    <span class="product-badge new">Baru</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-body p-3 d-flex flex-column">
                                            <h6 class="card-title small line-clamp-2 mb-2" style="min-height: 40px;">
                                                {{ $product['name'] }}</h6>

                                            <div class="mb-2">
                                                @if (isset($product['discount']) && $product['discount'])
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="text-danger fw-bold small">Rp
                                                            {{ number_format($product['discounted_price'] ?? $product['price'] * (1 - $product['discount'] / 100), 0, ',', '.') }}</span>
                                                        <span class="text-muted text-decoration-line-through smaller">Rp
                                                            {{ number_format($product['price'], 0, ',', '.') }}</span>
                                                    </div>
                                                @else
                                                    <span class="text-primary fw-bold small">Rp
                                                        {{ number_format($product['price'], 0, ',', '.') }}</span>
                                                @endif
                                            </div>

                                            @if (isset($product['rating']))
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="rating-stars me-2">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $product['rating'])
                                                                <i class="fas fa-star text-warning"
                                                                    style="font-size: 0.7rem;"></i>
                                                            @else
                                                                <i class="far fa-star text-muted"
                                                                    style="font-size: 0.7rem;"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <small
                                                        class="text-muted">({{ $product['review_count'] ?? 0 }})</small>
                                                </div>
                                            @endif

                                            @if (isset($product['stock']))
                                                <div class="mb-2">
                                                    @if ($product['stock'] > 0)
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

                                            <div class="mt-auto">
                                                <button class="btn btn-primary btn-sm w-100 add-to-cart"
                                                    data-product-id="{{ $product['id'] }}" data-in-cart="false">
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

    <script>
        class StoreProductManager {
            constructor() {
                this.wishlistState = new Map();
                this.cartState = new Map();
                this.animationTypes = ['removing', 'shrink-out', 'fade-out-up', 'slide-out-right'];
                this.init();
            }

            init() {
                console.log('🔄 StoreProductManager initialized');
                this.bindWishlistEvents();
                this.bindCartEvents();
                this.bindProductCardHover();
                this.autoHideModals();
                this.initializeStates();
            }

            initializeStates() {
                // Initialize wishlist buttons state - semua item di wishlist page sudah aktif
                document.querySelectorAll('.store-wishlist-btn').forEach(btn => {
                    const productId = btn.dataset.productId;
                    this.wishlistState.set(productId, true);
                });

                // Initialize cart buttons state
                document.querySelectorAll('.add-to-cart').forEach(btn => {
                    const productId = btn.dataset.productId;
                    const isInCart = btn.getAttribute('data-in-cart') === 'true';
                    if (isInCart) {
                        this.cartState.set(productId, true);
                    }
                });
            }

            bindWishlistEvents() {
                document.addEventListener('click', (e) => {
                    const wishlistBtn = e.target.closest('.store-wishlist-btn');
                    if (wishlistBtn) {
                        e.preventDefault();
                        e.stopPropagation();
                        this.toggleWishlist(wishlistBtn);
                    }
                });
            }

            bindCartEvents() {
                document.addEventListener('click', (e) => {
                    const cartBtn = e.target.closest('.add-to-cart');
                    if (cartBtn) {
                        e.preventDefault();
                        e.stopPropagation();
                        this.toggleCart(cartBtn);
                    }
                });
            }

            bindProductCardHover() {
                document.addEventListener('mouseenter', (e) => {
                    const card = e.target.closest('.store-product-card');
                    if (card) {
                        card.style.transform = 'translateY(-5px)';
                        card.style.boxShadow = '0 15px 30px rgba(0,0,0,0.15)';
                    }
                }, true);

                document.addEventListener('mouseleave', (e) => {
                    const card = e.target.closest('.store-product-card');
                    if (card) {
                        card.style.transform = 'translateY(0)';
                        card.style.boxShadow = '0 5px 15px rgba(0,0,0,0.08)';
                    }
                }, true);
            }

            async toggleWishlist(button) {
                const productId = button.dataset.productId;
                const wishlistId = button.dataset.wishlistId;
                const isInWishlist = this.wishlistState.get(productId) || button.classList.contains('active');

                if (!isInWishlist) {
                    await this.addToWishlist(productId, button);
                } else {
                    await this.removeFromWishlist(productId, wishlistId, button);
                }
            }

            async addToWishlist(productId, button) {
                try {
                    const response = await fetch('{{ route("store.wishlist.toggle") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        this.wishlistState.set(productId, true);
                        button.classList.add('active');
                        button.innerHTML = '<i class="fas fa-heart"></i>';
                        this.showModal('wishlistModal');
                        this.updateWishlistCount(1);
                    } else {
                        throw new Error(data.message);
                    }
                } catch (error) {
                    console.error('Error adding to wishlist:', error);
                    this.showErrorAlert('Gagal menambahkan ke wishlist');
                }
            }

            async removeFromWishlist(productId, wishlistId, button) {
                try {
                    // Add removing animation to button
                    button.classList.add('removing');

                    const response = await fetch(`/store/wishlist/remove/${wishlistId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        this.wishlistState.set(productId, false);
                        button.classList.remove('active', 'removing');
                        this.showModal('wishlistRemoveModal');
                        this.updateWishlistCount(-1);

                        // Remove item from DOM with smooth animation
                        this.removeWishlistItemWithAnimation(productId);
                    } else {
                        button.classList.remove('removing');
                        throw new Error(data.message);
                    }
                } catch (error) {
                    console.error('Error removing from wishlist:', error);
                    button.classList.remove('removing');
                    this.showErrorAlert('Gagal menghapus dari wishlist');
                }
            }

            removeWishlistItemWithAnimation(productId) {
                const wishlistItem = document.querySelector(`.wishlist-item[data-product-id="${productId}"]`);
                if (wishlistItem) {
                    // Pilih animasi secara random atau gunakan yang pertama
                    const animationType = this.animationTypes[0]; // Bisa diubah ke random: Math.floor(Math.random() * this.animationTypes.length)

                    // Add animation class
                    wishlistItem.classList.add(animationType);

                    // Remove from DOM after animation completes
                    setTimeout(() => {
                        wishlistItem.remove();

                        // Check if container is empty
                        const container = document.getElementById('wishlist-items-container');
                        if (container && container.children.length === 0) {
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        }
                    }, 500); // Sesuaikan dengan durasi animasi
                }
            }

            toggleCart(button) {
                const productId = button.dataset.productId;
                const isInCart = this.cartState.get(productId) || button.getAttribute('data-in-cart') === 'true';

                if (!isInCart) {
                    this.addToCart(productId, button);
                } else {
                    this.removeFromCart(productId, button);
                }
            }

            addToCart(productId, button) {
                // Show loading state
                const originalHTML = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menambahkan...';
                button.disabled = true;

                // Simulate API call
                setTimeout(() => {
                    this.cartState.set(productId, true);
                    button.classList.add('added', 'cart-pulse');
                    button.setAttribute('data-in-cart', 'true');
                    button.innerHTML = '<i class="fas fa-check me-2"></i>Dalam Keranjang';
                    button.disabled = false;

                    setTimeout(() => {
                        button.classList.remove('cart-pulse');
                    }, 500);

                    this.showModal('cartModal');
                    this.updateCartCount(1);
                }, 1000);
            }

            removeFromCart(productId, button) {
                // Show loading state
                const originalHTML = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menghapus...';
                button.disabled = true;

                // Simulate API call
                setTimeout(() => {
                    this.cartState.set(productId, false);
                    button.classList.remove('added');
                    button.classList.add('removing');
                    button.setAttribute('data-in-cart', 'false');
                    button.innerHTML = '<i class="fas fa-shopping-cart me-2"></i>Tambah Keranjang';
                    button.disabled = false;

                    setTimeout(() => {
                        button.classList.remove('removing', 'cart-pulse');
                    }, 500);

                    this.showModal('cartRemoveModal');
                    this.updateCartCount(-1);
                }, 1000);
            }

            showModal(modalId) {
                console.log(`🔄 Attempting to show modal: ${modalId}`);

                const modalElement = document.getElementById(modalId);
                if (modalElement) {
                    try {
                        const modal = new bootstrap.Modal(modalElement);
                        modal.show();
                        console.log(`✅ Modal ${modalId} shown successfully`);

                        // Auto hide after 3 seconds
                        setTimeout(() => {
                            modal.hide();
                            console.log(`✅ Modal ${modalId} auto-hidden`);
                        }, 3000);
                    } catch (error) {
                        console.error(`❌ Error showing modal ${modalId}:`, error);
                    }
                } else {
                    console.error(`❌ Modal element not found: ${modalId}`);
                }
            }

            showErrorAlert(message) {
                alert(message);
            }

            updateCartCount(increment) {
                this.updateBadgeCount('.store-nav-icon[href*="cart"] .store-badge', increment);
            }

            updateWishlistCount(increment) {
                // Update badge count
                this.updateBadgeCount('.store-nav-icon[href*="wishlist"] .store-badge', increment);

                // Update wishlist count text
                const wishlistCountElement = document.getElementById('wishlist-count');
                if (wishlistCountElement) {
                    const currentText = wishlistCountElement.textContent;
                    const currentCount = parseInt(currentText) || 0;
                    const newCount = Math.max(0, currentCount + increment);

                    wishlistCountElement.textContent = `${newCount} Item`;
                    wishlistCountElement.classList.add('wishlist-count-update');

                    setTimeout(() => {
                        wishlistCountElement.classList.remove('wishlist-count-update');
                    }, 600);
                }
            }

            updateBadgeCount(selector, increment) {
                const badge = document.querySelector(selector);
                if (badge) {
                    const current = parseInt(badge.textContent) || 0;
                    const newCount = Math.max(0, current + increment);
                    badge.textContent = newCount;
                    badge.style.display = newCount > 0 ? 'flex' : 'none';
                    this.animateBadge(badge);
                }
            }

            animateBadge(badge) {
                badge.style.animation = 'none';
                setTimeout(() => badge.style.animation = 'badgePulse 0.6s ease', 10);
            }

            autoHideModals() {
                document.querySelectorAll('.modal').forEach(modal => {
                    modal.addEventListener('shown.bs.modal', () => {
                        setTimeout(() => {
                            const bsModal = bootstrap.Modal.getInstance(modal);
                            if (bsModal) bsModal.hide();
                        }, 3000);
                    });
                });
            }
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            console.log('🚀 Wishlist page loaded - StoreProductManager starting...');

            // Initialize product manager
            window.storeManager = new StoreProductManager();

            // Add product card navigation
            document.addEventListener('click', (e) => {
                if (e.target.closest('.store-product-card') &&
                    !e.target.closest('.store-wishlist-btn') &&
                    !e.target.closest('.store-add-to-cart')) {
                    const productCard = e.target.closest('.store-product-card');
                    const productId = productCard.querySelector('.store-wishlist-btn')?.dataset.productId;
                    if (productId) {
                        window.location.href = `/store/product/${productId}`;
                    }
                }
            });
        });
    </script>
@endsection
