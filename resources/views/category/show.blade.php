@extends('layouts.app')

@section('title', $category->name . ' - Nongnghiepvathucpham-AFTD.com')

@section('content')
    <div class="container py-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item active">{{ $category->name }}</li>
            </ol>
        </nav>

        <h2 class="mb-4">{{ $category->name }}</h2>

        @if($category->description)
            <p class="text-muted mb-4">{{ $category->description }}</p>
        @endif

        <div class="row">
            @forelse($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card product-card h-100">
                        <a href="{{ route('products.show', $product->slug) }}">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300' }}"
                                class="card-img-top product-image" alt="{{ $product->name }}">
                        </a>
                        <div class="card-body">
                            <h6 class="card-title">{{ Str::limit($product->name, 50) }}</h6>
                            <div class="mb-2">
                                @if($product->sale_price)
                                    <span class="product-price">{{ number_format($product->sale_price) }}đ</span>
                                    <span class="product-sale-price">{{ number_format($product->price) }}đ</span>
                                    <span class="product-discount">-{{ $product->discount_percent }}%</span>
                                @else
                                    <span class="product-price">{{ number_format($product->price) }}đ</span>
                                @endif
                            </div>
                            <button type="button" class="btn btn-primary w-100 add-to-cart-btn"
                                data-product-id="{{ $product->id }}">
                                <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <p class="mb-0">Không có sản phẩm nào trong danh mục này.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
@endsection