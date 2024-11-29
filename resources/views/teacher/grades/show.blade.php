@extends('layouts.teacher')

@section('content')
    <div class="container">
        <!-- resources/views/grades/show.blade.php -->
        <h3>Điểm của học sinh trong lớp</h3>
        <form action="{{ route('teacher.grades.store') }}" method="POST">
            @csrf
            <input type="hidden" name="teacher_id" value="{{ $teacher_id }}">
            <input type="hidden" name="class_id" value="{{ $class_id }}">
            @foreach ($grades as $grade)
                <div>
                    <label for="student_{{ $grade->student_id }}">{{ $grade->student->name }}</label>
                    <input type="text" name="regular_score_1" value="{{ $grade->regular_score_1 }}">
                    <input type="text" name="regular_score_2" value="{{ $grade->regular_score_2 }}">
                    <input type="text" name="midterm_score" value="{{ $grade->midterm_score }}">
                    <input type="text" name="final_score" value="{{ $grade->final_score }}">
                    <button type="submit">Cập nhật</button>
                </div>
            @endforeach
        </form>

    </div>
@endsection
