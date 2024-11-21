@extends('layouts.admin')

@section('title', 'Quản lý học sinh')

@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Danh sách phụ huynh</h1>
            <a href="{{ route('admin.parents.create', ['user_id' => $user->id]) }}" class="btn btn-success btn-lg ms-auto">Thêm Phụ Huynh</a>
        </div>

        <!--Tìm kiếm học sinh-->
        <form action="{{ route('admin.parents.search') }}" method="GET" class="d-flex md4 mb-4">
            <input type="text" name="keyword" class="form-control form-control-lg" placeholder="Tìm kiếm theo tên, lớp, khóa học">
            <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
        </form>

        <!--Bảng danh sách học sinh-->
        @if($parents->isEmpty())
            <div class="alert alert-warning" role="alert">
                Không có học sinh nào trong danh sách.
            </div>
        @else
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên Phụ Huynh</th>
                        <th>Email</th>
                        <th>Số Điện Thoại</th>
                        <th>Tên Con</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parents as $parent)
                        <tr>
                            <td>{{ $parent->id }}</td>
                            <td>{{ $parent->name }}</td>
                            <td>{{ $parent->email }}</td>
                            <td>{{ $parent->phone }}</td>
                            <td>{{ $parent->child_name}}</td>
                            <td>
                                <a href="{{ route('admin.parents.edit', $parent->id) }}" class="btn btn-warning btn-lg">Chỉnh sửa</a>

                                <!-- Form xóa học sinh với xác nhận -->
                                <form action="{{ route('admin.parents.destroy', $parent->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa học sinh này?');">
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
