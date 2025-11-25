<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TokoOnline - Solusi Toko Online UMKM')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    {{-- @vite(['resources/css/landing.css']) --}}
    <link rel="stylesheet" href="{{ url('/css/landing.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Load Lottie Player di head -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">
                <i class="fas fa-store me-2"></i>TokoOnline
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('landing') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('features') }}">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pricing') }}">Harga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('landing') }}#about">Tentang</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a href="{{ route('login') }}" class="btn btn-login">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="footer-brand">TokoOnline</div>
                    <p class="text-white">Solusi lengkap untuk toko online UMKM. Kelola penjualan, inventori, dan
                        pelanggan dengan mudah.</p>
                </div>
                <div class="col-lg-2 col-6 mb-4">
                    <h5 class="text-white mb-3">Perusahaan</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('landing') }}#about">Tentang Kami</a></li>
                        <li><a href="{{ route('landing') }}#features">Fitur</a></li>
                        <li><a href="{{ route('pricing') }}">Harga</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 mb-4">
                    <h5 class="text-white mb-3">Dukungan</h5>
                    <ul class="footer-links">
                        <li><a href="#">Bantuan</a></li>
                        <li><a href="#">Kontak</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 mb-4">
                    <h5 class="text-white mb-3">Legal</h5>
                    <ul class="footer-links">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="text-center pt-4 mt-4 border-top border-secondary">
                <p class="text-white mb-0">&copy; 2025 TokoOnline. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Global Scripts -->
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Intersection Observer untuk animasi scroll
        function initScrollAnimation() {
            const sections = document.querySelectorAll('.section');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            sections.forEach(section => {
                observer.observe(section);
            });
        }

        // Initialize observer
        document.addEventListener('DOMContentLoaded', function() {
            initScrollAnimation();
        });
    </script>

    @stack('styles')
    @stack('scripts')
</body>

</html>
