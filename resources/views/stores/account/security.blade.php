@extends('layouts.store')

@section('title', 'Keamanan Akun - Toko UMKM')

@section('content')
    <div class="container-fluid bg-light">
        <div class="container">
            <!-- Header yang Minimalis dan Informatif -->
            <div class="row align-items-center py-4">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="/" class="text-decoration-none">
                                    <i class="fas fa-home me-1"></i>Beranda
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('store.account.profile') }}" class="text-decoration-none">Akun Saya</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Keamanan</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center text-muted">
                        <i class="fas fa-shield-alt me-2"></i>
                        <span class="fw-medium">Keamanan Akun</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Area dengan Background Putih -->
    <div class="container-fluid bg-white py-5">
        <div class="container">
            <!-- Content Keamanan -->
            <div class="row">
                <div class="col-12">
                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <h4 class="fw-semibold mb-0">
                            <i class="fas fa-shield-alt me-2"></i>Keamanan Akun
                        </h4>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- Ubah Password -->
                            <div class="card security-card shadow-sm border-0 mb-5">
                                <div class="card-header bg-white py-4">
                                    <h5 class="fw-semibold mb-0">
                                        <i class="fas fa-key me-2 text-primary"></i>Ubah Password
                                    </h5>
                                </div>
                                <div class="card-body p-4">
                                    <form action="{{ route('store.account.password.update') }}" method="POST" id="passwordForm">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="current_password" class="form-label fw-semibold">
                                                    Password Saat Ini
                                                </label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="current_password"
                                                           name="current_password" required
                                                           placeholder="Masukkan password saat ini">
                                                    <button type="button" class="btn btn-outline-secondary toggle-password"
                                                            data-target="current_password">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                                <div class="form-text">Masukkan password Anda yang saat ini digunakan</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="new_password" class="form-label fw-semibold">
                                                    Password Baru
                                                </label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="new_password"
                                                           name="new_password" required minlength="8"
                                                           placeholder="Password baru (min. 8 karakter)">
                                                    <button type="button" class="btn btn-outline-secondary toggle-password"
                                                            data-target="new_password">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                                <div class="form-text">Minimal 8 karakter</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="new_password_confirmation" class="form-label fw-semibold">
                                                    Konfirmasi Password Baru
                                                </label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control"
                                                           id="new_password_confirmation" name="new_password_confirmation"
                                                           required minlength="8"
                                                           placeholder="Konfirmasi password baru">
                                                    <button type="button" class="btn btn-outline-secondary toggle-password"
                                                            data-target="new_password_confirmation">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                                <div class="form-text">Ulangi password baru</div>
                                            </div>
                                            <div class="col-12">
                                                <div class="password-strength mt-3">
                                                    <div class="progress mb-2" style="height: 6px;">
                                                        <div class="progress-bar" id="passwordStrengthBar"
                                                             role="progressbar" style="width: 0%"></div>
                                                    </div>
                                                    <small class="text-muted" id="passwordStrengthText">
                                                        Kekuatan password: -
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-4">
                                                <button type="submit" class="btn btn-primary btn-lg" id="submitPasswordBtn">
                                                    <i class="fas fa-key me-2"></i>Ubah Password
                                                </button>
                                                <button type="reset" class="btn btn-outline-secondary btn-lg ms-2">
                                                    <i class="fas fa-times me-2"></i>Batal
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Pengaturan Notifikasi -->
                            <div class="card security-card shadow-sm border-0 mb-5">
                                <div class="card-header bg-white py-4">
                                    <h5 class="fw-semibold mb-0">
                                        <i class="fas fa-bell me-2 text-primary"></i>Pengaturan Notifikasi
                                    </h5>
                                </div>
                                <div class="card-body p-4">
                                    <form id="notificationForm">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <h6 class="fw-semibold mb-3">Email Notifikasi</h6>
                                                <div class="form-check form-switch mb-3">
                                                    <input class="form-check-input" type="checkbox" id="emailOrderNotifications" checked>
                                                    <label class="form-check-label" for="emailOrderNotifications">
                                                        Notifikasi Pesanan
                                                    </label>
                                                    <div class="form-text">Dapatkan update status pesanan via email</div>
                                                </div>
                                                <div class="form-check form-switch mb-3">
                                                    <input class="form-check-input" type="checkbox" id="emailPromoNotifications" checked>
                                                    <label class="form-check-label" for="emailPromoNotifications">
                                                        Promo dan Penawaran Khusus
                                                    </label>
                                                    <div class="form-text">Informasi promo terbaru dan penawaran khusus</div>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="emailNewsletter">
                                                    <label class="form-check-label" for="emailNewsletter">
                                                        Newsletter
                                                    </label>
                                                    <div class="form-text">Tips belanja dan update produk terbaru</div>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-4">
                                                <h6 class="fw-semibold mb-3">Notifikasi Browser</h6>
                                                <div class="form-check form-switch mb-3">
                                                    <input class="form-check-input" type="checkbox" id="browserOrderNotifications" checked>
                                                    <label class="form-check-label" for="browserOrderNotifications">
                                                        Notifikasi Pesanan
                                                    </label>
                                                    <div class="form-text">Notifikasi real-time untuk status pesanan</div>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="browserPromoNotifications">
                                                    <label class="form-check-label" for="browserPromoNotifications">
                                                        Notifikasi Promo
                                                    </label>
                                                    <div class="form-text">Pemberitahuan promo flash sale dan diskon</div>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-4">
                                                <button type="button" class="btn btn-primary" id="saveNotificationBtn">
                                                    <i class="fas fa-save me-2"></i>Simpan Pengaturan
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Sesi Aktif -->
                            <div class="card security-card shadow-sm border-0">
                                <div class="card-header bg-white py-4">
                                    <h5 class="fw-semibold mb-0">
                                        <i class="fas fa-desktop me-2 text-primary"></i>Sesi Aktif
                                    </h5>
                                </div>
                                <div class="card-body p-4">
                                    <div class="session-list">
                                        <!-- Sesi Saat Ini -->
                                        <div class="session-item p-3 border rounded-3 mb-3 bg-light">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div class="flex-grow-1">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="fas fa-check-circle text-success me-2"></i>
                                                        <h6 class="fw-semibold mb-0">Sesi Saat Ini</h6>
                                                    </div>
                                                    <p class="text-muted small mb-1">
                                                        <i class="fas fa-globe me-1"></i>
                                                        Chrome pada Windows 10
                                                    </p>
                                                    <p class="text-muted small mb-1">
                                                        <i class="fas fa-map-marker-alt me-1"></i>
                                                        Jakarta, Indonesia
                                                    </p>
                                                    <p class="text-muted small mb-0">
                                                        <i class="fas fa-clock me-1"></i>
                                                        Aktif sejak 2 jam yang lalu
                                                    </p>
                                                </div>
                                                <span class="badge bg-success">Aktif</span>
                                            </div>
                                        </div>

                                        <!-- Sesi Lainnya -->
                                        <div class="session-item p-3 border rounded-3 mb-3">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div class="flex-grow-1">
                                                    <h6 class="fw-semibold mb-2">Firefox pada Android</h6>
                                                    <p class="text-muted small mb-1">
                                                        <i class="fas fa-map-marker-alt me-1"></i>
                                                        Bandung, Indonesia
                                                    </p>
                                                    <p class="text-muted small mb-0">
                                                        <i class="fas fa-clock me-1"></i>
                                                        Terakhir aktif: 3 hari yang lalu
                                                    </p>
                                                </div>
                                                <button class="btn btn-outline-danger btn-sm">
                                                    <i class="fas fa-sign-out-alt me-1"></i>Keluar
                                                </button>
                                            </div>
                                        </div>

                                        <div class="session-item p-3 border rounded-3">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div class="flex-grow-1">
                                                    <h6 class="fw-semibold mb-2">Safari pada iPhone</h6>
                                                    <p class="text-muted small mb-1">
                                                        <i class="fas fa-map-marker-alt me-1"></i>
                                                        Surabaya, Indonesia
                                                    </p>
                                                    <p class="text-muted small mb-0">
                                                        <i class="fas fa-clock me-1"></i>
                                                        Terakhir aktif: 1 minggu yang lalu
                                                    </p>
                                                </div>
                                                <button class="btn btn-outline-danger btn-sm">
                                                    <i class="fas fa-sign-out-alt me-1"></i>Keluar
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-outline-danger w-100" id="logoutAllBtn">
                                            <i class="fas fa-sign-out-alt me-2"></i>Keluar dari Semua Sesi Lainnya
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

    <!-- Spacer untuk jarak dengan footer -->
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12 py-5"></div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            document.querySelectorAll('.toggle-password').forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const targetInput = document.getElementById(targetId);
                    const icon = this.querySelector('i');

                    if (targetInput.type === 'password') {
                        targetInput.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        targetInput.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });

            // Password strength indicator
            const passwordInput = document.getElementById('new_password');
            const strengthBar = document.getElementById('passwordStrengthBar');
            const strengthText = document.getElementById('passwordStrengthText');

            passwordInput.addEventListener('input', function() {
                const password = this.value;
                const strength = calculatePasswordStrength(password);

                strengthBar.style.width = strength.percentage + '%';
                strengthBar.className = 'progress-bar ' + strength.class;
                strengthText.textContent = 'Kekuatan password: ' + strength.text;
            });

            function calculatePasswordStrength(password) {
                let score = 0;

                // Length check
                if (password.length >= 8) score += 25;
                if (password.length >= 12) score += 15;

                // Character variety
                if (/[a-z]/.test(password)) score += 10;
                if (/[A-Z]/.test(password)) score += 10;
                if (/[0-9]/.test(password)) score += 10;
                if (/[^a-zA-Z0-9]/.test(password)) score += 10;

                // Pattern checks
                if (!/(.)\1{2,}/.test(password)) score += 10; // No repeated characters
                if (!/(123|abc|password|qwerty)/i.test(password)) score += 10; // No common patterns

                // Cap the score at 100
                score = Math.min(score, 100);

                // Determine strength level
                if (score >= 80) {
                    return { percentage: score, class: 'bg-success', text: 'Sangat Kuat' };
                } else if (score >= 60) {
                    return { percentage: score, class: 'bg-info', text: 'Kuat' };
                } else if (score >= 40) {
                    return { percentage: score, class: 'bg-warning', text: 'Cukup' };
                } else if (score >= 20) {
                    return { percentage: score, class: 'bg-danger', text: 'Lemah' };
                } else {
                    return { percentage: score, class: 'bg-secondary', text: 'Sangat Lemah' };
                }
            }

            // Form validation
            const passwordForm = document.getElementById('passwordForm');
            passwordForm.addEventListener('submit', function(e) {
                const newPassword = document.getElementById('new_password').value;
                const confirmPassword = document.getElementById('new_password_confirmation').value;

                if (newPassword !== confirmPassword) {
                    e.preventDefault();
                    alert('Password baru dan konfirmasi password tidak cocok!');
                    return;
                }

                if (newPassword.length < 8) {
                    e.preventDefault();
                    alert('Password baru harus minimal 8 karakter!');
                    return;
                }

                // Show loading state
                const submitBtn = document.getElementById('submitPasswordBtn');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
                submitBtn.disabled = true;
            });

            // Save notification settings
            document.getElementById('saveNotificationBtn').addEventListener('click', function() {
                const btn = this;
                const originalText = btn.innerHTML;

                btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
                btn.disabled = true;

                // Simulate API call
                setTimeout(() => {
                    btn.innerHTML = '<i class="fas fa-check me-2"></i>Berhasil Disimpan';
                    btn.classList.remove('btn-primary');
                    btn.classList.add('btn-success');

                    setTimeout(() => {
                        btn.innerHTML = originalText;
                        btn.classList.remove('btn-success');
                        btn.classList.add('btn-primary');
                        btn.disabled = false;
                    }, 2000);
                }, 1000);
            });

            // Logout from other sessions
            document.getElementById('logoutAllBtn').addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin keluar dari semua sesi lainnya? Anda akan tetap login di perangkat ini.')) {
                    const btn = this;
                    const originalText = btn.innerHTML;

                    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
                    btn.disabled = true;

                    // Simulate API call
                    setTimeout(() => {
                        btn.innerHTML = '<i class="fas fa-check me-2"></i>Berhasil';
                        btn.classList.remove('btn-outline-danger');
                        btn.classList.add('btn-success');

                        // Remove other sessions from UI
                        document.querySelectorAll('.session-item:not(.bg-light)').forEach(item => {
                            item.remove();
                        });

                        setTimeout(() => {
                            btn.innerHTML = originalText;
                            btn.classList.remove('btn-success');
                            btn.classList.add('btn-outline-danger');
                            btn.disabled = false;
                        }, 2000);
                    }, 1500);
                }
            });

            // Logout from individual session
            document.querySelectorAll('.session-item:not(.bg-light) .btn-outline-danger').forEach(button => {
                button.addEventListener('click', function() {
                    const sessionItem = this.closest('.session-item');
                    const deviceName = sessionItem.querySelector('.fw-semibold').textContent;

                    if (confirm(`Keluar dari sesi ${deviceName}?`)) {
                        const originalText = this.innerHTML;

                        this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>';
                        this.disabled = true;

                        // Simulate API call
                        setTimeout(() => {
                            sessionItem.style.opacity = '0';
                            setTimeout(() => {
                                sessionItem.remove();
                            }, 300);
                        }, 1000);
                    }
                });
            });
        });
    </script>
@endsection
