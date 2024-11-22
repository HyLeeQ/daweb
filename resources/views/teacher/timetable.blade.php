@extends('layouts.teacher')

@section('title', 'Thời Khóa Biểu')

@section('content')
    <div class="container my-5">
        <h2>Thời Khóa Biểu của {{ $teacher->name }}</h2> <!-- Hiển thị tên giáo viên -->
        
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
                @foreach (range(1, 5) as $i)
                    <tr>
                        <td><input type="text" value=" {{ $i }}" class="form-control" readonly style="text-align: center; font-size: 15px"></td>

                        @foreach (range(1, 7) as $day)
                            <td>
                                @php
                                    // Lọc thời khóa biểu cho ngày và giờ hiện tại
                                    $schedule = $timetable->firstWhere(function ($item) use ($day, $i) {
                                        return $item->day_of_week == $day && $item->time_slot == $i;
                                    });
                                @endphp
                                
                                @if ($schedule)
                                    <p>{{ $schedule->classroom->name }}</p> <!-- Hiển thị tên lớp -->
                                    {{-- <p>{{ \Carbon\Carbon::parse($schedule->created_at)->format('d/m/Y') }}</p> --}}
                                @else
                                    <p></p>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
