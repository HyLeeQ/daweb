@extends('layouts.admin')

@section('title', 'Chỉnh sửa thông tin học sinh')

@section('content')
<div class="container my-5">
    <div class="card">
        <div class="card-header text-center bg-warning text-white">
            <h2>Chỉnh Sửa Thông Tin Học Sinh</h2>
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

            <!-- Form chỉnh sửa thông tin học sinh -->
            <form action="{{ route('admin.students.update', $student->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Tên Sinh Viên -->
                <div class="mb-3">
                    <label for="name" class="form-label">Tên Sinh Viên</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $student->name) }}" required>
                </div>

                <!-- Ngày Tháng Năm Sinh -->
                <div class="mb-3">
                    <label for="dob" class="form-label">Ngày Sinh</label>
                    <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob', $student->dob) }}" required>
                </div>

                <!-- Khóa Học -->
                <div class="mb-3">
                    <label for="course" class="form-label">Khóa Học</label>
                    <select class="form-select" id="course" name="course" required>
                        <option value="2023-2024" {{ $student->course == '2023-2024' ? 'selected' : '' }}>2023-2024</option>
                        <option value="2024-2025" {{ $student->course == '2024-2025' ? 'selected' : '' }}>2024-2025</option>
                        <option value="2025-2026" {{ $student->course == '2025-2026' ? 'selected' : '' }}>2025-2026</option>
                    </select>
                </div>

                <!-- Lớp -->
                <div class="mb-3">
                    <label for="class" class="form-label">Lớp</label>
                    <input type="text" class="form-control" id="class" name="class" value="{{ old('class', $student->class) }}" required>
                </div>

                <!-- Giáo Viên Chủ Nhiệm -->
                <div class="mb-3">
                    <label for="teacher" class="form-label">Giáo Viên Chủ Nhiệm</label>
                    <input type="text" class="form-control" id="teacher" name="teacher" value="{{ old('teacher', $student->teacher) }}" required>
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
