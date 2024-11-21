@extends('layouts.admin')

@section('title', 'Quản lý học sinh')

@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Danh sách học sinh</h1>
            <a href="{{ route('admin.students.create') }}" class="btn btn-success btn-lg ms-auto">Thêm học sinh</a>
        </div>

        <!--Tìm kiếm học sinh-->
        <form action="{{ route('admin.students.search') }}" method="GET" class="d-flex md4 mb-4">
            <input type="text" name="keyword" class="form-control form-control-lg" placeholder="Tìm kiếm theo tên, lớp, khóa học">
            <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
        </form>

        <!--Bảng danh sách học sinh-->
        @if($students->isEmpty())
            <div class="alert alert-warning" role="alert">
                Không có học sinh nào trong danh sách.
            </div>
        @else
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên Sinh Viên</th>
                        <th>Ngày Sinh</th>
                        <th>Khóa Học</th>
                        <th>Lớp</th>
                        <th>Giáo Viên Chủ Nhiệm</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->dob }}</td>
                            <td>{{ $student->course }}</td>
                            <td>{{ $student->class }}</td>
                            <td>{{ $student->teacher }}</td>
                            <td>
                                <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-warning btn-lg">Chỉnh sửa</a>

                                <!-- Form xóa học sinh với xác nhận -->
                                <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa học sinh này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-lg">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
