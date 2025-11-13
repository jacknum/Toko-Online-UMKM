@extends('layouts.store')

@section('title', $category['name'] . ' - Toko UMKM')

@section('content')
<!-- Category Products Page -->
<section class="store-category-products">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/store') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('store.categories') }}">Kategori</a></li>
                        <li class="breadcrumb-item active">{{ $category['name'] }}</li>
                    </ol>
                </nav>

                <div class="store-category-header">
                    <div class="store-category-title-section">
                        <div class="store-category-icon-large">
                            <i class="{{ $category['icon'] }}"></i>
                        </div>
                        <div>
                            <h1 class="store-page-title">{{ $category['name'] }}</h1>
                            <p class="store-page-subtitle">Temukan produk {{ strtolower($category['name']) }} terbaik dari UMKM lokal</p>
                        </div>
                    </div>
                    <div class="store-category-stats">
                        <span class="store-product-count">{{ count($products) }} produk tersedia</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row">
            @foreach($products as $product)
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="{{ route('store.product.detail', $product['id']) }}" class="product-link">
                    <div class="store-product-card">
                        <div class="store-product-image">
                            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="img-fluid">
                            <div class="store-product-badge">{{ $product['badge'] }}</div>
                            <button class="store-wishlist-btn" data-product-id="{{ $product['id'] }}">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="store-product-info">
                            <h5 class="store-product-title">{{ $product['name'] }}</h5>
                            <p class="store-product-desc">{{ $product['description'] }}</p>
                            <div class="store-product-price">
                                <span class="store-price-current">Rp {{ number_format($product['price'], 0, ',', '.') }}</span>
                                @if($product['original_price'] > $product['price'])
                                <span class="store-price-original">Rp {{ number_format($product['original_price'], 0, ',', '.') }}</span>
                                @endif
                            </div>
                            <div class="store-product-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($product['rating']))<i class="fas fa-star"></i>
                                    @elseif($i == ceil($product['rating']) && !is_int($product['rating']))<i class="fas fa-star-half-alt"></i>
                                    @else<i class="far fa-star"></i>@endif
                                @endfor
                                <span class="store-rating-count">({{ $product['review_count'] }})</span>
                            </div>
                            <button class="btn store-add-to-cart" data-product-id="{{ $product['id'] }}">Tambah Keranjang</button>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Include Modals from index -->
@include('stores.partials.modals')
@endsection
