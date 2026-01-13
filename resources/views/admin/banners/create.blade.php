@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Thêm Banner mới</h1>
            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                            <div class="mb-3">
                                <label class="form-label">Tiêu đề (Không bắt buộc)</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Hình ảnh <span class="text-danger">*</span></label>
                                <input type="file" name="image_path" class="form-control @error('image_path') is-invalid @enderror" required accept="image/*">
                                @error('image_path')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Link liên kết</label>
                                <input type="text" name="link_url" class="form-control @error('link_url') is-invalid @enderror" value="{{ old('link_url') }}"
                                    placeholder="https://...">
                                @error('link_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Vị trí hiển thị <span class="text-danger">*</span></label>
                                <select name="position" class="form-select @error('position') is-invalid @enderror" required>
                                    <option value="hero_slider" {{ old('position') == 'hero_slider' ? 'selected' : '' }}>Hero
                                        Slider (Trang chủ)</option>
                                    <option value="banner_section_1" {{ old('position') == 'banner_section_1' ? 'selected' : '' }}>Banner Section 1 (3 hình ngang)</option>
                                    <option value="banner_section_2" {{ old('position') == 'banner_section_2' ? 'selected' : '' }}>Banner Section 2 (2 hình ngang)</option>
                                </select>
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Thứ tự hiển thị</label>
                                <input type="number" name="display_order" class="form-control @error('display_order') is-invalid @enderror"
                                    value="{{ old('display_order', 0) }}" min="0">
                                @error('display_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="isActive" checked>
                                    <label class="form-check-label" for="isActive">Kích hoạt</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Lưu Banner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection