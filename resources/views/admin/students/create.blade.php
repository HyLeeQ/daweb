@extends('layouts.admin')

@section('title', 'Thêm Học Sinh')

@section('content')
<div class="container my-5">
    <div class="card">
        <div class="card-header text-center bg-primary text-white">
            <h2 class="display-5">Thêm Thông Tin Học Sinh</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.students.store') }}" method="POST">
                @csrf
                <!-- Tên Sinh Viên -->
                <div class="mb-4">
                    <label for="name" class="form-label fs-4">Tên Sinh Viên</label>
                    <input type="text" class="form-control form-control-lg" id="name" name="name" required>
                </div>

                <!-- Ngày Sinh -->
                <div class="mb-4">
                    <label for="dob" class="form-label fs-4">Ngày Sinh</label>
                    <input type="date" class="form-control form-control-lg" id="dob" name="dob" required>
                </div>

                <!-- Khóa Học -->
                <div class="mb-4">
                    <label for="course" class="form-label fs-4">Khóa Học</label>
                    <select class="form-select form-select-lg" id="course" name="course" required>
                        <option value="2023-2024">2023-2024</option>
                        <option value="2024-2025">2024-2025</option>
                    </select>
                </div>

                <!-- Lớp -->
                <div class="mb-4">
                    <label for="class" class="form-label fs-4">Lớp</label>
                    <input type="text" class="form-control form-control-lg" id="class" name="class" required>
                </div>

                <!-- Giáo Viên Chủ Nhiệm -->
                <div class="mb-4">
                    <label for="teacher" class="form-label fs-4">Giáo Viên Chủ Nhiệm</label>
                    <input type="text" class="form-control form-control-lg" id="teacher" name="teacher" required>
                </div>

                <!-- Nút Lưu -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection