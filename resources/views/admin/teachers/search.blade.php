@extends('layouts.admin')

@section('title', 'Tìm kiếm giáo viên')

@section('content')
    <div class="container my-5">
        <h2>Kết quả tìm kiếm</h2>

        <!-- Hiển thị từ khóa tìm kiếm -->
        <div class="mb-4">
            <strong>Từ khóa tìm kiếm: </strong>{{ request()->input('keyword') }}
        </div>
        <!-- Nút trở về -->
        <div class="mb-4">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>
        <table class="table table-bordered mt-4">
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
                </tr>
            </thead>
            <tbody>
                @if ($teachers->count() > 0)
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
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="text-center">Không tìm thấy kết quả.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
