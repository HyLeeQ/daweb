@extends('layouts.teacher')

@section('content')
<div class="container my-5">
    <h3 class="mb-4"><b>Thông báo cho {{ $teacher->name }}</b></h3>

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
    @forelse ($notifications as $notification)
        @php
            $data = is_array($notification->data) ? $notification->data : json_decode($notification->data, true);
        @endphp

        <div class="notification mb-4 p-4 border rounded" style="font-size: 25px; line-height: 1;">
            <h5 class="mb-2" style="font-size: 18px;">
                Thông báo từ Admin
            </h5>
            <p style="font-size: 15px">{{ $data['message'] ?? 'Không có nội dung thông báo' }}</p>
            <small class="text-muted">Thời gian: {{ $notification->created_at->format('d/m/Y H:i') }}</small>
        </div>
    @empty
        <p>Không có thông báo nào.</p>
    @endforelse
</div>
@endsection
