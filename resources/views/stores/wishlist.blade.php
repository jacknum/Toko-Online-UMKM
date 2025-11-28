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
                                <div class="col-lg-3 col-md-4 col-6 wishlist-item"
                                    data-product-id="{{ $item->product_id }}" data-wishlist-id="{{ $item->id }}">
                                    <div class="store-product-card">
                                        <a href="{{ route('store.product.detail', $item->product_id) }}"
                                            class="product-link">
                                            <div class="store-product-image">
                                                <img src="{{ $item->product_image ?: 'https://via.placeholder.com/300x300' }}"
                                                    alt="{{ $item->product_name }}" class="img-fluid">
                                                @if ($item->product_discount_percent > 0)
                                                    <div class="store-product-badge discount">
                                                        -{{ $item->product_discount_percent }}%</div>
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
                                            <a href="{{ route('store.product.detail', $item->product_id) }}"
                                                class="product-link">
                                                <h5 class="store-product-title">{{ $item->product_name }}</h5>
                                                <p class="store-product-desc">
                                                    {{ Str::limit($item->product_description ?? 'Deskripsi produk tidak tersedia', 60) }}
                                                </p>
                                            </a>
                                            <div class="store-product-price">
                                                <span class="store-price-current">Rp
                                                    {{ number_format($item->product_price, 0, ',', '.') }}</span>
                                                @if ($item->product_original_price > $item->product_price)
                                                    <span class="store-price-original">Rp
                                                        {{ number_format($item->product_original_price, 0, ',', '.') }}</span>
                                                @endif
                                            </div>
                                            <div class="store-product-rating">
                                                @php
                                                    $rating = $item->product_rating ?? 0;
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

                                                <span
                                                    class="store-rating-count">({{ $item->product_review_count ?? 0 }})</span>
                                            </div>
                                            <div class="store-product-meta">
                                                <span
                                                    class="store-product-stock {{ $item->product_stock > 0 ? 'in-stock' : 'out-of-stock' }}">
                                                    {{ $item->product_stock > 0 ? 'Tersedia' : 'Habis' }}
                                                </span>
                                                <span class="store-product-category">{{ $item->product_category }}</span>
                                            </div>
                                            <button class="btn store-add-to-cart"
                                                data-product-id="{{ $item->product_id }}"
                                                data-product-name="{{ $item->product_name }}"
                                                data-product-price="{{ $item->product_price }}"
                                                data-product-image="{{ $item->product_image }}"
                                                data-product-stock="{{ $item->product_stock }}">
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
                this.initializeStates();

                // CEK CART STATE DARI BACKEND
                this.checkCartState();
            }

            initializeStates() {
                // Initialize wishlist buttons state - semua item di wishlist page sudah aktif
                document.querySelectorAll('.store-wishlist-btn').forEach(btn => {
                    const productId = btn.dataset.productId;
                    this.wishlistState.set(productId, true);
                });

                // Initialize cart buttons state
                document.querySelectorAll('.store-add-to-cart, .add-to-cart').forEach(btn => {
                    const productId = btn.dataset.productId;
                    const isInCart = btn.getAttribute('data-in-cart') === 'true';
                    if (isInCart) {
                        this.cartState.set(productId, true);
                    }
                });
            }

            bindWishlistEvents() {
                document.addEventListener('click', (e) => {
                    const wishlistBtn = e.target.closest('.store-wishlist-btn, .btn-wishlist');
                    if (wishlistBtn) {
                        e.preventDefault();
                        e.stopPropagation();
                        this.toggleWishlist(wishlistBtn);
                    }
                });
            }

            bindCartEvents() {
                // CARA 1: Direct binding seperti index.blade.php (LEBIH RELIABLE)
                const bindButtons = () => {
                    document.querySelectorAll('.store-add-to-cart, .add-to-cart').forEach(btn => {
                        // Remove old listener jika ada
                        btn.removeEventListener('click', btn._cartClickHandler);

                        // Create new handler
                        btn._cartClickHandler = (e) => {
                            e.preventDefault();
                            e.stopPropagation();
                            console.log('🎯 Cart button clicked:', btn);
                            this.addToCart(btn);
                        };

                        // Add new listener
                        btn.addEventListener('click', btn._cartClickHandler);
                        console.log('✅ Cart button bound:', btn.dataset.productId);
                    });
                };

                // Bind immediately
                bindButtons();

                // Re-bind after any DOM changes (untuk pagination, dll)
                const observer = new MutationObserver(() => {
                    bindButtons();
                });

                const container = document.getElementById('wishlist-items-container');
                if (container) {
                    observer.observe(container, {
                        childList: true,
                        subtree: true
                    });
                }
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
                    const response = await fetch('{{ route('store.wishlist.toggle') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    });

                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        throw new Error('Server returned non-JSON response');
                    }

                    const data = await response.json();

                    if (data.success) {
                        this.wishlistState.set(productId, true);
                        button.classList.add('active');
                        button.innerHTML = '<i class="fas fa-heart"></i>';
                        this.showModal('wishlistModal');
                        this.updateWishlistCount(1);
                    } else {
                        if (data.login_required) {
                            this.showLoginAlert();
                            return;
                        }
                        throw new Error(data.message);
                    }
                } catch (error) {
                    console.error('Error adding to wishlist:', error);
                    this.showErrorAlert('Gagal menambahkan ke wishlist');
                }
            }

            async removeFromWishlist(productId, wishlistId, button) {
                try {
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
                    const animationType = this.animationTypes[0];
                    wishlistItem.classList.add(animationType);

                    setTimeout(() => {
                        wishlistItem.remove();

                        const container = document.getElementById('wishlist-items-container');
                        if (container && container.children.length === 0) {
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        }
                    }, 500);
                }
            }

            // GANTI METHOD addToCart() DI WISHLIST.BLADE.PHP DENGAN INI
            // GANTI METHOD addToCart() - Perbaiki pengecekan state

            async addToCart(button) {
                const productId = button.dataset.productId;

                // CEK STATE DARI CLASS, BUKAN DARI MAP!
                const isInCart = button.classList.contains('in-cart');

                console.log('🎯 Button clicked. Product ID:', productId, 'Is in cart:', isInCart);
                console.log('🎯 Button classes:', button.className);

                if (isInCart) {
                    // Jika sudah di cart, hapus dari cart
                    console.log('🗑️ Product is in cart, removing...');
                    await this.removeFromCart(button, productId);
                    return;
                }

                // Jika belum di cart, tambahkan ke cart
                console.log('➕ Product not in cart, adding...');

                const productName = button.dataset.productName;
                const productPrice = button.dataset.productPrice;
                const productImage = button.dataset.productImage;
                const productStock = button.dataset.productStock;

                if (!productId) {
                    console.error('❌ Product ID is missing!');
                    alert('Error: Product ID tidak ditemukan');
                    return;
                }

                try {
                    // Show loading state
                    this.setButtonLoading(button, true);

                    const requestData = {
                        product_id: parseInt(productId),
                        quantity: 1
                    };

                    const response = await fetch('/store/cart/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(requestData)
                    });

                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        const text = await response.text();
                        console.error('❌ Non-JSON response:', text.substring(0, 500));

                        if (text.includes('login') || text.includes('Login')) {
                            this.showLoginAlert();
                            this.setButtonLoading(button, false);
                            return;
                        }

                        throw new Error('Server returned non-JSON response');
                    }

                    const data = await response.json();

                    if (!data.success) {
                        console.error('❌ Request failed:', data.message);

                        if (data.login_required) {
                            this.showLoginAlert();
                            this.setButtonLoading(button, false);
                            return;
                        }
                        throw new Error(data.message || 'Gagal menambahkan ke keranjang');
                    }

                    // SUCCESS!
                    console.log('✅ Product added to cart successfully');

                    // Update button ke state "Dalam Keranjang" (PERMANEN)
                    this.setButtonInCart(button);

                    // Update cart count badge
                    this.updateCartCount(data.cart_count);

                    // Show success modal
                    this.showModal('cartModal');

                } catch (error) {
                    console.error('❌ Error adding to cart:', error);
                    this.showErrorAlert('Error: ' + error.message);
                    this.setButtonLoading(button, false);
                }
            }

            // PERBAIKI removeFromCart() - Tambahkan lebih banyak log
            async removeFromCart(button, productId) {
                console.log('🗑️ === REMOVE FROM CART START ===');
                console.log('🗑️ Product ID:', productId);

                try {
                    // Show loading state
                    button.classList.add('loading');
                    button.classList.remove('in-cart'); // Remove in-cart saat loading
                    button.disabled = true;
                    button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menghapus...';

                    console.log('📤 Sending remove request...');

                    const response = await fetch('/store/cart/remove-by-product', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: parseInt(productId)
                        })
                    });

                    console.log('📡 Remove response status:', response.status);

                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        const text = await response.text();
                        console.error('❌ Non-JSON response:', text.substring(0, 500));
                        throw new Error('Server returned non-JSON response');
                    }

                    const data = await response.json();
                    console.log('📦 Remove response data:', data);

                    if (!data.success) {
                        console.error('❌ Remove failed:', data.message);
                        throw new Error(data.message || 'Gagal menghapus dari keranjang');
                    }

                    console.log('✅ Product removed from cart successfully');

                    // Update button kembali ke "Tambah Keranjang"
                    this.setButtonNotInCart(button);

                    // Update cart count badge
                    this.updateCartCount(data.cart_count);

                    // Show remove modal
                    this.showModal('cartRemoveModal');

                    console.log('🗑️ === REMOVE FROM CART END ===');

                } catch (error) {
                    console.error('❌ Error removing from cart:', error);
                    this.showErrorAlert('Error: ' + error.message);

                    // Reset button ke state in-cart jika error
                    this.setButtonInCart(button);
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

            // PERBAIKI setButtonInCart() - Pastikan class ditambahkan dengan benar
            setButtonInCart(button) {
                console.log('🟢 Setting button to IN CART state');

                // Remove semua class lain dulu
                button.classList.remove('loading', 'added');

                // Add class in-cart
                button.classList.add('in-cart');

                // Enable button
                button.disabled = false;

                // Update text dan icon
                button.innerHTML = '<i class="fas fa-check me-2"></i>Dalam Keranjang';

                // Simpan state di Map juga
                const productId = button.dataset.productId;
                this.cartState.set(productId, true);

                // Verify class added
                console.log('✅ Button classes after setInCart:', button.className);
                console.log('✅ Has in-cart class:', button.classList.contains('in-cart'));
            }

            // PERBAIKI setButtonNotInCart()
            setButtonNotInCart(button) {
                console.log('🔴 Setting button to NOT IN CART state');

                // Remove semua class
                button.classList.remove('loading', 'in-cart', 'added');

                // Enable button
                button.disabled = false;

                // Update text dan icon
                button.innerHTML = '<i class="fas fa-shopping-cart me-2"></i>Tambah Keranjang';

                // Update state di Map
                const productId = button.dataset.productId;
                this.cartState.set(productId, false);

                // Verify class removed
                console.log('✅ Button classes after setNotInCart:', button.className);
                console.log('✅ Has in-cart class:', button.classList.contains('in-cart'));
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
                console.log(`🔄 Attempting to show modal: ${modalId}`);

                const modalElement = document.getElementById(modalId);
                if (modalElement) {
                    try {
                        const modal = new bootstrap.Modal(modalElement);
                        modal.show();
                        console.log(`✅ Modal ${modalId} shown successfully`);

                        // Auto hide setelah 2 detik - TANPA conflict
                        setTimeout(() => {
                            try {
                                modal.hide();
                                // Force remove backdrop jika masih ada
                                document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
                                    backdrop.remove();
                                });
                                document.body.classList.remove('modal-open');
                                document.body.style.removeProperty('overflow');
                                document.body.style.removeProperty('padding-right');
                                console.log(`✅ Modal ${modalId} auto-hidden and cleaned up`);
                            } catch (e) {
                                console.error('Error hiding modal:', e);
                            }
                        }, 2000);
                    } catch (error) {
                        console.error(`❌ Error showing modal ${modalId}:`, error);
                    }
                } else {
                    console.error(`❌ Modal element not found: ${modalId}`);
                }
            }

            // PERBAIKI checkCartState() - Pastikan button di-update dengan benar
            async checkCartState() {
                console.log('🔍 === CHECKING CART STATE FROM BACKEND ===');

                try {
                    const response = await fetch('/store/cart/items', {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    if (!response.ok) {
                        console.warn('⚠️ Could not fetch cart items, status:', response.status);
                        return;
                    }

                    const data = await response.json();
                    console.log('📦 Cart items from backend:', data);

                    if (data.success && data.items && data.items.length > 0) {
                        console.log(`✅ Found ${data.items.length} items in cart`);

                        // Update button state berdasarkan data cart
                        data.items.forEach(cartItem => {
                            const button = document.querySelector(
                                `.store-add-to-cart[data-product-id="${cartItem.product_id}"]`
                            );

                            if (button) {
                                console.log(`🔄 Updating button for product ${cartItem.product_id}`);
                                this.setButtonInCart(button);
                            } else {
                                console.warn(`⚠️ Button not found for product ${cartItem.product_id}`);
                            }
                        });

                        console.log('✅ All cart buttons updated');
                    } else {
                        console.log('ℹ️ No items in cart or empty response');
                    }

                    console.log('🔍 === CART STATE CHECK COMPLETE ===');

                } catch (error) {
                    console.error('❌ Error checking cart state:', error);
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
                    this.animateBadge(badge || navIcon.querySelector('.store-badge'));
                } else {
                    if (badge) {
                        badge.remove();
                    }
                }
            }

            updateWishlistCount(increment) {
                // Update badge count
                const badge = document.querySelector('.store-nav-icon[href*="wishlist"] .store-badge');
                if (badge) {
                    const current = parseInt(badge.textContent) || 0;
                    const newCount = Math.max(0, current + increment);
                    badge.textContent = newCount;
                    badge.style.display = newCount > 0 ? 'flex' : 'none';
                    this.animateBadge(badge);
                }

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

            animateBadge(badge) {
                if (badge) {
                    badge.style.animation = 'none';
                    setTimeout(() => badge.style.animation = 'badgePulse 0.6s ease', 10);
                }
            }
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            console.log('🚀 Wishlist page loaded - StoreProductManager starting...');

            // Initialize product manager
            window.storeManager = new StoreProductManager();

            document.querySelectorAll('.store-add-to-cart').forEach(btn => {
                console.log('🔗 Binding cart button:', btn.dataset.productId);
            });

            // Add product card navigation
            document.addEventListener('click', (e) => {
                if (e.target.closest('.store-product-card') &&
                    !e.target.closest('.store-wishlist-btn') &&
                    !e.target.closest('.store-add-to-cart') &&
                    !e.target.closest('.btn-wishlist') &&
                    !e.target.closest('.add-to-cart')) {
                    const productCard = e.target.closest('.store-product-card');
                    const productLink = productCard.querySelector('.product-link');
                    if (productLink) {
                        window.location.href = productLink.href;
                    }
                }
            });
        });
    </script>
@endsection
