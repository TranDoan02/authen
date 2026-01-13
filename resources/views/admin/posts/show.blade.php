@extends('admin.layout')

@section('title', 'Chi tiết bài viết')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Chi tiết bài viết: {{ $post->title }}</h2>
    <div>
        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i>Sửa
        </a>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Nội dung bài viết</h5>
            </div>
            <div class="card-body">
                @if($post->featured_image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $post->featured_image) }}" 
                             class="img-fluid rounded" alt="{{ $post->title }}">
                    </div>
                @endif

                <h3 class="mb-3">{{ $post->title }}</h3>

                <div class="d-flex align-items-center text-muted mb-4">
                    @if($post->category)
                        <span class="badge bg-primary me-2">{{ $post->category->name }}</span>
                    @endif
                    <small class="me-3"><i class="far fa-calendar me-1"></i>{{ $post->published_at ? $post->published_at->format('d/m/Y') : 'Chưa đăng' }}</small>
                    <small class="me-3"><i class="far fa-eye me-1"></i>{{ $post->views }} lượt xem</small>
                    @if($post->author)
                        <small><i class="far fa-user me-1"></i>{{ $post->author->name }}</small>
                    @endif
                </div>

                @if($post->excerpt)
                    <div class="alert alert-info">
                        <strong>Mô tả ngắn:</strong> {{ $post->excerpt }}
                    </div>
                @endif

                <div class="post-content">
                    {!! $post->content !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Thông tin bài viết</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm table-bordered">
                    <tr>
                        <th width="120">ID</th>
                        <td>{{ $post->id }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $post->slug }}</td>
                    </tr>
                    <tr>
                        <th>Danh mục</th>
                        <td>{{ $post->category->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Tác giả</th>
                        <td>{{ $post->author->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Trạng thái</th>
                        <td>
                            <span class="badge bg-{{ $post->is_published ? 'success' : 'warning' }}">
                                {{ $post->is_published ? 'Đã xuất bản' : 'Bản nháp' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Ngày xuất bản</th>
                        <td>{{ $post->published_at ? $post->published_at->format('d/m/Y H:i') : 'Chưa đăng' }}</td>
                    </tr>
                    <tr>
                        <th>Lượt xem</th>
                        <td>{{ $post->views }}</td>
                    </tr>
                    <tr>
                        <th>Ngày tạo</th>
                        <td>{{ $post->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Cập nhật</th>
                        <td>{{ $post->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">SEO</h5>
            </div>
            <div class="card-body">
                <p><strong>Meta Title:</strong><br>{{ $post->meta_title ?? 'N/A' }}</p>
                <p><strong>Meta Description:</strong><br>{{ $post->meta_description ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Thao tác nhanh</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="btn btn-info">
                        <i class="fas fa-external-link-alt me-2"></i>Xem trên website
                    </a>
                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Sửa bài viết
                    </a>
                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" 
                          onsubmit="return confirm('Bạn có chắc muốn xóa bài viết này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash me-2"></i>Xóa bài viết
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

