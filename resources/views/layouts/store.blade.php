<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko UMKM - Belanja Online')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ url('/css/buyer.css') }}">
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

            <!-- Search Bar -->
            <div class="store-search mx-4">
                <form action="{{ route('store.search') }}" method="GET" class="search-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control search-input"
                            placeholder="Cari produk, kategori, atau merek..." value="{{ request('q') }}"
                            autocomplete="off">
                        <button class="btn search-btn" type="submit">
                            <i class="fas fa-search"></i>
                            Cari
                        </button>
                    </div>
                </form>
            </div>

            <!-- Navigation Icons -->
            <div class="store-nav-icons">
                <a href="{{ url('/store') }}" class="store-nav-icon">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
                <a href="{{ url('/store/wishlist') }}" class="store-nav-icon">
                    <i class="fas fa-heart"></i>
                    <span class="store-badge">3</span>
                </a>
                <a href="{{ url('/store/cart') }}" class="store-nav-icon">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="store-badge">5</span>
                </a>
                <div class="dropdown">
                    <a href="#" class="store-nav-icon dropdown-toggle" id="userDropdown"
                        data-bs-toggle="dropdown">
                        <i class="fas fa-user"></i>
                        <span>Akun</span>
                    </a>
                    <ul class="dropdown-menu store-dropdown">
                        <li><a class="dropdown-item" href="{{ url('/store/profile') }}"><i
                                    class="fas fa-user-circle me-2"></i>Profil</a></li>
                        <li><a class="dropdown-item" href="{{ url('/store/addresses') }}"><i
                                    class="fas fa-map-marker-alt me-2"></i>Alamat</a></li>
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
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                            </form>
                        </li>
                    </ul>
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
                        <li><a href="{{ url('/store') }}">Home</a></li>
                        <li><a href="{{ url('/store/cart') }}">Keranjang</a></li>
                        <li><a href="{{ url('/store/wishlist') }}">Wishlist</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h6>Akun</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ url('/stores/profile') }}">Profil</a></li>
                        <li><a href="{{ url('/store/addresses') }}">Alamat</a></li>
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
        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.store-search-input');
            const searchBtn = document.querySelector('.store-search-btn');

            searchBtn.addEventListener('click', function() {
                const searchTerm = searchInput.value.trim();
                if (searchTerm) {
                    window.location.href = `/store/search?q=${encodeURIComponent(searchTerm)}`;
                }
            });

            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    const searchTerm = searchInput.value.trim();
                    if (searchTerm) {
                        window.location.href = `/store/search?q=${encodeURIComponent(searchTerm)}`;
                    }
                }
            });
        });
    </script>

    @yield('scripts')
</body>

</html>
