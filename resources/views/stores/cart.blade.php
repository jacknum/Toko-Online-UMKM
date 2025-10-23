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
                                <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400&h=300&fit=crop" class="card-img-top" alt="Smartphone" style="height: 200px; object-fit: cover;">
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
                                <img src="https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=400&h=300&fit=crop" class="card-img-top" alt="Kemeja" style="height: 200px; object-fit: cover;">
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
                                <img src="https://images.unsplash.com/photo-1587734195503-904fca47e0e9?w=400&h=300&fit=crop" class="card-img-top" alt="Kopi" style="height: 200px; object-fit: cover;">
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
                                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=300&fit=crop" class="card-img-top" alt="Headphone" style="height: 200px; object-fit: cover;">
                                <div class="card-body p-3">
                                    <h6 class="card-title small">Headphone Wireless</h6>
                                    <p class="text-primary fw-bold mb-2 small">Rp 450.000</p>
                                    <button type="button" class="btn btn-primary btn-sm w-100" onclick="addToCart()">
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
                                <h4 class="mb-0 fw-semibold"><i class="fas fa-credit-card me-2"></i>Metode Pembayaran</h4>
                            </div>
                            <div class="card-body p-4">
                                <!-- Bank Transfer -->
                                <div class="payment-method mb-5">
                                    <h5 class="fw-semibold mb-4">Transfer Bank</h5>
                                    <div class="row g-4">
                                        <div class="col-md-4">
                                            <div class="payment-option text-center p-4 border rounded-3">
                                                <img src="https://i.ibb.co/0j7J2Z7/bca-logo.png" alt="BCA" style="height: 45px; object-fit: contain;" class="mb-3">
                                                <p class="fw-semibold mb-2">BCA</p>
                                                <p class="text-muted small mb-0">123-456-7890</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="payment-option text-center p-4 border rounded-3">
                                                <img src="https://i.ibb.co/7YfL0QK/bni-logo.png" alt="BNI" style="height: 45px; object-fit: contain;" class="mb-3">
                                                <p class="fw-semibold mb-2">BNI</p>
                                                <p class="text-muted small mb-0">987-654-3210</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="payment-option text-center p-4 border rounded-3">
                                                <img src="https://i.ibb.co/4T2y8J3/bri-logo.png" alt="BRI" style="height: 45px; object-fit: contain;" class="mb-3">
                                                <p class="fw-semibold mb-2">BRI</p>
                                                <p class="text-muted small mb-0">456-789-0123</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="payment-option text-center p-4 border rounded-3">
                                                <img src="https://i.ibb.co/0Q8L1ZJ/mandiri-logo.png" alt="Mandiri" style="height: 45px; object-fit: contain;" class="mb-3">
                                                <p class="fw-semibold mb-2">Mandiri</p>
                                                <p class="text-muted small mb-0">111-222-3333</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="payment-option text-center p-4 border rounded-3">
                                                <img src="https://i.ibb.co/0mY7W0J/btn-logo.png" alt="BTN" style="height: 45px; object-fit: contain;" class="mb-3">
                                                <p class="fw-semibold mb-2">BTN</p>
                                                <p class="text-muted small mb-0">444-555-6666</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="payment-option text-center p-4 border rounded-3">
                                                <img src="https://i.ibb.co/0Q8L1ZJ/bsi-logo.png" alt="BSI" style="height: 45px; object-fit: contain;" class="mb-3">
                                                <p class="fw-semibold mb-2">BSI</p>
                                                <p class="text-muted small mb-0">777-888-9999</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- E-Wallet -->
                                <div class="payment-method">
                                    <h5 class="fw-semibold mb-4">E-Wallet & QRIS</h5>
                                    <div class="row g-4">
                                        <div class="col-md-3">
                                            <div class="payment-option text-center p-3 border rounded-3">
                                                <img src="https://i.ibb.co/0j7J2Z7/gopay-logo.png" alt="Gopay" style="height: 40px; object-fit: contain;" class="mb-2">
                                                <p class="fw-semibold small mb-0">Gopay</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="payment-option text-center p-3 border rounded-3">
                                                <img src="https://i.ibb.co/7YfL0QK/ovo-logo.png" alt="OVO" style="height: 40px; object-fit: contain;" class="mb-2">
                                                <p class="fw-semibold small mb-0">OVO</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="payment-option text-center p-3 border rounded-3">
                                                <img src="https://i.ibb.co/4T2y8J3/dana-logo.png" alt="DANA" style="height: 40px; object-fit: contain;" class="mb-2">
                                                <p class="fw-semibold small mb-0">DANA</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="payment-option text-center p-3 border rounded-3">
                                                <img src="https://i.ibb.co/0Q8L1ZJ/linkaja-logo.png" alt="LinkAja" style="height: 40px; object-fit: contain;" class="mb-2">
                                                <p class="fw-semibold small mb-0">LinkAja</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="payment-option text-center p-3 border rounded-3">
                                                <img src="https://i.ibb.co/0mY7W0J/shopeepay-logo.png" alt="ShopeePay" style="height: 40px; object-fit: contain;" class="mb-2">
                                                <p class="fw-semibold small mb-0">ShopeePay</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="payment-option text-center p-3 border rounded-3">
                                                <img src="https://i.ibb.co/0Q8L1ZJ/qris-logo.png" alt="QRIS" style="height: 40px; object-fit: contain;" class="mb-2">
                                                <p class="fw-semibold small mb-0">QRIS</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="payment-option text-center p-3 border rounded-3">
                                                <img src="https://i.ibb.co/0j7J2Z7/spay-logo.png" alt="Shoopay" style="height: 40px; object-fit: contain;" class="mb-2">
                                                <p class="fw-semibold small mb-0">Shoopay</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="payment-option text-center p-3 border rounded-3">
                                                <img src="https://i.ibb.co/7YfL0QK/jenius-logo.png" alt="Jenius" style="height: 40px; object-fit: contain;" class="mb-2">
                                                <p class="fw-semibold small mb-0">Jenius</p>
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
                    <button class="btn-prev-simple" data-prev="1">
                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali
                    </button>
                    <button class="btn-next-simple" data-next="3">
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
                                            <p class="fw-semibold mb-1">John Doe</p>
                                            <p class="text-muted small mb-1">+62 812-3456-7890</p>
                                            <p class="text-muted small mb-0">
                                                Jl. Contoh Alamat No. 123, Kel. Contoh, Kec. Contoh<br>
                                                Kota Contoh, Provinsi Contoh - 12345
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="fw-semibold mb-3">Kurir Pengiriman</h6>
                                        <div class="shipping-option p-3 border rounded mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="shipping" id="jne">
                                                <label class="form-check-label w-100" for="jne">
                                                    <div class="d-flex justify-content-between">
                                                        <span>JNE Reguler</span>
                                                        <span class="fw-semibold">Rp 15.000</span>
                                                    </div>
                                                    <small class="text-muted">Estimasi: 2-3 hari</small>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="shipping-option p-3 border rounded">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="shipping" id="tiki">
                                                <label class="form-check-label w-100" for="tiki">
                                                    <div class="d-flex justify-content-between">
                                                        <span>TIKI Reguler</span>
                                                        <span class="fw-semibold">Rp 18.000</span>
                                                    </div>
                                                    <small class="text-muted">Estimasi: 1-2 hari</small>
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
                    <p class="text-muted mb-4">Terima kasih telah berbelanja di Toko UMKM. Pesanan Anda sedang diproses.</p>
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

