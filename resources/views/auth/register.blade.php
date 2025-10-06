<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Toko Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
        }

        /* ANIMASI BACKGROUND KEREN */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin: 0;
            overflow: hidden;
            position: relative;
        }

        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #f5576c);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 20s infinite linear;
        }

        .shape:nth-child(1) {
            width: 300px;
            height: 300px;
            top: -150px;
            left: -150px;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 200px;
            height: 200px;
            top: 20%;
            right: -100px;
            animation-delay: -5s;
            animation-duration: 25s;
        }

        .shape:nth-child(3) {
            width: 150px;
            height: 150px;
            bottom: -75px;
            left: 20%;
            animation-delay: -10s;
            animation-duration: 30s;
        }

        .shape:nth-child(4) {
            width: 250px;
            height: 250px;
            bottom: 30%;
            right: 10%;
            animation-delay: -15s;
            animation-duration: 35s;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            25% {
                transform: translate(100px, 100px) rotate(90deg);
            }

            50% {
                transform: translate(200px, 0) rotate(180deg);
            }

            75% {
                transform: translate(100px, -100px) rotate(270deg);
            }

            100% {
                transform: translate(0, 0) rotate(360deg);
            }
        }

        /* Main Container */
        .register-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 1000px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: containerSlide 0.8s ease-out;
        }

        @keyframes containerSlide {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header */
        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-header h2 {
            color: #333;
            font-weight: 700;
            margin-bottom: 10px;
            animation: textGlow 2s ease-in-out infinite alternate;
        }

        .form-header p {
            color: #666;
            font-size: 1.1rem;
        }

        @keyframes textGlow {
            from {
                text-shadow: 0 0 10px rgba(102, 126, 234, 0.3);
            }

            to {
                text-shadow: 0 0 20px rgba(102, 126, 234, 0.6);
            }
        }

        /* Landscape Layout */
        .landscape-form {
            width: 100%;
        }

        .form-columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: start;
        }

        .form-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Form Styles - DIPERBAIKI */
        .form-group {
            position: relative;
            margin-bottom: 0;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 16px 16px 16px 50px;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            height: 56px;
            background: #f8f9fa;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
            outline: none;
            background: #fff;
            transform: translateY(-2px);
        }

        /* Label Styles - DIPERBAIKI TOTAL */
        .form-label {
            position: absolute;
            left: 50px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none;
            background: #f8f9fa;
            padding: 0 8px;
            margin: 0;
            z-index: 2;
        }

        .form-control:focus+.form-label,
        .form-control:not(:placeholder-shown)+.form-label {
            top: 0;
            left: 42px;
            font-size: 0.8rem;
            color: #667eea;
            background: white;
            transform: translateY(-50%);
            font-weight: 600;
        }

        /* Form Icons */
        .form-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            z-index: 10;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .form-control:focus~.form-icon {
            color: #667eea;
            transform: translateY(-50%) scale(1.1);
        }

        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            z-index: 10;
            padding: 5px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle:hover {
            color: #667eea;
            transform: translateY(-50%) scale(1.1);
        }

        /* Role Selection */
        .role-wrapper {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .role-label {
            font-weight: 600;
            color: #333;
            font-size: 1rem;
            display: flex;
            align-items: center;
            margin: 0;
        }

        .role-selection {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .role-option {
            padding: 15px 10px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            background: #f8f9fa;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            color: #666;
        }

        .role-option:hover {
            border-color: #667eea;
            background: #f0f2ff;
            transform: translateY(-2px);
        }

        .role-option.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: #667eea;
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
            animation: rolePulse 2s infinite;
        }

        @keyframes rolePulse {

            0%,
            100% {
                box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
            }

            50% {
                box-shadow: 0 5px 25px rgba(102, 126, 234, 0.6);
            }
        }

        .role-option i {
            font-size: 1.2rem;
        }

        .role-option span {
            font-size: 0.9rem;
        }

        /* Terms and Conditions */
        .terms-wrapper {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin: 10px 0;
        }

        .terms-checkbox {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            cursor: pointer;
            accent-color: #667eea;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .terms-checkbox:checked {
            transform: scale(1.1);
        }

        .terms-label {
            font-size: 0.95rem;
            color: #666;
            line-height: 1.5;
            cursor: pointer;
            margin: 0;
        }

        .auth-link {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .auth-link:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        /* Submit Button */
        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 14px 20px;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin: 10px 0;
            position: relative;
            overflow: hidden;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
            animation: buttonPulse 0.6s ease-in-out;
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        @keyframes buttonPulse {
            0% {
                transform: translateY(-2px) scale(1);
            }

            50% {
                transform: translateY(-2px) scale(1.05);
            }

            100% {
                transform: translateY(-2px) scale(1);
            }
        }

        /* Auth Footer */
        .auth-footer {
            text-align: center;
            color: #6c757d;
            margin-top: 10px;
        }

        /* Back to Login */
        .back-login {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .back-login a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
            position: relative;
        }

        .back-login a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #667eea;
            transition: width 0.3s ease;
        }

        .back-login a:hover::after {
            width: 100%;
        }

        .back-login a:hover {
            color: #764ba2;
            transform: translateX(-5px);
        }

        /* Loading animation */
        .fa-spinner {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .form-columns {
                grid-template-columns: 1fr;
                gap: 25px;
            }

            .register-container {
                padding: 30px 25px;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .register-container {
                padding: 25px 20px;
            }

            .form-header {
                margin-bottom: 30px;
            }

            .form-header h2 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .role-selection {
                grid-template-columns: 1fr;
                gap: 8px;
            }

            .role-option {
                flex-direction: row;
                justify-content: center;
                padding: 12px;
            }

            .role-option i {
                font-size: 1rem;
            }

            .form-column {
                gap: 15px;
            }

            .register-container {
                padding: 20px 15px;
            }
        }

        /* Success Animation */
        @keyframes success {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        .success {
            animation: success 0.6s ease-in-out;
        }
    </style>
</head>

<body>
    <!-- Animated Background -->
    <div class="animated-bg"></div>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="register-container">
        <div class="form-header">
            <h2><i class="fas fa-user-plus me-2"></i>Daftar Akun Baru</h2>
            <p class="text-muted">Isi form berikut untuk membuat akun baru Anda</p>
        </div>

        <form id="registerForm" class="landscape-form">
            <div class="form-columns">
                <!-- Kolom Kiri -->
                <div class="form-column">
                    <div class="form-group">
                        <i class="fas fa-user form-icon"></i>
                        <input type="text" class="form-control" id="fullName" placeholder=" " required>
                        <label for="fullName" class="form-label">Nama Lengkap</label>
                    </div>

                    <div class="form-group">
                        <i class="fas fa-envelope form-icon"></i>
                        <input type="email" class="form-control" id="email" placeholder=" " required>
                        <label for="email" class="form-label">Alamat Email</label>
                    </div>

                    <div class="form-group position-relative">
                        <i class="fas fa-lock form-icon"></i>
                        <input type="password" class="form-control" id="password" placeholder=" " required>
                        <label for="password" class="form-label">Password</label>
                        <button type="button" class="password-toggle">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>

                    <div class="form-group position-relative">
                        <i class="fas fa-lock form-icon"></i>
                        <input type="password" class="form-control" id="confirmPassword" placeholder=" " required>
                        <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                        <button type="button" class="password-toggle">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="form-column">
                    <div class="form-group">
                        <i class="fas fa-phone form-icon"></i>
                        <input type="tel" class="form-control" id="phone" placeholder=" " required>
                        <label for="phone" class="form-label">Nomor Telepon</label>
                    </div>

                    <div class="form-group">
                        <i class="fas fa-home form-icon"></i>
                        <input type="text" class="form-control" id="address" placeholder=" " required>
                        <label for="address" class="form-label">Alamat Lengkap</label>
                    </div>

                    <div class="role-wrapper">
                        <label class="role-label"><i class="fas fa-user-tag me-2"></i>Pilih Role:</label>
                        <div class="role-selection">
                            <div class="role-option active" data-role="admin">
                                <i class="fas fa-crown"></i>
                                <span>Admin</span>
                            </div>
                            <div class="role-option" data-role="penjual">
                                <i class="fas fa-store"></i>
                                <span>Penjual</span>
                            </div>
                            <div class="role-option" data-role="pembeli">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Pembeli</span>
                            </div>
                        </div>
                    </div>

                    <div class="terms-wrapper">
                        <input class="terms-checkbox" type="checkbox" id="agreeTerms" required>
                        <label class="terms-label" for="agreeTerms">
                            Saya menyetujui <a href="#" class="auth-link">syarat dan ketentuan</a>
                        </label>
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                    </button>

                    <div class="auth-footer">
                        <p class="mb-0">Sudah punya akun?</p>
                    </div>
                </div>
            </div>
        </form>

        <div class="back-login">
            <a href="{{ route('login') }}">
                <i class="fas fa-arrow-left me-1"></i>Kembali ke Halaman Login
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const registerForm = document.getElementById('registerForm');
            let selectedRole = 'admin';

            // Password toggle functionality
            document.querySelectorAll('.password-toggle').forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const passwordInput = this.parentElement.querySelector('input');
                    const icon = this.querySelector('i');

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

            // Update selected role
            document.querySelectorAll('.role-option').forEach(option => {
                option.addEventListener('click', function() {
                    // Remove active class from all options
                    document.querySelectorAll('.role-option').forEach(opt => {
                        opt.classList.remove('active');
                    });

                    // Add active class to clicked option
                    this.classList.add('active');
                    selectedRole = this.getAttribute('data-role');

                    // Add success animation
                    this.classList.add('success');
                    setTimeout(() => {
                        this.classList.remove('success');
                    }, 600);
                });
            });

            // Real-time password confirmation validation
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirmPassword');

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

            // Form submission
            registerForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Get form values
                const fullName = document.getElementById('fullName').value;
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('confirmPassword').value;
                const phone = document.getElementById('phone').value;
                const address = document.getElementById('address').value;

                // Validate required fields
                if (!fullName || !email || !password || !confirmPassword || !phone || !address) {
                    alert('Semua field harus diisi!');
                    return;
                }

                // Validate email format
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    alert('Format email tidak valid!');
                    return;
                }

                // Validate passwords match
                if (password !== confirmPassword) {
                    alert('Password dan konfirmasi password tidak cocok!');
                    return;
                }

                // Validate password strength
                if (password.length < 6) {
                    alert('Password harus minimal 6 karakter!');
                    return;
                }

                // Validate phone number
                if (phone.length < 10) {
                    alert('Nomor telepon harus minimal 10 digit!');
                    return;
                }

                // Validate terms agreement
                if (!document.getElementById('agreeTerms').checked) {
                    alert('Anda harus menyetujui syarat dan ketentuan!');
                    return;
                }

                // Add loading animation
                const submitBtn = this.querySelector('.btn-submit');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mendaftarkan...';
                submitBtn.disabled = true;

                // Simulate registration process
                setTimeout(() => {
                    // Reset button
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;

                    // Show success message with user data
                    const successMessage = `
Registrasi berhasil!

Detail Akun:
- Nama: ${fullName}
- Email: ${email}
- Role: ${selectedRole}
- Telepon: ${phone}

Mengarahkan ke halaman login...
                    `;

                    alert(successMessage);

                    // Redirect to login page
                    window.location.href = "{{ route('login') }}";
                }, 3000);
            });

            // Add input validation styling
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.value.trim() !== '') {
                        this.style.borderColor = '#28a745';
                        this.style.boxShadow = '0 0 0 0.2rem rgba(40, 167, 69, 0.15)';
                    } else {
                        this.style.borderColor = '#e0e0e0';
                        this.style.boxShadow = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>
