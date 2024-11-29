@extends('layouts.teacher')

@section('content')
<div class="container text-center">
    <h1>Điểm của học sinh</h1>

    <!-- Nút "Nhập điểm" -->
    <div class="mb-3">
        <a href="{{ route('teacher.grades.create', ['teacher_id' => $teacher_id]) }}" class="btn btn-sm btn-primary">Nhập điểm</a>
    </div>

    @foreach ($grades as $classId => $classGrades)
    @php
        // Tìm tên lớp theo classId từ bảng classrooms
        $className = \App\Models\Classroom::find($classId)->name;
    @endphp
    <h3>Lớp: {{ $className }}</h3>

    <!-- Căn giữa bảng -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped mx-auto" style="width: 80%;">
            <thead>
                <tr>
                    <th>Học sinh</th>
                    <th>Điểm TX 1</th>
                    <th>Điểm TX 2</th>
                    <th>Điểm TX 3</th>
                    <th>Điểm GK</th>
                    <th>Điểm CK</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classGrades as $grade)
                    @php
                        // Lấy thông tin học sinh
                        $student = $grade->student;
                    @endphp
                    <tr>
                        <td>{{ $student->name }}</td> <!-- Hiển thị tên học sinh một lần duy nhất -->
                        <td>{{ $grade->regular_score_1 }}</td>
                        <td>{{ $grade->regular_score_2 }}</td>
                        <td>{{ $grade->regular_score_3 }}</td>
                        <td>{{ $grade->midterm_score }}</td>
                        <td>{{ $grade->final_score }}</td>
                        <td>
                            <!-- Nút chỉnh sửa điểm nếu cần -->
                            <a href="{{ route('teacher.grades.edit', ['teacher_id' => $teacher_id, 'class_id' => $classId, 'student_id' => $grade->student_id]) }}" class="btn btn-sm btn-warning">Sửa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endforeach

</div>
@endsection
