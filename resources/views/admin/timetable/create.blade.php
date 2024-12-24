@extends('layouts.admin')

@section('title', 'Tạo thời khóa biểu')

@section('content')
    <div class="container my-5">
        <h2>Tạo Thời Khóa Biểu</h2>
    </div>
    <a href="{{ route('admin.timetable.index') }}"
    class="btn btn-primary d-flex justify-content-center align-items-center ms-auto"
    style="height: 38px; width: 120px; font-size: 16px; margin-bottom: 20px; display: block;">
    Trở về
</a>
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form action="{{ route('admin.timetable.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="class_id" class="form-label">Chọn Lớp</label>
            <select name="class_id" class="form-select" required>
                <option value="">Chọn Lớp</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>
    
        <!-- Bảng thời khóa biểu -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Thời Gian</th>
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
                        <td><input type="text" name="time[{{ $i }}]" value="Tiết {{ $i }}" class="form-control" readonly></td>
    
                        @foreach (range(1, 7) as $day)
                            <td>
                                <select name="schedule[{{ $i }}][{{ $day }}]" class="form-select" style="height: 60px; width: 120px">
                                    <option value="">Chọn Môn</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->subject }} - {{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Tạo Thời Khóa Biểu</button>
        </div>
    </form>
    
@endsection
