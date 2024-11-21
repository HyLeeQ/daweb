@extends('layouts.master') 

@section('title', 'Đăng Nhập')
@section('description', 'Đăng nhập vào hệ thống')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>ĐĂNG NHẬP</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4"> <!-- Center the form -->
            <form action="{{ route('login') }}" method="POST" class="fh5co-form animate-box" data-animate-effect="fadeIn">
                @csrf
                <div class="form-group">
                    <label for="username" class="sr-only">Số Điện Thoại</label>
                    <input type="text" name="phone" class="form-control" id="username" placeholder="Số Điện Thoại" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="password" class="sr-only">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Mật khẩu" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="remember"><input type="checkbox" id="remember"> Ghi nhớ tài khoản</label>
                </div>
                <div class="form-group">
                    <p><a href="{{ route('register.form') }}">Đăng ký ngay</a> | <a href="{{ route('forgot.email') }}">Quên mật khẩu?</a></p>
                </div>
                <div class="form-group">
                    <input type="submit" value="Đăng Nhập" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection
