@extends('layouts.teacher')

@section('content')
<div class="container my-5">
    <h3>Thông báo cho {{$teacher->name}}</h3>

    <!-- Hiển thị thông báo thành công nếu có -->
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <!-- Hiển thị lỗi nếu có -->
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <!-- Hiển thị các thông báo -->
    @foreach ($notifications as $notification)
        @php
        $data = json_decode($notification->data, true);
        @endphp
        <div class="notification mb-4 p-3 border rounded">
            <h5 class="mb-2">Thông báo từ Admin</h5>
            <p>{{ $data['message'] ?? 'Không có nội dung thông báo' }}</p>
            <small class="text-muted">Thời gian: {{ $notification->created_at->format('d/m/Y H:i') }}</small>
        </div>
    @endforeach
</div>
@endsection
