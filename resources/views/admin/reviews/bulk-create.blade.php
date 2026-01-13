@extends('admin.layout')

@section('title', 'Tạo đánh giá hàng loạt')

@section('content')
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.reviews.index') }}">Quản lý đánh giá</a></li>
                <li class="breadcrumb-item active">Tạo hàng loạt</li>
            </ol>
        </nav>
        <h2>Tạo đánh giá hàng loạt</h2>
        <p class="text-muted">Tính năng này giúp bạn tạo nhanh nhiều đánh giá cho một sản phẩm (Số điện thoại sẽ được tạo
            ngẫu nhiên).</p>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.reviews.bulk-store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="product_id" class="form-label fw-bold">1. Chọn sản phẩm</label>
                    <select class="form-select @error('product_id') is-invalid @enderror" id="product_id" name="product_id"
                        required>
                        <option value="">-- Chọn sản phẩm --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">2. Danh sách đánh giá</label>
                    <div id="reviews-container">
                        <!-- Review Row Template -->
                        <div class="review-row card mb-3 bg-light">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <input type="text" name="reviews[0][name]" class="form-control"
                                            placeholder="Tên người dùng" required>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="reviews[0][rating]" class="form-select" required>
                                            <option value="5" selected>5 sao</option>
                                            <option value="4">4 sao</option>
                                            <option value="3">3 sao</option>
                                            <option value="2">2 sao</option>
                                            <option value="1">1 sao</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <textarea name="reviews[0][comment]" class="form-control" rows="1"
                                            placeholder="Nội dung đánh giá" required></textarea>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="date" name="reviews[0][created_at]" class="form-control"
                                            value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" id="add-more" class="btn btn-outline-primary">
                        <i class="fas fa-plus me-2"></i>Thêm dòng khác
                    </button>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">Quay lại</a>
                    <button type="submit" class="btn btn-primary px-5">Bắt đầu tạo hàng loạt</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let rowCount = 1;
                const container = document.getElementById('reviews-container');
                const addBtn = document.getElementById('add-more');

                addBtn.addEventListener('click', function () {
                    const newRow = document.createElement('div');
                    newRow.className = 'review-row card mb-3 bg-light animation-fade-in';
                    newRow.innerHTML = `
                        <div class="card-body position-relative">
                            <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-row" style="font-size: 0.7rem;"></button>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <input type="text" name="reviews[${rowCount}][name]" class="form-control" placeholder="Tên người dùng" required>
                                </div>
                                <div class="col-md-2">
                                    <select name="reviews[${rowCount}][rating]" class="form-select" required>
                                        <option value="5" selected>5 sao</option>
                                        <option value="4">4 sao</option>
                                        <option value="3">3 sao</option>
                                        <option value="2">2 sao</option>
                                        <option value="1">1 sao</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <textarea name="reviews[${rowCount}][comment]" class="form-control" rows="1" placeholder="Nội dung đánh giá" required></textarea>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" name="reviews[${rowCount}][created_at]" class="form-control" value="${new Date().toISOString().split('T')[0]}">
                                </div>
                            </div>
                        </div>
                    `;
                    container.appendChild(newRow);
                    rowCount++;
                });

                container.addEventListener('click', function (e) {
                    if (e.target.classList.contains('remove-row')) {
                        e.target.closest('.review-row').remove();
                    }
                });
            });
        </script>
        <style>
            .animation-fade-in {
                animation: fadeIn 0.3s ease-in-out;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    @endpush
@endsection