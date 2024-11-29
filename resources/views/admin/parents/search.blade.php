@extends('layouts.admin')

@section('title', 'Tìm kiếm phụ huynh')

@section('content')
    <div class="container my-5">
        <h2>Kết quả tìm kiếm phụ huynh</h2>

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
        
        <!-- Bảng kết quả tìm kiếm -->
        <table class="table table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên Phụ Huynh</th>
                    <th>Email</th>
                    <th>Số Điện Thoại</th>
                    <th>Tên Con</th>
                    <th>Lớp</th>
                </tr>
            </thead>
            <tbody>
                @if ($parents->count() > 0)
                    @foreach ($parents as $parent)
                        <tr>
                            <td>{{ $parent->id }}</td>
                            <td>{{ $parent->name }}</td>
                            <td>{{ $parent->email }}</td>
                            <td>{{ $parent->phone }}</td>
                            <td>
                                <ul>
                                    @foreach ($parent->students as $student)
                                        <li>{{ $student->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    @foreach ($parent->students as $student)
                                        <li>{{ $student->class }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">Không tìm thấy kết quả.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
