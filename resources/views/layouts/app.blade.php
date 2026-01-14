<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Nongnghiepvathucpham-AFTD.com')</title>
    <meta name="description" content="@yield('description', 'Nongnghiepvathucpham-AFTD.com')">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

    <style>
        /* FORCE MENU VISIBILITY DEBUGGING */
        .navbar-nav .nav-link {
            color: #000 !important;
            opacity: 1 !important;
            visibility: visible !important;
            display: block !important;
        }

        .navbar-collapse.collapse {
            display: flex !important;
            /* Force flex on desktop if bootstrap fails */
        }

        @media (max-width: 991.98px) {
            .navbar-collapse.collapse:not(.show) {
                display: none !important;
            }
        }

        /* FORCE CART VISIBILITY */
        .navbar a[href*="cart"] {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            opacity: 1 !important;
            visibility: visible !important;
            color: #6c757d !important;
            border: 1px solid #6c757d !important;
            height: 38px !important;
            width: 50px !important;
        }

        a[href*="cart"] i {
            display: inline-block !important;
            visibility: visible !important;
            color: inherit !important;
        }
    </style>
</head>

<body>
    <!-- Top Bar -->
    <div class="top-bar bg-primary text-white py-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-4 col-md-6">
                    <small class="d-block d-md-inline" style="font-size: 0.7rem;">
                        <i class="fas fa-phone me-1"></i><span class="d-none d-sm-inline">Hotline: </span><a
                            href="tel:0981600975" class="text-white text-decoration-none fw-bold">098.160.0975</a>
                    </small>
                </div>
                <div class="col-8 col-md-6 text-end">
                    <div class="d-inline-flex gap-1 gap-md-2 align-items-center" style="font-size: 0.7rem;">
                        @auth
                            <a href="{{ route('orders.index') }}" class="text-white text-decoration-none text-nowrap">
                                <i class="fas fa-user"></i> <span>{{ auth()->user()->name }}</span>
                            </a>
                            @if(auth()->user()->is_admin)
                                <span class="text-white">|</span>
                                <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none text-nowrap">
                                    <i class="fas fa-user-shield"></i> <span>Quản trị</span>
                                </a>
                            @endif
                            <span class="text-white mx-1">|</span>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit"
                                    class="btn btn-link text-white text-decoration-none p-0 small text-nowrap"
                                    style="font-size: 0.75rem;">Thoát</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-white text-decoration-none">Đăng nhập</a>
                            <span class="text-white">|</span>
                            <a href="{{ route('register') }}" class="text-white text-decoration-none">Đăng ký</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="bg-white shadow-sm sticky-top" style="top: 0; z-index: 1030;">
        <nav class="navbar navbar-expand-lg navbar-light py-3">
            <div class="container">
                <a class="navbar-brand py-0 text-center d-flex flex-column align-items-center"
                    href="{{ route('home') }}">
                    <img src="{{ asset('logo.png') }}" alt="Nongnghiepvathucpham-AFTD.com"
                        style="height: 50px; width: auto; margin-bottom: 2px;">
                    <span
                        style="display: block; font-size: 11px; font-weight: 800; color: #000; line-height: 1.2; letter-spacing: 0.5px;">CÔNG
                        TY CP PHÁT TRIỂN CÔNG NGHỆ</span>
                    <span
                        style="display: block; font-size: 11px; font-weight: 800; line-height: 1.2; letter-spacing: 0.5px;">
                        <span style="color: #339d6f;">NÔNG NGHIỆP</span> <span style="color: #225776;">VÀ THỰC
                            PHẨM</span>
                    </span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-grow-1 justify-content-evenly">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Trang chủ</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">Giới thiệu </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">Sản phẩm</a>
                        </li>

                        <li class="nav-item dropdown hover-dropdown">
                            <a class="nav-link" href="{{ route('blog.index') }}">
                                Tin tức
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/blog?category=1">Phát triển sản phẩm khoa học công
                                        nghệ</a></li>
                                <li><a class="dropdown-item" href="/blog?category=3">Khoa học công nghệ và ứng dụng
                                        chuyển giao</a>
                                </li>
                                <li><a class="dropdown-item" href="/blog?category=4">Kết quả nghiên cứu mới</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/blog?category=2">Chứng nhận</a>
                        </li>
                    </ul>

                    <div class="d-flex align-items-center gap-3">
                        <form class="d-flex me-3" action="{{ route('products.search') }}" method="GET">
                            <input class="form-control form-control-sm" type="search" name="search"
                                placeholder="Tìm kiếm..." value="{{ request('search') }}" style="width: 200px;">
                            <button class="btn btn-outline-primary btn-sm" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>

                        <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary position-relative"
                            title="Xem giỏ hàng" style="min-width: 50px;">
                            <i class="fas fa-shopping-cart fs-5 text-secondary"></i>
                            @php
                                $cartCount = 0;
                                if (auth()->check()) {
                                    $cartCount = \App\Models\CartItem::where('user_id', auth()->id())->sum('quantity') ?? 0;
                                } else {
                                    $cartCount = \App\Models\CartItem::where('session_id', session()->getId())->sum('quantity') ?? 0;
                                }
                            @endphp
                            @if($cartCount > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-count"
                                    style="font-size: 0.7rem; min-width: 20px; padding: 2px 6px;">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white mt-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <h5 class="mb-3">Nongnghiepvathucpham-AFTD.com</h5>
                    <p class="text-white-50">Sản phẩm an toàn cho người tiêu dùng</p>
                    <p class="text-white-50 mb-2">
                        <i class="fas fa-phone me-2"></i>0966.358.100
                    </p>
                    <p class="text-white-50 mb-3">
                        <i class="fas fa-envelope me-2"></i>nongnghiepvathucpham-aftd@gmail.com
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube fa-lg"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="mb-3">Hỗ trợ khách hàng</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Chính sách giá</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Tư vấn chọn mua</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Câu hỏi thường gặp</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Cam kết</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Lý do bán</a></li>
                        <li class="mb-2"><a href="{{ route('contact') }}"
                                class="text-white-50 text-decoration-none">Liên hệ</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="mb-3">Chính sách chung</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Chính sách vận
                                chuyển</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Chính sách bảo hành</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Chính sách đổi trả</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Chính sách hàng chính
                                hãng</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Chính sách bảo mật</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Chính sách thanh
                                toán</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h6 class="mb-3">Link nhanh</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Sứ mệnh</a></li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Về
                                Nongnghiepvathucpham-AFTD.com</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Kiến thức nội tiết</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Kiến thức làm đẹp</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Kiến thức cân nặng</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Kiến thức sức khỏe</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h6 class="mb-3">Hệ thống kho Nongnghiepvathucpham-AFTD.com</h6>
                    <div class="mb-3">
                        <strong>Văn Phòng Hưng Yên</strong><br>
                        <small class="text-white-50">
                            <i class="fas fa-map-marker-alt me-1"></i>Xóm 12, Xã Nghĩa Trụ, Huyện Văn Giang, Tỉnh Hưng
                            Yên, Việt Nam<br>
                            <i class="fas fa-clock me-1"></i>Giờ làm việc: 8h30 - 17h30<br>
                            <i class="fas fa-phone me-1"></i>Hotline: 0981600975
                        </small>
                    </div>
                </div>
            </div>
            <hr class="bg-white my-4">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="text-white-50 small mb-0">
                        Hộ kinh doanh Trần Thị Mỹ An, MS thuế: 8636634045-001, cấp ngày 16/07/2024<br>
                        Nơi cấp: UBND H. Cẩm Khê, Địa chỉ: Khu Suông 1, Hương Lung, Cẩm Khê, Phú Thọ.<br>
                        Điện thoại: 0326374486, Email: nongnghiepvathucpham-aftd@gmail.com, Chịu TNND: Trần Thị Mỹ An
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="text-white-50 small mb-0">&copy; {{ date('Y') }} dev by mr.friday13th. All rights
                        reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>