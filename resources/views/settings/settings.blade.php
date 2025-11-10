@extends('layouts.app')

@section('title', 'Pengaturan')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3 mb-0">Pengaturan</h1>
                <p class="mb-0 text-muted">Kelola akun, toko, dan preferensi Anda</p>
            </div>
        </div>
    </div>

    <!-- Settings Navigation -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-body py-3">
                    <ul class="nav nav-pills nav-fill" id="settingsTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="account-tab" data-bs-toggle="tab" data-bs-target="#account" type="button" role="tab">
                                <i class="fas fa-user me-2"></i>Akun Saya
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="address-tab" data-bs-toggle="tab" data-bs-target="#address" type="button" role="tab">
                                <i class="fas fa-map-marker-alt me-2"></i>Alamat Toko
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment" type="button" role="tab">
                                <i class="fas fa-credit-card me-2"></i>Pembayaran
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="support-tab" data-bs-toggle="tab" data-bs-target="#support" type="button" role="tab">
                                <i class="fas fa-headset me-2"></i>Bantuan & Support
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Content -->
    <div class="row">
        <div class="col-12">
            <div class="tab-content" id="settingsTabContent">

                <!-- Account Settings -->
                <div class="tab-pane fade show active" id="account" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card card-custom shadow mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-user-circle text-primary me-2"></i>
                                        Informasi Profil
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <form id="profileForm">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" name="name"
                                                       value="{{ Auth::user()->name ?? '' }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email"
                                                       value="{{ Auth::user()->email ?? '' }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Nomor Telepon</label>
                                                <input type="tel" class="form-control" name="phone"
                                                       value="{{ Auth::user()->phone ?? '' }}" placeholder="+62">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Nama Toko</label>
                                                <input type="text" class="form-control" name="store_name"
                                                       value="{{ Auth::user()->store_name ?? '' }}" placeholder="Nama toko Anda">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Bio Toko</label>
                                                <textarea class="form-control" name="store_bio" rows="3"
                                                          placeholder="Deskripsi singkat tentang toko Anda">{{ Auth::user()->store_bio ?? '' }}</textarea>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save me-2"></i>Simpan Perubahan Profil
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="card card-custom shadow">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-lock text-success me-2"></i>
                                        Keamanan Akun
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <form id="securityForm">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label">Kata Sandi Saat Ini</label>
                                                <input type="password" class="form-control" name="current_password" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Kata Sandi Baru</label>
                                                <input type="password" class="form-control" name="new_password" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Konfirmasi Kata Sandi Baru</label>
                                                <input type="password" class="form-control" name="new_password_confirmation" required>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="logout_other_devices" id="logoutOtherDevices">
                                                    <label class="form-check-label" for="logoutOtherDevices">
                                                        Keluar dari semua perangkat lain
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-key me-2"></i>Perbarui Kata Sandi
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card card-custom shadow">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-image text-info me-2"></i>
                                        Foto Profil
                                    </h5>
                                </div>
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&size=200&background=4361ee&color=fff' }}"
                                             alt="Profile" class="rounded-circle" width="150" height="150" id="profileImage">
                                    </div>
                                    <input type="file" class="form-control mb-3" id="avatarUpload" accept="image/*">
                                    <button type="button" class="btn btn-outline-primary w-100" id="uploadAvatarBtn">
                                        <i class="fas fa-upload me-2"></i>Unggah Foto
                                    </button>
                                    <div class="mt-2">
                                        <small class="text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address Settings -->
                <div class="tab-pane fade" id="address" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card card-custom shadow">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-store text-warning me-2"></i>
                                        Alamat Toko
                                    </h5>
                                    <button class="btn btn-primary btn-sm" id="showAddressFormBtn">
                                        <i class="fas fa-plus me-1"></i>Tambah Alamat
                                    </button>
                                </div>
                                <div class="card-body">
                                    <!-- Form Alamat (Awalnya Disembunyikan) -->
                                    <div id="addressFormContainer" class="d-none">
                                        <form id="addressForm">
                                            @csrf
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label class="form-label">Label Alamat</label>
                                                    <input type="text" class="form-control" name="address_label"
                                                           placeholder="Contoh: Toko Utama, Gudang, dll.">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Alamat Lengkap</label>
                                                    <textarea class="form-control" name="full_address" rows="3"
                                                              placeholder="Jl. Contoh No. 123"></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Provinsi</label>
                                                    <select class="form-select" name="province" id="provinceSelect">
                                                        <option value="">Pilih Provinsi</option>
                                                        <!-- Options will be populated by JavaScript -->
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Kota/Kabupaten</label>
                                                    <select class="form-select" name="city" id="citySelect" disabled>
                                                        <option value="">Pilih Kota/Kabupaten</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Kecamatan</label>
                                                    <input type="text" class="form-control" name="district">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Kode Pos</label>
                                                    <input type="text" class="form-control" name="postal_code">
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="is_primary" id="isPrimary">
                                                        <label class="form-check-label" for="isPrimary">
                                                            Jadikan sebagai alamat utama
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-warning me-2">
                                                        <i class="fas fa-save me-2"></i>Simpan Alamat
                                                    </button>
                                                    <button type="button" class="btn btn-secondary" id="cancelAddressFormBtn">
                                                        Batal
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <hr class="my-4">
                                    </div>

                                    <!-- Daftar Alamat -->
                                    <div id="addressList">
                                        <div class="list-group">
                                            <!-- Example addresses -->
                                            <div class="list-group-item">
                                                <div class="d-flex w-100 justify-content-between align-items-start">
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Toko Utama</h6>
                                                        <p class="mb-1 small text-muted">Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta 10210</p>
                                                        <small class="text-success">Alamat Utama</small>
                                                    </div>
                                                    <div class="btn-group btn-group-sm ms-3">
                                                        <button class="btn btn-outline-primary btn-sm edit-address-btn">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-outline-danger btn-sm delete-address-btn"
                                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                                data-type="alamat" data-name="Toko Utama">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="d-flex w-100 justify-content-between align-items-start">
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Gudang Pusat</h6>
                                                        <p class="mb-1 small text-muted">Jl. Gatot Subroto No. 45, Jakarta Selatan, DKI Jakarta 12950</p>
                                                    </div>
                                                    <div class="btn-group btn-group-sm ms-3">
                                                        <button class="btn btn-outline-primary btn-sm edit-address-btn">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-outline-danger btn-sm delete-address-btn"
                                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                                data-type="alamat" data-name="Gudang Pusat">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card card-custom shadow">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-info-circle text-info me-2"></i>
                                        Informasi Alamat
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-info">
                                        <small>
                                            <i class="fas fa-lightbulb me-2"></i>
                                            <strong>Tips:</strong><br>
                                            • Anda dapat menambahkan multiple alamat toko<br>
                                            • Pilih satu alamat sebagai alamat utama<br>
                                            • Alamat utama akan ditampilkan di halaman toko
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Settings -->
                <div class="tab-pane fade" id="payment" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card card-custom shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-university text-success me-2"></i>
                                        Rekening Bank
                                    </h5>
                                    <button class="btn btn-success btn-sm" id="showBankFormBtn">
                                        <i class="fas fa-plus me-1"></i>Tambah Rekening
                                    </button>
                                </div>
                                <div class="card-body">
                                    <!-- Form Rekening Bank -->
                                    <div id="bankFormContainer" class="d-none mb-4">
                                        <form id="bankAccountForm">
                                            @csrf
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Nama Bank</label>
                                                    <select class="form-select" name="bank_name" required>
                                                        <option value="">Pilih Bank</option>
                                                        <option value="bca">BCA</option>
                                                        <option value="bni">BNI</option>
                                                        <option value="bri">BRI</option>
                                                        <option value="mandiri">Mandiri</option>
                                                        <option value="cimb">CIMB Niaga</option>
                                                        <option value="permata">Permata</option>
                                                        <option value="other">Lainnya</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Nomor Rekening</label>
                                                    <input type="text" class="form-control" name="account_number"
                                                           placeholder="1234567890" required>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Nama Pemilik Rekening</label>
                                                    <input type="text" class="form-control" name="account_holder"
                                                           value="{{ Auth::user()->name ?? '' }}" required>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="is_primary_account" id="isPrimaryAccount">
                                                        <label class="form-check-label" for="isPrimaryAccount">
                                                            Jadikan sebagai rekening utama
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-success me-2">
                                                        <i class="fas fa-plus me-2"></i>Tambah Rekening
                                                    </button>
                                                    <button type="button" class="btn btn-secondary" id="cancelBankFormBtn">
                                                        Batal
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <hr class="my-4">
                                    </div>

                                    <!-- Daftar Rekening -->
                                    <div id="bankAccountList">
                                        <div class="list-group">
                                            <div class="list-group-item">
                                                <div class="d-flex w-100 justify-content-between align-items-start">
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">BCA</h6>
                                                        <p class="mb-1">1234567890</p>
                                                        <small class="text-muted">A/N: {{ Auth::user()->name }}</small>
                                                    </div>
                                                    <div>
                                                        <span class="badge bg-success me-2">Utama</span>
                                                        <button class="btn btn-outline-danger btn-sm delete-bank-btn"
                                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                                data-type="rekening bank" data-name="BCA - 1234567890">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-group-item">
                                                <div class="d-flex w-100 justify-content-between align-items-start">
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">BRI</h6>
                                                        <p class="mb-1">9876543210</p>
                                                        <small class="text-muted">A/N: {{ Auth::user()->name }}</small>
                                                    </div>
                                                    <div>
                                                        <span class="badge bg-secondary me-2">Cadangan</span>
                                                        <button class="btn btn-outline-danger btn-sm delete-bank-btn"
                                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                                data-type="rekening bank" data-name="BRI - 9876543210">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-custom shadow">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-mobile-alt text-primary me-2"></i>
                                        E-Wallet & Pembayaran Digital
                                    </h5>
                                    <button class="btn btn-primary btn-sm" id="showEwalletFormBtn">
                                        <i class="fas fa-plus me-1"></i>Tambah E-Wallet
                                    </button>
                                </div>
                                <div class="card-body">
                                    <!-- Form E-Wallet -->
                                    <div id="ewalletFormContainer" class="d-none mb-4">
                                        <form id="ewalletForm">
                                            @csrf
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Jenis E-Wallet</label>
                                                    <select class="form-select" name="ewallet_type" required>
                                                        <option value="">Pilih E-Wallet</option>
                                                        <option value="gopay">GoPay</option>
                                                        <option value="ovo">OVO</option>
                                                        <option value="dana">DANA</option>
                                                        <option value="shopeepay">ShopeePay</option>
                                                        <option value="linkaja">LinkAja</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Nomor Telepon</label>
                                                    <input type="text" class="form-control" name="ewallet_number"
                                                           placeholder="081234567890" required>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="is_active" id="isActiveEwallet" checked>
                                                        <label class="form-check-label" for="isActiveEwallet">
                                                            Aktifkan pembayaran dengan e-wallet ini
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary me-2">
                                                        <i class="fas fa-plus me-2"></i>Tambah E-Wallet
                                                    </button>
                                                    <button type="button" class="btn btn-secondary" id="cancelEwalletFormBtn">
                                                        Batal
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <hr class="my-4">
                                    </div>

                                    <!-- Daftar E-Wallet -->
                                    <div class="row g-3" id="ewalletList">
                                        <div class="col-md-6">
                                            <div class="card ewallet-card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <h6 class="mb-0">
                                                            <i class="fas fa-wallet text-success me-2"></i>GoPay
                                                        </h6>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" checked>
                                                        </div>
                                                    </div>
                                                    <p class="mb-1 small text-muted">081234567890</p>
                                                    <button class="btn btn-outline-danger btn-sm mt-2 delete-ewallet-btn"
                                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                            data-type="e-wallet" data-name="GoPay - 081234567890">
                                                        <i class="fas fa-trash me-1"></i>Hapus
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card ewallet-card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <h6 class="mb-0">
                                                            <i class="fas fa-mobile text-purple me-2"></i>OVO
                                                        </h6>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" checked>
                                                        </div>
                                                    </div>
                                                    <p class="mb-1 small text-muted">081234567890</p>
                                                    <button class="btn btn-outline-danger btn-sm mt-2 delete-ewallet-btn"
                                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                            data-type="e-wallet" data-name="OVO - 081234567890">
                                                        <i class="fas fa-trash me-1"></i>Hapus
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card card-custom shadow">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-info-circle text-info me-2"></i>
                                        Informasi Pembayaran
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-info">
                                        <small>
                                            <i class="fas fa-lightbulb me-2"></i>
                                            <strong>Tips:</strong><br>
                                            • Tambahkan minimal satu rekening bank<br>
                                            • E-wallet memudahkan pembayaran customer<br>
                                            • Rekening utama akan digunakan untuk penarikan dana
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Support Settings -->
                <div class="tab-pane fade" id="support" role="tabpanel">
                    <!-- Tetap sama seperti sebelumnya -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card card-custom shadow mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-robot text-primary me-2"></i>
                                        AI Assistant Toko
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="chat-container bg-light rounded p-3" style="height: 300px; overflow-y: auto;">
                                        <div class="chat-message bot-message mb-3">
                                            <div class="message-bubble bg-white rounded p-3 shadow-sm">
                                                <strong>AI Assistant:</strong> Halo! Saya AI Assistant toko Anda. Ada yang bisa saya bantu? Saya bisa membantu dengan pertanyaan tentang produk, pesanan, atau pengaturan toko.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mt-3">
                                        <input type="text" class="form-control" placeholder="Ketik pertanyaan Anda..." id="chatInput">
                                        <button class="btn btn-primary" type="button" id="sendMessageBtn">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-muted">Contoh pertanyaan: "Bagaimana cara menambah produk?" atau "Lihat pesanan terbaru"</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card card-custom shadow mb-4">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-headset text-success me-2"></i>
                                        Kontak Support
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="list-group">
                                        <a href="https://wa.me/6281234567890" target="_blank" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center">
                                                <i class="fab fa-whatsapp text-success me-3 fs-5"></i>
                                                <div>
                                                    <h6 class="mb-1">WhatsApp Support</h6>
                                                    <small class="text-muted">+62 812-3456-7890</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="mailto:support@tokokami.com" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-envelope text-primary me-3 fs-5"></i>
                                                <div>
                                                    <h6 class="mb-1">Email Support</h6>
                                                    <small class="text-muted">support@tokokami.com</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="tel:+622112345678" class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-phone text-info me-3 fs-5"></i>
                                                <div>
                                                    <h6 class="mb-1">Telepon</h6>
                                                    <small class="text-muted">(021) 1234-5678</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-custom shadow">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-clock text-warning me-2"></i>
                                        Jam Operasional
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="operational-hours">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Senin - Jumat</span>
                                            <span>08:00 - 17:00</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Sabtu</span>
                                            <span>09:00 - 15:00</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>Minggu</span>
                                            <span class="text-danger">Libur</span>
                                        </div>
                                    </div>
                                    <div class="mt-3 p-3 bg-light rounded">
                                        <small class="text-muted">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Response time: 1-2 jam kerja untuk WhatsApp & Email
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fas fa-trash-alt text-danger fa-3x mb-3"></i>
                    <h6 class="fw-bold">Apakah Anda yakin ingin menghapus?</h6>
                </div>
                <p class="text-center mb-0">
                    <span id="deleteItemType" class="fw-bold"></span>:
                    <span id="deleteItemName" class="text-primary"></span>
                </p>
                <p class="text-muted text-center small mt-2">
                    Tindakan ini tidak dapat dibatalkan
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                    <i class="fas fa-trash me-2"></i>Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentDeleteButton = null;
        let currentItemType = '';
        let currentItemName = '';

        // Initialize delete modal
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        const deleteItemType = document.getElementById('deleteItemType');
        const deleteItemName = document.getElementById('deleteItemName');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

        // Delete button click handlers
        document.querySelectorAll('.delete-address-btn, .delete-bank-btn, .delete-ewallet-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                currentDeleteButton = this;
                currentItemType = this.getAttribute('data-type');
                currentItemName = this.getAttribute('data-name');

                // Update modal content
                deleteItemType.textContent = currentItemType.charAt(0).toUpperCase() + currentItemType.slice(1);
                deleteItemName.textContent = currentItemName;
            });
        });

        // Confirm delete action
        confirmDeleteBtn.addEventListener('click', function() {
            if (currentDeleteButton) {
                // Determine what type of item to delete
                if (currentDeleteButton.classList.contains('delete-address-btn')) {
                    currentDeleteButton.closest('.list-group-item').remove();
                    showAlert('success', 'Alamat berhasil dihapus!');
                }
                else if (currentDeleteButton.classList.contains('delete-bank-btn')) {
                    currentDeleteButton.closest('.list-group-item').remove();
                    showAlert('success', 'Rekening bank berhasil dihapus!');
                }
                else if (currentDeleteButton.classList.contains('delete-ewallet-btn')) {
                    currentDeleteButton.closest('.col-md-6').remove();
                    showAlert('success', 'E-Wallet berhasil dihapus!');
                }

                // Close modal
                deleteModal.hide();
                currentDeleteButton = null;
            }
        });

        // Profile image upload
        document.getElementById('uploadAvatarBtn')?.addEventListener('click', function() {
            const fileInput = document.getElementById('avatarUpload');
            const file = fileInput.files[0];

            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    showAlert('error', 'Ukuran file maksimal 2MB');
                    return;
                }

                // Simulate upload
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImage').src = e.target.result;
                    showAlert('success', 'Foto profil berhasil diunggah!');
                };
                reader.readAsDataURL(file);
            } else {
                showAlert('error', 'Pilih file terlebih dahulu');
            }
        });

        // Form submissions
        document.getElementById('profileForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            saveForm(this, 'Profil berhasil diperbarui!');
        });

        document.getElementById('securityForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            saveForm(this, 'Kata sandi berhasil diperbarui!');
        });

        // Address Management
        const addressFormContainer = document.getElementById('addressFormContainer');
        const showAddressFormBtn = document.getElementById('showAddressFormBtn');
        const cancelAddressFormBtn = document.getElementById('cancelAddressFormBtn');

        if (showAddressFormBtn) {
            showAddressFormBtn.addEventListener('click', function() {
                addressFormContainer.classList.remove('d-none');
                this.classList.add('d-none');
            });
        }

        if (cancelAddressFormBtn) {
            cancelAddressFormBtn.addEventListener('click', function() {
                addressFormContainer.classList.add('d-none');
                showAddressFormBtn.classList.remove('d-none');
                document.getElementById('addressForm').reset();
            });
        }

        document.getElementById('addressForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            saveForm(this, 'Alamat berhasil disimpan!');
            addressFormContainer.classList.add('d-none');
            showAddressFormBtn.classList.remove('d-none');
        });

        // Bank Account Management
        const bankFormContainer = document.getElementById('bankFormContainer');
        const showBankFormBtn = document.getElementById('showBankFormBtn');
        const cancelBankFormBtn = document.getElementById('cancelBankFormBtn');

        if (showBankFormBtn) {
            showBankFormBtn.addEventListener('click', function() {
                bankFormContainer.classList.remove('d-none');
                this.classList.add('d-none');
            });
        }

        if (cancelBankFormBtn) {
            cancelBankFormBtn.addEventListener('click', function() {
                bankFormContainer.classList.add('d-none');
                showBankFormBtn.classList.remove('d-none');
                document.getElementById('bankAccountForm').reset();
            });
        }

        document.getElementById('bankAccountForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            saveForm(this, 'Rekening bank berhasil ditambahkan!');
            bankFormContainer.classList.add('d-none');
            showBankFormBtn.classList.remove('d-none');
        });

        // E-Wallet Management
        const ewalletFormContainer = document.getElementById('ewalletFormContainer');
        const showEwalletFormBtn = document.getElementById('showEwalletFormBtn');
        const cancelEwalletFormBtn = document.getElementById('cancelEwalletFormBtn');

        if (showEwalletFormBtn) {
            showEwalletFormBtn.addEventListener('click', function() {
                ewalletFormContainer.classList.remove('d-none');
                this.classList.add('d-none');
            });
        }

        if (cancelEwalletFormBtn) {
            cancelEwalletFormBtn.addEventListener('click', function() {
                ewalletFormContainer.classList.add('d-none');
                showEwalletFormBtn.classList.remove('d-none');
                document.getElementById('ewalletForm').reset();
            });
        }

        document.getElementById('ewalletForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            saveForm(this, 'E-Wallet berhasil ditambahkan!');
            ewalletFormContainer.classList.add('d-none');
            showEwalletFormBtn.classList.remove('d-none');
        });

        // Edit address buttons
        document.querySelectorAll('.edit-address-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const addressItem = this.closest('.list-group-item');
                const title = addressItem.querySelector('h6').textContent;
                const address = addressItem.querySelector('p').textContent;

                // Fill form with existing data
                document.querySelector('input[name="address_label"]').value = title;
                document.querySelector('textarea[name="full_address"]').value = address;

                // Show form
                addressFormContainer.classList.remove('d-none');
                showAddressFormBtn.classList.add('d-none');

                showAlert('info', 'Edit mode: ' + title);
            });
        });

        // Chat functionality
        document.getElementById('sendMessageBtn')?.addEventListener('click', function() {
            sendMessage();
        });

        document.getElementById('chatInput')?.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        // Province and city selection (simplified)
        const provinces = [
            { id: 1, name: 'DKI Jakarta' },
            { id: 2, name: 'Jawa Barat' },
            { id: 3, name: 'Jawa Tengah' },
            { id: 4, name: 'Jawa Timur' },
            { id: 5, name: 'Banten' }
        ];

        const provinceSelect = document.getElementById('provinceSelect');
        const citySelect = document.getElementById('citySelect');

        if (provinceSelect) {
            provinces.forEach(province => {
                const option = document.createElement('option');
                option.value = province.id;
                option.textContent = province.name;
                provinceSelect.appendChild(option);
            });

            provinceSelect.addEventListener('change', function() {
                citySelect.disabled = !this.value;
                if (this.value) {
                    // Simulate loading cities
                    citySelect.innerHTML = '<option value="">Memuat kota...</option>';
                    setTimeout(() => {
                        citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
                        const cities = ['Jakarta Pusat', 'Jakarta Selatan', 'Jakarta Barat', 'Jakarta Timur', 'Jakarta Utara'];
                        cities.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city.toLowerCase().replace(' ', '_');
                            option.textContent = city;
                            citySelect.appendChild(option);
                        });
                    }, 500);
                }
            });
        }

        function sendMessage() {
            const chatInput = document.getElementById('chatInput');
            const message = chatInput.value.trim();

            if (!message) return;

            const chatContainer = document.querySelector('.chat-container');

            // Add user message
            const userMessageDiv = document.createElement('div');
            userMessageDiv.className = 'chat-message user-message mb-3';
            userMessageDiv.innerHTML = `
                <div class="message-bubble rounded p-3 shadow-sm">
                    <strong>Anda:</strong> ${message}
                </div>
            `;
            chatContainer.appendChild(userMessageDiv);

            // Clear input
            chatInput.value = '';

            // Simulate AI response
            setTimeout(() => {
                const botResponse = getAIResponse(message);
                const botMessageDiv = document.createElement('div');
                botMessageDiv.className = 'chat-message bot-message mb-3';
                botMessageDiv.innerHTML = `
                    <div class="message-bubble bg-white rounded p-3 shadow-sm">
                        <strong>AI Assistant:</strong> ${botResponse}
                    </div>
                `;
                chatContainer.appendChild(botMessageDiv);
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }, 1000);

            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        function getAIResponse(message) {
            const responses = {
                'produk': 'Untuk menambah produk, buka menu "Produk Saya" dan klik tombol "Tambah Produk". Isi informasi produk seperti nama, deskripsi, harga, dan foto produk.',
                'pesanan': 'Anda bisa melihat pesanan masuk di menu "Pesanan Masuk" dan pesanan keluar di "Pesanan Keluar". Setiap pesanan bisa dikelola statusnya.',
                'pembayaran': 'Informasi pembayaran dan komisi bisa dilihat di menu "Pembayaran & Komisi". Pastikan rekening bank sudah terdaftar di pengaturan.',
                'default': 'Saya memahami pertanyaan Anda. Untuk informasi lebih detail, silakan hubungi tim support kami melalui WhatsApp atau email yang tersedia.'
            };

            message = message.toLowerCase();
            if (message.includes('produk') || message.includes('barang')) {
                return responses.produk;
            } else if (message.includes('pesanan') || message.includes('order')) {
                return responses.pesanan;
            } else if (message.includes('pembayaran') || message.includes('bayar')) {
                return responses.pembayaran;
            } else {
                return responses.default;
            }
        }

        function saveForm(form, successMessage) {
            const formData = new FormData(form);

            // Simulate API call
            setTimeout(() => {
                showAlert('success', successMessage);
            }, 1000);
        }

        function showAlert(type, message) {
            // Remove existing alerts
            const existingAlerts = document.querySelectorAll('.alert-dismissible.position-fixed');
            existingAlerts.forEach(alert => alert.remove());

            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 1050; min-width: 300px;';
            alertDiv.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle me-2"></i>
                    <div>${message}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

            document.body.appendChild(alertDiv);

            setTimeout(() => {
                if (alertDiv.parentNode) {
                    alertDiv.parentNode.removeChild(alertDiv);
                }
            }, 5000);
        }
    });
</script>
@endsection
