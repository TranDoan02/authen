@extends('layouts.app')

@section('title', 'Sản phẩm - Nongnghiepvathucpham-AFTD.com')

@section('content')
    <div class="container py-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 mb-4">
                <!-- Desktop View -->
                <div class="card shadow-sm d-none d-md-block border-0 mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="mb-0 fw-bold"><i class="fas fa-list-ul me-2"></i>Danh mục sản phẩm</h5>
                    </div>
                    <div class="list-group list-group-flush border">
                        <a href="{{ route('products.index') }}"
                            class="list-group-item list-group-item-action {{ !request('category') ? 'active' : '' }}">
                            <i class="fas fa-th-large me-2"></i>Tất cả sản phẩm
                        </a>
                        @foreach ($categories as $category)
                            <a href="{{ route('products.index', ['category' => $category->id]) }}"
                                class="list-group-item list-group-item-action {{ request('category') == $category->id ? 'active' : '' }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Mobile View (Simplified) -->
                <div class="d-md-none mb-4">
                    <div class="card border-primary shadow-sm">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3"
                            onclick="const target = document.getElementById('mobile-cats-final'); target.classList.toggle('d-none');"
                            style="cursor: pointer;">
                            <h5 class="mb-0 fw-bold"><i class="fas fa-list-ul me-2"></i>DANH MỤC</h5>
                            <i class="fas fa-plus"></i>
                        </div>
                        <div id="mobile-cats-final" class="{{ request('category') ? '' : 'd-none' }} bg-white border-top">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a href="{{ route('products.index') }}"
                                        class="d-block p-3 text-decoration-none border-bottom {{ !request('category') ? 'bg-light fw-bold text-primary' : 'text-dark' }}">
                                        <i class="fas fa-th-large me-2"></i>Tất cả sản phẩm
                                    </a>
                                </li>
                                @forelse ($categories as $category)
                                    <li>
                                        <a href="{{ route('products.index', ['category' => $category->id]) }}"
                                            class="d-block p-3 text-decoration-none border-bottom {{ request('category') == $category->id ? 'bg-light fw-bold text-primary' : 'text-dark' }}">
                                            <i class="fas fa-caret-right me-2 text-primary"></i>{{ $category->name }}
                                        </a>
                                    </li>
                                @empty
                                    <li class="p-3 text-muted italic">Không tìm thấy danh mục nào.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                #mobile-cats-final .text-dark {
                    color: #212529 !important;
                }
                #mobile-cats-final a:active {
                    background-color: #f8f9fa;
                }
            </style>

            <!-- Products -->
            <div class="col-md-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Sản phẩm</h2>
                    <div>
                        <select class="form-select"
                            onchange="window.location.href = '{{ route('products.index') }}?sort=' + this.value">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Mới nhất</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần
                            </option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần
                            </option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Tên A-Z</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    @forelse($products as $product)
                        <div class="col-md-4 mb-4">
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
                                    <div class="mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $product->rating ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                        <small class="text-muted">({{ $product->rating_count }})</small>
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
                                <p class="mb-0">Không tìm thấy sản phẩm nào.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection