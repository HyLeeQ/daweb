@extends('layouts.admin')

@section('content')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><b>Danh sách thông báo đã gửi</b></h1>
            <!-- Nút Soạn tin nhắn -->
            <a href="{{ route('admin.notification.create') }}"
                class="btn btn-primary d-flex justify-content-center align-items-center"
                style="height: 35px; width: 120px; font-size: 16px;">Soạn tin nhắn</a>
        </div>

        @forelse ($notifications as $notification)
            @php
                $data = json_decode($notification->data, true);
                $recipientType = '';
                $recipientName = '';

                // Kiểm tra xem đây có phải là thông báo gửi cho tất cả không
                $isForAll = $notification->notifiable_id === 0;

                if ($notification->notifiable_type === 'App\\Models\\Teacher') {
                    $recipientType = 'Giáo viên';
                    // Lấy tên người nhận
                    $recipientName = $notification->notifiable->name ?? 'Không xác định';
                } elseif ($notification->notifiable_type === 'App\\Models\\ParentModel') {
                    $recipientType = 'Phụ huynh';
                    // Lấy tên người nhận
                    $recipientName = $notification->notifiable->name ?? 'Không xác định';
                }
            @endphp

            <div class="notification mb-4 p-4 border rounded" style="font-size: 25px; line-height: 1;">
                <h5 class="mb-2"  style="font-size: 18px;">
                    @if ($isForAll)
                        Thông báo đến tất cả {{ $recipientType }}
                    @else
                        Thông báo đến {{ $recipientName }}
                    @endif
                </h5>
                <p style="font-size: 15px">{{ $data['message'] ?? 'Không có nội dung thông báo' }}</p>
                <small class="text-muted">Thời gian: {{ $notification->created_at->format('H:i d/m/Y') }}</small>
            </div>
        @empty
            <p>Không có thông báo nào được gửi.</p>
        @endforelse
    </div>
@endsection
