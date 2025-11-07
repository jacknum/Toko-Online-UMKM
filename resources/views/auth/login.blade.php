@extends('layouts.auth')

@section('title', 'Login - Toko Online Banyumas')

@section('auth-content')
<div class="auth-layout">
    <div class="auth-image-section">
        <div class="auth-image-container">
            <!-- Lottie Animation -->
            <div id="lottie-animation" class="lottie-container"></div>
            <!-- Teks dipindahkan ke bawah animasi -->
            <div class="auth-text-below">
                <h2>Toko Online Banyumas</h2>
                <p>Selamat Datang di Toko Online Banyumas</p>
            </div>
        </div>
    </div>

    <div class="auth-form-section">
        <div class="auth-form-container">
            <div class="auth-form-header">
                <h2>Login</h2>
                <p>Silahkan masukkan username dan password</p>
            </div>

            <form id="loginForm" method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf
                <div class="form-floating">
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                        value="{{ old('username') }}" placeholder="Username" required>
                    <label for="username"><i class="fas fa-user me-2"></i>Username</label>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating position-relative">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="Password" required>
                    <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                    <button type="button" class="password-toggle">
                        <i class="fas fa-eye"></i>
                    </button>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end align-items-center mb-3">
                    <a href="{{ route('password.request') }}" class="auth-link small">Lupa password?</a>
                </div>

                <button type="submit" class="btn btn-auth mb-2">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </button>

                <!-- Tombol Kembali ke Dashboard -->
                <a href="{{ route('landing') }}" class="btn btn-back-dashboard">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                </a>

                <div class="auth-footer">
                    <p class="mb-0">Belum punya akun?
                        <a href="{{ route('register') }}" class="auth-link">Daftar di sini</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Success -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px; border: none;">
            <div class="modal-header"
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 15px 15px 0 0;">
                <h5 class="modal-title text-white" id="successModalLabel">
                    <i class="fas fa-check-circle me-2"></i>Login Berhasil!
                </h5>
            </div>
            <div class="modal-body text-center py-4">
                <div class="mb-3">
                    <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                </div>
                <h5 class="text-success mb-3">Selamat! Login berhasil</h5>
                <p class="text-muted">Anda akan diarahkan ke dashboard dalam <span id="countdown">3</span> detik.</p>
            </div>
            <div class="modal-footer" style="border: none; border-radius: 0 0 15px 15px;">
                <a href="{{ route('dashboard') }}" class="btn btn-primary w-100 py-2">
                    <i class="fas fa-tachometer-alt me-2"></i>Ke Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Include Lottie Player -->
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginForm = document.getElementById('loginForm');
        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
        let countdown = 3;
        let countdownInterval;

        // Initialize Lottie Animation
        function initLottieAnimation() {
            const lottieContainer = document.getElementById('lottie-animation');

            // Clear existing content
            lottieContainer.innerHTML = '';

            // Create lottie player
            const player = document.createElement('lottie-player');
            player.src = "{{ asset('js/lottie/login.json') }}";
            player.background = 'transparent';
            player.speed = 1;
            player.style.width = '100%';
            player.style.height = '100%';
            player.loop = true;
            player.autoplay = true;

            lottieContainer.appendChild(player);
        }

        // Initialize animation when page loads
        initLottieAnimation();

        // Cek jika ada session success dari backend (jika login berhasil)
        @if (session('success'))
            showSuccessModal();
        @endif

        // Form submission handling
        loginForm.addEventListener('submit', function(e) {
            // Form akan di-submit secara normal ke backend
            // Add loading animation
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
            submitBtn.disabled = true;

            // Jika form berhasil submit dan login berhasil,
            // modal akan ditampilkan oleh session success dari backend
        });

        function showSuccessModal() {
            successModal.show();
            startCountdown();
        }

        function startCountdown() {
            const countdownElement = document.getElementById('countdown');
            countdown = 3;
            countdownElement.textContent = countdown;

            countdownInterval = setInterval(function() {
                countdown--;
                countdownElement.textContent = countdown;

                if (countdown <= 0) {
                    clearInterval(countdownInterval);
                    window.location.href = "{{ route('dashboard') }}";
                }
            }, 1000);
        }

        // Jika modal ditutup manual, clear interval dan redirect
        document.getElementById('successModal').addEventListener('hidden.bs.modal', function() {
            clearInterval(countdownInterval);
            window.location.href = "{{ route('dashboard') }}";
        });

        // Password toggle functionality
        document.querySelectorAll('.password-toggle').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const passwordInput = this.previousElementSibling;
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' :
                    'password';
                passwordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ?
                    '<i class="fas fa-eye"></i>' :
                    '<i class="fas fa-eye-slash"></i>';
            });
        });

        // Handle responsive behavior for Lottie animation
        window.addEventListener('resize', function() {
            // Adjust Lottie container height based on screen size
            const lottieContainer = document.getElementById('lottie-animation');
            if (window.innerWidth <= 992) {
                lottieContainer.style.height = '200px';
            } else {
                lottieContainer.style.height = '70%';
            }
        });
    });
</script>
@endsection
