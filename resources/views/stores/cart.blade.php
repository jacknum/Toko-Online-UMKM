@extends('layouts.store')

@section('title', 'Keranjang Belanja - Toko UMKM')

@section('content')
    <div class="container-fluid bg-light py-4">
        <div class="container">
            <!-- Header yang Lebih Profesional -->
            <div class="row align-items-center mb-4">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                                <i class="fas fa-shopping-cart me-1"></i>Keranjang Belanja Saya
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center gap-3">
                        @if ($cartCount > 0)
                            <button class="btn btn-outline-danger btn-sm px-3 py-2 d-flex align-items-center" 
                                    onclick="clearCart()"
                                    style="border-radius: 8px; transition: all 0.3s ease;">
                                <i class="fas fa-trash-alt me-2"></i>
                                <span>Kosongkan Keranjang</span>
                            </button>
                        @endif
                        <div class="d-flex align-items-center bg-white px-3 py-2 rounded-3 shadow-sm">
                            <i class="fas fa-shopping-cart me-2 text-primary"></i>
                            <span class="fw-semibold text-dark" id="cart-count">{{ $cartCount }} Item</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progress Checkout yang Sederhana dan Rapi -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="checkout-progress-wrapper">
                        <div class="progress-steps-simple">
                            <!-- Step 1: Keranjang -->
                            <div class="step-simple active" data-step="1">
                                <div class="step-number">1</div>
                                <span class="step-text">Keranjang</span>
                            </div>

                            <!-- Step 2: Pembayaran -->
                            <div class="step-simple" data-step="2">
                                <div class="step-number">2</div>
                                <span class="step-text">Pembayaran</span>
                            </div>

                            <!-- Step 3: Pengiriman -->
                            <div class="step-simple" data-step="3">
                                <div class="step-number">3</div>
                                <span class="step-text">Pengiriman</span>
                            </div>

                            <!-- Step 4: Selesai -->
                            <div class="step-simple" data-step="4">
                                <div class="step-number">4</div>
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
                                                        <th scope="col" class="ps-4" style="width: 45%;">Produk</th>
                                                        <th scope="col" style="width: 15%;">Harga</th>
                                                        <th scope="col" class="text-center" style="width: 20%;">Jumlah</th>
                                                        <th scope="col" class="text-end pe-4" style="width: 15%;">Subtotal</th>
                                                        <th scope="col" style="width: 5%;"></th>
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
                                        <button class="btn btn-primary w-100 py-3 fw-semibold"
                                            onclick="navigateToStep(2)">
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
                            <a href="/store" class="btn btn-primary btn-lg">
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
                                        class="card-img-top" alt="Smartphone"
                                        style="height: 200px; object-fit: cover;">
                                    <div class="card-body p-3">
                                        <h6 class="card-title small">Smartphone Samsung Galaxy</h6>
                                        <p class="text-primary fw-bold mb-2 small">Rp 2.499.000</p>
                                        <button type="button" class="btn btn-primary btn-sm w-100"
                                            onclick="addToCart(1, 'Smartphone Samsung Galaxy', 2499000, 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400&h=300&fit=crop')">
                                            <i class="fas fa-cart-plus me-1"></i>Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Produk 2 -->
                            <div class="col-6 col-md-3">
                                <div class="card product-card h-100 border-0 shadow-sm">
                                    <img src="https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=400&h=300&fit=crop"
                                        class="card-img-top" alt="Kemeja"
                                        style="height: 200px; object-fit: cover;">
                                    <div class="card-body p-3">
                                        <h6 class="card-title small">Kemeja Flanel Pria</h6>
                                        <p class="text-primary fw-bold mb-2 small">Rp 189.000</p>
                                        <button type="button" class="btn btn-primary btn-sm w-100"
                                            onclick="addToCart(2, 'Kemeja Flanel Pria', 189000, 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=400&h=300&fit=crop')">
                                            <i class="fas fa-cart-plus me-1"></i>Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Produk 3 -->
                            <div class="col-6 col-md-3">
                                <div class="card product-card h-100 border-0 shadow-sm">
                                    <img src="https://images.unsplash.com/photo-1587734195503-904fca47e0e9?w=400&h=300&fit=crop"
                                        class="card-img-top" alt="Kopi"
                                        style="height: 200px; object-fit: cover;">
                                    <div class="card-body p-3">
                                        <h6 class="card-title small">Kopi Arabika Gayo</h6>
                                        <p class="text-primary fw-bold mb-2 small">Rp 75.000</p>
                                        <button type="button" class="btn btn-primary btn-sm w-100"
                                            onclick="addToCart(3, 'Kopi Arabika Gayo', 75000, 'https://images.unsplash.com/photo-1587734195503-904fca47e0e9?w=400&h=300&fit=crop')">
                                            <i class="fas fa-cart-plus me-1"></i>Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Produk 4 -->
                            <div class="col-6 col-md-3">
                                <div class="card product-card h-100 border-0 shadow-sm">
                                    <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=300&fit=crop"
                                        class="card-img-top" alt="Headphone"
                                        style="height: 200px; object-fit: cover;">
                                    <div class="card-body p-3">
                                        <h6 class="card-title small">Headphone Wireless</h6>
                                        <p class="text-primary fw-bold mb-2 small">Rp 450.000</p>
                                        <button type="button" class="btn btn-primary btn-sm w-100"
                                            onclick="addToCart(4, 'Headphone Wireless', 450000, 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=300&fit=crop')">
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
                                                    <div class="payment-option text-center p-4 border rounded-3"
                                                        onclick="selectPayment('{{ $bank['name'] }}', '{{ $bank['account'] }}', 'bank')">
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
                                                    <div class="payment-option text-center p-3 border rounded-3"
                                                        onclick="selectPayment('{{ $wallet['name'] }}', '{{ $wallet['account'] ?? '' }}', 'ewallet')">
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
                                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Keranjang
                                </button>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary btn-lg" id="btn-to-shipping" disabled onclick="verifyPayment()">
                                    <i class="fas fa-check-circle me-2"></i>Verifikasi Pembayaran
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

                                            <!-- Filter Kurir -->
                                            <div class="mb-4">
                                                <div class="btn-group w-100" role="group">
                                                    <input type="radio" class="btn-check" name="kurir-filter" id="all-kurir" checked>
                                                    <label class="btn btn-outline-primary" for="all-kurir">
                                                        <i class="fas fa-list me-2"></i>Semua Kurir
                                                    </label>
                                                    <input type="radio" class="btn-check" name="kurir-filter" id="recommended-kurir">
                                                    <label class="btn btn-outline-primary" for="recommended-kurir">
                                                        <i class="fas fa-star me-2"></i>Rekomendasi
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="kurir-options">
                                                <!-- Pilihan Penjual - Recommended -->
                                                <div class="kurir-option p-3 border rounded mb-3 recommended-kurir" data-kurir="pilihan-penjual">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="radio" name="kurir" id="pilihan-penjual" value="pilihan-penjual" data-price="0" checked>
                                                        <label class="form-check-label w-100" for="pilihan-penjual">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="kurir-logo me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white;">
                                                                        <i class="fas fa-store fa-lg"></i>
                                                                    </div>
                                                                    <div>
                                                                        <span class="fw-semibold">Pilihan Penjual</span>
                                                                        <span class="badge bg-success ms-2"><i class="fas fa-crown me-1"></i>Rekomendasi</span>
                                                                    </div>
                                                                </div>
                                                                <span class="fw-bold text-success">GRATIS</span>
                                                            </div>
                                                            <small class="text-muted d-block"><i class="fas fa-info-circle me-1"></i>Penjual akan memilih kurir terbaik untuk produk Anda</small>
                                                            <small class="text-muted d-block"><i class="fas fa-clock me-1"></i>Estimasi: 1-3 hari kerja</small>
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- JNE -->
                                                <div class="kurir-option p-3 border rounded mb-3" data-kurir="jne">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="radio" name="kurir" id="jne" value="jne" data-price="15000">
                                                        <label class="form-check-label w-100" for="jne">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="https://banner2.cleanpng.com/20180622/qhb/aazg7smfj.webp" alt="JNE" style="width: 40px; height: 40px; object-fit: contain;" class="me-3">
                                                                    <span class="fw-semibold">JNE Reguler</span>
                                                                </div>
                                                                <span class="fw-bold text-primary">Rp 15.000</span>
                                                            </div>
                                                            <small class="text-muted d-block"><i class="fas fa-clock me-1"></i>Estimasi: 2-3 hari kerja</small>
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- TIKI -->
                                                <div class="kurir-option p-3 border rounded mb-3" data-kurir="tiki">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="radio" name="kurir" id="tiki" value="tiki" data-price="18000">
                                                        <label class="form-check-label w-100" for="tiki">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="https://www.pikpng.com/pngl/b/129-1294161_tiki-logo-png-logo-pt-tiki-clipart.png" alt="TIKI" style="width: 40px; height: 40px; object-fit: contain;" class="me-3">
                                                                    <span class="fw-semibold">TIKI Reguler</span>
                                                                </div>
                                                                <span class="fw-bold text-primary">Rp 18.000</span>
                                                            </div>
                                                            <small class="text-muted d-block"><i class="fas fa-clock me-1"></i>Estimasi: 1-2 hari kerja</small>
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- J&T Express -->
                                                <div class="kurir-option p-3 border rounded mb-3" data-kurir="jnt">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="radio" name="kurir" id="jnt" value="jnt" data-price="14000">
                                                        <label class="form-check-label w-100" for="jnt">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="https://1000logos.net/wp-content/uploads/2022/08/JT-Express-Logo.png" alt="J&T" style="width: 40px; height: 40px; object-fit: contain;" class="me-3">
                                                                    <span class="fw-semibold">J&T Express</span>
                                                                </div>
                                                                <span class="fw-bold text-primary">Rp 14.000</span>
                                                            </div>
                                                            <small class="text-muted d-block"><i class="fas fa-clock me-1"></i>Estimasi: 2-3 hari kerja</small>
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- POS Indonesia -->
                                                <div class="kurir-option p-3 border rounded mb-3" data-kurir="pos">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="radio" name="kurir" id="pos" value="pos" data-price="12000">
                                                        <label class="form-check-label w-100" for="pos">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="https://toppng.com/uploads/preview/pos-indonesia-vector-logo-free-11574058314mhkyvtrdtv.png" alt="POS Indonesia" style="width: 40px; height: 40px; object-fit: contain;" class="me-3">
                                                                    <span class="fw-semibold">POS Indonesia</span>
                                                                </div>
                                                                <span class="fw-bold text-primary">Rp 12.000</span>
                                                            </div>
                                                            <small class="text-muted d-block"><i class="fas fa-clock me-1"></i>Estimasi: 3-5 hari kerja</small>
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- SiCepat -->
                                                <div class="kurir-option p-3 border rounded mb-3" data-kurir="sicepat">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="radio" name="kurir" id="sicepat" value="sicepat" data-price="13000">
                                                        <label class="form-check-label w-100" for="sicepat">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="https://www.barantum.com/assets/img/successstory/casestudy/sicepat/sicepat.png" alt="SiCepat" style="width: 40px; height: 40px; object-fit: contain;" class="me-3">
                                                                    <span class="fw-semibold">SiCepat REG</span>
                                                                </div>
                                                                <span class="fw-bold text-primary">Rp 13.000</span>
                                                            </div>
                                                            <small class="text-muted d-block"><i class="fas fa-clock me-1"></i>Estimasi: 2-4 hari kerja</small>
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- Anteraja -->
                                                <div class="kurir-option p-3 border rounded" data-kurir="anteraja">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="radio" name="kurir" id="anteraja" value="anteraja" data-price="16000">
                                                        <label class="form-check-label w-100" for="anteraja">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="https://webstoriess.enkosa.com/wp-content/uploads/2024/01/Download-Logo-Anteraja-PNG.png" alt="Anteraja" style="width: 40px; height: 40px; object-fit: contain;" class="me-3">
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
                                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Pembayaran
                                </button>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary btn-lg" id="btn-to-complete" disabled onclick="navigateToStep(4)">
                                    <i class="fas fa-check-circle me-2"></i>Selesaikan Pesanan
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
                            <a href="{{ route('store.orders') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-clipboard-list me-2"></i>Cek Pesanan Saya
                            </a>
                            <a href="{{ route('landing') }}" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-home me-2"></i>Kembali ke Beranda
                            </a>
                            <a href="{{ route('store.index') }}" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-shopping-bag me-2"></i>Lanjut Belanja
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Simple Progress Steps Styles */
        .checkout-progress-wrapper {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
        }

        .progress-steps-simple {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }

        .step-simple {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
            flex: 1;
        }

        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            font-weight: 700;
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }

        .step-text {
            font-weight: 600;
            color: #6c757d;
            font-size: 0.9rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        /* Active State */
        .step-simple.active .step-number {
            background: #007bff;
            border-color: #007bff;
            color: white;
            transform: scale(1.1);
        }

        .step-simple.active .step-text {
            color: #007bff;
            font-weight: 700;
        }

        /* Completed State */
        .step-simple.completed .step-number {
            background: #28a745;
            border-color: #28a745;
            color: white;
        }

        .step-simple.completed .step-text {
            color: #28a745;
        }

        /* Connector Line */
        .progress-steps-simple::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 25%;
            right: 25%;
            height: 2px;
            background: #dee2e6;
            z-index: 1;
        }

        /* Animation untuk step panels */
        .step-panel {
            display: none;
            animation: fadeIn 0.5s ease-in-out;
        }

        .step-panel.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Tombol Kosongkan Keranjang */
        .btn-outline-danger {
            border: 2px solid #dc3545;
            color: #dc3545;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-danger:hover {
            background: #dc3545;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
        }

        /* Selected payment option */
        .payment-option.selected {
            border-color: #007bff !important;
            background-color: #f8f9ff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.15);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .checkout-progress-wrapper {
                padding: 1.5rem;
            }

            .step-number {
                width: 35px;
                height: 35px;
                font-size: 0.9rem;
            }

            .step-text {
                font-size: 0.8rem;
            }

            .progress-steps-simple::before {
                top: 17px;
            }
        }

        @media (max-width: 576px) {
            .progress-steps-simple {
                flex-direction: column;
                gap: 1.5rem;
            }

            .step-simple {
                flex-direction: row;
                width: 100%;
                justify-content: flex-start;
            }

            .step-number {
                margin-bottom: 0;
                margin-right: 12px;
            }

            .progress-steps-simple::before {
                display: none;
            }

            .step-text {
                text-align: left;
            }
        }
    </style>

    <script>
        let cart = @json($cartData);

        let selectedPayment = null;
        let selectedKurir = 'pilihan-penjual';
        let shippingCost = 0;
        let orderNumber = 'ORD-' + Math.floor(100000 + Math.random() * 900000);
        let paymentProofUploaded = false;

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize cart display
            updateCartDisplay();

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

            // Filter kurir handler
            document.querySelectorAll('input[name="kurir-filter"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const filterType = this.id;
                    const allKurirOptions = document.querySelectorAll('.kurir-option');

                    if (filterType === 'all-kurir') {
                        allKurirOptions.forEach(option => {
                            option.style.display = 'block';
                        });
                    } else if (filterType === 'recommended-kurir') {
                        allKurirOptions.forEach(option => {
                            if (option.classList.contains('recommended-kurir')) {
                                option.style.display = 'block';
                            } else {
                                option.style.display = 'none';
                            }
                        });
                    }
                });
            });

            // Set pilihan penjual sebagai default
            const pilihanPenjual = document.getElementById('pilihan-penjual');
            if (pilihanPenjual) {
                pilihanPenjual.checked = true;
                selectedKurir = 'pilihan-penjual';
                shippingCost = 0;
                document.getElementById('btn-to-complete').disabled = false;
                updateCartSummary();
            }
        });

        function navigateToStep(stepNumber) {
            const currentPanel = document.querySelector('.step-panel.active');
            if (currentPanel) {
                currentPanel.classList.remove('active');
                
                // Update progress steps
                updateProgressSteps(stepNumber);
                
                const newPanel = document.querySelector(`.step-panel[data-step="${stepNumber}"]`);
                if (newPanel) {
                    newPanel.classList.add('active');
                    if (stepNumber == 4) {
                        updateOrderDetails();
                    }
                }
            }
        }

        function updateProgressSteps(currentStep) {
            document.querySelectorAll('.step-simple').forEach(step => {
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
        function updateCartDisplay() {
            const cartCount = document.getElementById('cart-count');
            const cartItems = document.getElementById('cart-items');
            const emptyCart = document.getElementById('empty-cart');
            const cartWithItems = document.getElementById('cart-with-items');

            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            cartCount.textContent = totalItems + ' Item';

            if (cart.length === 0) {
                emptyCart.classList.remove('d-none');
                cartWithItems.classList.add('d-none');
            } else {
                emptyCart.classList.add('d-none');
                cartWithItems.classList.remove('d-none');

                cartItems.innerHTML = '';
                cart.forEach(item => {
                    const subtotal = item.price * item.quantity;
                    cartItems.innerHTML += `
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <img src="${item.image}"
                                    alt="${item.name}"
                                    class="rounded me-3 flex-shrink-0"
                                    style="width: 60px; height: 60px; object-fit: cover;"
                                    onerror="this.src='https://via.placeholder.com/60x60?text=No+Image'">
                                <div class="product-info flex-grow-1">
                                    <h6 class="mb-1 fw-semibold" style="font-size: 0.9rem; line-height: 1.2;">${item.name}</h6>
                                    <small class="text-muted">Stok: Tersedia</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="fw-medium text-nowrap" style="font-size: 0.9rem;">Rp ${formatNumber(item.price)}</span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex align-items-center justify-content-center">
                                <button class="btn btn-sm btn-outline-secondary px-2 py-1"
                                        onclick="updateQuantity(${item.id}, ${item.quantity - 1})"
                                        style="min-width: 32px; height: 32px;"
                                        ${item.quantity <= 1 ? 'disabled' : ''}>
                                    <i class="fas fa-minus" style="font-size: 0.7rem;"></i>
                                </button>
                                <span class="mx-2 fw-medium" style="min-width: 40px; text-align: center; font-size: 0.9rem;">${item.quantity}</span>
                                <button class="btn btn-sm btn-outline-secondary px-2 py-1"
                                        onclick="updateQuantity(${item.id}, ${item.quantity + 1})"
                                        style="min-width: 32px; height: 32px;">
                                    <i class="fas fa-plus" style="font-size: 0.7rem;"></i>
                                </button>
                            </div>
                        </td>
                        <td class="text-end pe-4">
                            <span class="fw-bold text-primary text-nowrap" style="font-size: 0.9rem;">Rp ${formatNumber(subtotal)}</span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-danger p-1"
                                    onclick="removeFromCart(${item.id})"
                                    style="width: 32px; height: 32px;">
                                <i class="fas fa-trash" style="font-size: 0.7rem;"></i>
                            </button>
                        </td>
                    </tr>
                `;
                });

                updateCartSummary();
            }
        }

        async function updateQuantity(cartId, newQuantity) {
            // Validasi quantity
            if (newQuantity < 1) {
                showToast('Jumlah minimal adalah 1', 'error');
                return;
            }

            try {
                const response = await fetch(`/store/cart/update/${cartId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        quantity: newQuantity
                    })
                });

                const data = await response.json();

                if (data.success) {
                    location.reload();
                } else {
                    showToast(data.message, 'error');
                }
            } catch (error) {
                console.error('Error updating quantity:', error);
                showToast('Terjadi kesalahan saat memperbarui jumlah', 'error');
            }
        }

        async function removeFromCart(cartId) {
            if (!confirm('Apakah Anda yakin ingin menghapus produk ini dari keranjang?')) {
                return;
            }

            try {
                const response = await fetch(`/store/cart/remove/${cartId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    location.reload();
                } else {
                    showToast(data.message, 'error');
                }
            } catch (error) {
                console.error('Error removing item:', error);
                showToast('Terjadi kesalahan saat menghapus item', 'error');
            }
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

        function selectPayment(name, account, type) {
            selectedPayment = {
                name,
                account,
                type
            };

            document.getElementById('payment-proof-section').style.display = 'block';

            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const total = subtotal + shippingCost;

            document.getElementById('payment-total-display').textContent = 'Rp ' + formatNumber(total);
            document.getElementById('payment-amount-display').textContent = 'Rp ' + formatNumber(total);
            document.getElementById('payment-account-display').textContent = account;

            if (type === 'bank') {
                document.getElementById('bank-instructions').classList.remove('d-none');
                document.getElementById('ewallet-instructions').classList.add('d-none');
            } else {
                document.getElementById('bank-instructions').classList.add('d-none');
                document.getElementById('ewallet-instructions').classList.remove('d-none');
            }

            if (paymentProofUploaded) {
                document.getElementById('btn-to-shipping').disabled = false;
            }

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

            if (selectedKurir) {
                const kurirNames = {
                    'pilihan-penjual': 'Pilihan Penjual',
                    'jne': 'JNE Reguler',
                    'tiki': 'TIKI Reguler',
                    'pos': 'POS Indonesia',
                    'jnt': 'J&T Express',
                    'sicepat': 'SiCepat REG',
                    'anteraja': 'Anteraja Reguler'
                };

                const kurirEstimates = {
                    'pilihan-penjual': '1-3 hari kerja',
                    'jne': '2-3 hari kerja',
                    'tiki': '1-2 hari kerja',
                    'pos': '3-5 hari kerja',
                    'jnt': '2-3 hari kerja',
                    'sicepat': '2-4 hari kerja',
                    'anteraja': '1-3 hari kerja'
                };

                document.getElementById('order-shipping').textContent = kurirNames[selectedKurir] || '-';
                document.getElementById('order-estimate').textContent = kurirEstimates[selectedKurir] || '-';
            }
        }

        function showToast(message, type = 'success') {
            const bgColor = type === 'success' ? 'bg-success' : 'bg-danger';
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';

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

            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();

            toast.addEventListener('hidden.bs.toast', function() {
                document.body.removeChild(toast);
            });
        }

        async function clearCart() {
            if (!confirm('Apakah Anda yakin ingin mengosongkan keranjang?')) {
                return;
            }

            try {
                const response = await fetch('/store/cart/clear', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    location.reload();
                } else {
                    showToast(data.message, 'error');
                }
            } catch (error) {
                console.error('Error clearing cart:', error);
                showToast('Terjadi kesalahan saat mengosongkan keranjang', 'error');
            }
        }
    </script>
@endsection