@extends('layouts.master')

@section('title', 'Tạo Thông Tin Phụ Huynh')
@section('description', 'Điền thông tin phụ huynh mới')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>TẠO THÔNG TIN PHỤ HUYNH</h1>
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
            <div class="col-md-6 col-md-offset-3"> <!-- Center the form -->
                <form action="{{ route('admin.parents.store', ['user_id' => $user->id ?? null]) }}" method="POST" class="fh5co-form">
                    @csrf
                    <!-- Ẩn ID của user -->
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                
                    <!-- Hiển thị tên và email đã có sẵn từ bảng users -->
                    <div class="form-group">
                        <label for="name">Tên:</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                    </div>
                
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                    </div>
                
                    <div class="form-group">
                        <label for="phone">Số Điện Thoại:</label>
                        <input type="text" class="form-control" value="{{ $user->phone }}" disabled>
                    </div>
                
                    <!-- Thông tin con cái (1 học sinh) -->
                    <h4>Thông Tin Con Cái</h4>
                    <div class="form-group">
                        <label for="student_name">Tên Học Sinh:</label>
                        <input type="text" name="student_name" class="form-control" placeholder="Tên Học Sinh" required>
                    </div>
                
                    <div class="form-group">
                        <label for="student_dob">Ngày Sinh:</label>
                        <input type="date" name="student_dob" class="form-control" required>
                    </div>
                
                    <div class="form-group">
                        <label for="student_course">Khóa Học:</label>
                        <input type="text" name="student_course" class="form-control" placeholder="Khóa Học" required>
                    </div>
                
                    <div class="form-group">
                        <label for="student_class">Lớp:</label>
                        <input type="text" name="student_class" class="form-control" placeholder="Lớp" required>
                    </div>
                
                    <div class="form-group">
                        <label for="student_teacher">Giáo Viên:</label>
                        <input type="text" name="student_teacher" class="form-control" placeholder="Giáo Viên" required>
                    </div>
                
                    <div class="form-group">
                        <input type="submit" value="Lưu Thông Tin Phụ Huynh" class="btn btn-primary">
                    </div>
                </form>
                
            </div>
        </div>
    </div>
@endsection
