@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng - Nongnghiepvathucpham-AFTD.com')

@section('content')
    <div class="container py-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Đơn hàng</a></li>
                <li class="breadcrumb-item active">{{ $order->order_number }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Chi tiết đơn hàng</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($item->product && $item->product->image)
                                                    <img src="{{ asset('storage/' . $item->product->image) }}" class="me-3"
                                                        style="width: 60px; height: 60px; object-fit: cover;">
                                                @endif
                                                <div>
                                                    <strong>{{ $item->product_name }}</strong>
                                                    @if($item->product_sku)
                                                        <br><small class="text-muted">SKU: {{ $item->product_sku }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->price) }}đ</td>
                                        <td><strong>{{ number_format($item->total) }}đ</strong></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Thông tin đơn hàng</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Mã đơn hàng:</strong><br>{{ $order->order_number }}</p>
                        <p><strong>Ngày đặt:</strong><br>{{ $order->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Trạng thái:</strong><br>
                            @php
                                $statusLabels = [
                                    'pending' => 'Chờ xử lý',
                                    'processing' => 'Đang xử lý',
                                    'shipped' => 'Đã giao hàng',
                                    'delivered' => 'Đã nhận hàng',
                                    'cancelled' => 'Đã hủy'
                                ];
                            @endphp
                            <span
                                class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'delivered' ? 'success' : 'info') }}">
                                {{ $statusLabels[$order->status] ?? $order->status }}
                            </span>
                        </p>
                        <p><strong>Phương thức thanh toán:</strong><br>
                            {{ $order->payment_method == 'cod' ? 'Thanh toán khi nhận hàng' :
        ($order->payment_method == 'bank_transfer' ? 'Chuyển khoản' : 'Thanh toán online') }}
                        </p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Thông tin giao hàng</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>{{ $order->customer_name }}</strong></p>
                        <p>{{ $order->shipping_address }}<br>
                            {{ $order->shipping_ward }}, {{ $order->shipping_district }}<br>
                            {{ $order->shipping_city }}</p>
                        <p><i class="fas fa-phone me-2"></i>{{ $order->customer_phone }}</p>
                        <p><i class="fas fa-envelope me-2"></i>{{ $order->customer_email }}</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Tổng cộng</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tạm tính:</span>
                            <strong>{{ number_format($order->subtotal) }}đ</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Phí vận chuyển:</span>
                            <span>{{ number_format($order->shipping_fee) }}đ</span>
                        </div>
                        @if($order->discount > 0)
                            <div class="d-flex justify-content-between mb-2">
                                <span>Giảm giá:</span>
                                <span class="text-danger">-{{ number_format($order->discount) }}đ</span>
                            </div>
                        @endif
                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong>Tổng cộng:</strong>
                            <strong class="text-danger fs-5">{{ number_format($order->total) }}đ</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection