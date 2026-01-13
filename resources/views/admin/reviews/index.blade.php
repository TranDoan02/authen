@extends('admin.layout')

@section('title', 'Quản lý đánh giá')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Quản lý đánh giá</h2>
        <a href="{{ route('admin.reviews.bulk-create') }}" class="btn btn-success">
            <i class="fas fa-magic me-2"></i>Tạo hàng loạt
        </a>
    </div>

    <!-- Search & Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.reviews.index') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="search" placeholder="Tên khách, nội dung, SĐT..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="product_id">
                            <option value="">Tất cả sản phẩm</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" name="status">
                            <option value="">Tất cả trạng thái</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ duyệt</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Đã duyệt</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary w-100">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Reviews Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">ID</th>
                            <th>Sản phẩm</th>
                            <th>Người gửi</th>
                            <th style="width: 120px;">Xếp hạng</th>
                            <th>Nội dung</th>
                            <th>Trạng thái</th>
                            <th style="width: 110px;">Ngày tạo</th>
                            <th style="width: 150px;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $review)
                            <tr>
                                <td>{{ $review->id }}</td>
                                <td>
                                    <a href="{{ route('products.show', $review->product->slug) }}" target="_blank"
                                        class="text-decoration-none">
                                        {{ Str::limit($review->product->name, 30) }}
                                    </a>
                                </td>
                                <td>
                                    <strong>{{ $review->name }}</strong><br>
                                    <small class="text-muted">{{ $review->phone }}</small>
                                </td>
                                <td class="text-warning">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $review->rating ? '' : '-half-alt text-muted' }}"></i>
                                    @endfor
                                </td>
                                <td>
                                    <p class="mb-0 small" title="{{ $review->comment }}">
                                        {{ Str::limit($review->comment, 80) }}
                                    </p>
                                </td>
                                <td>
                                    <form action="{{ route('admin.reviews.toggle-approval', $review->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="btn btn-sm btn-{{ $review->is_approved ? 'success' : 'warning' }}">
                                            {{ $review->is_approved ? 'Đã duyệt' : 'Chờ duyệt' }}
                                        </button>
                                    </form>
                                </td>
                                <td><small>{{ $review->created_at->format('d/m/Y H:i') }}</small></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-outline-primary"
                                            title="Sửa">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa đánh giá này?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Xóa">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">Không có đánh giá nào phù hợp</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
@endsection