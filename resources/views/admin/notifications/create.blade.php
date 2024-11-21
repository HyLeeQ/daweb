@extends('layouts.admin')

@section('title', 'Soạn Thông Báo')

@section('content')
<div class="container my-5">
    <h2>Soạn Thông Báo</h2>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.notification.send_to_teacher') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="teacher_id" class="form-label">Chọn Giáo Viên</label>
            <select name="teacher_id" class="form-select" required>
                <option value="">Chọn giáo viên</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="message" class="form-label">Nội Dung Thông Báo</label>
            <textarea name="message" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Gửi Thông Báo</button>
    </form>
</div>
@endsection
