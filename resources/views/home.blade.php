@extends('layouts.app')

@section('title', 'Nongnghiepvathucpham-AFTD.com - Sản phẩm an toàn cho người tiêu dùng')

@section('content')
    <!-- Hero Banner Slider -->
    @if(isset($heroBanners) && $heroBanners->count() > 0)
        <section class="hero-banner mb-4">
            <div class="container">
                <div class="swiper hero-swiper">
                    <div class="swiper-wrapper">
                        @foreach($heroBanners as $banner)
                            <div class="swiper-slide">
                                <a href="{{ $banner->link_url ?? '#' }}">
                                    <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title ?? 'Banner' }}"
                                        class="img-fluid rounded w-100" style="object-fit: cover; min-height: 400px;">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    @endif

    <!-- Category Icons -->
    <section class="category-icons py-4 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-6 col-md-2 mb-3">
                    <div class="category-icon-box p-3 bg-white rounded shadow-sm">
                        <i class="fas fa-bolt fa-2x text-danger mb-2"></i>
                        <p class="mb-0 small fw-bold">Flash sale</p>
                    </div>
                </div>
                <div class="col-6 col-md-2 mb-3">
                    <div class="category-icon-box p-3 bg-white rounded shadow-sm">
                        <i class="fas fa-fire fa-2x text-danger mb-2"></i>
                        <p class="mb-0 small fw-bold">Bán chạy nhất</p>
                    </div>
                </div>
                <div class="col-6 col-md-2 mb-3">
                    <div class="category-icon-box p-3 bg-white rounded shadow-sm">
                        <i class="fas fa-heartbeat fa-2x text-primary mb-2"></i>
                        <p class="mb-0 small fw-bold">Sức Khỏe</p>
                    </div>
                </div>
                <div class="col-6 col-md-2 mb-3">
                    <div class="category-icon-box p-3 bg-white rounded shadow-sm">
                        <i class="fas fa-spa fa-2x text-pink mb-2"></i>
                        <p class="mb-0 small fw-bold">Làm Đẹp</p>
                    </div>
                </div>
                <div class="col-6 col-md-2 mb-3">
                    <div class="category-icon-box p-3 bg-white rounded shadow-sm">
                        <i class="fas fa-weight fa-2x text-info mb-2"></i>
                        <p class="mb-0 small fw-bold">Cân nặng</p>
                    </div>
                </div>
                <div class="col-6 col-md-2 mb-3">
                    <div class="category-icon-box p-3 bg-white rounded shadow-sm">
                        <i class="fas fa-flask fa-2x text-warning mb-2"></i>
                        <p class="mb-0 small fw-bold">Nội tiết</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Flash Sale -->
    @if(isset($flashSale) && $flashSale->isActive())
        <section class="flash-sale-section py-5 bg-danger text-white">
            <div class="container">
                <div class="text-center mb-4">
                    <h2 class="fw-bold mb-3">Flash sale giáng sinh</h2>
                    <p class="mb-2">KẾT THÚC SAU</p>
                    <div class="flash-sale-countdown" data-end-time="{{ $flashSale->end_time->toIso8601String() }}">
                        <!-- Countdown sẽ được render bởi JavaScript -->
                    </div>
                </div>
                <div class="row g-4">
                    @foreach($flashSale->products->take(6) as $flashSaleProduct)
                        @php $product = $flashSaleProduct->product; @endphp
                        <div class="col-6 col-md-4 col-lg-2">
                            <div class="card product-card h-100 bg-white">
                                <a href="{{ route('products.show', $product->slug) }}">
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300' }}"
                                        class="card-img-top product-image" alt="{{ $product->name }}">
                                </a>
                                <div class="card-body p-2">
                                    <h6 class="card-title small mb-2" style="min-height: 40px;">{{ Str::limit($product->name, 50) }}
                                    </h6>
                                    <div class="mb-2">
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <span
                                                class="product-price small">{{ number_format($flashSaleProduct->sale_price) }}đ</span>
                                            <span class="product-sale-price small">{{ number_format($product->price) }}đ</span>
                                        </div>
                                        <span
                                            class="product-discount small">-{{ round((($product->price - $flashSaleProduct->sale_price) / $product->price) * 100) }}%</span>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">
                                            <i class="fas fa-truck me-1"></i>Miễn phí vận chuyển
                                        </small>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Đã bán {{ $product->sales_count }}</small>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-sm w-100 add-to-cart-btn"
                                        data-product-id="{{ $product->id }}">
                                        <i class="fas fa-cart-plus me-1"></i>Thêm vào giỏ
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-light">Xem tất cả</a>
                </div>
            </div>
        </section>
    @endif

    <!-- Banner Section -->
    @if(isset($section1Banners) && $section1Banners->count() > 0)
        <section class="banner-section py-4">
            <div class="container">
                <div class="row g-3">
                    @foreach($section1Banners as $banner)
                        <div class="col-md-4">
                            <div class="banner-item rounded overflow-hidden">
                                <a href="{{ $banner->link_url ?? '#' }}">
                                    <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title ?? 'Banner' }}"
                                        class="img-fluid w-100">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Featured Products - Bán chạy nhất -->
    <section class="featured-products py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Bán chạy nhất</h2>
                <a href="{{ route('products.index') }}" class="btn btn-outline-primary">Xem tất cả</a>
            </div>
            <div class="row g-4">
                @foreach($featuredProducts->take(8) as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card product-card h-100">
                            <a href="{{ route('products.show', $product->slug) }}">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300' }}"
                                    class="card-img-top product-image" alt="{{ $product->name }}">
                            </a>
                            <div class="card-body">
                                <h6 class="card-title" style="min-height: 40px;">{{ Str::limit($product->name, 50) }}</h6>
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
                                <button type="button" class="btn btn-primary w-100 btn-sm add-to-cart-btn"
                                    data-product-id="{{ $product->id }}">
                                    <i class="fas fa-cart-plus me-1"></i>Thêm vào giỏ
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Sức Khỏe Products -->
    @if($healthProducts->count() > 0 && $healthCategory)
        <section class="category-products py-5 bg-light">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">
                        <i class="fas fa-heartbeat text-primary me-2"></i>{{ $healthCategory->name }}
                    </h2>
                    <a href="{{ route('category.show', $healthCategory->slug) }}" class="btn btn-outline-primary">Xem tất cả</a>
                </div>
                <div class="row g-4">
                    @foreach($healthProducts as $product)
                        <div class="col-6 col-md-4 col-lg-2">
                            @include('partials.product-card', ['product' => $product])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Banner Section 2 -->
    @if(isset($section2Banners) && $section2Banners->count() > 0)
        <section class="banner-section py-4">
            <div class="container">
                <div class="row g-3">
                    @foreach($section2Banners as $banner)
                        <div class="col-md-6">
                            <div class="banner-item rounded overflow-hidden">
                                <a href="{{ $banner->link_url ?? '#' }}">
                                    <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title ?? 'Banner' }}"
                                        class="img-fluid w-100">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Làm Đẹp Products -->
    @if($beautyProducts->count() > 0 && $beautyCategory)
        <section class="category-products py-5">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">
                        <i class="fas fa-spa text-pink me-2"></i>{{ $beautyCategory->name }}
                    </h2>
                    <a href="{{ route('category.show', $beautyCategory->slug) }}" class="btn btn-outline-primary">Xem tất cả</a>
                </div>
                <div class="row g-4">
                    @foreach($beautyProducts as $product)
                        <div class="col-6 col-md-4 col-lg-2">
                            @include('partials.product-card', ['product' => $product])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Cân Nặng Products -->
    @if($weightProducts->count() > 0 && $weightCategory)
        <section class="category-products py-5 bg-light">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">
                        <i class="fas fa-weight text-info me-2"></i>{{ $weightCategory->name }}
                    </h2>
                    <a href="{{ route('category.show', $weightCategory->slug) }}" class="btn btn-outline-primary">Xem tất cả</a>
                </div>
                <div class="row g-4">
                    @foreach($weightProducts as $product)
                        <div class="col-6 col-md-4 col-lg-2">
                            @include('partials.product-card', ['product' => $product])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Nội Tiết Products -->
    @if($hormoneProducts->count() > 0 && $hormoneCategory)
        <section class="category-products py-5">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">
                        <i class="fas fa-flask text-warning me-2"></i>{{ $hormoneCategory->name }}
                    </h2>
                    <a href="{{ route('category.show', $hormoneCategory->slug) }}" class="btn btn-outline-primary">Xem tất
                        cả</a>
                </div>
                <div class="row g-4">
                    @foreach($hormoneProducts as $product)
                        <div class="col-6 col-md-4 col-lg-2">
                            @include('partials.product-card', ['product' => $product])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Latest Blog Posts -->
    @if(isset($latestPosts) && $latestPosts->count() > 0)
        <section class="latest-posts py-5 bg-light">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">Tin tức nổi bật</h2>
                    <a href="{{ route('blog.index') }}" class="btn btn-outline-primary">Xem tất cả</a>
                </div>
                <div class="row g-4">
                    @foreach($latestPosts->take(4) as $post)
                        <div class="col-md-3">
                            <div class="card h-100">
                                <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : 'https://via.placeholder.com/300' }}"
                                    class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h6 class="card-title">{{ Str::limit($post->title, 60) }}</h6>
                                    <p class="card-text text-muted small mb-2">
                                        {{ Str::limit(strip_tags($post->excerpt ?? $post->content), 100) }}
                                    </p>
                                    <small class="text-muted d-block mb-2">{{ $post->published_at->format('d/m/Y') }} - An Trần
                                        Authentic</small>
                                    <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-sm btn-outline-primary">Đọc
                                        thêm</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@push('scripts')
    <script>
        // Initialize Hero Swiper
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.hero-swiper', {
                slidesPerView: 1,
                spaceBetween: 10,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                autoplay: {
                    delay: 5000,
                },
            });
        });
    </script>
@endpush