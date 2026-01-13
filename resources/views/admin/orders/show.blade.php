@extends('admin.layout')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Chi tiết đơn hàng: {{ $order->order_number }}</h2>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Quay lại</a>
</div>

<div class="row g-4">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Sản phẩm trong đơn</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
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
                                                <img src="{{ asset('storage/' . $item->product->image) }}" 
                                                     class="me-3" style="width: 60px; height: 60px; object-fit: cover;">
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
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Thông tin đơn hàng</h5>
            </div>
            <div class="card-body">
                <p><strong>Mã đơn hàng:</strong><br>{{ $order->order_number }}</p>
                <p><strong>Ngày đặt:</strong><br>{{ $order->created_at->format('d/m/Y H:i') }}</p>
                
                <div class="mb-3">
                    <label class="form-label"><strong>Trạng thái:</strong></label>
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Đã giao hàng</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Đã nhận hàng</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                    </form>
                </div>

                <p><strong>Phương thức thanh toán:</strong><br>
                    {{ $order->payment_method == 'cod' ? 'Thanh toán khi nhận hàng' : 
                       ($order->payment_method == 'bank_transfer' ? 'Chuyển khoản' : 'Thanh toán online') }}
                </p>
                <p><strong>Trạng thái thanh toán:</strong><br>
                    <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">
                        {{ $order->payment_status == 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                    </span>
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
                @if($order->notes)
                    <p><strong>Ghi chú:</strong><br>{{ $order->notes }}</p>
                @endif
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
@endsection

