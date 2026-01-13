@extends('layouts.app')

@section('title', 'Giỏ hàng - Nongnghiepvathucpham-AFTD.com')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Giỏ hàng của bạn</h2>

        @if($cartItems->count() > 0)
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            @foreach($cartItems as $item)
                                <div class="cart-item border-bottom pb-3 mb-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://via.placeholder.com/100' }}"
                                                class="img-fluid rounded" alt="{{ $item->product->name }}"
                                                style="max-width: 100px;">
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="mb-1">
                                                <a href="{{ route('products.show', $item->product->slug) }}"
                                                    class="text-decoration-none">
                                                    {{ $item->product->name }}
                                                </a>
                                            </h6>
                                            <small class="text-muted d-block">SKU: {{ $item->product->sku ?? 'N/A' }}</small>
                                            <small class="text-muted">
                                                {{ number_format($item->price) }}đ / sản phẩm
                                            </small>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="input-group" style="width: 120px;">
                                                <button class="btn btn-outline-secondary btn-sm" type="button"
                                                    onclick="updateCartItem({{ $item->id }}, Math.max(1, parseInt(document.getElementById('qty-{{ $item->id }}').value) - 1))">-</button>
                                                <input type="number" class="form-control form-control-sm text-center"
                                                    id="qty-{{ $item->id }}" value="{{ $item->quantity }}" min="1"
                                                    max="{{ $item->product->stock }}"
                                                    onchange="updateCartItem({{ $item->id }}, this.value)">
                                                <button class="btn btn-outline-secondary btn-sm" type="button"
                                                    onclick="updateCartItem({{ $item->id }}, parseInt(document.getElementById('qty-{{ $item->id }}').value) + 1)">+</button>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <strong
                                                class="text-danger">{{ number_format($item->price * $item->quantity) }}đ</strong>
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <button class="btn btn-sm btn-outline-danger" onclick="removeCartItem({{ $item->id }})"
                                                title="Xóa">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Tổng cộng</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tạm tính:</span>
                                <strong>{{ number_format($total) }}đ</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Phí vận chuyển:</span>
                                <span>Miễn phí</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <strong>Tổng cộng:</strong>
                                <strong class="text-danger">{{ number_format($total) }}đ</strong>
                            </div>
                            @auth
                                <a href="{{ route('checkout') }}" class="btn btn-danger w-100 btn-lg">
                                    <i class="fas fa-shopping-bag me-2"></i>Thanh toán
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-danger w-100 btn-lg">
                                    <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập để thanh toán
                                </a>
                            @endauth
                            <a href="{{ route('products.index') }}" class="btn btn-outline-primary w-100 mt-2">
                                Tiếp tục mua sắm
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-5x text-muted mb-3"></i>
                <h4>Giỏ hàng trống</h4>
                <p class="text-muted">Bạn chưa có sản phẩm nào trong giỏ hàng.</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Tiếp tục mua sắm</a>
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            function updateCartItem(id, quantity) {
                $.ajax({
                    url: '/cart/update/' + id,
                    method: 'PUT',
                    data: {
                        quantity: quantity,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            location.reload();
                        }
                    },
                    error: function () {
                        toastr.error('Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                });
            }

            function removeCartItem(id) {
                if (!confirm('Bạn có chắc muốn xóa sản phẩm này?')) return;

                $.ajax({
                    url: '/cart/remove/' + id,
                    method: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.message);
                            location.reload();
                        }
                    },
                    error: function () {
                        toastr.error('Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                });
            }
        </script>
    @endpush
@endsection