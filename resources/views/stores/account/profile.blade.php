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
                            <!-- Informasi User -->
                            <div class="text-center mb-4">
                                <div class="user-icon mx-auto mb-3">
                                    <i class="fas fa-user-circle fa-4x text-primary"></i>
                                </div>
                                <h5 class="fw-semibold mb-1">{{ Auth::user()->name }}</h5>
                                <p class="text-muted small">Bergabung sejak {{ Auth::user()->created_at->format('d M Y') }}</p>
                            </div>

                            <!-- Form Profil -->
                            <form action="{{ route('store.account.profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label fw-semibold">Nomor Telepon</label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                               id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}" required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label for="email" class="form-label fw-semibold">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
@endsection
