@extends('layouts.welcome')


@section('title', 'Chào mừng - Cổng thông tin phụ huynh')  
@section('description', 'Trang chủ của cổng thông tin phụ huynh')
@section('content')
<div>
    <br>
</div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Chào mừng đến với cổng thông tin phụ huynh.</h1>
                <p class="lead">Theo dõi tiến trình học tập và thông tin quan trọng của con em.</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-3 text-center">
                <h4>Cập nhật điểm số</h4>
                <p>Theo dõi điểm số và tiến trình học tập của con.</p>
            </div>
            <div class="col-md-3 text-center">
                <h4>Thời khóa biểu</h4>
                <p>Kiểm tra lịch học và các hoạt động hằng ngày.</p>
            </div>
            <div class="col-md-3 text-center">
                <h4>Thông báo</h4>
                <p>Nhận thông báo của nhà trường.</p>
            </div>
            <div class="col-md-3 text-center">
                <h4>Hoạt động ngoại khóa</h4>
                <p>Thông tin về các hoạt động ngoại khóa của trường.</p>
            </div>
        </div>

        <div class="row mt-5 text-center">
            <div class="col-md-12">
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Đăng nhập ngay</a>
            </div>
        </div>
    </div>
@endsection
