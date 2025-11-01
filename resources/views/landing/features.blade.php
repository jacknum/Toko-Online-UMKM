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
            <!-- Product Management -->
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
                    <div id="lottie-animation-products" class="lottie-container"></div>
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
                    <div id="lottie-animation-orders" class="lottie-container"></div>
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
                    <div id="lottie-animation-payments" class="lottie-container"></div>
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

@push('styles')
<style>
    /* Lottie Animation Styles untuk Features Page */
    .lottie-container {
        width: 100%;
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border-radius: 10px;
        margin: 1rem 0;
    }

    lottie-player {
        width: 100% !important;
        height: 100% !important;
        background: transparent !important;
    }

    .lottie-loading {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        background: #f8f9fa;
        border-radius: 10px;
        color: #6c757d;
        width: 100%;
        flex-direction: column;
    }

    @media (max-width: 768px) {
        .lottie-container {
            height: 250px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('🚀 Initializing Features Lottie animations...');

        // File Lottie untuk Features Page
        const lottieFiles = {
            products: "{{ asset('js/lottie/management.json') }}",
            orders: "{{ asset('js/lottie/pengiriman.json') }}",
            payments: "{{ asset('js/lottie/pembayaran.json') }}"
        };

        // Initialize semua Lottie animations
        function initFeaturesLottie() {
            // Product Management Animation
            initSingleLottie('lottie-animation-products', lottieFiles.products, 'Manajemen Produk');

            // Order Management Animation
            initSingleLottie('lottie-animation-orders', lottieFiles.orders, 'Pesanan');

            // Payment System Animation
            initSingleLottie('lottie-animation-payments', lottieFiles.payments, 'Pembayaran');
        }

        function initSingleLottie(containerId, filePath, featureName) {
            const container = document.getElementById(containerId);

            if (!container) {
                console.error(`❌ ${featureName} Lottie container not found:`, containerId);
                return;
            }

            console.log(`🎯 Initializing ${featureName} Lottie...`);

            // Show loading state
            container.innerHTML = `
                <div class="lottie-loading">
                    <div class="text-center">
                        <i class="fas fa-spinner fa-spin fa-2x mb-2"></i>
                        <p>Memuat ${featureName}...</p>
                    </div>
                </div>
            `;

            setTimeout(() => {
                container.innerHTML = '';

                const player = document.createElement('lottie-player');
                player.src = filePath;
                player.background = 'transparent';
                player.speed = 1;
                player.style.width = '100%';
                player.style.height = '100%';
                player.loop = true;
                player.autoplay = true;

                container.appendChild(player);

                player.addEventListener('load', () => {
                    console.log(`✅ ${featureName} Lottie loaded successfully`);
                });

                player.addEventListener('error', (error) => {
                    console.error(`❌ ${featureName} Lottie failed:`, error);
                    container.innerHTML = `
                        <div class="lottie-loading">
                            <i class="fas fa-cube fa-3x mb-3 text-muted"></i>
                            <p>${featureName} Animation</p>
                            <small class="text-muted">Tidak dapat dimuat</small>
                        </div>
                    `;
                });

            }, 100);
        }

        // Test file availability untuk semua files
        function testAllLottieFiles() {
            let tested = 0;
            const total = Object.keys(lottieFiles).length;

            Object.entries(lottieFiles).forEach(([feature, path]) => {
                fetch(path)
                    .then(response => {
                        if (response.ok) {
                            console.log(`✅ ${feature} file accessible`);
                        } else {
                            console.warn(`⚠️ ${feature} file not found:`, path);
                        }
                    })
                    .catch(error => {
                        console.warn(`⚠️ ${feature} file error:`, path);
                    })
                    .finally(() => {
                        tested++;
                        if (tested === total) {
                            initFeaturesLottie();
                        }
                    });
            });
        }

        // Initialize features Lottie
        testAllLottieFiles();
    });
</script>
@endpush
