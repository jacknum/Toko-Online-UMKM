@extends('layouts.auth')

@section('title', 'Registrasi - Nama Perusahaan')

@section('auth-title', 'REGISTER')

@section('auth-content')
<form id="registerForm">
    <div class="form-floating">
        <input type="text" class="form-control" id="fullName" placeholder="Nama Lengkap" required>
        <label for="fullName"><i class="fas fa-user me-2"></i>Nama Lengkap</label>
    </div>
    
    <div class="form-floating">
        <input type="email" class="form-control" id="email" placeholder="Email" required>
        <label for="email"><i class="fas fa-envelope me-2"></i>Alamat Email</label>
    </div>
    
    <div class="form-floating position-relative">
        <input type="password" class="form-control" id="password" placeholder="Password" required>
        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
        <button type="button" class="password-toggle">
            <i class="fas fa-eye"></i>
        </button>
    </div>
    
    <div class="form-floating position-relative">
        <input type="password" class="form-control" id="confirmPassword" placeholder="Konfirmasi Password" required>
        <label for="confirmPassword"><i class="fas fa-lock me-2"></i>Konfirmasi Password</label>
        <button type="button" class="password-toggle">
            <i class="fas fa-eye"></i>
        </button>
    </div>
    
    <div class="form-floating">
        <input type="tel" class="form-control" id="phone" placeholder="Nomor Telepon" required>
        <label for="phone"><i class="fas fa-phone me-2"></i>Nomor Telepon</label>
    </div>
    
    <div class="form-floating">
        <input type="text" class="form-control" id="address" placeholder="Alamat" required>
        <label for="address"><i class="fas fa-home me-2"></i>Alamat Lengkap</label>
    </div>
    
    <div class="mb-3">
        <label class="form-label"><i class="fas fa-user-tag me-2"></i>Pilih Role:</label>
        <div class="role-selection">
            <div class="role-option active" data-role="admin">
                <i class="fas fa-crown me-1"></i> Admin
            </div>
            <div class="role-option" data-role="penjual">
                <i class="fas fa-store me-1"></i> Penjual
            </div>
            <div class="role-option" data-role="pembeli">
                <i class="fas fa-shopping-cart me-1"></i> Pembeli
            </div>
        </div>
    </div>
    
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="agreeTerms" required>
        <label class="form-check-label" for="agreeTerms">
            Saya menyetujui <a href="#" class="auth-link">syarat dan ketentuan</a>
        </label>
    </div>
    
    <button type="submit" class="btn btn-auth mb-3">
        <i class="fas fa-user-plus me-2"></i>Register
    </button>
    
    <div class="auth-footer">
        <p class="mb-0">Sudah punya akun? 
            <a href="{{ route('login') }}" class="auth-link">Login di sini</a>
        </p>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const registerForm = document.getElementById('registerForm');
        let selectedRole = 'admin';
        
        // Update selected role
        document.querySelectorAll('.role-option').forEach(option => {
            option.addEventListener('click', function() {
                selectedRole = this.getAttribute('data-role');
            });
        });
        
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate passwords match
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (password !== confirmPassword) {
                alert('Password dan konfirmasi password tidak cocok!');
                return;
            }
            
            // Add loading animation
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mendaftarkan...';
            submitBtn.disabled = true;
            
            // Simulate registration process
            setTimeout(() => {
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                
                // Show success message
                alert(`Registrasi berhasil sebagai ${selectedRole}! Mengarahkan ke login...`);
                window.location.href = "{{ route('login') }}";
            }, 3000);
        });
    });
</script>
@endsection