@extends('admin.layout')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Chi tiết sản phẩm: {{ $product->name }}</h2>
    <div>
        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>Sửa
        </a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Thông tin sản phẩm</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="200">ID</th>
                        <td>{{ $product->id }}</td>
                    </tr>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $product->slug }}</td>
                    </tr>
                    <tr>
                        <th>SKU</th>
                        <td>{{ $product->sku ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Danh mục</th>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Giá</th>
                        <td>
                            @if($product->sale_price)
                                <span class="text-danger fw-bold">{{ number_format($product->sale_price) }}đ</span>
                                <span class="text-muted text-decoration-line-through ms-2">{{ number_format($product->price) }}đ</span>
                                <span class="badge bg-danger ms-2">-{{ $product->discount_percent }}%</span>
                            @else
                                <span class="fw-bold">{{ number_format($product->price) }}đ</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Tồn kho</th>
                        <td>
                            <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                {{ $product->stock }} sản phẩm
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td>
                            <span class="badge bg-{{ $product->is_active ? 'success' : 'danger' }}">
                                {{ $product->is_active ? 'Hoạt động' : 'Tạm dừng' }}
                            </span>
                            @if($product->is_featured)
                                <span class="badge bg-warning ms-2">Nổi bật</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Đánh giá</th>
                        <td>
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $product->rating ? 'text-warning' : 'text-muted' }}"></i>
                            @endfor
                            <span class="ms-2">({{ $product->rating_count }} đánh giá)</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Đã bán</th>
                        <td>{{ $product->sales_count }} sản phẩm</td>
                    </tr>
                    <tr>
                        <th>Lượt xem</th>
                        <td>{{ $product->views }} lượt</td>
                    </tr>
                    <tr>
                        <th>Mô tả ngắn</th>
                        <td>{{ $product->short_description ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Mô tả chi tiết</th>
                        <td>{!! $product->description ?? 'N/A' !!}</td>
                    </tr>
                    <tr>
                        <th>Meta Title</th>
                        <td>{{ $product->meta_title ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Meta Description</th>
                        <td>{{ $product->meta_description ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Ngày tạo</th>
                        <td>{{ $product->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Cập nhật lần cuối</th>
                        <td>{{ $product->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Images -->
        @if($product->images->count() > 0)
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Hình ảnh sản phẩm</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @if($product->image)
                        <div class="col-md-3">
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     class="img-thumbnail w-100" alt="Main" style="height: 200px; object-fit: cover;">
                                <span class="badge bg-primary position-absolute top-0 start-0 m-2">Hình chính</span>
                            </div>
                        </div>
                    @endif
                    @foreach($product->images as $image)
                        <div class="col-md-3">
                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                 class="img-thumbnail w-100" alt="Image" style="height: 200px; object-fit: cover;">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Reviews -->
        @if($product->reviews->count() > 0)
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Đánh giá ({{ $product->reviews->count() }})</h5>
            </div>
            <div class="card-body">
                @foreach($product->reviews as $review)
                    <div class="border-bottom pb-3 mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <div>
                                <strong>{{ $review->name }}</strong>
                                @if($review->user)
                                    <small class="text-muted">({{ $review->user->email }})</small>
                                @endif
                            </div>
                            <div>
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                            </div>
                        </div>
                        @if($review->comment)
                            <p class="mb-2">{{ $review->comment }}</p>
                        @endif
                        <small class="text-muted">{{ $review->created_at->format('d/m/Y H:i') }}</small>
                        <span class="badge bg-{{ $review->is_approved ? 'success' : 'warning' }} ms-2">
                            {{ $review->is_approved ? 'Đã duyệt' : 'Chờ duyệt' }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Thao tác nhanh</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="btn btn-info">
                        <i class="fas fa-external-link-alt me-2"></i>Xem trên website
                    </a>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Sửa sản phẩm
                    </a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" 
                          onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash me-2"></i>Xóa sản phẩm
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Thống kê</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Lượt xem:</strong>
                    <div class="progress mt-1">
                        <div class="progress-bar" role="progressbar" 
                             style="width: {{ min(100, ($product->views / 1000) * 100) }}%">
                            {{ $product->views }}
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Đã bán:</strong>
                    <div class="progress mt-1">
                        <div class="progress-bar bg-success" role="progressbar" 
                             style="width: {{ min(100, ($product->sales_count / 100) * 100) }}%">
                            {{ $product->sales_count }}
                        </div>
                    </div>
                </div>
                <div>
                    <strong>Đánh giá trung bình:</strong>
                    <div class="mt-1">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $product->rating ? 'text-warning' : 'text-muted' }}"></i>
                        @endfor
                        <span class="ms-2">{{ number_format($product->rating, 1) }}/5</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

