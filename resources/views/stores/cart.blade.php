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
                        <span class="fw-medium" id="cart-count">0 Item</span>
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
                    <!-- Cart with Items -->
                    <div id="cart-with-items" class="d-none">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-header bg-white py-3">
                                        <h5 class="mb-0 fw-semibold">Produk dalam Keranjang</h5>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle mb-0">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th scope="col" class="ps-4">Produk</th>
                                                        <th scope="col">Harga</th>
                                                        <th scope="col" class="text-center">Jumlah</th>
                                                        <th scope="col" class="text-end pe-4">Subtotal</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="cart-items">
                                                    <!-- Cart items will be populated here -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card shadow-sm border-0 sticky-top" style="top: 20px;">
                                    <div class="card-header bg-white py-3">
                                        <h5 class="mb-0 fw-semibold">Ringkasan Belanja</h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Subtotal</span>
                                            <span class="fw-medium" id="cart-subtotal">Rp 0</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-3">
                                            <span class="text-muted">Biaya Pengiriman</span>
                                            <span class="fw-medium" id="cart-shipping">Rp 0</span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between mb-3">
                                            <span class="fw-semibold">Total</span>
                                            <span class="fw-bold text-primary fs-5" id="cart-total">Rp 0</span>
                                        </div>
                                        <button class="btn btn-primary w-100 py-3 fw-semibold" onclick="navigateToStep(2)">
                                            <i class="fas fa-credit-card me-2"></i>Lanjut ke Pembayaran
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Empty Cart State -->
                    <div id="empty-cart" class="text-center py-5 my-5">
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
                                        <button type="button" class="btn btn-primary btn-sm w-100" onclick="addToCart(1, 'Smartphone Samsung Galaxy', 2499000, 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400&h=300&fit=crop')">
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
                                        <button type="button" class="btn btn-primary btn-sm w-100" onclick="addToCart(2, 'Kemeja Flanel Pria', 189000, 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=400&h=300&fit=crop')">
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
                                        <button type="button" class="btn btn-primary btn-sm w-100" onclick="addToCart(3, 'Kopi Arabika Gayo', 75000, 'https://images.unsplash.com/photo-1587734195503-904fca47e0e9?w=400&h=300&fit=crop')">
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
                                        <button type="button" class="btn btn-primary btn-sm w-100" onclick="addToCart(4, 'Headphone Wireless', 450000, 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=300&fit=crop')">
                                            <i class="fas fa-cart-plus me-1"></i>Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                    <!-- Transfer Bank -->
                                    <div class="payment-method mb-5">
                                        <h5 class="fw-semibold mb-4">Transfer Bank</h5>
                                        <div class="row g-4">
                                            @foreach ($banks as $bank)
                                                <div class="col-md-4">
                                                    <div class="payment-option text-center p-4 border rounded-3" onclick="selectPayment('{{ $bank['name'] }}', '{{ $bank['account'] }}', 'bank')">
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
                                                    <div class="payment-option text-center p-3 border rounded-3" onclick="selectPayment('{{ $wallet['name'] }}', '{{ $wallet['account'] ?? '' }}', 'ewallet')">
                                                        <img src="{{ $wallet['image'] }}" alt="{{ $wallet['name'] }}"
                                                            style="height: 40px; object-fit: contain;" class="mb-2">
                                                        <p class="fw-semibold small mb-0">{{ $wallet['name'] }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Upload Bukti Pembayaran -->
                                    <div class="payment-proof mt-5" id="payment-proof-section" style="display: none;">
                                        <h5 class="fw-semibold mb-4">Upload Bukti Pembayaran</h5>
                                        <div class="card border-0 bg-light">
                                            <div class="card-body p-4">
                                                <div class="text-center mb-4">
                                                    <div class="payment-details mb-4">
                                                        <h4 class="fw-bold text-primary mb-2" id="payment-total-display">Rp 0</h4>
                                                        <p class="text-muted mb-3">Total yang harus dibayar</p>
                                                        <div class="payment-instruction bg-white p-3 rounded border">
                                                            <h6 class="fw-semibold mb-3">Instruksi Pembayaran</h6>
                                                            <div id="bank-instructions" class="text-start">
                                                                <p class="mb-2"><i class="fas fa-mobile-alt me-2"></i>Buka aplikasi mobile banking atau internet banking Anda</p>
                                                                <p class="mb-2"><i class="fas fa-exchange-alt me-2"></i>Pilih menu transfer</p>
                                                                <p class="mb-2"><i class="fas fa-credit-card me-2"></i>Masukkan nomor rekening: <span id="payment-account-display" class="fw-semibold"></span></p>
                                                                <p class="mb-2"><i class="fas fa-money-bill-wave me-2"></i>Masukkan jumlah: <span id="payment-amount-display" class="fw-semibold"></span></p>
                                                                <p class="mb-0"><i class="fas fa-check-circle me-2"></i>Konfirmasi dan selesaikan transaksi</p>
                                                            </div>
                                                            <div id="ewallet-instructions" class="text-start d-none">
                                                                <p class="mb-2"><i class="fas fa-mobile-alt me-2"></i>Buka aplikasi e-wallet Anda</p>
                                                                <p class="mb-2"><i class="fas fa-qrcode me-2"></i>Pilih menu pembayaran atau scan QR</p>
                                                                <p class="mb-2"><i class="fas fa-camera me-2"></i>Scan kode QR di bawah ini</p>
                                                                <div class="text-center my-3">
                                                                    <div class="bg-white p-3 d-inline-block border rounded">
                                                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=TokoUMKM-{{ time() }}" alt="QR Code" class="img-fluid">
                                                                    </div>
                                                                </div>
                                                                <p class="mb-0"><i class="fas fa-check-circle me-2"></i>Konfirmasi dan selesaikan transaksi</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="upload-section">
                                                    <div class="mb-3">
                                                        <label for="payment-proof" class="form-label fw-semibold">Upload Bukti Pembayaran</label>
                                                        <input type="file" class="form-control" id="payment-proof" accept="image/*,.pdf">
                                                        <div class="form-text">Format: JPG, PNG, PDF (Maks. 2MB)</div>
                                                    </div>
                                                    <div class="preview-area text-center p-4 border rounded bg-white d-none" id="proof-preview">
                                                        <i class="fas fa-file-image text-muted fa-3x mb-3"></i>
                                                        <p class="mb-2 fw-semibold" id="proof-filename"></p>
                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeProof()">
                                                            <i class="fas fa-trash me-1"></i>Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="navigation-buttons mt-4">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <button class="btn btn-outline-primary btn-lg" onclick="navigateToStep(1)">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Kembali ke Keranjang
                                </button>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary btn-lg" id="btn-to-shipping" disabled onclick="verifyPayment()">
                                    <i class="fas fa-check-circle me-2"></i>
                                    Verifikasi Pembayaran
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Pengiriman -->
                <div class="step-panel" data-step="3">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="card shadow-sm border-0">
                                <div class="card-header bg-white py-3">
                                    <h4 class="mb-0 fw-semibold"><i class="fas fa-truck me-2"></i>Pilih Kurir Pengiriman</h4>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <h6 class="fw-semibold mb-3">Alamat Pengiriman</h6>
                                            <div class="address-card p-3 border rounded">
                                                <div class="address-content">
                                                    <p class="fw-semibold mb-1">John Doe</p>
                                                    <p class="text-muted mb-2">+62 812-3456-7890</p>
                                                    <p class="text-muted mb-0">
                                                        Jl. Contoh Alamat No. 123, Kel. Contoh, Kec. Contoh<br>
                                                        Kota Contoh, Provinsi Contoh - 12345
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="fw-semibold mb-3">Pilih Kurir</h6>
                                            
                                            <div class="kurir-options">
                                                <!-- JNE -->
                                                <div class="kurir-option p-3 border rounded mb-3">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="radio" name="kurir" id="jne" value="jne" data-price="15000">
                                                        <label class="form-check-label w-100" for="jne">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5a/JNE_logo_2019.svg/1200px-JNE_logo_2019.svg.png" alt="JNE" style="height: 30px; object-fit: contain;" class="me-3">
                                                                    <span class="fw-semibold">JNE Reguler</span>
                                                                </div>
                                                                <span class="fw-bold text-primary">Rp 15.000</span>
                                                            </div>
                                                            <small class="text-muted d-block"><i class="fas fa-clock me-1"></i>Estimasi: 2-3 hari kerja</small>
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- TIKI -->
                                                <div class="kurir-option p-3 border rounded mb-3">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="radio" name="kurir" id="tiki" value="tiki" data-price="18000">
                                                        <label class="form-check-label w-100" for="tiki">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/71/Tiki_logo.svg/1200px-Tiki_logo.svg.png" alt="TIKI" style="height: 30px; object-fit: contain;" class="me-3">
                                                                    <span class="fw-semibold">TIKI Reguler</span>
                                                                </div>
                                                                <span class="fw-bold text-primary">Rp 18.000</span>
                                                            </div>
                                                            <small class="text-muted d-block"><i class="fas fa-clock me-1"></i>Estimasi: 1-2 hari kerja</small>
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- POS Indonesia -->
                                                <div class="kurir-option p-3 border rounded mb-3">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="radio" name="kurir" id="pos" value="pos" data-price="12000">
                                                        <label class="form-check-label w-100" for="pos">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6e/Logo_Pos_Indonesia_2020.svg/1200px-Logo_Pos_Indonesia_2020.svg.png" alt="POS Indonesia" style="height: 30px; object-fit: contain;" class="me-3">
                                                                    <span class="fw-semibold">POS Indonesia</span>
                                                                </div>
                                                                <span class="fw-bold text-primary">Rp 12.000</span>
                                                            </div>
                                                            <small class="text-muted d-block"><i class="fas fa-clock me-1"></i>Estimasi: 3-5 hari kerja</small>
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- J&T Express -->
                                                <div class="kurir-option p-3 border rounded mb-3">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="radio" name="kurir" id="jnt" value="jnt" data-price="14000">
                                                        <label class="form-check-label w-100" for="jnt">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fb/J%26T_Express_logo.svg/1200px-J%26T_Express_logo.svg.png" alt="J&T" style="height: 30px; object-fit: contain;" class="me-3">
                                                                    <span class="fw-semibold">J&T Express</span>
                                                                </div>
                                                                <span class="fw-bold text-primary">Rp 14.000</span>
                                                            </div>
                                                            <small class="text-muted d-block"><i class="fas fa-clock me-1"></i>Estimasi: 2-3 hari kerja</small>
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- SiCepat -->
                                                <div class="kurir-option p-3 border rounded mb-3">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="radio" name="kurir" id="sicepat" value="sicepat" data-price="13000">
                                                        <label class="form-check-label w-100" for="sicepat">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/71/SiCepat_logo.svg/1200px-SiCepat_logo.svg.png" alt="SiCepat" style="height: 30px; object-fit: contain;" class="me-3">
                                                                    <span class="fw-semibold">SiCepat REG</span>
                                                                </div>
                                                                <span class="fw-bold text-primary">Rp 13.000</span>
                                                            </div>
                                                            <small class="text-muted d-block"><i class="fas fa-clock me-1"></i>Estimasi: 2-4 hari kerja</small>
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- Anteraja -->
                                                <div class="kurir-option p-3 border rounded">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="radio" name="kurir" id="anteraja" value="anteraja" data-price="16000">
                                                        <label class="form-check-label w-100" for="anteraja">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="https://anteraja.id/assets/images/logo.png" alt="Anteraja" style="height: 30px; object-fit: contain;" class="me-3">
                                                                    <span class="fw-semibold">Anteraja Reguler</span>
                                                                </div>
                                                                <span class="fw-bold text-primary">Rp 16.000</span>
                                                            </div>
                                                            <small class="text-muted d-block"><i class="fas fa-clock me-1"></i>Estimasi: 1-3 hari kerja</small>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="navigation-buttons mt-4">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <button class="btn btn-outline-primary btn-lg" onclick="navigateToStep(2)">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Kembali ke Pembayaran
                                </button>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary btn-lg" id="btn-to-complete" disabled onclick="navigateToStep(4)">
                                    <i class="fas fa-check-circle me-2"></i>
                                    Selesaikan Pesanan
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
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
                        
                        <div class="card shadow-sm border-0 mx-auto mb-4" style="max-width: 500px;">
                            <div class="card-body p-4">
                                <h5 class="fw-semibold mb-3">Detail Pesanan</h5>
                                <div class="text-start">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">No. Pesanan:</span>
                                        <span class="fw-medium" id="order-number">#ORD-123456</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Total Pembayaran:</span>
                                        <span class="fw-bold text-primary" id="order-total">Rp 0</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Metode Pembayaran:</span>
                                        <span class="fw-medium" id="order-payment">-</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Kurir:</span>
                                        <span class="fw-medium" id="order-shipping">-</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Estimasi Pengiriman:</span>
                                        <span class="fw-medium" id="order-estimate">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            <a href="/orders" class="btn btn-primary btn-lg">
                                <i class="fas fa-clipboard-list me-2"></i>Cek Pesanan Saya
                            </a>
                            <a href="/" class="btn btn-outline-primary btn-lg">
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
        // Cart data structure
        let cart = [];
        let selectedPayment = null;
        let selectedKurir = null;
        let shippingCost = 0;
        let orderNumber = 'ORD-' + Math.floor(100000 + Math.random() * 900000);
        let paymentProofUploaded = false;

        document.addEventListener('DOMContentLoaded', function() {
            // Load cart from localStorage
            loadCart();
            
            // Initialize order number
            document.getElementById('order-number').textContent = '#' + orderNumber;

            // Payment proof upload handler
            document.getElementById('payment-proof').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    if (file.size > 2 * 1024 * 1024) {
                        showToast('Ukuran file terlalu besar. Maksimal 2MB.', 'error');
                        this.value = '';
                        return;
                    }
                    
                    const preview = document.getElementById('proof-preview');
                    const filename = document.getElementById('proof-filename');
                    
                    filename.textContent = file.name;
                    preview.classList.remove('d-none');
                    paymentProofUploaded = true;
                    
                    // Enable verify button if payment method is selected
                    if (selectedPayment) {
                        document.getElementById('btn-to-shipping').disabled = false;
                    }
                }
            });

            // Kurir selection handler
            document.querySelectorAll('input[name="kurir"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.checked) {
                        selectedKurir = this.value;
                        shippingCost = parseInt(this.getAttribute('data-price'));
                        document.getElementById('btn-to-complete').disabled = false;
                        updateCartSummary();
                    }
                });
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
                        
                        // Update order details in step 4
                        if (stepNumber == 4) {
                            updateOrderDetails();
                        }
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

        // Cart functionality
        function loadCart() {
            const savedCart = localStorage.getItem('umkmCart');
            if (savedCart) {
                cart = JSON.parse(savedCart);
                updateCartDisplay();
            }
        }

        function saveCart() {
            localStorage.setItem('umkmCart', JSON.stringify(cart));
            updateCartDisplay();
        }

        function addToCart(id, name, price, image) {
            const existingItem = cart.find(item => item.id === id);
            
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    id: id,
                    name: name,
                    price: price,
                    image: image,
                    quantity: 1
                });
            }
            
            saveCart();
            showToast('Produk berhasil ditambahkan ke keranjang!');
        }

        function updateCartDisplay() {
            const cartCount = document.getElementById('cart-count');
            const cartItems = document.getElementById('cart-items');
            const emptyCart = document.getElementById('empty-cart');
            const cartWithItems = document.getElementById('cart-with-items');
            
            // Update cart count
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            cartCount.textContent = totalItems + ' Item';
            
            if (cart.length === 0) {
                emptyCart.classList.remove('d-none');
                cartWithItems.classList.add('d-none');
            } else {
                emptyCart.classList.add('d-none');
                cartWithItems.classList.remove('d-none');
                
                // Render cart items
                cartItems.innerHTML = '';
                cart.forEach(item => {
                    const subtotal = item.price * item.quantity;
                    cartItems.innerHTML += `
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <img src="${item.image}" alt="${item.name}" class="rounded me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                    <div>
                                        <h6 class="mb-0 small fw-semibold">${item.name}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-medium">Rp ${formatNumber(item.price)}</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <button class="btn btn-sm btn-outline-secondary" onclick="updateQuantity(${item.id}, -1)">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <span class="mx-3 fw-medium">${item.quantity}</span>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="updateQuantity(${item.id}, 1)">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <span class="fw-bold text-primary">Rp ${formatNumber(subtotal)}</span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-danger" onclick="removeFromCart(${item.id})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                });
                
                updateCartSummary();
            }
        }

        function updateQuantity(id, change) {
            const item = cart.find(item => item.id === id);
            if (item) {
                item.quantity += change;
                
                if (item.quantity <= 0) {
                    removeFromCart(id);
                } else {
                    saveCart();
                }
            }
        }

        function removeFromCart(id) {
            cart = cart.filter(item => item.id !== id);
            saveCart();
        }

        function updateCartSummary() {
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const total = subtotal + shippingCost;
            
            document.getElementById('cart-subtotal').textContent = 'Rp ' + formatNumber(subtotal);
            document.getElementById('cart-shipping').textContent = 'Rp ' + formatNumber(shippingCost);
            document.getElementById('cart-total').textContent = 'Rp ' + formatNumber(total);
        }

        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Payment functionality
        function selectPayment(name, account, type) {
            selectedPayment = { name, account, type };
            
            // Show payment proof section
            document.getElementById('payment-proof-section').style.display = 'block';
            
            // Update payment details
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const total = subtotal + shippingCost;
            
            document.getElementById('payment-total-display').textContent = 'Rp ' + formatNumber(total);
            document.getElementById('payment-amount-display').textContent = 'Rp ' + formatNumber(total);
            document.getElementById('payment-account-display').textContent = account;
            
            // Show appropriate instructions
            if (type === 'bank') {
                document.getElementById('bank-instructions').classList.remove('d-none');
                document.getElementById('ewallet-instructions').classList.add('d-none');
            } else {
                document.getElementById('bank-instructions').classList.add('d-none');
                document.getElementById('ewallet-instructions').classList.remove('d-none');
            }
            
            // Enable verify button if proof is already uploaded
            if (paymentProofUploaded) {
                document.getElementById('btn-to-shipping').disabled = false;
            }
            
            // Show selection feedback
            document.querySelectorAll('.payment-option').forEach(option => {
                option.classList.remove('selected');
            });
            event.currentTarget.classList.add('selected');
        }

        function removeProof() {
            document.getElementById('payment-proof').value = '';
            document.getElementById('proof-preview').classList.add('d-none');
            paymentProofUploaded = false;
            document.getElementById('btn-to-shipping').disabled = true;
        }

        function verifyPayment() {
            if (!selectedPayment) {
                showToast('Pilih metode pembayaran terlebih dahulu', 'error');
                return;
            }
            
            if (!paymentProofUploaded) {
                showToast('Upload bukti pembayaran terlebih dahulu', 'error');
                return;
            }
            
            showToast('Bukti pembayaran berhasil diupload! Menunggu verifikasi...', 'success');
            
            // Simulate verification process
            setTimeout(() => {
                navigateToStep(3);
                showToast('Pembayaran telah diverifikasi! Silakan pilih kurir pengiriman.', 'success');
            }, 2000);
        }

        function updateOrderDetails() {
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const total = subtotal + shippingCost;
            
            document.getElementById('order-total').textContent = 'Rp ' + formatNumber(total);
            document.getElementById('order-payment').textContent = selectedPayment ? selectedPayment.name : '-';
            
            // Set shipping details
            if (selectedKurir) {
                const kurirOption = document.querySelector(`input[name="kurir"][value="${selectedKurir}"]`);
                const kurirLabel = kurirOption ? kurirOption.closest('.kurir-option').querySelector('.fw-semibold').textContent : '-';
                document.getElementById('order-shipping').textContent = kurirLabel;
                
                // Set estimate based on kurir method
                let estimate = '';
                switch(selectedKurir) {
                    case 'jne': estimate = '2-3 hari kerja'; break;
                    case 'tiki': estimate = '1-2 hari kerja'; break;
                    case 'pos': estimate = '3-5 hari kerja'; break;
                    case 'jnt': estimate = '2-3 hari kerja'; break;
                    case 'sicepat': estimate = '2-4 hari kerja'; break;
                    case 'anteraja': estimate = '1-3 hari kerja'; break;
                    default: estimate = '-';
                }
                document.getElementById('order-estimate').textContent = estimate;
            }
        }

        function showToast(message, type = 'success') {
            const bgColor = type === 'success' ? 'bg-success' : 'bg-danger';
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
            
            // Create toast element
            const toast = document.createElement('div');
            toast.className = `toast align-items-center text-white ${bgColor} border-0 position-fixed`;
            toast.style.top = '20px';
            toast.style.right = '20px';
            toast.style.zIndex = '1055';
            
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas ${icon} me-2"></i>${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;
            
            document.body.appendChild(toast);
            
            // Initialize and show toast
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
            
            // Remove toast after it's hidden
            toast.addEventListener('hidden.bs.toast', function() {
                document.body.removeChild(toast);
            });
        }
    </script>

    <style>
        .step {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .step:hover {
            transform: translateY(-2px);
        }
        
        .step.completed .step-icon {
            background-color: #198754;
            color: white;
        }
        
        .step.active .step-icon {
            background-color: #0d6efd;
            color: white;
        }
        
        .step-panel {
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .step-panel.active {
            display: block;
            opacity: 1;
        }
        
        .step-panel.fade-out {
            opacity: 0;
        }
        
        .payment-option, .kurir-option {
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .payment-option:hover, .kurir-option:hover {
            border-color: #0d6efd !important;
            transform: translateY(-2px);
        }
        
        .payment-option.selected, .kurir-option:hover {
            border-color: #0d6efd !important;
            background-color: rgba(13, 110, 253, 0.05);
        }
        
        .kurir-option .form-check-input:checked + label {
            background-color: rgba(13, 110, 253, 0.05);
        }
        
        .toast {
            min-width: 300px;
        }
        
        .navigation-buttons {
            margin-top: 2rem;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 160px;
        }
        
        .btn-lg {
            padding: 12px 24px;
            font-size: 1.1rem;
        }
        
        .payment-instruction {
            text-align: left;
        }
        
        .payment-instruction p {
            margin-bottom: 0.5rem;
            display: flex;
            align-items: flex-start;
        }
        
        .payment-instruction i {
            width: 20px;
            margin-top: 2px;
        }
        
        .kurir-option img {
            filter: grayscale(100%);
            transition: filter 0.3s ease;
        }
        
        .kurir-option:hover img,
        .kurir-option .form-check-input:checked + label img {
            filter: grayscale(0%);
        }
        
        .upload-section {
            border-top: 1px solid #dee2e6;
            padding-top: 1.5rem;
            margin-top: 1.5rem;
        }
        
        .preview-area {
            border: 2px dashed #dee2e6;
        }
    </style>
@endsection