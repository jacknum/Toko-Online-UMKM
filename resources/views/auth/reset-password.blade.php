@extends('layouts.auth')

@section('title', 'Reset Password - Nama Perusahaan')

@section('auth-title', 'RESET PASSWORD')

@section('auth-content')
    <form id="resetPasswordForm" method="POST" action="{{ route('password.update') }}">
        @csrf

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="auth-description mb-4">
            <p class="text-muted text-center">
                Buat password baru untuk akun Anda.
            </p>
        </div>

        <!-- Email (hidden) -->
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="form-floating mb-3 position-relative">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password" placeholder="Password Baru" required minlength="8">
            <label for="password"><i class="fas fa-lock me-2"></i>Password Baru</label>
            <button type="button" class="password-toggle">
                <i class="fas fa-eye"></i>
            </button>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Minimal 8 karakter</div>
        </div>

        <div class="form-floating mb-4 position-relative">
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password Baru" required>
            <label for="password_confirmation"><i class="fas fa-lock me-2"></i>Konfirmasi Password Baru</label>
            <button type="button" class="password-toggle">
                <i class="fas fa-eye"></i>
            </button>
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-auth mb-3">
            <i class="fas fa-save me-2"></i>Reset Password
        </button>

        <!-- Tombol Kembali -->
        <a href="{{ route('password.request') }}" class="btn btn-back-login">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </form>

    <!-- Modal Success -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px; border: none;">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 15px 15px 0 0;">
                    <h5 class="modal-title text-white" id="successModalLabel">
                        <i class="fas fa-check-circle me-2"></i>Password Berhasil Direset!
                    </h5>
                </div>
                <div class="modal-body text-center py-4">
                    <div class="mb-3">
                        <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="text-success mb-3">Reset Password Berhasil</h5>
                    <p class="text-muted">Password Anda telah berhasil direset. Silakan login dengan password baru.</p>
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
            const resetPasswordForm = document.getElementById('resetPasswordForm');

            // Form submission handling
            resetPasswordForm.addEventListener('submit', function(e) {
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('password_confirmation').value;

                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('Password dan konfirmasi password tidak cocok!');
                    return;
                }

                if (!this.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                this.classList.add('was-validated');

                // Jika form valid, show loading state
                if (this.checkValidity()) {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
                    submitBtn.disabled = true;
                }
            });

            // Password toggle functionality
            document.querySelectorAll('.password-toggle').forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const passwordInput = this.previousElementSibling;
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
                });
            });

            // Auto focus pada password field
            document.getElementById('password').focus();
        });
    </script>
@endsection
