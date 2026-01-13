@extends('admin.layout')

@section('title', 'Sửa bài viết')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Sửa bài viết: {{ $post->title }}</h2>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Tiêu đề *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                value="{{ old('title', $post->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug"
                                value="{{ old('slug', $post->slug) }}">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mô tả ngắn</label>
                            <textarea class="form-control" name="excerpt"
                                rows="3">{{ old('excerpt', $post->excerpt) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nội dung *</label>
                            <textarea id="content" class="form-control @error('content') is-invalid @enderror"
                                name="content" rows="15">{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Sử dụng editor để định dạng nội dung</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Danh mục</label>
                            <select class="form-select" name="category_id">
                                <option value="">Chọn danh mục</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Hình ảnh đại diện</label>
                            @if($post->featured_image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Current"
                                        class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            @endif
                            <input type="file" class="form-control" name="featured_image" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_published" id="is_published"
                                    value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_published">Xuất bản</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ngày xuất bản</label>
                            <input type="datetime-local" class="form-control" name="published_at"
                                value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" class="form-control" name="meta_title"
                                value="{{ old('meta_title', $post->meta_title) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea class="form-control" name="meta_description"
                                rows="3">{{ old('meta_description', $post->meta_description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">
                                <strong>Tác giả:</strong> {{ $post->author->name ?? 'N/A' }}<br>
                                <strong>Lượt xem:</strong> {{ $post->views }}<br>
                                <strong>Ngày tạo:</strong> {{ $post->created_at->format('d/m/Y H:i') }}
                            </small>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Cập nhật bài viết</button>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            tinymce.init({
                selector: '#content',
                height: 500,
                menubar: true,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic forecolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help | image | link | code',
                content_style: 'body { font-family: Arial, sans-serif; font-size: 14px; }',
                language: 'vi',
                image_advtab: true,
                file_picker_types: 'image',
                file_picker_callback: function (cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');

                    input.onchange = function () {
                        var file = this.files[0];
                        var reader = new FileReader();

                        reader.onload = function () {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), { title: file.name });
                        };
                        reader.readAsDataURL(file);
                    };

                    input.click();
                },
                setup: function (editor) {
                    editor.on('init', function () {
                        editor.getBody().style.fontSize = '14px';
                    });
                }
            });
        });
    </script>
@endpush