@extends('layouts.auth')

@section('title', 'Register - Toko Online')
@section('body-class', 'register-body')

@section('auth-content')
    <div class="register-container">
        <div class="register-header">
            <h2><i class="fas fa-user-plus me-2"></i>Daftar Akun Baru</h2>
            <p class="text-muted">Isi form berikut untuk membuat akun baru Anda</p>
        </div>

        <form id="registerForm" class="landscape-form" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-columns">
                <!-- Kolom Kiri -->
                <div class="form-column">
                    <div class="register-form-group">
                        <i class="fas fa-user register-form-icon"></i>
                        <input type="text" class="register-form-control @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name') }}" placeholder=" " required>
                        <label for="name" class="register-form-label">Nama Lengkap</label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="register-form-group">
                        <i class="fas fa-user register-form-icon"></i>
                        <input type="text" class="register-form-control @error('username') is-invalid @enderror"
                            id="username" name="username" value="{{ old('username') }}" placeholder=" " required>
                        <label for="username" class="register-form-label">Username</label>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="register-form-group">
                        <i class="fas fa-envelope register-form-icon"></i>
                        <input type="email" class="register-form-control @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email') }}" placeholder=" " required>
                        <label for="email" class="register-form-label">Alamat Email</label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="register-form-group position-relative">
                        <i class="fas fa-lock register-form-icon"></i>
                        <input type="password" class="register-form-control @error('password') is-invalid @enderror"
                            id="password" name="password" placeholder=" " required>
                        <label for="password" class="register-form-label">Password</label>
                        <button type="button" class="register-password-toggle">
                            <i class="fas fa-eye"></i>
                        </button>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="register-form-group position-relative">
                        <i class="fas fa-lock register-form-icon"></i>
                        <input type="password" class="register-form-control" id="password_confirmation"
                            name="password_confirmation" placeholder=" " required>
                        <label for="password_confirmation" class="register-form-label">Konfirmasi Password</label>
                        <button type="button" class="register-password-toggle">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="form-column">
                    <div class="register-form-group">
                        <i class="fas fa-phone register-form-icon"></i>
                        <input type="tel" class="register-form-control @error('phone') is-invalid @enderror"
                            id="phone" name="phone" value="{{ old('phone') }}" placeholder=" " required>
                        <label for="phone" class="register-form-label">Nomor Telepon</label>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="register-form-group">
                        <i class="fas fa-home register-form-icon"></i>
                        <input type="text" class="register-form-control @error('address') is-invalid @enderror"
                            id="address" name="address" value="{{ old('address') }}" placeholder=" " required>
                        <label for="address" class="register-form-label">Alamat Lengkap</label>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="register-role-wrapper">
                        <label class="register-role-label"><i class="fas fa-user-tag me-2"></i>Pilih Role:</label>
                        <div class="register-role-selection">
                            <div class="register-role-option active" data-role="admin">
                                <i class="fas fa-crown"></i>
                                <span>Admin</span>
                            </div>
                            <div class="register-role-option" data-role="penjual">
                                <i class="fas fa-store"></i>
                                <span>Penjual</span>
                            </div>
                            <div class="register-role-option" data-role="pembeli">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Pembeli</span>
                            </div>
                        </div>
                        <input type="hidden" name="role" id="selectedRole" value="admin">
                    </div>

                    <div class="register-terms-wrapper">
                        <input class="register-terms-checkbox" type="checkbox" id="agreeTerms" name="agree_terms"
                            required>
                        <label class="register-terms-label" for="agreeTerms">
                            Saya menyetujui <a href="#" class="register-auth-link">syarat dan ketentuan</a>
                        </label>
                    </div>

                    <button type="submit" class="register-btn-submit">
                        <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                    </button>

                    <div class="register-auth-footer">
                        <p class="mb-0">Sudah punya akun?</p>
                    </div>
                </div>
            </div>
        </form>

        <div class="register-back-login">
            <a href="{{ route('login') }}">
                <i class="fas fa-arrow-left me-1"></i>Kembali ke Halaman Login
            </a>
        </div>
    </div>

    <!-- Modal Success -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px; border: none;">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 15px 15px 0 0;">
                    <h5 class="modal-title text-white" id="successModalLabel">
                        <i class="fas fa-check-circle me-2"></i>Registrasi Berhasil!
                    </h5>
                </div>
                <div class="modal-body text-center py-4">
                    <div class="mb-3">
                        <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="text-success mb-3">Selamat! Akun Anda berhasil dibuat</h5>
                    <p class="text-muted">Data Anda telah tersimpan di database. Anda akan diarahkan ke halaman login dalam
                        <span id="countdown">5</span> detik.
                    </p>
                </div>
                <div class="modal-footer" style="border: none; border-radius: 0 0 15px 15px;">
                    <a href="{{ route('login') }}" class="btn btn-primary w-100 py-2">
                        <i class="fas fa-sign-in-alt me-2"></i>Login Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const registerForm = document.getElementById('registerForm');
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            let countdown = 5;
            let countdownInterval;

            // Cek jika ada session success dari backend
            @if (session('success'))
                showSuccessModal();
            @endif

            // Form submission handling
            registerForm.addEventListener('submit', function(e) {
                // Client-side validation
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('password_confirmation').value;

                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('Password dan konfirmasi password tidak cocok!');
                    return;
                }

                if (password.length < 6) {
                    e.preventDefault();
                    alert('Password harus minimal 6 karakter!');
                    return;
                }

                // Add loading animation
                const submitBtn = this.querySelector('.register-btn-submit');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mendaftarkan...';
                submitBtn.disabled = true;
            });

            function showSuccessModal() {
                successModal.show();
                startCountdown();
            }

            function startCountdown() {
                const countdownElement = document.getElementById('countdown');
                countdown = 5;
                countdownElement.textContent = countdown;

                countdownInterval = setInterval(function() {
                    countdown--;
                    countdownElement.textContent = countdown;

                    if (countdown <= 0) {
                        clearInterval(countdownInterval);
                        window.location.href = "{{ route('login') }}";
                    }
                }, 1000);
            }

            // Jika modal ditutup manual, clear interval
            document.getElementById('successModal').addEventListener('hidden.bs.modal', function() {
                clearInterval(countdownInterval);
                window.location.href = "{{ route('login') }}";
            });

            // Role selection functionality
            document.querySelectorAll('.register-role-option').forEach(option => {
                option.addEventListener('click', function() {
                    // Remove active class from all options
                    document.querySelectorAll('.register-role-option').forEach(opt => {
                        opt.classList.remove('active');
                    });

                    // Add active class to clicked option
                    this.classList.add('active');
                    const selectedRole = this.getAttribute('data-role');
                    document.getElementById('selectedRole').value = selectedRole;

                    // Add success animation
                    this.classList.add('success');
                    setTimeout(() => {
                        this.classList.remove('success');
                    }, 600);
                });
            });

            // Real-time password confirmation validation
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');

            function validatePasswordMatch() {
                if (passwordInput.value !== confirmPasswordInput.value && confirmPasswordInput.value !== '') {
                    confirmPasswordInput.style.borderColor = '#dc3545';
                    confirmPasswordInput.style.boxShadow = '0 0 0 0.2rem rgba(220, 53, 69, 0.15)';
                } else if (confirmPasswordInput.value !== '') {
                    confirmPasswordInput.style.borderColor = '#28a745';
                    confirmPasswordInput.style.boxShadow = '0 0 0 0.2rem rgba(40, 167, 69, 0.15)';
                } else {
                    confirmPasswordInput.style.borderColor = '#e0e0e0';
                    confirmPasswordInput.style.boxShadow = 'none';
                }
            }

            if (passwordInput && confirmPasswordInput) {
                passwordInput.addEventListener('input', validatePasswordMatch);
                confirmPasswordInput.addEventListener('input', validatePasswordMatch);
            }
        });
    </script>
@endsection
