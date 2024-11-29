@extends('layouts.teacher')

@section('content')
    <div class="container">
        <h2>Nhập điểm của học sinh: {{ $grade->student->name }}</h2>
        
        <form action="{{ route('teacher.grades.store') }}" method="POST">
            @csrf
            <input type="hidden" name="teacher_id" value="{{ $teacher_id }}">
        
            <div class="form-group">
                <label for="subject_id">Môn học:</label>
                <select name="subject_id" id="subject_id" class="form-control">
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
        
            <div class="form-group">
                <label for="student_id">Học sinh:</label>
                <select name="student_id" id="student_id" class="form-control">
                    <!-- Giả sử có danh sách học sinh ở đây -->
                    <!-- Bạn có thể thêm logic để lấy danh sách học sinh trong lớp của giáo viên -->
                </select>
            </div>
        
            <div class="form-group">
                <label for="regular_score_1">Điểm thường xuyên 1:</label>
                <input type="number" name="regular_score_1" class="form-control" required>
            </div>
        
            <div class="form-group">
                <label for="regular_score_2">Điểm thường xuyên 2:</label>
                <input type="number" name="regular_score_2" class="form-control" required>
            </div>
        
            <div class="form-group">
                <label for="regular_score_3">Điểm thường xuyên 3:</label>
                <input type="number" name="regular_score_3" class="form-control" required>
            </div>
        
            <div class="form-group">
                <label for="midterm_score">Điểm giữa kỳ:</label>
                <input type="number" name="midterm_score" class="form-control" required>
            </div>
        
            <div class="form-group">
                <label for="final_score">Điểm cuối kỳ:</label>
                <input type="number" name="final_score" class="form-control" required>
            </div>
        
            <button type="submit" class="btn btn-primary">Lưu điểm</button>
        </form>
        
    </div>
@endsection
