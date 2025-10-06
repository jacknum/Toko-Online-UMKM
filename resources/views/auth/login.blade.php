@extends('layouts.auth')

@section('title', 'Login - Nama Perusahaan')

@section('auth-title', 'LOGIN')

@section('auth-content')
<form id="loginForm">
    <div class="form-floating">
        <input type="text" class="form-control" id="username" placeholder="Username" required>
        <label for="username"><i class="fas fa-user me-2"></i>Username</label>
    </div>
    
    <div class="form-floating position-relative">
        <input type="password" class="form-control" id="password" placeholder="Password" required>
        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
        <button type="button" class="password-toggle">
            <i class="fas fa-eye"></i>
        </button>
    </div>
    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="rememberMe">
            <label class="form-check-label" for="rememberMe">
                Ingat saya
            </label>
        </div>
        <a href="#" class="auth-link small">Lupa password?</a>
    </div>
    
    <button type="submit" class="btn btn-auth mb-2">
        <i class="fas fa-sign-in-alt me-2"></i>Login
    </button>

    <!-- Tombol Kembali ke Dashboard -->
    <a href="{{ route('dashboard') }}" class="btn btn-back-dashboard">
        <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
    </a>
    
    <div class="auth-footer">
        <p class="mb-0">Belum punya akun? 
            <a href="{{ route('register') }}" class="auth-link">Daftar di sini</a>
        </p>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginForm = document.getElementById('loginForm');
        
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Add loading animation
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
            submitBtn.disabled = true;
            
            // Simulate login process
            setTimeout(() => {
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                
                // Show success message (in real app, this would be proper authentication)
                alert('Login berhasil! Mengarahkan ke dashboard...');
                window.location.href = "{{ route('dashboard') }}";
            }, 2000);
        });
    });
</script>
@endsection