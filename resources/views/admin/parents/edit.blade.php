@extends('layouts.master')

@section('content')
    <div class="container">
        <h1>Chỉnh sửa thông tin phụ huynh và học sinh</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('parent.update', $parent->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Thông tin phụ huynh -->
            <h3>Thông tin phụ huynh</h3>
            <p><strong>Tên:</strong> {{ $parent->user->name }}</p>
            <p><strong>Email:</strong> {{ $parent->user->email }}</p>
            <p><strong>Phone:</strong> {{ $parent->user->phone }}</p>

            <!-- Thông tin học sinh -->
            <h3>Thông tin học sinh</h3>
            @foreach ($students as $index => $student)
                <h4>Học sinh {{ $index + 1 }}</h4>
                <div class="form-group">
                    <label for="student_{{ $index }}_name">Tên học sinh:</label>
                    <input type="text" id="student_{{ $index }}_name" name="students[{{ $index }}][name]" 
                           class="form-control" value="{{ $student->name }}" required>
                    <input type="hidden" name="students[{{ $index }}][id]" value="{{ $student->id }}">
                </div>

                <div class="form-group">
                    <label for="student_{{ $index }}_dob">Ngày sinh:</label>
                    <input type="date" id="student_{{ $index }}_dob" name="students[{{ $index }}][dob]" 
                           class="form-control" value="{{ $student->dob }}" required>
                </div>

                <div class="form-group">
                    <label for="student_{{ $index }}_course">Khóa học:</label>
                    <input type="text" id="student_{{ $index }}_course" name="students[{{ $index }}][course]" 
                           class="form-control" value="{{ $student->course }}" required>
                </div>

                <div class="form-group">
                    <label for="student_{{ $index }}_class">Lớp:</label>
                    <input type="text" id="student_{{ $index }}_class" name="students[{{ $index }}][class]" 
                           class="form-control" value="{{ $student->class }}" required>
                </div>

                <div class="form-group">
                    <label for="student_{{ $index }}_teacher">Giáo viên:</label>
                    <input type="text" id="student_{{ $index }}_teacher" name="students[{{ $index }}][teacher]" 
                           class="form-control" value="{{ $student->teacher }}" required>
                </div>
            @endforeach

            <!-- Thêm các khung nhập liệu trống cho học sinh mới -->
            @for ($i = $parent->students->count(); $i < $parent->students->count() + 3; $i++)
                <h4>Học sinh mới {{ $i - $parent->students->count() + 1 }}</h4>
                <div class="form-group">
                    <label for="student_{{ $i }}_name">Tên học sinh:</label>
                    <input type="text" id="student_{{ $i }}_name" name="students[{{ $i }}][name]" 
                           class="form-control" placeholder="Tên học sinh">
                </div>

                <div class="form-group">
                    <label for="student_{{ $i }}_dob">Ngày sinh:</label>
                    <input type="date" id="student_{{ $i }}_dob" name="students[{{ $i }}][dob]" 
                           class="form-control" placeholder="Ngày sinh">
                </div>

                <div class="form-group">
                    <label for="student_{{ $i }}_course">Khóa học:</label>
                    <input type="text" id="student_{{ $i }}_course" name="students[{{ $i }}][course]" 
                           class="form-control" placeholder="Khóa học">
                </div>

                <div class="form-group">
                    <label for="student_{{ $i }}_class">Lớp:</label>
                    <input type="text" id="student_{{ $i }}_class" name="students[{{ $i }}][class]" 
                           class="form-control" placeholder="Lớp">
                </div>

                <div class="form-group">
                    <label for="student_{{ $i }}_teacher">Giáo viên:</label>
                    <input type="text" id="student_{{ $i }}_teacher" name="students[{{ $i }}][teacher]" 
                           class="form-control" placeholder="Giáo viên">
                </div>
            @endfor

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
            </div>
        </form>
    </div>
@endsection
