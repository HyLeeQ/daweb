@extends('layouts.admin')

@section('title', 'Chỉnh sửa thông tin giáo viên')

@section('content')
<div class="container my-5">
    <div class="card">
        <div class="card-header text-center bg-warning text-white">
            <h2>Chỉnh Sửa Thông Tin Giáo Viên</h2>
        </div>
        <div class="card-body">
            <!-- Hiển thị thông báo lỗi nếu có -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form chỉnh sửa thông tin giáo viên -->
            <form action="{{ route('admin.teacher.update', $teacher->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Tên Giáo Viên -->
                <div class="mb-3">
                    <label for="name" class="form-label">Tên Giáo Viên</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $teacher->name) }}" required>
                </div>

                <!-- Email Giáo Viên -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $teacher->email) }}" required>
                </div>

                <!-- Số Điện Thoại Giáo Viên -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Số Điện Thoại</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $teacher->phone) }}" required>
                </div>

                <!-- Ngày Tháng Năm Sinh -->
                <div class="mb-3">
                    <label for="dob" class="form-label">Ngày Sinh</label>
                    <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob', $teacher->dob) }}" required>
                </div>

                <!-- Khóa Học Giáo Viên -->
                <div class="mb-3">
                    <label for="course" class="form-label">Khóa Học</label>
                    <input type="text" class="form-control" id="course" name="course" value="{{ old('course', $teacher->course) }}" required>
                </div>

                <!-- Môn Học Giáo Viên -->
                <div class="mb-3">
                    <label for="subject" class="form-label">Môn Học</label>
                    <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject', $teacher->subject) }}" required>
                </div>

                <!-- Địa Chỉ Giáo Viên -->
                <div class="mb-3">
                    <label for="address" class="form-label">Địa Chỉ</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $teacher->address) }}" required>
                </div>

                <!-- Nút cập nhật -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
