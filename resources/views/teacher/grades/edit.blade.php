@extends('layouts.teacher')

@section('content')
    <div class="container">
        <h2>Chỉnh sửa điểm của học sinh: {{ $grade->student->name }}</h2>
        
        <form action="{{ route('teacher.grades.update', $grade) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="regular_score_1">Điểm thường xuyên 1</label>
                <input type="number" step="0.01" name="regular_score_1" id="regular_score_1" class="form-control" value="{{ old('regular_score_1', $grade->regular_score_1) }}">
            </div>

            <div class="form-group">
                <label for="regular_score_2">Điểm thường xuyên 2</label>
                <input type="number" step="0.01" name="regular_score_2" id="regular_score_2" class="form-control" value="{{ old('regular_score_2', $grade->regular_score_2) }}">
            </div>

            <div class="form-group">
                <label for="regular_score_3">Điểm thường xuyên 3</label>
                <input type="number" step="0.01" name="regular_score_3" id="regular_score_3" class="form-control" value="{{ old('regular_score_3', $grade->regular_score_3) }}">
            </div>

            <div class="form-group">
                <label for="midterm_score">Điểm giữa kỳ</label>
                <input type="number" step="0.01" name="midterm_score" id="midterm_score" class="form-control" value="{{ old('midterm_score', $grade->midterm_score) }}">
            </div>

            <div class="form-group">
                <label for="final_score">Điểm cuối kỳ</label>
                <input type="number" step="0.01" name="final_score" id="final_score" class="form-control" value="{{ old('final_score', $grade->final_score) }}">
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật điểm</button>
        </form>
    </div>
@endsection
