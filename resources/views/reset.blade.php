@extends('layouts.master')

@section('title','Đặt Lại Mật Khẩu')
@section('description','Đặt lại mật khẩu để sử dụng')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Đặt Lại Mật Khẩu</h1>
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4"> <!-- Center the form -->
            <form action="{{ route('password.update') }}" method="POST" class="fh5co-form animate-box" data-animate-effect="fadeInLeft">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email ?? old('email')}}">
                <h2>Nhập Mật Khẩu Mới</h2>
                <div class="form-group">
                    <label for="password" class="sr-only">Mật Khẩu Mới</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Mật Khẩu Mới" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="sr-only">Xác Nhận Mật Khẩu</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Xác Nhận Mật Khẩu" required autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="submit" value="Đặt Lại Mật Khẩu" class="btn btn-primary">
                </div>
                <div class="form-group">
                    <p><a href="{{ route('login.form') }}">Đăng Nhập</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection
