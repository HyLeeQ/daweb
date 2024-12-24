@extends('layouts.admin')

@section('title', 'Thời Khóa Biểu Của Các Lớp')

@section('content')
    <div class="container my-5">
        <h2>Chọn Lớp Để Xem Thời Khóa Biểu</h2>

        <!-- Hiển thị thông báo nếu có -->
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <!-- Form chọn lớp -->
        <form action="{{ route('admin.timetable.index') }}" method="GET">
            <div class="mb-4">
                <label for="class_id" class="form-label">Chọn Lớp</label>
                <select name="class_id" class="form-select" required>
                    <option value="">Chọn Lớp</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}" {{ old('class_id', $selected_class_id) == $class->id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        
            <button type="submit" class="btn btn-primary w-100" style="height: 35px; font-size: 17px">Xem Thời Khóa Biểu</button>
        </form>
        
        <a href="{{ route('admin.timetable.create') }}"
            class="btn btn-primary w-100 d-flex justify-content-center align-items-center mt-3"
            style="height: 35px; font-size: 17px">Tạo thời khóa biểu</a>
        

        @if ($selected_class_id)
            <h3>Thời Khóa Biểu Của Lớp: {{ $classes->find($selected_class_id)->name }}</h3>

            <!-- Bảng thời khóa biểu của lớp đã chọn -->
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
                                        // Lọc thời khóa biểu theo lớp và ngày
                                        $schedule = $timetables->firstWhere(function ($item) use ($day, $i) {
                                            return $item->day_of_week == $day && $item->time_slot == $i;
                                        });
                                    @endphp

                                    @if ($schedule)
                                        <p>{{ $schedule->teacher->subject }} - {{ $schedule->teacher->name }}</p>
                                    @else
                                        <p></p>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Kiểm tra nếu có thời khóa biểu thì mới hiển thị nút xóa -->
            @if ($timetables->isNotEmpty())
                <form action="{{ route('admin.timetable.destroy', $selected_class_id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa thời khóa biểu của lớp này?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100 mt-3" style="height: 35px; font-size: 17px;">Xóa Thời Khóa Biểu</button>
                </form>
            @endif
        @endif
    </div>
@endsection
