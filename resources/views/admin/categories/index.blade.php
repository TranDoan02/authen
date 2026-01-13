@extends('admin.layout')

@section('title', 'Quản lý danh mục')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Quản lý danh mục</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Thêm danh mục
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Slug</th>
                        <th>Danh mục cha</th>
                        <th>Sắp xếp</th>
                        <th>Trạng thái</th>
                        <th>Sản phẩm</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>
                                <strong>{{ $category->name }}</strong>
                                @if($category->children->count() > 0)
                                    <span class="badge bg-info">{{ $category->children->count() }} danh mục con</span>
                                @endif
                            </td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->parent->name ?? 'Root' }}</td>
                            <td>{{ $category->sort_order }}</td>
                            <td>
                                <span class="badge bg-{{ $category->is_active ? 'success' : 'danger' }}">
                                    {{ $category->is_active ? 'Hoạt động' : 'Tạm dừng' }}
                                </span>
                            </td>
                            <td>{{ $category->products->count() }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-info" title="Xem">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning" title="Sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Xóa">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @foreach($category->children as $child)
                            <tr class="table-light">
                                <td>{{ $child->id }}</td>
                                <td class="ps-4">└─ {{ $child->name }}</td>
                                <td>{{ $child->slug }}</td>
                                <td>{{ $child->parent->name }}</td>
                                <td>{{ $child->sort_order }}</td>
                                <td>
                                    <span class="badge bg-{{ $child->is_active ? 'success' : 'danger' }}">
                                        {{ $child->is_active ? 'Hoạt động' : 'Tạm dừng' }}
                                    </span>
                                </td>
                                <td>{{ $child->products->count() }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.categories.edit', $child->id) }}" class="btn btn-warning" title="Sửa">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $child->id) }}" method="POST" class="d-inline" 
                                              onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Xóa">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

