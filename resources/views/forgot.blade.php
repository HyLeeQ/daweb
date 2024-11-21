@extends('layouts.master')

@section('title', 'Khôi Phục Mật Khẩu')
@section('description', 'Lấy lại mật khẩu đã mất')
@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>KHôi PHỤC MẬT KHẨU</h1>
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <form action="{{ route('password.email') }}" method="POST" class="fh5co-form animate-box" data-animate-effect="fadeIn">
                @csrf
                <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Nhập Email của bạn" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <p><a href="{{ route('login') }}">Đăng Nhập</a> | <a href="{{ route('register') }}">Đăng Ký</a></p>
                </div>
                <div class="form-group">
                    <input type="submit" value="Gửi Email" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection


