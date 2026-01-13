@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<h2 class="mb-4">Dashboard</h2>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Tổng sản phẩm</h5>
                <h2 class="mb-0">{{ $stats['total_products'] }}</h2>
                <small>Đang hoạt động: {{ $stats['active_products'] }}</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Tổng đơn hàng</h5>
                <h2 class="mb-0">{{ $stats['total_orders'] }}</h2>
                <small>Chờ xử lý: {{ $stats['pending_orders'] }}</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">Doanh thu</h5>
                <h2 class="mb-0">{{ number_format($stats['total_revenue']) }}đ</h2>
                <small>Tổng doanh thu</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h5 class="card-title">Người dùng</h5>
                <h2 class="mb-0">{{ $stats['total_users'] }}</h2>
                <small>Tổng số khách hàng</small>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Đơn hàng gần đây</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Mã đơn</th>
                                <th>Khách hàng</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ number_format($order->total) }}đ</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'delivered' ? 'success' : 'info') }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">Xem</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Chưa có đơn hàng nào</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Sản phẩm bán chạy</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse($topProducts as $product)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ Str::limit($product->name, 30) }}</strong><br>
                                <small class="text-muted">Đã bán: {{ $product->sales_count }}</small>
                            </div>
                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-sm btn-outline-primary">Xem</a>
                        </li>
                    @empty
                        <li class="list-group-item text-center">Chưa có sản phẩm nào</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

