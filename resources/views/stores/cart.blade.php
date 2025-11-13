@extends('layouts.store')

@section('title', 'Keranjang Belanja - Toko UMKM')

@section('content')
    <div class="container-fluid bg-light py-4">
        <div class="container">
            <!-- Header yang Minimalis dan Informatif -->
            <div class="row align-items-center mb-4">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">
                                    <i class="fas fa-home me-1"></i>Beranda
                                </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Keranjang Belanja</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center text-muted">
                        <i class="fas fa-shopping-cart me-2"></i>
                        <span class="fw-medium">0 Item</span>
                    </div>
                </div>
            </div>

            <!-- Progress Checkout -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="checkout-progress">
                        <div class="progress-steps">
                            <div class="step active" data-step="1">
                                <div class="step-icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <span class="step-text">Keranjang</span>
                            </div>
                            <div class="step" data-step="2">
                                <div class="step-icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <span class="step-text">Pembayaran</span>
                            </div>
                            <div class="step" data-step="3">
                                <div class="step-icon">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <span class="step-text">Pengiriman</span>
                            </div>
                            <div class="step" data-step="4">
                                <div class="step-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <span class="step-text">Selesai</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step Content -->
            <div id="step-content">
                <!-- Step 1: Keranjang -->
                <div class="step-panel active" data-step="1">
                    <!-- Empty Cart State -->
                    <div class="text-center py-5 my-5">
                        <div class="empty-cart-icon mb-4">
                            <i class="fas fa-shopping-cart fa-4x text-muted opacity-25"></i>
                        </div>
                        <h3 class="fw-semibold mb-3">Keranjang Belanja Kosong</h3>
                        <p class="text-muted mb-4">Belum ada produk dalam keranjang belanja Anda. Yuk, mulai berbelanja!</p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="/" class="btn btn-primary btn-lg">
                                <i class="fas fa-shopping-bag me-2"></i>Mulai Belanja
                            </a>
                            <a href="/store" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-search me-2"></i>Cari Produk
                            </a>
                        </div>
                    </div>

                    <!-- Demo Produk -->
                    <div class="mt-5">
                        <h5 class="fw-semibold mb-3">Produk Terpopuler</h5>
                        <div class="row g-3">
                            <!-- Produk 1 -->
                            <div class="col-6 col-md-3">
                                <div class="card product-card h-100 border-0 shadow-sm">
                                    <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400&h=300&fit=crop"
                                        class="card-img-top" alt="Smartphone" style="height: 200px; object-fit: cover;">
                                    <div class="card-body p-3">
                                        <h6 class="card-title small">Smartphone Samsung Galaxy</h6>
                                        <p class="text-primary fw-bold mb-2 small">Rp 2.499.000</p>
                                        <button type="button" class="btn btn-primary btn-sm w-100" onclick="addToCart()">
                                            <i class="fas fa-cart-plus me-1"></i>Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Produk 2 -->
                            <div class="col-6 col-md-3">
                                <div class="card product-card h-100 border-0 shadow-sm">
                                    <img src="https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=400&h=300&fit=crop"
                                        class="card-img-top" alt="Kemeja" style="height: 200px; object-fit: cover;">
                                    <div class="card-body p-3">
                                        <h6 class="card-title small">Kemeja Flanel Pria</h6>
                                        <p class="text-primary fw-bold mb-2 small">Rp 189.000</p>
                                        <button type="button" class="btn btn-primary btn-sm w-100" onclick="addToCart()">
                                            <i class="fas fa-cart-plus me-1"></i>Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Produk 3 -->
                            <div class="col-6 col-md-3">
                                <div class="card product-card h-100 border-0 shadow-sm">
                                    <img src="https://images.unsplash.com/photo-1587734195503-904fca47e0e9?w=400&h=300&fit=crop"
                                        class="card-img-top" alt="Kopi" style="height: 200px; object-fit: cover;">
                                    <div class="card-body p-3">
                                        <h6 class="card-title small">Kopi Arabika Gayo</h6>
                                        <p class="text-primary fw-bold mb-2 small">Rp 75.000</p>
                                        <button type="button" class="btn btn-primary btn-sm w-100" onclick="addToCart()">
                                            <i class="fas fa-cart-plus me-1"></i>Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Produk 4 -->
                            <div class="col-6 col-md-3">
                                <div class="card product-card h-100 border-0 shadow-sm">
                                    <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=300&fit=crop"
                                        class="card-img-top" alt="Headphone" style="height: 200px; object-fit: cover;">
                                    <div class="card-body p-3">
                                        <h6 class="card-title small">Headphone Wireless</h6>
                                        <p class="text-primary fw-bold mb-2 small">Rp 450.000</p>
                                        <button type="button" class="btn btn-primary btn-sm w-100"
                                            onclick="addToCart()">
                                            <i class="fas fa-cart-plus me-1"></i>Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="text-center mt-5">
                        <button class="btn-next-simple" data-next="2">
                            <i class="fas fa-credit-card me-2"></i>
                            Lanjut ke Pembayaran
                            <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Pembayaran -->
                <div class="step-panel" data-step="2">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="card shadow-sm border-0">
                                <div class="card-header bg-white py-3">
                                    <h4 class="mb-0 fw-semibold"><i class="fas fa-credit-card me-2"></i>Metode Pembayaran
                                    </h4>
                                </div>
                                <div class="card-body p-4">
                                    <!-- Transfer Bank -->
                                    <div class="payment-method mb-5">
                                        <h5 class="fw-semibold mb-4">Transfer Bank</h5>
                                        <div class="row g-4">
                                            @foreach ($banks as $bank)
                                                <div class="col-md-4">
                                                    <div class="payment-option text-center p-4 border rounded-3">
                                                        <img src="{{ $bank['image'] }}" alt="{{ $bank['name'] }}"
                                                            style="height: 45px; object-fit: contain;" class="mb-3">
                                                        <p class="fw-semibold mb-2">{{ $bank['name'] }}</p>
                                                        <p class="text-muted small mb-0">{{ $bank['account'] }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- E-Wallet & QRIS -->
                                    <div class="payment-method">
                                        <h5 class="fw-semibold mb-4">E-Wallet & QRIS</h5>
                                        <div class="row g-4">
                                            @foreach ($ewallets as $wallet)
                                                <div class="col-md-3">
                                                    <div class="payment-option text-center p-3 border rounded-3">
                                                        <img src="{{ $wallet['image'] }}" alt="{{ $wallet['name'] }}"
                                                            style="height: 40px; object-fit: contain;" class="mb-2">
                                                        <p class="fw-semibold small mb-0">{{ $wallet['name'] }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="navigation-buttons-simple mt-4">
                        <button class="btn-prev-simple" data-prev="1">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali
                        </button>
                        <button class="btn-next-simple" data-next="3">
                            <i class="fas fa-truck me-2"></i>
                            Lanjut ke Pengiriman
                            <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 3: Pengiriman -->
                <div class="step-panel" data-step="3">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card shadow-sm border-0">
                                <div class="card-header bg-white py-3">
                                    <h4 class="mb-0 fw-semibold"><i class="fas fa-truck me-2"></i>Informasi Pengiriman</h4>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <h6 class="fw-semibold mb-3">Alamat Pengiriman</h6>
                                            <div class="address-card p-3 border rounded">
                                                <div class="address-content">
                                                    <p class="fw-semibold mb-1 small">John Doe</p>
                                                    <p class="text-muted smaller mb-1">+62 812-3456-7890</p>
                                                    <p class="address-text text-muted smaller mb-0 text-truncate-2">
                                                        Jl. Contoh Alamat No. 123, Kel. Contoh, Kec. Contoh<br>
                                                        Kota Contoh, Provinsi Contoh - 12345
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="fw-semibold mb-3">Kurir Pengiriman</h6>

                                            <!-- JNE -->
                                            <div class="shipping-option p-3 border rounded mb-3">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="radio" name="shipping" id="jne" value="jne">
                                                    <label class="form-check-label w-100 mb-0" for="jne">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <span class="small fw-semibold">JNE Reguler</span>
                                                            <span class="fw-bold text-primary">Rp 15.000</span>
                                                        </div>
                                                        <small class="text-muted d-block">Estimasi: 2-3 hari kerja</small>
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- TIKI -->
                                            <div class="shipping-option p-3 border rounded mb-3">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="radio" name="shipping" id="tiki" value="tiki">
                                                    <label class="form-check-label w-100 mb-0" for="tiki">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <span class="small fw-semibold">TIKI Reguler</span>
                                                            <span class="fw-bold text-primary">Rp 18.000</span>
                                                        </div>
                                                        <small class="text-muted d-block">Estimasi: 1-2 hari kerja</small>
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- POS Indonesia -->
                                            <div class="shipping-option p-3 border rounded mb-3">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="radio" name="shipping" id="pos" value="pos">
                                                    <label class="form-check-label w-100 mb-0" for="pos">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <span class="small fw-semibold">POS Indonesia</span>
                                                            <span class="fw-bold text-primary">Rp 12.000</span>
                                                        </div>
                                                        <small class="text-muted d-block">Estimasi: 3-5 hari kerja</small>
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- J&T Express -->
                                            <div class="shipping-option p-3 border rounded mb-3">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="radio" name="shipping" id="jnt" value="jnt">
                                                    <label class="form-check-label w-100 mb-0" for="jnt">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <span class="small fw-semibold">J&T Express</span>
                                                            <span class="fw-bold text-primary">Rp 14.000</span>
                                                        </div>
                                                        <small class="text-muted d-block">Estimasi: 2-3 hari kerja</small>
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- SiCepat -->
                                            <div class="shipping-option p-3 border rounded mb-3">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="radio" name="shipping" id="sicepat" value="sicepat">
                                                    <label class="form-check-label w-100 mb-0" for="sicepat">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <span class="small fw-semibold">SiCepat REG</span>
                                                            <span class="fw-bold text-primary">Rp 13.000</span>
                                                        </div>
                                                        <small class="text-muted d-block">Estimasi: 2-4 hari kerja</small>
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Anteraja -->
                                            <div class="shipping-option p-3 border rounded">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="radio" name="shipping" id="anteraja" value="anteraja">
                                                    <label class="form-check-label w-100 mb-0" for="anteraja">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <span class="small fw-semibold">Anteraja Reguler</span>
                                                            <span class="fw-bold text-primary">Rp 16.000</span>
                                                        </div>
                                                        <small class="text-muted d-block">Estimasi: 1-3 hari kerja</small>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="navigation-buttons-simple mt-4">
                        <button class="btn-prev-simple" data-prev="2">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali
                        </button>
                        <button class="btn-next-simple" data-next="4">
                            <i class="fas fa-check-circle me-2"></i>
                            Selesaikan Pesanan
                            <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 4: Selesai -->
                <div class="step-panel" data-step="4">
                    <div class="text-center py-5 my-5">
                        <div class="success-icon mb-4">
                            <i class="fas fa-check-circle fa-5x text-success"></i>
                        </div>
                        <h3 class="fw-semibold mb-3 text-success">Pesanan Berhasil!</h3>
                        <p class="text-muted mb-4">Terima kasih telah berbelanja di Toko UMKM. Pesanan Anda sedang
                            diproses.</p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="/" class="btn btn-primary btn-lg">
                                <i class="fas fa-home me-2"></i>Kembali ke Beranda
                            </a>
                            <a href="/store" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-shopping-bag me-2"></i>Lanjut Belanja
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Step navigation functionality
            document.querySelectorAll('.btn-next-simple').forEach(button => {
                button.addEventListener('click', function() {
                    const nextStep = this.getAttribute('data-next');
                    navigateToStep(nextStep);
                });
            });

            document.querySelectorAll('.btn-prev-simple').forEach(button => {
                button.addEventListener('click', function() {
                    const prevStep = this.getAttribute('data-prev');
                    navigateToStep(prevStep);
                });
            });

            // Step click navigation
            document.querySelectorAll('.step').forEach(step => {
                step.addEventListener('click', function() {
                    const stepNumber = this.getAttribute('data-step');
                    navigateToStep(stepNumber);
                });
            });

            function navigateToStep(stepNumber) {
                // Animate out current active panel
                const currentPanel = document.querySelector('.step-panel.active');
                if (currentPanel) {
                    currentPanel.classList.add('fade-out');
                    setTimeout(() => {
                        currentPanel.classList.remove('active', 'fade-out');

                        // Update progress steps
                        updateProgressSteps(stepNumber);

                        // Show new panel
                        const newPanel = document.querySelector(`.step-panel[data-step="${stepNumber}"]`);
                        if (newPanel) {
                            newPanel.classList.add('active');
                        }
                    }, 300);
                }
            }

            function updateProgressSteps(currentStep) {
                document.querySelectorAll('.step').forEach(step => {
                    const stepNum = parseInt(step.getAttribute('data-step'));
                    step.classList.remove('active', 'completed');

                    if (stepNum < currentStep) {
                        step.classList.add('completed');
                    } else if (stepNum == currentStep) {
                        step.classList.add('active');
                    }
                });
            }

            // Add to cart demo function
            window.addToCart = function() {
                alert('Produk berhasil ditambahkan ke keranjang!');
            };
        });
    </script>
@endsection
