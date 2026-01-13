@extends('layouts.app')

@section('title', 'Đơn hàng của tôi - Nongnghiepvathucpham-AFTD.com')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4">Đơn hàng của tôi</h2>

        @if($orders->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Ngày đặt</th>
                            <th>Sản phẩm</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    {{ $order->items->count() }} sản phẩm
                                </td>
                                <td><strong>{{ number_format($order->total) }}đ</strong></td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'pending' => 'warning',
                                            'processing' => 'info',
                                            'shipped' => 'primary',
                                            'delivered' => 'success',
                                            'cancelled' => 'danger'
                                        ];
                                        $statusLabels = [
                                            'pending' => 'Chờ xử lý',
                                            'processing' => 'Đang xử lý',
                                            'shipped' => 'Đã giao hàng',
                                            'delivered' => 'Đã nhận hàng',
                                            'cancelled' => 'Đã hủy'
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                                        {{ $statusLabels[$order->status] ?? $order->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                                        Xem chi tiết
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-box fa-5x text-muted mb-3"></i>
                <h4>Chưa có đơn hàng nào</h4>
                <p class="text-muted">Bạn chưa có đơn hàng nào.</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Mua sắm ngay</a>
            </div>
        @endif
    </div>
@endsection