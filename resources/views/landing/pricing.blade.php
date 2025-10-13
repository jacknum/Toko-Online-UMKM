@extends('layouts.landing')

@section('title', 'Harga - TokoOnline')

@section('content')
<section class="section" style="padding-top: 8rem;">
    <div class="container">
        <h2 class="section-title">Paket Harga Terjangkau</h2>
        <p class="section-subtitle">
            Pilih paket yang sesuai dengan kebutuhan bisnis Anda
        </p>

        <div class="row justify-content-center">
            <!-- Free Plan -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card text-center">
                    <div class="feature-icon bg-light text-primary">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h4 class="feature-title">Starter</h4>
                    <div class="my-4">
                        <span class="h1 text-dark">Gratis</span>
                        <span class="text-muted">/selamanya</span>
                    </div>
                    <ul class="list-unstyled text-start mb-4">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>50 Produk</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Manajemen Pesanan</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Laporan Dasar</li>
                        <li class="mb-2"><i class="fas fa-times text-muted me-2"></i>Support Priority</li>
                        <li class="mb-2"><i class="fas fa-times text-muted me-2"></i>Analytics Lanjutan</li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary w-100">
                        Mulai Sekarang
                    </a>
                </div>
            </div>

            <!-- Pro Plan -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="feature-card text-center border-primary position-relative">
                    <div class="position-absolute top-0 start-50 translate-middle">
                        <span class="badge bg-primary">POPULER</span>
                    </div>
                    <div class="feature-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h4 class="feature-title">Professional</h4>
                    <div class="my-4">
                        <span class="h1 text-dark">Rp 99.000</span>
                        <span class="text-muted">/bulan</span>
                    </div>
                    <ul class="list-unstyled text-start mb-4">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Produk Unlimited</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Semua Fitur Pesanan</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Laporan Lengkap</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Support Priority</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Analytics Lanjutan</li>
                    </ul>
                    <a href="{{ route('register') }}" class="btn btn-primary w-100">
                        Pilih Paket Ini
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection