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
                    <div class="css-chart-container">
                        <div class="chart-wrapper">
                            <div class="chart-area">
                                <div class="chart-grid">
                                    <div class="grid-line"></div>
                                    <div class="grid-line"></div>
                                    <div class="grid-line"></div>
                                    <div class="grid-line"></div>
                                    <div class="grid-line"></div>
                                </div>
                                <div class="chart-line-animated"></div>
                                <div class="chart-fill-animated"></div>
                                <div class="chart-points">
                                    <div class="point" style="left: 4%; bottom: 31%;" data-value="65%"></div>
                                    <div class="point" style="left: 12%; bottom: 37.2%;" data-value="78%"></div>
                                    <div class="point" style="left: 20%; bottom: 43%;" data-value="90%"></div>
                                    <div class="point" style="left: 28%; bottom: 38.6%;" data-value="81%"></div>
                                    <div class="point" style="left: 36%; bottom: 45.8%;" data-value="96%"></div>
                                    <div class="point" style="left: 44%; bottom: 50%;" data-value="105%"></div>
                                    <div class="point" style="left: 52%; bottom: 57.1%;" data-value="120%"></div>
                                    <div class="point" style="left: 60%; bottom: 64.3%;" data-value="135%"></div>
                                    <div class="point" style="left: 68%; bottom: 71.4%;" data-value="150%"></div>
                                    <div class="point" style="left: 76%; bottom: 81%;" data-value="170%"></div>
                                    <div class="point" style="left: 84%; bottom: 88.1%;" data-value="185%"></div>
                                    <div class="point" style="left: 92%; bottom: 100%;" data-value="210%"></div>
                                </div>
                            </div>
                            <div class="chart-labels">
                                <span>Jan</span>
                                <span>Feb</span>
                                <span>Mar</span>
                                <span>Apr</span>
                                <span>Mei</span>
                                <span>Jun</span>
                                <span>Jul</span>
                                <span>Agu</span>
                                <span>Sep</span>
                                <span>Okt</span>
                                <span>Nov</span>
                                <span>Des</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
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

    <!-- About Section dengan Lottie Animation -->
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
                    <div class="lottie-animation-container">
                        <!-- Lottie Animation Container -->
                        <div id="lottie-animation" class="lottie-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    /* CSS khusus untuk Lottie Animation - Sama persis dengan auth */
    .lottie-animation-container {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .lottie-container {
        width: 100%;
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        position: relative;
        z-index: 1;
    }

    /* Styling untuk lottie-player element */
    lottie-player {
        width: 100% !important;
        height: 100% !important;
        background: transparent !important;
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
        margin: 0 auto !important;
        padding: 0 !important;
        display: block !important;
    }

    /* Loading state */
    .lottie-loading {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 400px;
        background: #f8f9fa;
        border-radius: 10px;
        color: #6c757d;
        width: 100%;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .lottie-container {
            height: 350px;
        }
    }

    @media (max-width: 768px) {
        .lottie-container {
            height: 300px;
        }
    }

    @media (max-width: 576px) {
        .lottie-container {
            height: 250px;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const lottieContainer = document.getElementById('lottie-animation');
        
        console.log('Initializing Lottie animation...');
        
        // Show loading state
        lottieContainer.innerHTML = `
            <div class="lottie-loading">
                <div class="text-center">
                    <i class="fas fa-spinner fa-spin fa-2x mb-2"></i>
                    <p>Memuat animasi...</p>
                </div>
            </div>
        `;

        // Gunakan path yang SAMA PERSIS dengan yang berhasil di login page
        const lottiePath = "{{ asset('js/lottie/shopping Ecommerce.json') }}";
        
        console.log('Loading Lottie from:', lottiePath);

        // Clear container dan buat player setelah delay kecil
        setTimeout(() => {
            lottieContainer.innerHTML = '';
            
            // Create lottie player element - SAMA PERSIS dengan login page
            const player = document.createElement('lottie-player');
            player.src = lottiePath;
            player.background = 'transparent';
            player.speed = 1;
            player.style.width = '100%';
            player.style.height = '100%';
            player.loop = true;
            player.autoplay = true;
            
            console.log('Lottie player created:', player);
            
            // Append to container
            lottieContainer.appendChild(player);
            
            // Event listeners untuk debugging
            player.addEventListener('load', () => {
                console.log('✅ Lottie animation loaded successfully');
            });

            player.addEventListener('error', (error) => {
                console.error('❌ Lottie animation failed to load:', error);
                console.log('Error details:', {
                    src: player.src,
                    readyState: player.readyState,
                    currentState: player.currentState
                });
                
                // Fallback content
                lottieContainer.innerHTML = `
                    <div style="text-align: center; color: #6c757d; padding: 40px;">
                        <i class="fas fa-shopping-cart" style="font-size: 80px; margin-bottom: 20px; color: #007bff;"></i>
                        <h4 style="color: #495057;">Toko Online UMKM</h4>
                        <p>Animasi tidak dapat dimuat</p>
                        <small>Path: ${lottiePath}</small>
                    </div>
                `;
            });

            player.addEventListener('ready', () => {
                console.log('🎉 Lottie player is ready');
            });

        }, 100);
        
        // Tambahkan debug info ke console
        console.log('Lottie container:', lottieContainer);
        console.log('Window lottie-player available:', typeof window.lottie !== 'undefined');
    });
</script>
@endpush