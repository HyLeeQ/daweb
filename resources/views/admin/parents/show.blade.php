@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Thông tin chi tiết phụ huynh</h2>
    <p><strong>Tên:</strong> {{ $parent->name }}</p>
    <p><strong>Email:</strong> {{ $parent->email }}</p>
    <p><strong>Số điện thoại:</strong> {{ $parent->phone }}</p>

    <h3>Danh sách con</h3>
    <ul>
        @foreach ($parent->students as $student)
            <li>
                <strong>Tên:</strong> {{ $student->name }}<br>
                <strong>Ngày sinh:</strong> {{ $student->dob }}<br>
                <strong>Lớp:</strong> {{ $student->class }}<br>
                <strong>Khóa học:</strong> {{ $student->course }}<br>
                <strong>Giáo viên:</strong> {{ $student->teacher }}
            </li>
        @endforeach
    </ul>
</div>
@endsection
