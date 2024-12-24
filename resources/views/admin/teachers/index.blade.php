@extends('layouts.admin')

@section('title', 'Quản lý giáo viên')

@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Danh sách giáo viên</h1>
        </div>

        <!-- Tìm kiếm giáo viên -->
        <form action="{{ route('admin.teacher.search') }}" method="GET" class="d-flex mb-4">
            <input type="text" name="keyword" class="form-control form-control-lg me-2" placeholder="Tìm kiếm theo tên, khóa học, môn học" style="height: 38px;">
            <button type="submit" class="btn btn-primary" style="font-size: 14px; font-weight: 600; background-color: #007bff; border-color: #007bff; color: white; padding: 0px 10px; border-radius: 5px; text-transform: uppercase; height: 38px;">
                Tìm kiếm
            </button>
        </form>

        <!-- Bảng danh sách giáo viên -->
        @if($teachers->isEmpty())
            <div class="alert alert-warning" role="alert">
                Không có giáo viên nào trong danh sách.
            </div>
        @else
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên Giáo Viên</th>
                        <th>Email</th>
                        <th>Số Điện Thoại</th>
                        <th>Ngày Sinh</th>
                        <th>Khóa Học</th>
                        <th>Môn Học</th>
                        <th>Địa Chỉ</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->id }}</td>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td>{{ $teacher->phone }}</td>
                            <td>{{ $teacher->dob }}</td>
                            <td>{{ $teacher->course }}</td>
                            <td>{{ $teacher->subject }}</td>
                            <td>{{ $teacher->address }}</td>
                            <td>
                                <!-- Sử dụng d-flex để căn chỉnh các nút trên cùng một hàng -->
                                <div class="d-flex">
                                    <!-- Nút chỉnh sửa -->
                                    <a href="{{ route('admin.teacher.edit', $teacher->id) }}" class="btn btn-warning btn-sm me-3 px-4" style="font-size: 14px; padding: 8px 20px; margin-right: 5px;">
                                        Chỉnh sửa
                                    </a>

                                    <!-- Form xóa giáo viên với xác nhận -->
                                    <form action="{{ route('admin.teacher.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa giáo viên này?');" class="ms-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm px-4" style="font-size: 14px; padding: 8px 20px; margin-right: 5px;">
                                            Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
