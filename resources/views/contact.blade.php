@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row">
            <!-- Left Column - Contact Info & Form -->
            <div class="col-lg-6 mb-4">
                <!-- Header Section -->
                <div class="mb-4">
                    <h1 class="fw-bold mb-3">NƠI GIẢI ĐÁP TOÀN BỘ MỌI THẮC MẮC CỦA BẠN?</h1>
                    <p class="text-muted">
                        Nongnghiepvathucpham-AFTD.com với sứ mệnh mang lại giá trị tốt nhất cho người Việt.
                        Chúng tôi cam kết cung cấp Sản phẩm an toàn cho người tiêu dùng, đảm bảo chất lượng và nguồn gốc
                        xuất xứ
                        rõ ràng.
                    </p>
                </div>

                <!-- Contact Details -->
                <div class="mb-4">
                    <div class="mb-3">
                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                        <strong>Địa chỉ:</strong>
                        <span class="text-muted">
                            Xóm 12, Xã Nghĩa Trụ, Tỉnh Hưng Yên, Việt Nam
                        </span>
                    </div>

                    <div class="mb-3">
                        <i class="fas fa-id-card text-primary me-2"></i>
                        <strong>Mã số thuế:</strong>
                        <span class="text-muted">0901141775</span>
                    </div>

                    <div class="mb-3">
                        <i class="fas fa-clock text-primary me-2"></i>
                        <strong>Thời gian làm việc:</strong>
                        <span class="text-muted">8h30 - 17h30 từ thứ 2 đến thứ 7</span>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">
                            <strong>Nơi cấp:</strong> Thuế cơ sở 3 tỉnh Hưng Yên
                            <strong>Ngày cấp:</strong> 2023-06-16
                        </small>
                    </div>

                    <div class="mb-3">
                        <i class="fas fa-phone text-primary me-2"></i>
                        <strong>Hotline:</strong>
                        <a href="tel:0981600975" class="text-decoration-none">098 160 0975</a>
                    </div>

                    <div class="mb-3">
                        <i class="fas fa-envelope text-primary me-2"></i>
                        <strong>Email:</strong>
                        <a href="mailto:nongnghiepvathucpham-aftd@gmail.com"
                            class="text-decoration-none">nongnghiepvathucpham-aftd@gmail.com</a>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="mb-3">LIÊN HỆ VỚI CHÚNG TÔI</h4>
                        <p class="text-muted mb-4">
                            Nếu bạn có thắc mắc gì, có thể gửi yêu cầu cho chúng tôi,
                            và chúng tôi sẽ liên lạc lại với bạn sớm nhất có thể.
                        </p>

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Điện thoại <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Nội dung</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message"
                                    name="message" rows="5" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success w-100 py-2">
                                <i class="fas fa-paper-plane me-2"></i>GỬI THÔNG TIN
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Column - Google Map -->
            <div class="col-lg-6 align-self-start">
                <div class="card shadow-sm overflow-hidden border-0">
                    <div class="card-body p-0">
                        <div class="map-container w-100" style="aspect-ratio: 1/1; position: relative;">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3720.5833!2d105.15!3d21.2!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313460833a69774d%3A0xbc4e2be8682e0717!2zSMawxqFuZyBMdW5nLCBD4bqpbSBLaMOqLCBQaMO6IFRo4buNLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1703664000000!5m2!1svi!2s"
                                width="100%" height="100%" style="border:0; position: absolute; top:0; left:0;"
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Office Locations -->
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="mb-4 text-center">Hệ thống văn phòng Nongnghiepvathucpham-AFTD.com</h3>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-map-marker-alt text-danger me-2"></i>
                            Văn Phòng Hưng Yên
                        </h5>
                        <p class="card-text">
                            <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                            Xóm 12, Xã Nghĩa Trụ, Huyện Văn Giang, Tỉnh Hưng Yên, Việt Nam<br>
                            <i class="fas fa-clock me-2 text-muted"></i>
                            Giờ làm việc: 8h30 - 17h30<br>
                            <i class="fas fa-phone me-2 text-muted"></i>
                            Hotline: <a href="tel:0981600975" class="text-decoration-none">098 160 0975</a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection