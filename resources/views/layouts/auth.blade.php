<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Auth - Nama Perusahaan')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ url('/css/auth.css') }}">
</head>

<body class="@yield('body-class', 'login-body')">
    <!-- Background untuk Login -->
    <div class="floating-elements">
        <div class="floating-element" style="width: 100px; height: 100px; top: 10%; left: 10%; animation-delay: 0s;">
        </div>
        <div class="floating-element" style="width: 150px; height: 150px; top: 60%; left: 80%; animation-delay: 2s;">
        </div>
        <div class="floating-element" style="width: 80px; height: 80px; top: 80%; left: 20%; animation-delay: 4s;">
        </div>
        <div class="floating-element" style="width: 120px; height: 120px; top: 20%; left: 70%; animation-delay: 1s;">
        </div>
    </div>

    <!-- Background untuk Register -->
    <div class="animated-bg"></div>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    @hasSection('auth-title')
        <!-- Layout untuk Login -->
        <div class="auth-container">
            <div class="auth-header">
                <div class="company-name">Nama Perusahaan</div>
                <h1 class="auth-title">@yield('auth-title', 'LOGIN')</h1>
            </div>

            <div class="auth-body">
                @yield('auth-content')
            </div>
        </div>
    @else
        <!-- Layout untuk Register -->
        @yield('auth-content')
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password toggle functionality untuk Login - DIPERBAIKI
            const passwordToggles = document.querySelectorAll('.password-toggle');
            passwordToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const passwordInput = this.closest('.form-floating').querySelector('input');
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' :
                        'password';
                    passwordInput.setAttribute('type', type);

                    // PERBAIKAN: Logika icon dibalik
                    this.innerHTML = type === 'password' ?
                        '<i class="fas fa-eye-slash"></i>' : // Password tersembunyi: icon eye-slash
                        '<i class="fas fa-eye"></i>'; // Password terlihat: icon eye
                });
            });

            // Password toggle functionality untuk Register - DIPERBAIKI
            const registerPasswordToggles = document.querySelectorAll('.register-password-toggle');

            registerPasswordToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    // Cari input password yang sesuai - PERBAIKAN SELECTOR
                    const formGroup = this.closest('.register-form-group');
                    if (!formGroup) {
                        console.error('Form group not found');
                        return;
                    }

                    const passwordInput = formGroup.querySelector('.register-form-control');
                    if (!passwordInput) {
                        console.error('Password input not found');
                        return;
                    }

                    const icon = this.querySelector('i');

                    // PERBAIKAN: Logika icon dibalik untuk konsistensi
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });

            // Role selection functionality untuk Register
            const registerRoleOptions = document.querySelectorAll('.register-role-option');
            registerRoleOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remove active class from all options
                    document.querySelectorAll('.register-role-option').forEach(opt => {
                        opt.classList.remove('active');
                    });

                    // Add active class to clicked option
                    this.classList.add('active');
                    const selectedRole = this.getAttribute('data-role');

                    // Update hidden input if exists
                    const roleInput = document.getElementById('selectedRole');
                    if (roleInput) {
                        roleInput.value = selectedRole;
                    }

                    // Add success animation
                    this.classList.add('success');
                    setTimeout(() => {
                        this.classList.remove('success');
                    }, 600);
                });
            });

            // Real-time password confirmation validation untuk Register
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');

            if (passwordInput && confirmPasswordInput) {
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

                passwordInput.addEventListener('input', validatePasswordMatch);
                confirmPasswordInput.addEventListener('input', validatePasswordMatch);
            }
        });
    </script>

    @yield('scripts')
</body>

</html>
