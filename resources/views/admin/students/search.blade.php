@extends('layouts.admin')

@section('title', 'Tìm kiếm học sinh')

@section('content')
    <div class="container my-5">
        <h2>Kết quả tìm kiếm</h2>

        <!-- Hiển thị từ khóa tìm kiếm -->
        <div class="mb-4">
            <strong>Từ khóa tìm kiếm: </strong>{{ request()->input('keyword') }}
        </div>

        <table class="table table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên Sinh Viên</th>
                    <th>Ngày Sinh</th>
                    <th>Khóa Học</th>
                    <th>Lớp</th>
                    <th>Giáo Viên Chủ Nhiệm</th>
                </tr>
            </thead>
            <tbody>
                @if ($students->count() > 0)
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->dob }}</td>
                            <td>{{ $student->course }}</td>
                            <td>{{ $student->class }}</td>
                            <td>{{ $student->teacher }}</td>
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
