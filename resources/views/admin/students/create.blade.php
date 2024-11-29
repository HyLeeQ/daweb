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

                    <div class="mb-4">
                        <label for="gender" class="form-label fs-4">Giới tính</label>
                        <select name="gender" id="gender" class="form-select form-select-lg" required>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
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
                        <select class="form-select form-select-lg" id="class" name="class" required>
                            <option value="">Chọn lớp</option>
                            @foreach ($classrooms as $classroom)
                                <option value="{{ $classroom->name }}">{{ $classroom->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="parent_id" class="form-label fs-4">Cha/Mẹ</label>
                        <select class="form-select form-select-lg" id="parent_id" name="parent_id" required>
                            <option value="">Chọn phụ huynh</option>
                            @foreach ($parents as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Giáo Viên Chủ Nhiệm -->
                    <div class="mb-4">
                        <label for="teacher" class="form-label fs-4">Giáo Viên Chủ Nhiệm</label>
                        <select class="form-select form-select-lg" id="teacher" name="teacher" required>
                            <option value="">Chọn giáo viên</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="mb-4">
                        <label for="teacher" class="form-label fs-4">Giáo Viên Chủ Nhiệm</label>
                        <input type="text" class="form-control form-control-lg" id="teacher" name="teacher" required>
                    </div> --}}

                    <!-- Nút Lưu -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
