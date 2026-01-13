@extends('admin.layout')

@section('title', 'Chi tiết danh mục')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Chi tiết danh mục: {{ $category->name }}</h2>
    <div>
        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>Sửa
        </a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Thông tin danh mục</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="200">ID</th>
                        <td>{{ $category->id }}</td>
                    </tr>
                    <tr>
                        <th>Tên danh mục</th>
                        <td>{{ $category->name }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $category->slug }}</td>
                    </tr>
                    <tr>
                        <th>Danh mục cha</th>
                        <td>{{ $category->parent->name ?? 'Root (Không có)' }}</td>
                    </tr>
                    <tr>
                        <th>Mô tả</th>
                        <td>{{ $category->description ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Thứ tự sắp xếp</th>
                        <td>{{ $category->sort_order }}</td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td>
                            <span class="badge bg-{{ $category->is_active ? 'success' : 'danger' }}">
                                {{ $category->is_active ? 'Hoạt động' : 'Tạm dừng' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Số sản phẩm</th>
                        <td>
                            <span class="badge bg-info">{{ $category->products->count() }} sản phẩm</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Số danh mục con</th>
                        <td>
                            <span class="badge bg-secondary">{{ $category->children->count() }} danh mục</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Meta Title</th>
                        <td>{{ $category->meta_title ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Meta Description</th>
                        <td>{{ $category->meta_description ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Ngày tạo</th>
                        <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Cập nhật lần cuối</th>
                        <td>{{ $category->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if($category->image)
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Hình ảnh</h5>
            </div>
            <div class="card-body">
                <img src="{{ asset('storage/' . $category->image) }}" 
                     class="img-fluid rounded" alt="{{ $category->name }}" style="max-width: 500px;">
            </div>
        </div>
        @endif

        @if($category->children->count() > 0)
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Danh mục con ({{ $category->children->count() }})</h5>
            </div>
            <div class="card-body">
                <div class="list-group">
                    @foreach($category->children as $child)
                        <a href="{{ route('admin.categories.show', $child->id) }}" 
                           class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $child->name }}</strong>
                                    <br><small class="text-muted">{{ $child->slug }}</small>
                                </div>
                                <div>
                                    <span class="badge bg-info">{{ $child->products->count() }} sản phẩm</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        @if($category->products->count() > 0)
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Sản phẩm trong danh mục ({{ $category->products->count() }})</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Giá</th>
                                <th>Tồn kho</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category->products->take(10) as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ Str::limit($product->name, 50) }}</td>
                                    <td>{{ number_format($product->price) }}đ</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        <a href="{{ route('admin.products.show', $product->id) }}" 
                                           class="btn btn-sm btn-info">Xem</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($category->products->count() > 10)
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.products.index', ['category' => $category->id]) }}" 
                           class="btn btn-sm btn-primary">Xem tất cả {{ $category->products->count() }} sản phẩm</a>
                    </div>
                @endif
            </div>
        </div>
        @endif
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Thao tác nhanh</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('category.show', $category->slug) }}" target="_blank" class="btn btn-info">
                        <i class="fas fa-external-link-alt me-2"></i>Xem trên website
                    </a>
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Sửa danh mục
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" 
                          onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash me-2"></i>Xóa danh mục
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

