<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Toko Online')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/seller.css'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Nama Perusahaan</h3>
        </div>

        <div class="sidebar-menu">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> <span class="menu-text">Dashboard</span>
            </a>

            <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
                <i class="fas fa-box"></i> <span class="menu-text">Produk Saya</span>
            </a>

            <!-- Pesanan Masuk -->
            <a href="{{ route('orders.incoming') }}"
                class="{{ request()->is('orders/incoming') || request()->routeIs('orders.incoming') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i> <span class="menu-text">Pesanan Masuk</span>
            </a>

            <!-- Pesanan Keluar -->
            <a href="{{ route('orders.outgoing') }}"
                class="{{ request()->is('orders/outgoing') || request()->routeIs('orders.outgoing') ? 'active' : '' }}">
                <i class="fas fa-truck"></i> <span class="menu-text">Pesanan Keluar</span>
            </a>

            <a href="{{ route('payments.index') }}" class="{{ request()->routeIs('payments.*') ? 'active' : '' }}">
                <i class="fas fa-money-bill-wave"></i> <span class="menu-text">Pembayaran & Komisi</span>
            </a>

            <!-- Settings Menu -->
            <a href="{{ route('settings') }}" class="{{ request()->routeIs('settings.*') ? 'active' : '' }}">
                <i class="fas fa-cog"></i> <span class="menu-text">Pengaturan</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom rounded">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <span class="navbar-brand mb-0 h1 d-none d-md-block">Toko Online UMKM</span>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        @auth
                            <!-- User Dropdown - Visible when logged in -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                            <i class="fas fa-user me-2"></i> Profil
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('settings') }}">
                                            <i class="fas fa-cog me-2"></i> Pengaturan
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item" id="logoutBtn">
                                                <i class="fas fa-sign-out-alt me-2"></i> Keluar
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <!-- Auth Buttons - Visible when not logged in -->
                            <li class="nav-item auth-buttons">
                                <a href="{{ route('login') }}" class="btn btn-login">
                                    <i class="fas fa-sign-in-alt me-1"></i>Login
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-register">
                                    <i class="fas fa-user-plus me-1"></i>Register
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle sidebar on small screens
            const sidebarToggler = document.querySelector('.navbar-toggler');
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');

            if (sidebarToggler) {
                sidebarToggler.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        if (sidebar.style.width === '70px') {
                            sidebar.style.width = '250px';
                            mainContent.style.marginLeft = '250px';
                        } else {
                            sidebar.style.width = '70px';
                            mainContent.style.marginLeft = '70px';
                        }
                    }
                });
            }

            // Check if user is logged in (you can modify this logic based on your auth system)
            checkAuthStatus();

            // Logout functionality
            document.getElementById('logoutBtn')?.addEventListener('click', function(e) {
                e.preventDefault();
                logout();
            });

            // Active menu highlighting
            highlightActiveMenu();
        });

        function checkAuthStatus() {
            // Simulate checking if user is logged in
            // In real application, you would check localStorage, cookies, or session
            const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';

            const authButtons = document.querySelector('.auth-buttons');
            const userDropdown = document.querySelector('.nav-item.dropdown');

            if (isLoggedIn) {
                authButtons.classList.add('d-none');
                userDropdown.classList.remove('d-none');
            } else {
                authButtons.classList.remove('d-none');
                userDropdown.classList.add('d-none');
            }
        }

        function logout() {
            // Simulate logout process
            localStorage.removeItem('isLoggedIn');
            alert('Anda telah berhasil logout!');
            checkAuthStatus();

            // Redirect to login page after logout
            setTimeout(() => {
                window.location.href = '{{ route('login') }}';
            }, 1000);
        }

        function generateReport() {
            // Simulate report generation
            const reportCard = document.querySelector('.report-card');
            const originalContent = reportCard.innerHTML;

            reportCard.innerHTML = `
                <div class="card-body text-center">
                    <i class="fas fa-spinner fa-spin fa-2x mb-3"></i>
                    <h5>Generating Report...</h5>
                    <p class="small mb-0">Please wait</p>
                </div>
            `;

            setTimeout(() => {
                reportCard.innerHTML = originalContent;
                alert('Laporan berhasil di-generate! File akan didownload otomatis.');

                // Simulate file download
                const link = document.createElement('a');
                link.href = '#';
                link.download = 'laporan_toko_online.pdf';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }, 2000);
        }

        function highlightActiveMenu() {
            const currentPath = window.location.pathname;
            const menuItems = document.querySelectorAll('.sidebar-menu a');

            menuItems.forEach(item => {
                // Remove active class from all items
                item.classList.remove('active');

                // Check if current path matches the menu item's href
                const itemHref = item.getAttribute('href');
                if (itemHref) {
                    // Handle both absolute and relative paths
                    const hrefPath = itemHref.startsWith('/') ? itemHref : new URL(itemHref, window.location.origin)
                        .pathname;
                    if (currentPath === hrefPath) {
                        item.classList.add('active');
                    }
                }

                // Check for route patterns
                const route = item.getAttribute('data-route');
                if (route) {
                    if (route === 'dashboard' && (currentPath === '/' || currentPath === '/dashboard')) {
                        item.classList.add('active');
                    } else if (route === 'products' && currentPath.includes('/products')) {
                        item.classList.add('active');
                    } else if (route === 'orders' && currentPath.includes('/orders')) {
                        item.classList.add('active');
                    } else if (route === 'outgoing' && currentPath.includes('/outgoing')) {
                        item.classList.add('active');
                    } else if (route === 'payments' && currentPath.includes('/payments')) {
                        item.classList.add('active');
                    } else if (route === 'settings' && currentPath.includes('/settings')) {
                        item.classList.add('active');
                    }
                }
            });
        }

        // Add click event to menu items for immediate feedback
        document.querySelectorAll('.sidebar-menu a').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.sidebar-menu a').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Highlight menu on page load
        highlightActiveMenu();
    </script>

    @yield('scripts')
</body>

</html>
