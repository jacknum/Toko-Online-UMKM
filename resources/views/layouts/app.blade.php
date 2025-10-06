<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Toko Online')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
            --sidebar-width: 250px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fb;
            overflow-x: hidden;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, var(--primary), var(--secondary));
            color: white;
            transition: all 0.3s;
            z-index: 1000;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-menu {
            padding: 15px 0;
        }

        .sidebar-menu a {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            display: block;
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 3px solid white;
        }

        .sidebar-menu i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            transition: all 0.3s;
        }

        .page-header {
            background: white;
            padding: 25px 30px;
            border-bottom: 1px solid #e3e6f0;
            margin-bottom: 20px;
        }

        .navbar-custom {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 30px;
        }

        .card-custom {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 20px;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-card {
            text-align: center;
            padding: 20px;
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            opacity: 0.8;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-title {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .bg-primary-light {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary);
        }

        .bg-success-light {
            background-color: rgba(76, 201, 240, 0.1);
            color: var(--success);
        }

        .bg-warning-light {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        .bg-danger-light {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        .table-custom th {
            border-top: none;
            font-weight: 600;
            color: #6c757d;
        }

        .badge-custom {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .report-card {
            background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 20px;
            height: 100%;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .report-card:hover {
            transform: translateY(-3px);
        }

        .auth-buttons .btn {
            margin-left: 10px;
            border-radius: 20px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-login {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-login:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .btn-register {
            background: var(--primary);
            border: 2px solid var(--primary);
            color: white;
        }

        .btn-register:hover {
            background: var(--secondary);
            border-color: var(--secondary);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                text-align: center;
            }

            .sidebar .menu-text {
                display: none;
            }

            .sidebar-header h3 {
                display: none;
            }

            .sidebar-menu i {
                margin-right: 0;
                font-size: 1.2rem;
            }

            .main-content {
                margin-left: 70px;
            }

            .page-header {
                padding: 20px 15px;
            }

            .auth-buttons .btn {
                margin-left: 5px;
                padding: 6px 12px;
                font-size: 0.9rem;
            }

            .navbar-brand {
                font-size: 1.1rem;
            }
        }

        /* Form Container */
        #registerForm {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Form Floating Input Group */
        .form-floating {
            position: relative;
            margin-bottom: 0;
        }

        .form-floating .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 12px 12px 45px;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            height: 56px;
        }

        .form-floating .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
            outline: none;
        }

        .form-floating label {
            position: absolute;
            top: 50%;
            left: 45px;
            transform: translateY(-50%);
            padding: 0 5px;
            background: white;
            color: #999;
            font-size: 1rem;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .form-floating .form-control:focus~label,
        .form-floating .form-control:not(:placeholder-shown)~label {
            top: 0;
            left: 40px;
            font-size: 0.85rem;
            color: #667eea;
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
        }

        /* Password Field */
        .password-field {
            position: relative;
        }

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
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle:hover {
            color: #667eea;
        }

        .password-toggle:focus {
            outline: none;
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
        }

        .role-option.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: #667eea;
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
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
        }

        .terms-checkbox {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            cursor: pointer;
            accent-color: #667eea;
            flex-shrink: 0;
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
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Responsive Design */
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
        }


        /* Animation for auth buttons */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .btn-login:hover,
        .btn-register:hover {
            animation: pulse 0.6s ease-in-out;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Nama Perusahaan</h3>
        </div>
        <div class="sidebar-menu">
            <a href="#" class="active"><i class="fas fa-tachometer-alt"></i> <span class="menu-text">Dashboard</span></a>
            <a href="#"><i class="fas fa-box"></i> <span class="menu-text">Produk Saya</span></a>
            <a href="#"><i class="fas fa-shopping-cart"></i> <span class="menu-text">Pesanan Masuk</span></a>
            <a href="#"><i class="fas fa-truck"></i> <span class="menu-text">Pesanan Keluar</span></a>
            <a href="#"><i class="fas fa-money-bill-wave"></i> <span class="menu-text">Pembayaran & Komisi</span></a>
            <a href="#"><i class="fas fa-cog"></i> <span class="menu-text">Pengaturan</span></a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom rounded">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <span class="navbar-brand mb-0 h1 d-none d-md-block">Toko Online UMKM</span>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <!-- Auth Buttons - Visible when not logged in -->
                        <li class="nav-item auth-buttons">
                            <a href="{{ route('login') }}" class="btn btn-login">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-register">
                                <i class="fas fa-user-plus me-1"></i>Register
                            </a>
                        </li>

                        <!-- User Dropdown - Visible when logged in -->
                        <li class="nav-item dropdown d-none">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> Admin
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profil</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Pengaturan</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#" id="logoutBtn">
                                        <i class="fas fa-sign-out-alt me-2"></i> Keluar
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="h3 mb-0">Dashboard</h1>
                    <p class="mb-0 text-muted">Ringkasan performa toko online Anda</p>
                </div>
                <div class="col-auto">
                    <div class="card report-card" onclick="generateReport()">
                        <div class="card-body text-center">
                            <i class="fas fa-download fa-2x mb-3"></i>
                            <h5>Generate Report</h5>
                            <p class="small mb-0">Download laporan lengkap</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle sidebar on small screens
            const sidebarToggler = document.querySelector('.navbar-toggler');
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');

            if (sidebarToggler) {
                sidebarToggler.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        if (sidebar.style.width === '70px') {
                            sidebar.style.width = '250px';
                            mainContent.style.marginLeft = '250px';
                        } else {
                            sidebar.style.width = '70px';
                            mainContent.style.marginLeft = '70px';
                        }
                    }
                });
            }

            // Check if user is logged in (you can modify this logic based on your auth system)
            checkAuthStatus();

            // Logout functionality
            document.getElementById('logoutBtn')?.addEventListener('click', function(e) {
                e.preventDefault();
                logout();
            });
        });

        function checkAuthStatus() {
            // Simulate checking if user is logged in
            // In real application, you would check localStorage, cookies, or session
            const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';

            const authButtons = document.querySelector('.auth-buttons');
            const userDropdown = document.querySelector('.nav-item.dropdown');

            if (isLoggedIn) {
                authButtons.classList.add('d-none');
                userDropdown.classList.remove('d-none');
            } else {
                authButtons.classList.remove('d-none');
                userDropdown.classList.add('d-none');
            }
        }

        function logout() {
            // Simulate logout process
            localStorage.removeItem('isLoggedIn');
            alert('Anda telah berhasil logout!');
            checkAuthStatus();

            // Redirect to login page after logout
            setTimeout(() => {
                window.location.href = '{{ route("login") }}';
            }, 1000);
        }

        function generateReport() {
            // Simulate report generation
            const reportCard = document.querySelector('.report-card');
            const originalContent = reportCard.innerHTML;

            reportCard.innerHTML = `
                <div class="card-body text-center">
                    <i class="fas fa-spinner fa-spin fa-2x mb-3"></i>
                    <h5>Generating Report...</h5>
                    <p class="small mb-0">Please wait</p>
                </div>
            `;

            setTimeout(() => {
                reportCard.innerHTML = originalContent;
                alert('Laporan berhasil di-generate! File akan didownload otomatis.');

                // Simulate file download
                const link = document.createElement('a');
                link.href = '#';
                link.download = 'laporan_toko_online.pdf';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }, 2000);
        }
    </script>

    @yield('scripts')
</body>

</html>
