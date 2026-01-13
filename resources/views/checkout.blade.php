@extends('layouts.app')

@section('title', 'Thanh toán - Nongnghiep')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Thanh toán</h2>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Thông tin giao hàng</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Họ và tên *</label>
                                    <input type="text" class="form-control" name="customer_name"
                                        value="{{ auth()->user()->name ?? '' }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="email" class="form-control" name="customer_email"
                                        value="{{ auth()->user()->email ?? '' }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Số điện thoại *</label>
                                    <input type="text" class="form-control" name="customer_phone" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Thành phố *</label>
                                    <input type="text" class="form-control" name="shipping_city" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Quận/Huyện</label>
                                    <input type="text" class="form-control" name="shipping_district">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phường/Xã</label>
                                    <input type="text" class="form-control" name="shipping_ward">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Địa chỉ chi tiết *</label>
                                    <textarea class="form-control" name="shipping_address" rows="3" required></textarea>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Ghi chú</label>
                                    <textarea class="form-control" name="notes" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Phương thức thanh toán</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Lưu ý:</strong> Tính năng thanh toán đang được phát triển.
                                Hiện tại bạn có thể đặt hàng và chúng tôi sẽ liên hệ lại để xác nhận đơn hàng.
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod"
                                    checked>
                                <label class="form-check-label" for="cod">
                                    <strong>Thanh toán khi nhận hàng (COD)</strong>
                                    <br><small class="text-muted">Thanh toán bằng tiền mặt khi nhận hàng</small>
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="bank"
                                    value="bank_transfer" disabled>
                                <label class="form-check-label text-muted" for="bank">
                                    Chuyển khoản ngân hàng
                                    <br><small class="text-muted">(Sắp có)</small>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="online"
                                    value="online" disabled>
                                <label class="form-check-label text-muted" for="online">
                                    Thanh toán online
                                    <br><small class="text-muted">(Sắp có)</small>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card sticky-top" style="top: 20px;">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Đơn hàng</h5>
                        </div>
                        <div class="card-body">
                            @foreach($cartItems as $item)
                                <div class="d-flex justify-content-between mb-2">
                                    <div>
                                        <small>{{ $item->product->name }}</small>
                                        <br>
                                        <small class="text-muted">x{{ $item->quantity }}</small>
                                    </div>
                                    <strong>{{ number_format($item->price * $item->quantity) }}đ</strong>
                                </div>
                            @endforeach
                            <hr>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tạm tính:</span>
                                <strong>{{ number_format($subtotal) }}đ</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Phí vận chuyển:</span>
                                <span>Miễn phí</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <strong>Tổng cộng:</strong>
                                <strong class="text-danger fs-5">{{ number_format($subtotal) }}đ</strong>
                            </div>
                            <button type="submit" class="btn btn-danger w-100 btn-lg">
                                Đặt hàng
                            </button>
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-primary w-100 mt-2 btn-lg">
                                Quay lại giỏ hàng
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection