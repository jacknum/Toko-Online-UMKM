@extends('layouts.landing')

@section('title', 'Harga - TokoOnline')

@section('content')
<section class="section pricing-section" style="padding-top: 8rem;">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <span class="hero-badge mb-3">
                    <i class="fas fa-tags me-2"></i>Harga Terjangkau
                </span>
                <h2 class="section-title">Pilih Paket yang Tepat untuk Bisnis Anda</h2>
                <p class="section-subtitle">
                    Mulai dari gratis hingga fitur lengkap, semua paket dirancang untuk membantu UMKM berkembang
                </p>
            </div>
        </div>

        <!-- Pricing Toggle -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-6 text-center">
                <div class="pricing-toggle-container">
                    <div class="btn-group" role="group">
                        <input type="radio" class="btn-check" name="pricing-toggle" id="monthly" autocomplete="off" checked>
                        <label class="btn btn-pricing-toggle" for="monthly">
                            <i class="fas fa-calendar-alt me-2"></i>Bulanan
                        </label>

                        <input type="radio" class="btn-check" name="pricing-toggle" id="yearly" autocomplete="off">
                        <label class="btn btn-pricing-toggle" for="yearly">
                            <i class="fas fa-calendar-star me-2"></i>Tahunan
                            <span class="badge bg-success ms-2">Hemat 20%</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <!-- Free Plan -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="pricing-card">
                    <div class="pricing-header">
                        <div class="pricing-icon free">
                            <i class="fas fa-seedling"></i>
                        </div>
                        <h3 class="pricing-title">Starter</h3>
                        <p class="pricing-subtitle">Cocok untuk yang baru memulai</p>
                    </div>

                    <div class="pricing-price">
                        <span class="price-amount">Gratis</span>
                        <span class="price-period">selamanya</span>
                    </div>

                    <div class="pricing-features">
                        <div class="feature-item">
                            <i class="fas fa-check feature-check"></i>
                            <span>Hingga 50 Produk</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check feature-check"></i>
                            <span>Manajemen Pesanan Dasar</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check feature-check"></i>
                            <span>Laporan Penjualan Dasar</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check feature-check"></i>
                            <span>1 GB Storage</span>
                        </div>
                        <div class="feature-item disabled">
                            <i class="fas fa-times feature-times"></i>
                            <span>Support Priority</span>
                        </div>
                        <div class="feature-item disabled">
                            <i class="fas fa-times feature-times"></i>
                            <span>Analytics Lanjutan</span>
                        </div>
                        <div class="feature-item disabled">
                            <i class="fas fa-times feature-times"></i>
                            <span>Integrasi Marketplace</span>
                        </div>
                    </div>

                    <div class="pricing-cta">
                        <a href="{{ route('register') }}" class="btn btn-pricing-outline w-100">
                            <i class="fas fa-play me-2"></i>Mulai Gratis
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pro Plan - Featured -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="pricing-card featured">
                    <div class="popular-badge">
                        <i class="fas fa-crown me-1"></i>POPULER
                    </div>

                    <div class="pricing-header">
                        <div class="pricing-icon pro">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h3 class="pricing-title">Professional</h3>
                        <p class="pricing-subtitle">Untuk bisnis yang sedang berkembang</p>
                    </div>

                    <div class="pricing-price">
                        <span class="price-amount monthly-price">Rp 99.000</span>
                        <span class="price-amount yearly-price d-none">Rp 948.000</span>
                        <span class="price-period">/bulan</span>
                        <div class="price-save d-none">
                            <span class="badge bg-success">
                                <i class="fas fa-piggy-bank me-1"></i>Hemat Rp 240.000
                            </span>
                        </div>
                    </div>

                    <div class="pricing-features">
                        <div class="feature-item">
                            <i class="fas fa-check feature-check"></i>
                            <span>Produk Unlimited</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check feature-check"></i>
                            <span>Semua Fitur Pesanan</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check feature-check"></i>
                            <span>Laporan Lengkap & Analytics</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check feature-check"></i>
                            <span>10 GB Storage</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check feature-check"></i>
                            <span>Support Priority 24/7</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check feature-check"></i>
                            <span>Integrasi Marketplace</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check feature-check"></i>
                            <span>Backup Otomatis</span>
                        </div>
                    </div>

                    <div class="pricing-cta">
                        <a href="{{ route('register') }}" class="btn btn-primary w-100">
                            <i class="fas fa-star me-2"></i>Pilih Paket Ini
                        </a>
                    </div>
                </div>
            </div>

            <!-- Business Plan -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="pricing-card">
                    <div class="pricing-header">
                        <div class="pricing-icon business">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="pricing-title">Business</h3>
                        <p class="pricing-subtitle">Untuk bisnis yang sudah established</p>
                    </div>

                    <div class="pricing-price">
                        <span class="price-amount monthly-price">Rp 199.000</span>
                        <span class="price-amount yearly-price d-none">Rp 1.908.000</span>
                        <span class="price-period">/bulan</span>
                        <div class="price-save d-none">
                            <span class="badge bg-success">
                                <i class="fas fa-piggy-bank me-1"></i>Hemat Rp 480.000
                            </span>
                        </div>
                    </div>

                    <div class="pricing-features">
                        <div class="feature-item">
                            <i class="fas fa-check feature-check"></i>
                            <span>Semua Fitur Professional</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check feature-check"></i>
                            <span>Multiple User Accounts</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check feature-check"></i>
                            <span>Advanced Analytics & AI Insights</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check feature-check"></i>
                            <span>50 GB Storage</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check feature-check"></i>
                            <span>Dedicated Account Manager</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check feature-check"></i>
                            <span>Custom Domain</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check feature-check"></i>
                            <span>API Access</span>
                        </div>
                    </div>

                    <div class="pricing-cta">
                        <a href="{{ route('register') }}" class="btn btn-pricing-outline w-100">
                            <i class="fas fa-briefcase me-2"></i>Pilih Business
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="row justify-content-center mt-5">
            <div class="col-lg-8">
                <div class="faq-section">
                    <h3 class="text-center mb-4">Pertanyaan Umum</h3>
                    <div class="accordion" id="pricingFAQ">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    <i class="fas fa-question-circle me-2 text-primary"></i>
                                    Bisakah saya upgrade paket nanti?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#pricingFAQ">
                                <div class="accordion-body">
                                    Tentu! Anda bisa upgrade kapan saja. Selisih harga akan disesuaikan secara proporsional.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    <i class="fas fa-question-circle me-2 text-primary"></i>
                                    Apakah ada kontrak jangka panjang?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#pricingFAQ">
                                <div class="accordion-body">
                                    Tidak ada kontrak jangka panjang. Anda bisa berhenti berlangganan kapan saja.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    <i class="fas fa-question-circle me-2 text-primary"></i>
                                    Apakah data saya aman?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#pricingFAQ">
                                <div class="accordion-body">
                                    Ya, semua data dilindungi dengan enkripsi SSL dan backup rutin. Keamanan data adalah prioritas kami.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
