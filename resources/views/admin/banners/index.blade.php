@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Quản lý Banner</h1>
            <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Thêm mới
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Hình ảnh</th>
                                <th>Tiêu đề</th>
                                <th>Vị trí</th>
                                <th>Thứ tự</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($banners as $banner)
                                <tr>
                                    <td style="width: 150px;">
                                        <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}"
                                            class="img-fluid rounded" style="max-height: 80px;">
                                    </td>
                                    <td>{{ $banner->title ?? 'N/A' }}</td>
                                    <td>
                                        @if($banner->position == 'hero_slider')
                                            <span class="badge bg-primary">Hero Slider</span>
                                        @elseif($banner->position == 'banner_section_1')
                                            <span class="badge bg-info">Banner Section 1</span>
                                        @elseif($banner->position == 'banner_section_2')
                                            <span class="badge bg-secondary">Banner Section 2</span>
                                        @else
                                            <span class="badge bg-dark">{{ $banner->position }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $banner->display_order }}</td>
                                    <td>
                                        @if($banner->is_active)
                                            <span class="badge bg-success">Hiển thị</span>
                                        @else
                                            <span class="badge bg-danger">Ẩn</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Chưa có banner nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection