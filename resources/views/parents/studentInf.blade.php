@extends('layouts.parent')

@section('title', 'Thông Tin Con Cái')

@section('content')
<div class="container my-5">
    <h2>Thông Tin Con Cái</h2>
    <h3>Phụ Huynh: <b>{{ $parent->name }}</b></h3>

    @if ($students->isNotEmpty())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên Học Sinh</th>
                    <th>Ngày Sinh</th>
                    <th>Lớp</th>
                    <th>Thông Tin Khác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($student->date_of_birth)->format('d/m/Y') }}</td>
                        <td>{{ $student->classroom->name }}</td>
                        <td>
                            {{-- Hiển thị thêm các thông tin khác nếu cần --}}
                            <ul>
                                <li>Mã học sinh: {{ $student->id }}</li>
                                <li>Giới tính: {{ $student->gender == 'male' ? 'Nam' : 'Nữ' }}</li>
                                <li>Giáo viên chủ nhiêm: {{$student->teacher}}</li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Phụ huynh không có học sinh nào.</p>
    @endif
</div>
@endsection
