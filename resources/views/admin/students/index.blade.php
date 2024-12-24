@extends('layouts.admin')

@section('title', 'Quản lý học sinh')

@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Danh sách học sinh</h1>
            <a href="{{ route('admin.students.create') }}" class="btn btn-primary btn-lg ms-auto" style="font-size: 16px; padding: 8px 20px;">Thêm học sinh</a>
        </div>

        <!--Tìm kiếm học sinh-->
        <form action="{{ route('admin.students.search') }}" method="GET" class="d-flex md4 mb-4">
            <input type="text" name="keyword" class="form-control form-control-lg" placeholder="Tìm kiếm theo tên, lớp, khóa học" style="height: 38px;">
            <button type="submit" class="btn btn-primary" style="font-size: 14px; font-weight: 600; background-color: #007bff; border-color: #007bff; color: white; padding: 0px 10px; border-radius: 5px; text-transform: uppercase; height: 38px;">
                Tìm kiếm
            </button>
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
                        <th>Giới Tính</th>
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
                            <td>{{ $student->gender }}</td>
                            <td>{{ $student->dob }}</td>
                            <td>{{ $student->course }}</td>
                            <td>{{ $student->class }}</td>
                            <td>{{ $student->teacher }}</td>
                            <td>
                                <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-warning" style="font-size: 14px; padding: 8px 20px; margin-right: 5px;">Chỉnh sửa</a>

                                <!-- Form xóa học sinh với xác nhận -->
                                <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa học sinh này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="font-size: 14px; padding: 8px 20px; margin-right: 5px;">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
