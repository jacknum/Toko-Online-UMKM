@extends('layouts.auth')

@section('title', 'Lupa Password - Nama Perusahaan')

@section('auth-title', 'LUPA PASSWORD')

@section('auth-content')
    <form id="forgotPasswordForm" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="auth-description mb-4">
            <p class="text-muted text-center">
                Masukkan email Anda yang terdaftar untuk mereset password.
            </p>
        </div>

        <div class="form-floating mb-4">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email') }}" placeholder="name@example.com" required>
            <label for="email"><i class="fas fa-envelope me-2"></i>Alamat Email</label>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-auth mb-3">
            <i class="fas fa-arrow-right me-2"></i>Lanjutkan
        </button>

        <!-- Tombol Kembali ke Login -->
        <a href="{{ route('login') }}" class="btn btn-back-login">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Login
        </a>

        <div class="auth-footer">
            <p class="mb-0">Ingat password Anda?
                <a href="{{ route('login') }}" class="auth-link">Login di sini</a>
            </p>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const forgotPasswordForm = document.getElementById('forgotPasswordForm');

            // Form submission handling
            forgotPasswordForm.addEventListener('submit', function(e) {
                // Validasi form sebelum submit
                if (!this.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                this.classList.add('was-validated');

                // Jika form valid, show loading state
                if (this.checkValidity()) {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memeriksa...';
                    submitBtn.disabled = true;
                }
            });

            // Auto focus pada email field
            document.getElementById('email').focus();
        });
    </script>
@endsection
