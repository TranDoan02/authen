@extends('layouts.app')

@section('title', 'Tin tức - Nongnghiepvathucpham-AFTD.com')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-9">
                <h2 class="mb-4">Tin tức</h2>

                <div class="row">
                    @forelse($posts as $post)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : 'https://via.placeholder.com/300' }}"
                                    class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    @if($post->category)
                                        <span class="badge bg-primary mb-2">{{ $post->category->name }}</span>
                                    @endif
                                    <h5 class="card-title">{{ Str::limit($post->title, 60) }}</h5>
                                    <p class="card-text text-muted small">
                                        {{ Str::limit(strip_tags($post->excerpt ?? $post->content), 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="far fa-calendar me-1"></i>{{ $post->published_at->format('d/m/Y') }}
                                        </small>
                                        <a href="{{ route('blog.show', $post->slug) }}"
                                            class="btn btn-sm btn-outline-primary">Đọc thêm</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                <p class="mb-0">Chưa có bài viết nào.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $posts->links() }}
                </div>
            </div>

            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0">Danh mục</h6>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('blog.index') }}"
                            class="list-group-item list-group-item-action {{ !request('category') ? 'active' : '' }}">
                            Tất cả
                        </a>
                        @foreach($categories as $category)
                            <a href="{{ route('blog.index', ['category' => $category->id]) }}"
                                class="list-group-item list-group-item-action {{ request('category') == $category->id ? 'active' : '' }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                @if($latestPosts->count() > 0)
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0">Bài viết mới nhất</h6>
                        </div>
                        <div class="list-group list-group-flush">
                            @foreach($latestPosts as $post)
                                <a href="{{ route('blog.show', $post->slug) }}" class="list-group-item list-group-item-action">
                                    <h6 class="mb-1">{{ Str::limit($post->title, 50) }}</h6>
                                    <small class="text-muted">{{ $post->published_at->format('d/m/Y') }}</small>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection