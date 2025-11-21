<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko UMKM - Belanja Online')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/buyer.css'])
</head>

<body class="store-body">
    <!-- Header -->
    <nav class="store-navbar navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand store-brand" href="{{ url('/store') }}">
                <i class="fas fa-store me-2"></i>
                Toko UMKM
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
                        <span class="store-badge">3</span>
                        <span>Wishlist</span>
                    </a>
                    <a href="{{ url('/store/cart') }}" class="store-nav-icon" title="Keranjang">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="store-badge">5</span>
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
        /// Tambahkan script ini untuk fungsionalitas search yang lebih baik
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.store-search-input');
            const searchBtn = document.querySelector('.store-search-btn');
            const searchForm = document.querySelector('.search-form');
            const clearBtn = document.querySelector('.store-search-clear');
            const suggestions = document.querySelector('.store-search-suggestions');

            // Show/hide clear button based on input
            if (searchInput && clearBtn) {
                searchInput.addEventListener('input', function() {
                    if (this.value.trim()) {
                        clearBtn.classList.add('show');
                    } else {
                        clearBtn.classList.remove('show');
                    }
                });

                // Clear search functionality
                clearBtn.addEventListener('click', function() {
                    searchInput.value = '';
                    searchInput.focus();
                    clearBtn.classList.remove('show');
                    if (suggestions) {
                        suggestions.classList.remove('show');
                    }
                });
            }

            // Search suggestions (basic implementation)
            if (searchInput && suggestions) {
                searchInput.addEventListener('focus', function() {
                    if (this.value.trim()) {
                        suggestions.classList.add('show');
                    }
                });

                searchInput.addEventListener('input', function() {
                    if (this.value.trim()) {
                        suggestions.classList.add('show');
                        // Here you would typically fetch suggestions from an API
                    } else {
                        suggestions.classList.remove('show');
                    }
                });

                // Hide suggestions when clicking outside
                document.addEventListener('click', function(e) {
                    if (!searchInput.contains(e.target) && !suggestions.contains(e.target)) {
                        suggestions.classList.remove('show');
                    }
                });
            }

            // Enhanced search functionality
            if (searchForm) {
                searchForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const searchTerm = searchInput.value.trim();
                    if (searchTerm) {
                        // Add loading state
                        searchForm.classList.add('loading');

                        // Simulate search (replace with actual search logic)
                        setTimeout(() => {
                            window.location.href =
                                `/store/search?q=${encodeURIComponent(searchTerm)}`;
                        }, 500);
                    }
                });
            }

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Focus search with Ctrl+K or Cmd+K
                if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                    e.preventDefault();
                    if (searchInput) {
                        searchInput.focus();
                    }
                }

                // Clear search with Escape
                if (e.key === 'Escape' && searchInput) {
                    searchInput.value = '';
                    searchInput.blur();
                    if (clearBtn) clearBtn.classList.remove('show');
                    if (suggestions) suggestions.classList.remove('show');
                }
            });
        });

        // Tambahkan di bagian script yang sudah ada
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.querySelector('.search-form');
            const searchBtn = document.querySelector('.store-search-btn');

            if (searchForm && searchBtn) {
                searchForm.addEventListener('submit', function(e) {
                    // Trigger loading state
                    searchBtn.classList.add('loading');

                    // Optional: Simulate search delay (bisa dihapus jika menggunakan AJAX real)
                    setTimeout(() => {
                        searchBtn.classList.remove('loading');
                    }, 2000); // Hapus loading setelah 2 detik (simulasi)
                });
            }

            // Pastikan teks tetap putih saat hover
            const searchButtons = document.querySelectorAll('.store-search-btn');
            searchButtons.forEach(btn => {
                btn.addEventListener('mouseenter', function() {
                    this.style.color = 'white';
                });
                btn.addEventListener('mouseleave', function() {
                    this.style.color = 'white';
                });
            });
        });
    </script>

    @yield('scripts')
</body>

</html>
