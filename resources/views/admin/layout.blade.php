<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Nongnghiepvathucpham-AFTD.com</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-dark text-white vh-100 position-fixed" style="width: 250px; left: 0; top: 0; overflow-y: auto;">
            <div class="p-3">
                <h4 class="text-white mb-4">Admin Panel</h4>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'bg-primary rounded' : '' }}"
                            href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->routeIs('admin.products.*') ? 'bg-primary rounded' : '' }}"
                            href="{{ route('admin.products.index') }}">
                            <i class="fas fa-box me-2"></i>Sản phẩm
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->routeIs('admin.categories.*') ? 'bg-primary rounded' : '' }}"
                            href="{{ route('admin.categories.index') }}">
                            <i class="fas fa-folder me-2"></i>Danh mục
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->routeIs('admin.orders.*') ? 'bg-primary rounded' : '' }}"
                            href="{{ route('admin.orders.index') }}">
                            <i class="fas fa-shopping-cart me-2"></i>Đơn hàng
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->routeIs('admin.posts.*') ? 'bg-primary rounded' : '' }}"
                            href="{{ route('admin.posts.index') }}">
                            <i class="fas fa-newspaper me-2"></i>Bài viết
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->routeIs('admin.reviews.*') ? 'bg-primary rounded' : '' }}"
                            href="{{ route('admin.reviews.index') }}">
                            <i class="fas fa-star me-2"></i>Đánh giá
                        </a>
                    </li>
                    {{-- <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->routeIs('admin.flash-sales.*') ? 'bg-primary rounded' : '' }}"
                            href="{{ route('admin.flash-sales.index') }}">
                            <i class="fas fa-bolt me-2"></i>Flash Sale
                        </a>
                    </li> --}}
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white {{ request()->routeIs('admin.banners.*') ? 'bg-primary rounded' : '' }}"
                            href="{{ route('admin.banners.index') }}">
                            <i class="fas fa-images me-2"></i>Banner
                        </a>
                    </li>
                    <li class="nav-item mt-4">
                        <a class="nav-link text-white" href="{{ route('home') }}">
                            <i class="fas fa-home me-2"></i>Về trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link text-white w-100 text-start border-0 bg-transparent">
                                <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow-1" style="margin-left: 250px; width: calc(100% - 250px);">
            <!-- Top Bar -->
            <nav class="navbar navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <span class="navbar-text">
                        Xin chào, <strong>{{ auth()->user()->name }}</strong>
                    </span>
                </div>
            </nav>

            <!-- Content -->
            <div class="p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>

</html>