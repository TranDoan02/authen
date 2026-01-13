@extends('layouts.app')

@section('title', $product->name . ' - Nongnghiepvathucpham-AFTD.com')
@section('description', $product->short_description ?? Str::limit(strip_tags($product->description), 160))

@section('content')
    <div class="container py-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                @if($product->category)
                    <li class="breadcrumb-item"><a
                            href="{{ route('category.show', $product->category->slug) }}">{{ $product->category->name }}</a>
                    </li>
                @endif
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Product Images -->
            <div class="col-md-6">
                <div class="swiper product-images-swiper mb-3">
                    <div class="swiper-wrapper">
                        @if($product->image)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid"
                                    alt="{{ $product->name }}">
                            </div>
                        @endif
                        @foreach($product->images as $image)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid"
                                    alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-md-6">
                <h1 class="mb-3">{{ $product->name }}</h1>

                <div class="mb-3">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star {{ $i <= $product->rating ? 'text-warning' : 'text-muted' }}"></i>
                    @endfor
                    <span class="ms-2">({{ $product->rating_count }} đánh giá)</span>
                </div>

                <div class="mb-3">
                    @if($product->sale_price)
                        <h3 class="text-danger mb-1">{{ number_format($product->sale_price) }}đ</h3>
                        <span class="text-muted text-decoration-line-through">{{ number_format($product->price) }}đ</span>
                        <span class="badge bg-danger ms-2">-{{ $product->discount_percent }}%</span>
                    @else
                        <h3 class="text-danger">{{ number_format($product->price) }}đ</h3>
                    @endif
                </div>

                @if($product->short_description)
                    <div class="mb-3">
                        <p>{{ $product->short_description }}</p>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Số lượng:</label>
                    <div class="input-group" style="width: 150px;">
                        <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(-1)">-</button>
                        <input type="number" class="form-control text-center" id="quantity" value="1" min="1"
                            max="{{ $product->stock }}">
                        <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(1)">+</button>
                    </div>
                    <small class="text-muted">Còn {{ $product->stock }} sản phẩm</small>
                </div>

                <div class="d-grid gap-2 mb-3">
                    @if($product->stock > 0)
                        <button type="button" class="btn btn-danger btn-lg" id="add-to-cart-btn"
                            data-product-id="{{ $product->id }}">
                            <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ hàng
                        </button>
                        @auth
                            <a href="{{ route('checkout') }}?product_id={{ $product->id }}&quantity=1"
                                class="btn btn-primary btn-lg">
                                <i class="fas fa-bolt me-2"></i>Mua ngay
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập để mua ngay
                            </a>
                        @endauth
                    @else
                        <button class="btn btn-secondary btn-lg" disabled>
                            <i class="fas fa-times-circle me-2"></i>Hết hàng
                        </button>
                    @endif
                </div>

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Thông tin sản phẩm</h6>
                        <ul class="list-unstyled mb-0">
                            <li><strong>SKU:</strong> {{ $product->sku ?? 'N/A' }}</li>
                            <li><strong>Danh mục:</strong> {{ $product->category->name ?? 'N/A' }}</li>
                            <li><strong>Tình trạng:</strong>
                                <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $product->stock > 0 ? 'Còn hàng' : 'Hết hàng' }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Description -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#description">Mô tả</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#reviews-section">Đánh giá
                                    ({{ $product->reviews->count() }})</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="description">
                                {!! $product->description !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div id="reviews-section" class="card mt-5 border-0 shadow-sm rounded-4"
                    style="display: block !important; visibility: visible !important; opacity: 1 !important;">
                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex align-items-center mb-4">
                            <h3 class="mb-0 text-primary fw-bold">Đánh giá từ khách hàng</h3>
                            <div class="ms-3 badge bg-primary rounded-pill">{{ $product->reviews->count() }} nhận xét</div>
                        </div>
                        <hr class="mb-5">
                        <div class="row mb-5">
                            <div class="col-md-4 text-center border-end">
                                <h4 class="mb-2">Đánh giá trung bình</h4>
                                <div class="display-4 text-warning mb-2">{{ number_format($product->rating, 1) }}/5
                                </div>
                                <div class="mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $product->rating ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                </div>
                                <p class="text-muted">({{ $product->reviews->count() }} đánh giá)</p>
                            </div>
                            <div class="col-md-8 px-md-4">
                                @php
                                    $ratingCounts = $product->reviews->groupBy('rating')->map->count();
                                @endphp
                                @for($i = 5; $i >= 1; $i--)
                                    @php
                                        $count = $ratingCounts->get($i, 0);
                                        $percent = $product->reviews->count() > 0 ? ($count / $product->reviews->count()) * 100 : 0;
                                    @endphp
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="me-2" style="width: 50px;">{{ $i }} sao</div>
                                        <div class="progress flex-grow-1" style="height: 10px;">
                                            <div class="progress-bar bg-warning" role="progressbar"
                                                style="width: {{ $percent }}%"></div>
                                        </div>
                                        <div class="ms-2 text-muted" style="width: 100px;">{{ $count }} đánh giá</div>
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <div class="card mb-5 border-light shadow-sm bg-light">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Chia sẻ nhận xét của bạn</h5>
                                <form id="review-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    <div class="mb-4">
                                        <label class="form-label d-block">Chọn sao:</label>
                                        <div class="rating-input text-warning fs-4">
                                            <i class="far fa-star rating-star" data-rating="1" style="cursor: pointer;"></i>
                                            <i class="far fa-star rating-star" data-rating="2" style="cursor: pointer;"></i>
                                            <i class="far fa-star rating-star" data-rating="3" style="cursor: pointer;"></i>
                                            <i class="far fa-star rating-star" data-rating="4" style="cursor: pointer;"></i>
                                            <i class="far fa-star rating-star" data-rating="5" style="cursor: pointer;"></i>
                                            <input type="hidden" name="rating" id="review-rating" value="5">
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <input type="text" name="name" class="form-control" placeholder="Họ và tên"
                                                required value="{{ Auth::user()->name ?? '' }}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="phone" class="form-control" placeholder="Số điện thoại"
                                                required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <textarea name="comment" class="form-control" rows="4"
                                            placeholder="Nhận xét của bạn" required></textarea>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-4">
                                        <button type="button" class="btn btn-outline-warning rounded-pill px-4">
                                            <i class="fas fa-camera me-2"></i>Thêm hình ảnh
                                        </button>
                                        <button type="submit"
                                            class="btn btn-warning rounded-pill px-5 fw-bold shadow-sm">Gửi
                                            Đánh Giá</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="review-list">
                            <h5 class="mb-4">Các bình luận</h5>
                            @forelse($product->reviews as $review)
                                <div class="review-item mb-4 bg-white p-4 rounded-4 shadow-sm border">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar me-3 bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 50px; height: 50px; font-weight: bold;">
                                            {{ strtoupper(substr($review->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="d-flex align-items-center gap-2">
                                                <h6 class="mb-0 fw-bold">{{ $review->name }}</h6>
                                                <span class="badge bg-success-subtle text-success small">
                                                    <i class="fas fa-check-circle me-1"></i>Đã mua hàng tại
                                                    Nongnghiepvathucpham-AFTD.com
                                                </span>
                                            </div>
                                            <div class="mt-1">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }} small"></i>
                                                @endfor
                                                <small class="ms-2 text-muted fw-light">
                                                    <i class="far fa-thumbs-up me-1"></i>Like (0)
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ps-md-5 ms-md-2">
                                        <p class="mb-2 text-dark">{{ $review->comment }}</p>
                                        <div class="text-muted small">
                                            <i class="far fa-calendar-alt me-1"></i>{{ $review->created_at->format('d/m/Y') }}
                                        </div>

                                        <div class="mt-3 bg-light p-3 rounded-3 border-start border-4 border-warning">
                                            <div class="d-flex align-items-center mb-1">
                                                <img src="/images/logo-icon.png" class="me-2 rounded-circle"
                                                    style="width: 24px; height: 24px;" alt="Admin"
                                                    onerror="this.src='https://via.placeholder.com/24'">
                                                <span class="fw-bold me-2 small">Quản trị viên</span>
                                                <span class="badge bg-primary small" style="font-size: 0.6rem;">QTV</span>
                                            </div>
                                            <p class="mb-0 small text-muted">Chào bạn, Nongnghiepvathucpham-AFTD.com cảm ơn bạn
                                                đã quan tâm
                                                và tin dùng sản phẩm của Shop. Hy vọng bạn sẽ luôn ủng hộ Shop trong thời gian
                                                tới nhé.</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5 bg-light rounded-4">
                                    <i class="far fa-comment-dots fs-1 text-muted mb-3 d-block"></i>
                                    <p class="text-muted">Chưa có đánh giá nào cho sản phẩm này.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Related Products -->
                @if($relatedProducts->count() > 0)
                    <div class="row mt-5">
                        <div class="col-12">
                            <h3 class="mb-4">Sản phẩm cùng loại</h3>
                            <div class="row row-cols-2 row-cols-md-4 g-4">
                                @foreach($relatedProducts as $relatedProduct)
                                    <div class="col">
                                        @include('partials.product-card', ['product' => $relatedProduct])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Best Sellers -->
                @if($bestSellingProducts->count() > 0)
                    <div class="row mt-5">
                        <div class="col-12">
                            <h3 class="mb-4">Sản phẩm bán chạy</h3>
                            <div class="row row-cols-2 row-cols-md-4 g-4">
                                @foreach($bestSellingProducts as $bestSellingProduct)
                                    <div class="col">
                                        @include('partials.product-card', ['product' => $bestSellingProduct])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            @push('scripts')
                <script>
                    function changeQuantity(delta) {
                        const input = document.getElementById('quantity');
                        const currentValue = parseInt(input.value) || 1;
                        const max = parseInt(input.max) || 999;
                        const newValue = Math.max(1, Math.min(max, currentValue + delta));
                        input.value = newValue;
                    }

                    // Add to cart button handler
                    document.addEventListener('DOMContentLoaded', function () {
                        const addToCartBtn = document.getElementById('add-to-cart-btn');
                        if (addToCartBtn) {
                            addToCartBtn.addEventListener('click', function () {
                                const productId = this.getAttribute('data-product-id');
                                const quantityInput = document.getElementById('quantity');
                                const quantity = quantityInput ? parseInt(quantityInput.value) || 1 : 1;

                                // Check if addToCart function exists
                                if (typeof window.addToCart === 'function') {
                                    window.addToCart(productId, quantity);
                                } else {
                                    // Fallback: direct AJAX call
                                    console.warn('addToCart function not found, using fallback');
                                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                                    if (!csrfToken) {
                                        alert('CSRF token not found. Please refresh the page.');
                                        return;
                                    }

                                    const button = this;
                                    const originalText = button.innerHTML;
                                    button.disabled = true;
                                    button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang thêm...';

                                    fetch('/cart/add', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': csrfToken,
                                            'Accept': 'application/json'
                                        },
                                        body: JSON.stringify({
                                            product_id: productId,
                                            quantity: quantity
                                        })
                                    })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                if (typeof toastr !== 'undefined') {
                                                    toastr.success(
                                                        '<i class="fas fa-check-circle me-2"></i>' + data.message +
                                                        '<br><small class="text-muted">Giỏ hàng của bạn có ' + data.cart_count + ' sản phẩm</small>',
                                                        'Đã thêm vào giỏ hàng',
                                                        {
                                                            timeOut: 4000,
                                                            extendedTimeOut: 2000
                                                        }
                                                    );
                                                } else {
                                                    console.log('Toastr not available');
                                                }
                                                // Update cart count
                                                const cartCountEl = document.querySelectorAll('.cart-count');
                                                cartCountEl.forEach(el => {
                                                    if (data.cart_count !== undefined) {
                                                        el.textContent = data.cart_count > 0 ? data.cart_count : '';
                                                    }
                                                });
                                            } else {
                                                if (typeof toastr !== 'undefined') {
                                                    toastr.error(
                                                        '<i class="fas fa-exclamation-circle me-2"></i>' + (data.message || 'Có lỗi xảy ra'),
                                                        'Lỗi',
                                                        {
                                                            timeOut: 5000
                                                        }
                                                    );
                                                } else {
                                                    console.error('Error:', data.message || 'Có lỗi xảy ra');
                                                }
                                            }
                                            button.disabled = false;
                                            button.innerHTML = originalText;
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                            if (typeof toastr !== 'undefined') {
                                                toastr.error(
                                                    '<i class="fas fa-times-circle me-2"></i>Có lỗi xảy ra. Vui lòng thử lại.',
                                                    'Lỗi',
                                                    {
                                                        timeOut: 5000
                                                    }
                                                );
                                            } else {
                                                console.error('Error:', error);
                                            }
                                            button.disabled = false;
                                            button.innerHTML = originalText;
                                        });
                                }
                            });
                        }

                        console.log('Page loaded, addToCart function:', typeof window.addToCart);

                        // Review form handler
                        const reviewForm = document.getElementById('review-form');
                        if (reviewForm) {
                            // Star rating logic
                            const stars = document.querySelectorAll('.rating-star');
                            const ratingInput = document.getElementById('review-rating');

                            stars.forEach(star => {
                                star.addEventListener('mouseenter', function () {
                                    const rating = parseInt(this.getAttribute('data-rating'));
                                    highlightStars(rating);
                                });

                                star.addEventListener('mouseleave', function () {
                                    highlightStars(parseInt(ratingInput.value));
                                });

                                star.addEventListener('click', function () {
                                    const rating = parseInt(this.getAttribute('data-rating'));
                                    ratingInput.value = rating;
                                    highlightStars(rating);
                                });
                            });

                            function highlightStars(rating) {
                                stars.forEach(star => {
                                    const starRating = parseInt(star.getAttribute('data-rating'));
                                    if (starRating <= rating) {
                                        star.classList.remove('far');
                                        star.classList.add('fas');
                                    } else {
                                        star.classList.remove('fas');
                                        star.classList.add('far');
                                    }
                                });
                            }

                            // Initial highlight
                            highlightStars(parseInt(ratingInput.value));

                            reviewForm.addEventListener('submit', function (e) {
                                e.preventDefault();
                                const formData = new FormData(this);
                                const data = Object.fromEntries(formData.entries());
                                const button = this.querySelector('button[type="submit"]');
                                const originalText = button.innerHTML;

                                button.disabled = true;
                                button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang gửi...';

                                fetch('{{ route('reviews.store') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify(data)
                                })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            toastr.success(data.message);
                                            reviewForm.reset();
                                            ratingInput.value = 5;
                                            highlightStars(5);
                                        } else {
                                            toastr.error(data.message || 'Có lỗi xảy ra');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        toastr.error('Có lỗi xảy ra. Vui lòng thử lại.');
                                    })
                                    .finally(() => {
                                        button.disabled = false;
                                        button.innerHTML = originalText;
                                    });
                            });
                        }
                    });
                </script>
            @endpush
@endsection