<style>
.checkout-progress {
    max-width: 700px;
    margin: 0 auto;
}

.progress-steps {
    display: flex;
    justify-content: space-between;
    position: relative;
}

.progress-steps::before {
    content: '';
    position: absolute;
    top: 20px;
    left: 0;
    right: 0;
    height: 2px;
    background-color: #e9ecef;
    z-index: 1;
}

.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    z-index: 2;
    cursor: pointer;
    transition: all 0.3s ease;
}

.step:hover {
    transform: translateY(-2px);
}

.step-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 8px;
    transition: all 0.3s ease;
    border: 3px solid white;
}

.step.active .step-icon {
    background: #007bff;
    color: white;
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
}

.step.completed .step-icon {
    background: #28a745;
    color: white;
}

.step-text {
    font-size: 0.875rem;
    font-weight: 500;
    color: #6c757d;
    transition: all 0.3s ease;
}

.step.active .step-text {
    color: #007bff;
    font-weight: 600;
}

.step.completed .step-text {
    color: #28a745;
}

.step-panel {
    display: none;
    animation: fadeIn 0.5s ease-in;
}

.step-panel.active {
    display: block;
}

.product-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.payment-option, .shipping-option, .address-card {
    transition: all 0.3s ease;
    cursor: pointer;
    border: 2px solid transparent !important;
}

.payment-option:hover, .shipping-option:hover {
    border-color: #007bff !important;
    background-color: #f8f9fa;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.empty-cart-icon, .success-icon {
    opacity: 0.8;
}

/* Simple & Professional Navigation Buttons */
.navigation-buttons-simple {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 500px;
    margin: 0 auto;
    gap: 15px;
}

.btn-prev-simple {
    display: inline-flex;
    align-items: center;
    padding: 14px 28px;
    background: white;
    border: 2px solid #dee2e6;
    color: #6c757d;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-prev-simple:hover {
    border-color: #007bff;
    color: #007bff;
    background: #f8f9ff;
    transform: translateX(-2px);
}

.btn-next-simple {
    display: inline-flex;
    align-items: center;
    padding: 14px 32px;
    background: #007bff;
    border: 2px solid #007bff;
    color: white;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    text-decoration: none;
    box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
}

.btn-next-simple:hover {
    background: #0056b3;
    border-color: #0056b3;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 123, 255, 0.4);
}

.btn-next-simple:active {
    transform: translateY(0);
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-out {
    animation: fadeOut 0.3s ease-out;
}

@keyframes fadeOut {
    from {
        opacity: 1;
        transform: translateY(0);
    }
    to {
        opacity: 0;
        transform: translateY(-20px);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .navigation-buttons-simple {
        flex-direction: column;
        width: 100%;
    }
    
    .btn-prev-simple,
    .btn-next-simple {
        width: 100%;
        justify-content: center;
    }
    
    .payment-option {
        padding: 20px 15px !important;
    }
}
</style>

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