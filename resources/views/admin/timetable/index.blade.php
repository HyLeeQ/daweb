@extends('layouts.admin')

@section('title', 'Danh Sách Thời Khóa Biểu')

@section('content')
<div class="container my-5">
    <h2>Danh Sách Thời Khóa Biểu</h2>

    @foreach($timetables as $timetable)
        <div class="notification">
            <p>Lớp: {{ $timetable->classroom->name }} - Môn: {{ $timetable->subject }}</p>
            <p>Giáo viên: {{ $timetable->teacher->name }} - Thời gian: {{ $timetable->time }} - Ngày: {{ $timetable->day_of_week }}</p>
        </div>
    @endforeach
</div>
@endsection