@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Chỉnh sửa thông tin phụ huynh</h2>
        <form action="{{ route('admin.parents.update', $parent->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Tên phụ huynh</label>
                <input type="text" name="name" class="form-control" value="{{ $parent->name }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $parent->email }}" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" value="{{ $parent->phone }}" required>
            </div>
            @foreach ($parent->students as $student)
                <div>
                    <label>Tên học sinh:</label>
                    <input type="text" name="students[{{ $student->id }}][name]" value="{{ $student->name }}">

                    <label>Lớp:</label>
                    <select name="students[{{ $student->id }}][classroom_id]" required>
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom->id }}" @if ($student->classroom_id == $classroom->id) selected @endif>
                                {{ $classroom->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
@endsection
