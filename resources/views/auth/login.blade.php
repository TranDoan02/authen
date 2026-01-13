@extends('layouts.app')

@section('title', 'Đăng nhập - Nongnghiepvathucpham-AFTD.com')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">Đăng nhập</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-3">Đăng nhập</button>

                            <div class="text-center mb-3">
                                <a href="{{ route('register') }}">Chưa có tài khoản? Đăng ký ngay</a>
                            </div>

                            <hr>

                            <a href="{{ route('facebook.login') }}" class="btn btn-primary w-100"
                                style="background-color: #1877f2;">
                                <i class="fab fa-facebook me-2"></i>Đăng nhập với Facebook
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection