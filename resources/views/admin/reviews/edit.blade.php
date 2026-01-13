@extends('admin.layout')

@section('title', 'Sửa đánh giá')

@section('content')
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.reviews.index') }}">Quản lý đánh giá</a></li>
                <li class="breadcrumb-item active">Sửa đánh giá #{{ $review->id }}</li>
            </ol>
        </nav>
        <h2>Sửa đánh giá #{{ $review->id }}</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Sản phẩm</label>
                        <input type="text" class="form-control" value="{{ $review->product->name }}" readonly disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Ngày tạo</label>
                        <input type="text" class="form-control" value="{{ $review->created_at->format('d/m/Y H:i:s') }}"
                            readonly disabled>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Tên khách hàng</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                            value="{{ old('name', $review->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                            value="{{ old('phone', $review->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="rating" class="form-label">Xếp hạng (1-5 sao)</label>
                    <select class="form-select @error('rating') is-invalid @enderror" id="rating" name="rating" required>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('rating', $review->rating) == $i ? 'selected' : '' }}>{{ $i }} sao
                            </option>
                        @endfor
                    </select>
                    @error('rating')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="comment" class="form-label">Nội dung đánh giá</label>
                    <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment"
                        rows="5" required>{{ old('comment', $review->comment) }}</textarea>
                    @error('comment')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input type="hidden" name="is_approved" value="0">
                        <input class="form-check-input" type="checkbox" id="is_approved" name="is_approved" value="1" {{ old('is_approved', $review->is_approved) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_approved">Duyệt đánh giá này (Sẽ hiển thị trên web)</label>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">Quay lại</a>
                    <button type="submit" class="btn btn-primary px-5">Cập nhật đánh giá</button>
                </div>
            </form>
        </div>
    </div>
@endsection