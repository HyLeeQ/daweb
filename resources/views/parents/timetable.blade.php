@extends('layouts.parent')

@section('title', 'Thời Khóa Biểu')

@section('content')
<div class="container my-5">
    <h2>Thời Khóa Biểu</h2>
    @foreach ($parent->students as $student)
        <h3>Học sinh: <b>{{ $student->name }}</b></h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tiết</th>
                    <th>Thứ 2</th>
                    <th>Thứ 3</th>
                    <th>Thứ 4</th>
                    <th>Thứ 5</th>
                    <th>Thứ 6</th>
                    <th>Thứ 7</th>
                    <th>Chủ Nhật</th>
                </tr>
            </thead>
            <tbody>
                @foreach (range(1, 10) as $i)
                    <tr>
                        <td><strong>Tiết {{ $i }}</strong></td>
                        @foreach (range(1, 7) as $day)
                            <td>
                                @php
                                    // Lấy thời khóa biểu cho ngày và tiết học hiện tại
                                    $schedule = $timetables[$student->id]->firstWhere(function ($item) use ($day, $i) {
                                        return $item->day_of_week == $day && $item->time_slot == $i;
                                    });
                                @endphp

                                @if ($schedule && $schedule->teacher)
                                    <p>{{ $schedule->teacher->subject }}</p> <!-- Hiển thị môn học -->
                                @else
                                    <p></p>
                                @endif
                            </td>
                            
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</div>
@endsection
