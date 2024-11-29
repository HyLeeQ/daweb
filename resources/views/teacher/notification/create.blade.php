@extends('layouts.teacher')

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

    <form action="{{ route('teacher.notification.send') }}" method="POST">
        @csrf

        <!-- Chọn lớp học -->
        <div class="mb-4">
            <label for="classroom_id" class="form-label">Chọn Lớp Học</label>
            <select id="classroom_id" name="classroom_id" class="form-select" required>
                <option value="">Chọn lớp học</option>
                @foreach($classrooms as $classroom)
                    <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Nội dung thông báo -->
        <div class="mb-4">
            <label for="message" class="form-label">Nội Dung Thông Báo</label>
            <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Gửi Thông Báo</button>
    </form>
</div>
<script>
    document.getElementById('classroom_id').addEventListener('change', function() {
        let classroomId = this.value;

        if (classroomId) {
            fetch(`/teacher/api/classrooms/${classroomId}/students`)
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Danh sách học sinh
                    // Bạn có thể thêm mã để hiển thị danh sách học sinh và cho phép giáo viên chọn
                })
                .catch(error => console.error('Error fetching students:', error));
        }
    });
</script>
@endsection


