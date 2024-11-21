@extends('layouts.admin')
@section('title', 'Tạo Tài Khoản')
@section('description', 'Tạo tài khoản để đăng nhập vào hệ thống')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>TẠO TÀI KHOẢN MỚI</h1>
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
                <form action="{{ route('register') }}" method="POST" class="fh5co-form animate-box"
                    data-animate-effect="fadeIn">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="sr-only">Họ và Tên</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Họ và Tên"
                            autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="sr-only">Số Điện Thoại</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Số Điện Thoại"
                            autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                            autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="sr-only">Mật khẩu</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Mật khẩu"
                            autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="re-password" class="sr-only">Nhập lại mật khẩu</label>
                        <input type="password" name="password_confirmation" class="form-control" id="re-password"
                            placeholder="Nhập lại mật khẩu" autocomplete="off" required>
                    </div>
                    <!-- Thêm phần chọn loại tài khoản -->
                    <div class="form-group">
                        <label for="role">Chọn loại tài khoản</label>
                        <select name="role" class="form-control" id="role" required>
                            <option value="">--Chọn Loại Tài Khoản--</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Giáo viên</option>
                            <option value="parent" {{ old('role') == 'parent' ? 'selected' : '' }}>Phụ huynh</option>
                        </select>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" value="Tạo Tài Khoản" class="btn btn-primary btn-lg">
                    </div>
                </form>
                <div class="form-group text-center mt-3">
                    <a href="{{ route('admin.index') }}" class="btn btn-secondary btn-lg">Trở lại</a>
                </div>
            </div>
        </div>
    @endsection
