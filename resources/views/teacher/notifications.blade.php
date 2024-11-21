@extends('layouts.teacher')

@section('content')
<div class="container my-5">
    <h3>Thông báo cho {{$teacher->name}}</h3>

    @if (session('status'))
        <div class="alert alert-success">{{section('status')}}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        </div>
    @endif

    @foreach ($notifications as $notification)
        @php
        $data = json_decode($notification->data, true);
        @endphp
        <div class="notification mb-4 p-3 border rounded">
            <h5 class="mb-2">Thông báo từ Admin</h5>
            <p>{{$data['message'] ?? 'Không có nội dung thông báo'}}</p>
            <small class="text-muted">Thời gian: {{$notification->created_at}}</small>
        </div>
    @endforeach
</div>
@endsection