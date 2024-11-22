@extends('layouts.admin')

@section('title', 'Quản lý phụ huynh')

@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Danh sách phụ huynh</h1>
        </div>

        <!-- Tìm kiếm phụ huynh -->
        <form action="{{ route('admin.parents.search') }}" method="GET" class="d-flex md4 mb-4">
            <input type="text" name="keyword" class="form-control form-control-lg"
                placeholder="Tìm kiếm theo tên, email, số điện thoại">
            <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
        </form>

        <!-- Bảng danh sách phụ huynh -->
        @if ($parents->isEmpty())
            <div class="alert alert-warning" role="alert">
                Không có phụ huynh nào trong danh sách.
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
                        <th>Lớp</th>
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
                            <td>
                                <ul>
                                    @foreach ($parent->students as $index => $student)
                                        <li>{{ $student->name }}</li>
                                        @if ($index < count($parent->students) - 1)
                                            <hr style="  width: 100%;  margin: 10px auto;border: 1px solid #000;">
                                        @endif
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    @foreach ($parent->students as $index => $student)
                                        <li>{{ $student->class }}</li>
                                        @if ($index < count($parent->students) - 1)
                                            <hr style="  width: 100%;  margin: 10px auto;border: 1px solid #000;">
                                        @endif
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <a href="{{ route('admin.parents.edit', $parent->id) }}"
                                    class="btn btn-warning btn-lg">Chỉnh sửa</a>

                                <!-- Form xóa phụ huynh với xác nhận -->
                                <form action="{{ route('admin.parents.delete', $parent->id) }}" method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa phụ huynh này?');">
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
