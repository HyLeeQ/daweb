@extends('layouts.parent')

@section('title', 'Thời Khóa Biểu')

@section('content')
<div class="container my-5">
    <h2>Thời Khóa Biểu</h2>
    @foreach ($students as $student)
        <h3>Học sinh: {{ $student->name }}</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Thời Gian</th>
                    <th>Thứ</th>
                    <th>Lớp</th>
                    <th>Ngày</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($timetables[$student->id] as $item)
                    <tr>
                        <td>{{ $item->time_slot }}</td>
                        <td>Thứ {{ $item->day_of_week }}</td>
                        <td>{{ $item->class_id }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</div>
@endsection
