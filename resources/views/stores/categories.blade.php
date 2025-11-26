@extends('layouts.store')

@section('title', 'Kategori Produk - Toko UMKM')

@section('content')
<!-- Categories Page -->
<section class="store-categories-page">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/store') }}">Home</a></li>
                        <li class="breadcrumb-item active">Kategori</li>
                    </ol>
                </nav>

                <h1 class="store-page-title text-white">Kategori Produk</h1>
                <p class="store-page-subtitle text-white mb-4">Temukan produk UMKM berdasarkan kategori favorit Anda</p>
            </div>
        </div>

        <div class="row">
            @foreach($categories as $category)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <a href="{{ route('store.category-products', $category['id']) }}" class="category-page-link">
                    <div class="store-category-page-card">
                        <div class="store-category-page-icon">
                            <i class="{{ $category['icon'] }}"></i>
                        </div>
                        <div class="store-category-page-content">
                            <h5>{{ $category['name'] }}</h5>
                            <p>{{ $category['description'] }}</p>
                            <span class="store-category-count">{{ $category['product_count'] }} produk</span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
