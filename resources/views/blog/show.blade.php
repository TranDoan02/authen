@extends('layouts.app')

@section('title', $post->title . ' - Nongnghiepvathucpham-AFTD.com')
@section('description', $post->excerpt ?? Str::limit(strip_tags($post->content), 160))

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Tin tức</a></li>
            @if($post->category)
                <li class="breadcrumb-item"><a href="{{ route('blog.index', ['category' => $post->category->id]) }}">{{ $post->category->name }}</a></li>
            @endif
            <li class="breadcrumb-item active">{{ Str::limit($post->title, 50) }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-9">
            <article>
                @if($post->featured_image)
                    <img src="{{ asset('storage/' . $post->featured_image) }}" class="img-fluid rounded mb-4" alt="{{ $post->title }}">
                @endif

                <h1 class="mb-3">{{ $post->title }}</h1>

                <div class="d-flex align-items-center text-muted mb-4">
                    @if($post->category)
                        <span class="badge bg-primary me-2">{{ $post->category->name }}</span>
                    @endif
                    <small class="me-3"><i class="far fa-calendar me-1"></i>{{ $post->published_at->format('d/m/Y') }}</small>
                    <small class="me-3"><i class="far fa-eye me-1"></i>{{ $post->views }} lượt xem</small>
                    @if($post->author)
                        <small><i class="far fa-user me-1"></i>{{ $post->author->name }}</small>
                    @endif
                </div>

                <div class="post-content">
                    {!! $post->content !!}
                </div>
            </article>

            @if($relatedPosts->count() > 0)
                <div class="mt-5">
                    <h3 class="mb-4">Bài viết liên quan</h3>
                    <div class="row">
                        @foreach($relatedPosts as $relatedPost)
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <img src="{{ $relatedPost->featured_image ? asset('storage/' . $relatedPost->featured_image) : 'https://via.placeholder.com/300' }}" 
                                         class="card-img-top" alt="{{ $relatedPost->title }}" style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ Str::limit($relatedPost->title, 60) }}</h6>
                                        <p class="card-text text-muted small">{{ Str::limit(strip_tags($relatedPost->excerpt ?? $relatedPost->content), 100) }}</p>
                                        <a href="{{ route('blog.show', $relatedPost->slug) }}" class="btn btn-sm btn-outline-primary">Đọc thêm</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">Bài viết mới nhất</h6>
                </div>
                <div class="list-group list-group-flush">
                    @php
                        $latestPosts = \App\Models\Post::where('is_published', true)
                            ->where('id', '!=', $post->id)
                            ->orderBy('published_at', 'desc')
                            ->limit(5)
                            ->get();
                    @endphp
                    @foreach($latestPosts as $latestPost)
                        <a href="{{ route('blog.show', $latestPost->slug) }}" class="list-group-item list-group-item-action">
                            <h6 class="mb-1">{{ Str::limit($latestPost->title, 50) }}</h6>
                            <small class="text-muted">{{ $latestPost->published_at->format('d/m/Y') }}</small>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

