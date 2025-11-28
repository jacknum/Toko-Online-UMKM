<!-- layouts/store.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Toko UMKM - Belanja Online')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    {{-- @vite(['resources/css/buyer.css']) --}}
    <link rel="stylesheet" href="{{ url('/css/buyer.css') }}">
</head>

<body class="store-body">
    <!-- Header -->
    <nav class="store-navbar navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand store-brand" href="{{ url('/store') }}">
                <img src="{{ asset('images/BI_Logo.png') }}" alt="Toko UMKM" class="store-logo">
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Search Bar & Navigation -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Search Bar dengan fitur tambahan -->
                <div class="store-search">
                    <form action="{{ route('store.search') }}" method="GET" class="search-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control store-search-input"
                                placeholder="Cari produk, kategori, atau merek..." value="{{ request('q') }}"
                                autocomplete="off">

                            <!-- Clear button -->
                            <button type="button" class="store-search-clear">
                                <i class="fas fa-times"></i>
                            </button>

                            <button class="btn store-search-btn" type="submit">
                                <i class="fas fa-search"></i>
                                <span>Cari</span>
                            </button>
                        </div>
                    </form>

                    <!-- Search suggestions dropdown -->
                    <div class="store-search-suggestions">
                        <div class="suggestion-item">
                            <i class="fas fa-search me-2"></i>
                            <span>Produk terpopuler</span>
                        </div>
                        <div class="suggestion-item">
                            <i class="fas fa-search me-2"></i>
                            <span>Kategori elektronik</span>
                        </div>
                        <div class="suggestion-item">
                            <i class="fas fa-search me-2"></i>
                            <span>Merek lokal</span>
                        </div>
                    </div>
                </div>

                <!-- Navigation Icons -->
                <div class="store-nav-icons ms-lg-auto">
                    <a href="{{ url('/store') }}" class="store-nav-icon" title="Beranda">
                        <i class="fas fa-home"></i>
                        <span>Beranda</span>
                    </a>
                    <a href="{{ url('/store/wishlist') }}" class="store-nav-icon" title="Wishlist">
                        <i class="fas fa-heart"></i>
                        @php
                            // Hitung jumlah wishlist dari database
                            $wishlistCount = 0;
                            if (auth()->check()) {
                                // Menggunakan method yang sudah diperbaiki
                                $wishlistCount = \App\Models\Wishlist::getCountForCurrentUser();
                            }
                        @endphp
                        @if ($wishlistCount > 0)
                            <span class="store-badge">{{ $wishlistCount }}</span>
                        @endif
                        <span>Wishlist</span>
                    </a>
                    <a href="{{ url('/store/cart') }}" class="store-nav-icon" title="Keranjang">
                        <i class="fas fa-shopping-cart"></i>
                        @php
                            // Hitung jumlah item keranjang dari database
                            $cartCount = 0;
                            if (auth()->check()) {
                                // Menggunakan method yang sudah diperbaiki
                                $cartCount = \App\Models\Cart::getTotalQuantityForCurrentUser();
                            }
                        @endphp
                        @if ($cartCount > 0)
                            <span class="store-badge">{{ $cartCount }}</span>
                        @endif
                        <span>Keranjang</span>
                    </a>
                    <div class="dropdown">
                        <a href="#" class="store-nav-icon dropdown-toggle" id="userDropdown"
                            data-bs-toggle="dropdown" title="Akun Saya">
                            <i class="fas fa-user"></i>
                            <span>Akun</span>
                        </a>
                        <ul class="dropdown-menu store-dropdown" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ url('/store/profile') }}"><i
                                        class="fas fa-user-circle me-2"></i>Profil Saya</a></li>
                            <li><a class="dropdown-item" href="{{ url('/store/orders') }}"><i
                                        class="fas fa-shopping-bag me-2"></i>Pesanan Saya</a></li>
                            <li><a class="dropdown-item" href="{{ url('/store/addresses') }}"><i
                                        class="fas fa-map-marker-alt me-2"></i>Alamat Saya</a></li>
                            <li><a class="dropdown-item" href="{{ url('/store/security') }}"><i
                                        class="fas fa-lock me-2"></i>Keamanan</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <!-- Form Logout -->
                                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                    @csrf
                                    <a class="dropdown-item text-danger" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>Keluar
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="store-main">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="store-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-store me-2"></i>Toko UMKM</h5>
                    <p>Platform belanja online terpercaya untuk produk UMKM lokal.</p>
                </div>
                <div class="col-md-2">
                    <h6>Menu</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ url('/store') }}">Beranda</a></li>
                        <li><a href="{{ url('/store/cart') }}">Keranjang</a></li>
                        <li><a href="{{ url('/store/wishlist') }}">Wishlist</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h6>Akun</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ url('/store/profile') }}">Profil Saya</a></li>
                        <li><a href="{{ url('/store/orders') }}">Pesanan Saya</a></li>
                        <li><a href="{{ url('/store/addresses') }}">Alamat Saya</a></li>
                        <li><a href="{{ url('/store/security') }}">Keamanan</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6>Kontak</h6>
                    <p><i class="fas fa-phone me-2"></i>+62 812-3456-7890</p>
                    <p><i class="fas fa-envelope me-2"></i>info@toko-umkm.com</p>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; 2025 Toko UMKM. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                this.loadInitialWishlistState();
            }

            async loadInitialWishlistState() {
                try {
                    const response = await fetch('{{ route('store.wishlist.count') }}');
                    const data = await response.json();

                    // Update badge count
                    this.updateWishlistBadge(data.count);

                    // Load individual product wishlist states (bisa ditambahkan endpoint khusus jika perlu)
                } catch (error) {
                    console.error('Error loading wishlist state:', error);
                }
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

                    // Show appropriate modal
                    if (data.in_wishlist) {
                        this.showModal('wishlistModal');
                    } else {
                        this.showModal('wishlistRemoveModal');
                    }

                } catch (error) {
                    console.error('Error toggling wishlist:', error);
                    this.showErrorAlert('Terjadi kesalahan saat memproses wishlist');
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
                    button.classList.add('removing');
                    setTimeout(() => button.classList.remove('removing'), 300);
                }
            }

            updateWishlistBadge(count) {
                const badge = document.querySelector('.store-nav-icon[href*="wishlist"] .store-badge');
                const navIcon = document.querySelector('.store-nav-icon[href*="wishlist"]');

                if (count > 0) {
                    if (!badge) {
                        // Create badge if it doesn't exist
                        const newBadge = document.createElement('span');
                        newBadge.className = 'store-badge';
                        newBadge.textContent = count;
                        navIcon.appendChild(newBadge);
                    } else {
                        badge.textContent = count;
                    }
                } else {
                    // Remove badge if count is 0
                    if (badge) {
                        badge.remove();
                    }
                }
            }

            showLoginAlert() {
                if (confirm('Anda perlu login untuk menambahkan produk ke wishlist. Apakah Anda ingin login?')) {
                    window.location.href = '{{ route('login') }}';
                }
            }

            showErrorAlert(message) {
                alert(message);
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
                const modalElement = document.getElementById(modalId);
                if (modalElement) {
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                }
            }

            updateCartCount(increment) {
                this.updateBadgeCount('.store-nav-icon[href*="cart"] .store-badge', increment);
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
                    if (modalElement) {
                        modalElement.addEventListener('shown.bs.modal', () => {
                            setTimeout(() => {
                                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                                if (modalInstance) modalInstance.hide();
                            }, 1500);
                        });
                    }
                });
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            new ProductManager();
        });
    </script>

    @yield('scripts')
</body>

</html>
