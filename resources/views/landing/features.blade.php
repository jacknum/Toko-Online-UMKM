@extends('layouts.landing')

@section('title', 'Fitur Lengkap - TokoOnline')

@section('content')
    <!-- Hero Section untuk Features -->
    <section class="hero" style="min-height: 80vh;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <span class="hero-badge">
                        <i class="fas fa-star me-2"></i>Fitur Unggulan
                    </span>
                    <h1 class="hero-title">Semua yang Anda Butuhkan dalam Satu Platform</h1>
                    <p class="hero-subtitle">
                        Kelola toko online Anda dengan fitur-fitur canggih yang dirancang khusus untuk UMKM Indonesia
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Features Section -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6">
                    <h2 class="section-title text-start">Manajemen Produk yang Powerful</h2>
                    <p class="text-muted mb-4">
                        Kelola katalog produk dengan mudah dan efisien. Upload produk dalam jumlah banyak, atur harga dan stok, serta kategorikan produk dengan sistem yang intuitif.
                    </p>
                    <div class="d-flex mb-3">
                        <div class="text-primary me-3">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                        <div>
                            <h5>Bulk Upload Produk</h5>
                            <p class="text-muted mb-0">Upload ratusan produk sekaligus dengan template Excel</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="text-primary me-3">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                        <div>
                            <h5>Manajemen Stok Real-time</h5>
                            <p class="text-muted mb-0">Pantau stok secara real-time dengan notifikasi low stock</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="text-primary me-3">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                        <div>
                            <h5>Galeri Produk Unlimited</h5>
                            <p class="text-muted mb-0">Tampilkan produk dengan multiple gambar berkualitas tinggi</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center">
                        <div class="animation-3d-container">
                            <!-- 3D Animation untuk Manajemen Produk -->
                            <div class="scene-3d">
                                <div class="cube">
                                    <div class="face front">
                                        <i class="fas fa-boxes"></i>
                                        <span>Produk</span>
                                    </div>
                                    <div class="face back">
                                        <i class="fas fa-database"></i>
                                        <span>Stok</span>
                                    </div>
                                    <div class="face right">
                                        <i class="fas fa-tags"></i>
                                        <span>Harga</span>
                                    </div>
                                    <div class="face left">
                                        <i class="fas fa-layer-group"></i>
                                        <span>Kategori</span>
                                    </div>
                                    <div class="face top">
                                        <i class="fas fa-upload"></i>
                                        <span>Upload</span>
                                    </div>
                                    <div class="face bottom">
                                        <i class="fas fa-chart-bar"></i>
                                        <span>Analytics</span>
                                    </div>
                                </div>
                            </div>
                            <div class="floating-elements">
                                <div class="element element-1">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div class="element element-2">
                                    <i class="fas fa-cube"></i>
                                </div>
                                <div class="element element-3">
                                    <i class="fas fa-pallet"></i>
                                </div>
                                <div class="element element-4">
                                    <i class="fas fa-barcode"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Management -->
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 order-lg-2">
                    <h2 class="section-title text-start">Sistem Pesanan Terintegrasi</h2>
                    <p class="text-muted mb-4">
                        Otomatiskan proses pesanan dari awal hingga akhir. Terima notifikasi real-time, kelola pengiriman, dan berikan pengalaman terbaik untuk pelanggan.
                    </p>
                    <div class="d-flex mb-3">
                        <div class="text-primary me-3">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                        <div>
                            <h5>Notifikasi Real-time</h5>
                            <p class="text-muted mb-0">Dapatkan notifikasi instan untuk setiap pesanan baru</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="text-primary me-3">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                        <div>
                            <h5>Tracking Pengiriman</h5>
                            <p class="text-muted mb-0">Lacak status pengiriman dengan integrasi kurir terkemuka</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="text-primary me-3">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                        <div>
                            <h5>Manajemen Retur</h5>
                            <p class="text-muted mb-0">Kelola proses retur dan refund dengan sistem yang terstruktur</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="text-center">
                        <div class="animation-3d-container">
                            <!-- 3D Animation untuk Pesanan -->
                            <div class="scene-3d">
                                <div class="cube">
                                    <div class="face front">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span>Order</span>
                                    </div>
                                    <div class="face back">
                                        <i class="fas fa-truck"></i>
                                        <span>Kirim</span>
                                    </div>
                                    <div class="face right">
                                        <i class="fas fa-bell"></i>
                                        <span>Notif</span>
                                    </div>
                                    <div class="face left">
                                        <i class="fas fa-exchange-alt"></i>
                                        <span>Retur</span>
                                    </div>
                                    <div class="face top">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>Track</span>
                                    </div>
                                    <div class="face bottom">
                                        <i class="fas fa-history"></i>
                                        <span>Riwayat</span>
                                    </div>
                                </div>
                            </div>
                            <div class="floating-elements">
                                <div class="element element-1">
                                    <i class="fas fa-receipt"></i>
                                </div>
                                <div class="element element-2">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                                <div class="element element-3">
                                    <i class="fas fa-box-open"></i>
                                </div>
                                <div class="element element-4">
                                    <i class="fas fa-route"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment System -->
            <div class="row align-items-center mb-5">
                <div class="col-lg-6">
                    <h2 class="section-title text-start">Sistem Pembayaran Lengkap</h2>
                    <p class="text-muted mb-4">
                        Dukung berbagai metode pembayaran yang familiar bagi pelanggan Indonesia. Dari transfer bank hingga e-wallet, semua tersedia dalam satu sistem.
                    </p>
                    <div class="d-flex mb-3">
                        <div class="text-primary me-3">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                        <div>
                            <h5>Multiple Payment Gateway</h5>
                            <p class="text-muted mb-0">Integrasi dengan Midtrans, Xendit, dan payment gateway lainnya</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="text-primary me-3">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                        <div>
                            <h5>COD (Cash on Delivery)</h5>
                            <p class="text-muted mb-0">Dukung pembayaran di tempat untuk layanan pengiriman tertentu</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="text-primary me-3">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                        <div>
                            <h5>Rekonsiliasi Otomatis</h5>
                            <p class="text-muted mb-0">Sinkronisasi otomatis antara pembayaran dan pesanan</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center">
                        <div class="animation-3d-container">
                            <!-- 3D Animation untuk Pembayaran -->
                            <div class="scene-3d">
                                <div class="cube">
                                    <div class="face front">
                                        <i class="fas fa-credit-card"></i>
                                        <span>Kartu</span>
                                    </div>
                                    <div class="face back">
                                        <i class="fas fa-wallet"></i>
                                        <span>E-Wallet</span>
                                    </div>
                                    <div class="face right">
                                        <i class="fas fa-university"></i>
                                        <span>Transfer</span>
                                    </div>
                                    <div class="face left">
                                        <i class="fas fa-money-bill-wave"></i>
                                        <span>COD</span>
                                    </div>
                                    <div class="face top">
                                        <i class="fas fa-shield-alt"></i>
                                        <span>Secure</span>
                                    </div>
                                    <div class="face bottom">
                                        <i class="fas fa-sync"></i>
                                        <span>Sync</span>
                                    </div>
                                </div>
                            </div>
                            <div class="floating-elements">
                                <div class="element element-1">
                                    <i class="fab fa-cc-visa"></i>
                                </div>
                                <div class="element element-2">
                                    <i class="fab fa-cc-mastercard"></i>
                                </div>
                                <div class="element element-3">
                                    <i class="fas fa-qrcode"></i>
                                </div>
                                <div class="element element-4">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- All Features Grid -->
    <section class="section bg-light">
        <div class="container">
            <h2 class="section-title">Semua Fitur dalam Satu Tempat</h2>
            <p class="section-subtitle">
                Platform lengkap dengan segala yang dibutuhkan toko online modern
            </p>

            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4 class="feature-title">Analytics Dashboard</h4>
                        <p class="feature-description">
                            Pantau performa toko dengan dashboard analytics real-time. Lihat grafik penjualan, traffic, dan konversi.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="feature-title">Manajemen Pelanggan</h4>
                        <p class="feature-description">
                            Kelola database pelanggan, riwayat belanja, dan segmentasi untuk marketing yang tepat.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <h4 class="feature-title">Marketing Tools</h4>
                        <p class="feature-description">
                            Buat promo, diskon, dan voucher untuk meningkatkan penjualan dan loyalitas pelanggan.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4 class="feature-title">Mobile Responsive</h4>
                        <p class="feature-description">
                            Akses dan kelola toko dari smartphone dengan interface yang dioptimalkan untuk mobile.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4 class="feature-title">Keamanan Data</h4>
                        <p class="feature-description">
                            Data toko dan pelanggan terlindungi dengan enkripsi SSL dan backup rutin.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-sync"></i>
                        </div>
                        <h4 class="feature-title">Auto Update</h4>
                        <p class="feature-description">
                            Sistem selalu update dengan fitur-fitur terbaru tanpa perlu setup manual.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2 class="cta-title">Siap Menggunakan Fitur Lengkap Kami?</h2>
            <p class="cta-subtitle">
                Bergabung dengan ribuan UMKM yang sudah meningkatkan penjualan dengan platform kami
            </p>
            <div class="d-flex flex-wrap gap-3 justify-content-center">
                <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-play me-2"></i>Mulai Sekarang - Gratis!
                </a>
                <a href="{{ route('pricing') }}" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-tags me-2"></i>Lihat Harga
                </a>
            </div>
        </div>
    </section>
@endsection
