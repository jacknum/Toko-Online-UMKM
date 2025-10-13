@extends('layouts.landing')

@section('title', 'TokoOnline - Solusi Toko Online UMKM Terbaik')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <span class="hero-badge">
                            <i class="fas fa-rocket me-2"></i>Platform #1 untuk UMKM
                        </span>
                        <h1 class="hero-title">
                            Kelola Toko Online Anda dengan Mudah dan Cepat
                        </h1>
                        <p class="hero-subtitle">
                            Sistem terintegrasi untuk mengelola produk, pesanan, pembayaran, dan pelanggan.
                            Mulai jualan online dalam hitungan menit.
                        </p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-play me-2"></i>Mulai Sekarang
                            </a>
                            <a href="{{ route('features') }}" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-info-circle me-2"></i>Pelajari Fitur
                            </a>
                        </div>
                        <div class="mt-4">
                            <small class="text-white-50">
                                <i class="fas fa-shield-alt me-1"></i>100% aman & terpercaya •
                                <i class="fas fa-users me-1"></i>500+ UMKM bergabung
                            </small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center floating">
                        <div class="position-relative">
                            <div class="bg-white rounded-3 shadow-lg p-4 d-inline-block">
                                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                    alt="Dashboard Preview" class="img-fluid rounded-2">
                            </div>
                            <div class="position-absolute top-0 start-0 mt-4 ms-4">
                                <div class="bg-success text-white rounded-pill px-3 py-1 small">
                                    <i class="fas fa-chart-line me-1"></i>+25% Penjualan
                                </div>
                            </div>
                            <div class="position-absolute bottom-0 end-0 mb-4 me-4">
                                <div class="bg-primary text-white rounded-pill px-3 py-1 small">
                                    <i class="fas fa-shopping-cart me-1"></i>50+ Orders
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section tetap sama -->
    <section class="section stats">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">UMKM Bergabung</div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-number">50K+</div>
                    <div class="stat-label">Produk Terjual</div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-number">99.9%</div>
                    <div class="stat-label">Uptime</div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section dengan gambar -->
    <section id="features" class="section">
        <div class="container">
            <h2 class="section-title">Fitur Unggulan Kami</h2>
            <p class="section-subtitle">
                Semua yang Anda butuhkan untuk mengembangkan toko online ada dalam satu platform
            </p>

            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <h4 class="feature-title">Manajemen Produk</h4>
                        <p class="feature-description">
                            Kelola katalog produk dengan mudah. Upload gambar, atur stok, harga, dan kategori dalam satu
                            tempat.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h4 class="feature-title">Proses Pesanan</h4>
                        <p class="feature-description">
                            Otomatiskan proses pesanan dari konfirmasi hingga pengiriman. Lacak status pesanan real-time.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <h4 class="feature-title">Sistem Pembayaran</h4>
                        <p class="feature-description">
                            Dukungan multiple payment gateway. Terintegrasi dengan bank transfer, e-wallet, dan COD.
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('features') }}" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-arrow-right me-2"></i>Lihat Semua Fitur
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2 class="cta-title">Siap Meningkatkan Penjualan Anda?</h2>
            <p class="cta-subtitle">
                Bergabung dengan ratusan UMKM yang sudah sukses berjualan online dengan platform kami
            </p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                <i class="fas fa-play me-2"></i>Mulai Sekarang - Gratis!
            </a>
        </div>
    </section>

    <!-- About Section dengan gambar -->
    <section id="about" class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="section-title text-start">Mengapa Memilih Kami?</h2>
                    <p class="text-muted mb-4">
                        Kami memahami kebutuhan UMKM Indonesia dalam menghadapi era digital. Platform kami dirancang khusus
                        untuk memudahkan Anda berjualan online tanpa ribet.
                    </p>
                    <div class="d-flex mb-3">
                        <div class="text-primary me-3">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                        <div>
                            <h5>Mudah Digunakan</h5>
                            <p class="text-muted mb-0">Interface yang intuitif, tidak perlu keahlian teknis</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="text-primary me-3">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                        <div>
                            <h5>Harga Terjangkau</h5>
                            <p class="text-muted mb-0">Mulai gratis dengan fitur lengkap untuk UMKM</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="text-primary me-3">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                        <div>
                            <h5>Scalable</h5>
                            <p class="text-muted mb-0">Tumbuh bersama bisnis Anda dari kecil hingga besar</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center">
                        <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                            alt="Business Growth" class="img-fluid rounded-3 shadow">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
