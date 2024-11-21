@extends('layouts.parent')

@section('content')
@foreach (auth()->user()->notifications as $notification)
    <div class="alert alert-info">
        {{ $notification->data['message'] }} - {{ $notification->data['sender'] }}
    </div>
@endforeach

@endsection