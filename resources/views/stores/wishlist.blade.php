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
                        <span class="fw-medium">{{ $totalItems }} Item</span>
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

                    @if (count($wishlistItems) > 0)
                        <!-- Wishlist Items Grid -->
                        <div class="row g-4" id="wishlist-items-container">
                            @foreach ($wishlistItems as $item)
                                @include('stores.partials.wishlist-item', ['item' => $item])
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if ($totalPages > 1)
                            <div class="d-flex justify-content-center mt-5">
                                <nav aria-label="Wishlist pagination">
                                    <ul class="pagination">
                                        <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                                            <a class="page-link"
                                                href="{{ $currentPage > 1 ? url('/store/wishlist?page=' . ($currentPage - 1)) : '#' }}"
                                                aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>

                                        @for ($i = 1; $i <= $totalPages; $i++)
                                            <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ url('/store/wishlist?page=' . $i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
                                            <a class="page-link"
                                                href="{{ $currentPage < $totalPages ? url('/store/wishlist?page=' . ($currentPage + 1)) : '#' }}"
                                                aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                            <div class="text-center mt-3">
                                <small class="text-muted">
                                    Menampilkan
                                    {{ ($currentPage - 1) * 8 + 1 }}-{{ min($currentPage * 8, $totalItems) }} dari
                                    {{ $totalItems }} item
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

    <style>
        /* Modal Animations */
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

        .remove-animation i {
            font-size: 4rem;
            color: #dc3545;
            animation: removePop 0.6s ease;
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

        @keyframes removePop {
            0% {
                transform: scale(0.5) rotate(0deg);
                opacity: 0;
            }

            50% {
                transform: scale(1.3) rotate(180deg);
            }

            100% {
                transform: scale(1) rotate(360deg);
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

        /* Button States */
        .btn-wishlist.active i {
            color: #dc3545 !important;
            animation: heartPop 0.3s ease;
        }

        .add-to-cart.added {
            background: #28a745 !important;
            animation: cartPulse 0.5s ease;
        }

        .add-to-cart.removing {
            background: #6c757d !important;
            animation: cartShrink 0.3s ease;
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

        @keyframes cartShrink {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(0.95);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Modal & UI Enhancements */
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

        /* Wishlist Specific Styles */
        .btn-wishlist {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: white;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            z-index: 10;
            transition: all 0.3s ease;
        }

        .btn-wishlist:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .btn-wishlist.active {
            background: #dc3545;
            color: white;
        }

        .btn-wishlist.active i {
            color: white !important;
        }

        .heart-beat {
            animation: heartBeat 0.6s ease;
        }

        .product-badges {
            position: absolute;
            top: 10px;
            left: 10px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .product-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            color: white;
        }

        .product-badge.discount {
            background: #dc3545;
        }

        .product-badge.new {
            background: #28a745;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .rating-stars {
            display: flex;
            align-items: center;
        }

        .smaller {
            font-size: 0.75rem;
        }

        /* Pagination Styles */
        .pagination {
            margin-bottom: 0;
        }

        .pagination .page-item .page-link {
            color: #6c757d;
            border: 1px solid #dee2e6;
            padding: 0.5rem 0.75rem;
            transition: all 0.3s ease;
        }

        .pagination .page-item .page-link:hover {
            color: #dc3545;
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }

        .pagination .page-item.active .page-link {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }

        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #f8f9fa;
            border-color: #dee2e6;
            opacity: 0.6;
        }

        .pagination .page-link {
            font-weight: 500;
            margin: 0 2px;
            border-radius: 8px;
        }

        /* Product card */
        .product-card {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .product-card .btn-wishlist,
        .product-card .add-to-cart {
            cursor: pointer;
        }

        /* Badge animations */
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
        class StoreProductManager {
            constructor() {
                this.wishlistState = new Map();
                this.cartState = new Map();
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
                // Initialize wishlist buttons state
                document.querySelectorAll('.btn-wishlist').forEach(btn => {
                    const productId = btn.dataset.productId;
                    if (btn.classList.contains('active')) {
                        this.wishlistState.set(productId, true);
                    }
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
                    const wishlistBtn = e.target.closest('.btn-wishlist');
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
                    const card = e.target.closest('.product-card');
                    if (card) {
                        card.style.transform = 'translateY(-5px)';
                        card.style.boxShadow = '0 15px 30px rgba(0,0,0,0.15)';
                    }
                }, true);

                document.addEventListener('mouseleave', (e) => {
                    const card = e.target.closest('.product-card');
                    if (card) {
                        card.style.transform = 'translateY(0)';
                        card.style.boxShadow = '';
                    }
                }, true);
            }

            toggleWishlist(button) {
                const productId = button.dataset.productId;
                const isInWishlist = this.wishlistState.get(productId) || button.classList.contains('active');
                const icon = button.querySelector('i');

                if (!isInWishlist) {
                    this.addToWishlist(productId, button, icon);
                } else {
                    this.removeFromWishlist(productId, button, icon);
                }
            }

            addToWishlist(productId, button, icon) {
                // Show loading state
                const originalHTML = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                button.disabled = true;

                // Simulate API call
                setTimeout(() => {
                    this.wishlistState.set(productId, true);

                    if (icon) {
                        icon.className = 'fas fa-heart';
                    }
                    button.classList.add('active', 'heart-beat');
                    button.disabled = false;

                    // Update button HTML
                    button.innerHTML = '<i class="fas fa-heart"></i>';

                    setTimeout(() => {
                        button.classList.remove('heart-beat');
                    }, 600);

                    this.showModal('wishlistModal');
                    this.updateWishlistCount(1);

                }, 800);
            }

            removeFromWishlist(productId, button, icon) {
                // Show loading state
                const originalHTML = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                button.disabled = true;

                // Simulate API call
                setTimeout(() => {
                    this.wishlistState.set(productId, false);

                    if (icon) {
                        icon.className = 'far fa-heart';
                    }
                    button.classList.remove('active');
                    button.classList.add('heart-beat');
                    button.disabled = false;

                    // Update button HTML
                    button.innerHTML = '<i class="far fa-heart"></i>';

                    setTimeout(() => {
                        button.classList.remove('heart-beat');
                    }, 600);

                    this.showModal('wishlistRemoveModal');
                    this.updateWishlistCount(-1);

                    // Remove item from DOM with smooth animation
                    if (window.location.pathname.includes('/wishlist')) {
                        this.removeWishlistItemWithAnimation(productId);
                    }
                }, 800);
            }

            removeWishlistItemWithAnimation(productId) {
                const productCard = document.querySelector(`[data-product-id="${productId}"]`);
                if (productCard) {
                    // Add removing class for animation
                    productCard.classList.add('removing');

                    // Remove from DOM after animation completes
                    setTimeout(() => {
                        productCard.remove();

                        // Check if container is empty
                        const container = document.getElementById('wishlist-items-container');
                        if (container && container.children.length === 0) {
                            setTimeout(() => {
                                window.location.reload();
                            }, 500);
                        }
                    }, 400); // Match this with CSS transition duration
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

            updateCartCount(increment) {
                this.updateBadgeCount('.store-nav-icon[href*="cart"] .store-badge', increment);
            }

            updateWishlistCount(increment) {
                this.updateBadgeCount('.store-nav-icon[href*="wishlist"] .store-badge', increment);
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

            // Check if modals are available
            const modals = ['cartModal', 'cartRemoveModal', 'wishlistModal', 'wishlistRemoveModal'];
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (modal) {
                    console.log(`✅ Modal ${modalId} found in DOM`);
                } else {
                    console.error(`❌ Modal ${modalId} NOT found in DOM`);
                }
            });

            // Initialize product manager
            window.storeManager = new StoreProductManager();

            // Add product card navigation
            document.addEventListener('click', (e) => {
                if (e.target.closest('.product-card') &&
                    !e.target.closest('.btn-wishlist') &&
                    !e.target.closest('.add-to-cart')) {
                    const productCard = e.target.closest('.product-card');
                    const productId = productCard.querySelector('.btn-wishlist')?.dataset.productId;
                    if (productId) {
                        window.location.href = `/store/product/${productId}`;
                    }
                }
            });
        });
    </script>
@endsection
