@extends('layouts.store')

@section('title', 'Profil Akun - Toko UMKM')

@section('content')
    <div class="container-fluid bg-light py-4">
        <div class="container">
            <!-- Header yang Minimalis dan Informatif -->
            <div class="row align-items-center mb-4">
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
                            <li class="breadcrumb-item active" aria-current="page">Profil</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center text-muted">
                        <i class="fas fa-user me-2"></i>
                        <span class="fw-medium">Profil Akun</span>
                    </div>
                </div>
            </div>

            <!-- Content Profile -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h4 class="mb-0 fw-semibold">
                                <i class="fas fa-user me-2"></i>Informasi Profil
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            <!-- Foto Profil -->
                            <div class="text-center mb-4">
                                <div class="avatar-profile position-relative mx-auto mb-3">
                                    <img src="{{ $user['avatar'] }}" alt="{{ $user['name'] }}"
                                         class="avatar-img rounded-circle">
                                    <button class="btn btn-sm btn-primary avatar-edit-btn"
                                            onclick="document.getElementById('avatar-input').click()">
                                        <i class="fas fa-camera"></i>
                                    </button>
                                    <input type="file" id="avatar-input" class="d-none" accept="image/*">
                                </div>
                                <h5 class="fw-semibold mb-1">{{ $user['name'] }}</h5>
                                <p class="text-muted small">Bergabung sejak {{ date('d M Y', strtotime($user['join_date'])) }}</p>
                            </div>

                            <!-- Form Profil -->
                            <form action="{{ route('store.account.profile.update') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{ $user['name'] }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label fw-semibold">Nomor Telepon</label>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                               value="{{ $user['phone'] }}" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="email" class="form-label fw-semibold">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{ $user['email'] }}" required>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                                        </button>
                                        <a href="{{ route('store.account.profile') }}" class="btn btn-outline-secondary btn-lg ms-2">
                                            <i class="fas fa-times me-2"></i>Batal
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links ke Halaman Lain -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('store.account.addresses') }}" class="btn btn-outline-primary">
                            <i class="fas fa-map-marker-alt me-2"></i>Kelola Alamat
                        </a>
                        <a href="{{ route('store.account.security') }}" class="btn btn-outline-primary">
                            <i class="fas fa-shield-alt me-2"></i>Pengaturan Keamanan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Avatar upload preview
            const avatarInput = document.getElementById('avatar-input');
            if (avatarInput) {
                avatarInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.querySelector('.avatar-img').src = e.target.result;
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>
@endsection
