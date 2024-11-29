@extends('layouts.parent')

@section('title', 'Thông Báo')

@section('content')
<div class="container my-5">
    <h3>Thông báo cho {{$parent->name}}</h3>

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
    <div class="notification mb-4 p-3 border rounded">
        <!-- Debug dữ liệu notification -->
        {{-- <pre>{{ var_dump($notification) }}</pre> --}}
        
        @php
            $data = is_array($notification->data) ? $notification->data : json_decode($notification->data, true);
        @endphp

        <!-- Kiểm tra nếu dữ liệu là mảng, không cần gọi json_decode -->
        @if ($notification->type === 'App\Notifications\AdminNotification')
            <h5 class="mb-2">Thông báo từ Admin</h5>
        @elseif ($notification->type === 'App\Notifications\TeacherNotification')
            <h5 class="mb-2">Thông báo từ Giáo viên Chủ Nhiệm</h5>
        @endif

        <p>{{ $data['message'] ?? 'Không có nội dung thông báo' }}</p>
        <small class="text-muted">Thời gian: {{ $notification->created_at->format('d/m/Y H:i') }}</small>
    </div>
@endforeach

</div>
@endsection
