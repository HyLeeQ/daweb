@extends('layouts.admin')

@section('title', 'Tạo Thông Tin Giáo Viên')
@section('description', 'Điền thông tin giáo viên mới')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12 text-center mb-4">
                <h1 class="fw-bold">TẠO THÔNG TIN GIÁO VIÊN</h1>
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
        <div class="row justify-content-center">
            <!-- Tăng kích thước form -->
            <div class="col-lg-8 col-md-10"> 
                <form action="{{ route('admin.teacher.store', ['user_id' => $user->id]) }}" method="POST" class="p-4 border rounded bg-light shadow">
                    @csrf
                    <!-- Ẩn ID của user -->
                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                    <!-- Hiển thị tên và email đã có sẵn từ bảng users -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Tên:</label>
                        <input type="text" class="form-control form-control-lg" value="{{ $user->name }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email:</label>
                        <input type="email" class="form-control form-control-lg" value="{{ $user->email }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label fw-bold">Số Điện Thoại:</label>
                        <input type="text" class="form-control form-control-lg" value="{{ $user->phone }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="dob" class="form-label fw-bold">Ngày Sinh:</label>
                        <input type="date" name="dob" class="form-control form-control-lg" placeholder="Ngày Sinh" required>
                    </div>

                    <div class="mb-3">
                        <label for="course" class="form-label fw-bold">Khóa Học:</label>
                        <input type="text" name="course" class="form-control form-control-lg" placeholder="Khóa Học" required>
                    </div>

                    <div class="mb-3">
                        <label for="subject" class="form-label fw-bold">Môn Học:</label>
                        <input type="text" name="subject" class="form-control form-control-lg" placeholder="Môn Học" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label fw-bold">Địa Chỉ:</label>
                        <input type="text" name="address" class="form-control form-control-lg" placeholder="Địa Chỉ" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Lưu Thông Tin Giáo Viên</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
