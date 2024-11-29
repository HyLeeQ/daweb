@extends('layouts.welcome')

@section('title', 'Chào mừng - Cổng thông tin phụ huynh')
@section('description', 'Trang chủ của cổng thông tin phụ huynh')
@section('content')
<div id="demo" class="carousel slide" data-bs-ride="carousel">

    <div class="pt-5">

        <div class="text-center mt-5">
            <h1 class="fw-bold display-4">Chào mừng đến với cổng thông tin phụ huynh</h1>
            <p class="lead text-muted">Theo dõi tiến trình học tập và thông tin quan trọng của con em.</p>
        </div>

        <!-- The slideshow/carousel -->
        <div class="carousel-inner rounded">
            <div class="carousel-item active">
                <img src="https://gitiho.com/caches/p_medium_large//uploads/315313/images/image_hinh-nen-powerpoint-chu-de-giao-duc-37.jpg"
                    alt="Los Angeles" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="https://lambanner.com/wp-content/uploads/2021/04/12-mnt-design-hinh-nen-giao-duc-truong-hoc_optimized.png"
                    alt="Chicago" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="https://img.lovepik.com/photo/40005/9569.jpg_wh860.jpg"
                    alt="Chicago" class="d-block w-100">
            </div>
            
            <!-- Add more carousel items here -->
        </div>

        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev invisible-button" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next invisible-button" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>

        <style>
            .carousel-inner img {
    height: 600px;
    object-fit: cover;
}

            .invisible-button {
                background: transparent;
                border: none;
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                width: 50px;
                height: 50px;
                cursor: pointer;
                z-index: 1;
            }
        </style>

        <div class="row mt-5 text-center">
            <div class="col-md-3">
                <div class="p-3 shadow rounded">
                    <h4 class="fw-bold">Cập nhật điểm số</h4>
                    <p class="text-muted">Theo dõi điểm số và tiến trình học tập của con.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 shadow rounded">
                    <h4 class="fw-bold">Thời khóa biểu</h4>
                    <p class="text-muted">Kiểm tra lịch học và các hoạt động hằng ngày.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 shadow rounded">
                    <h4 class="fw-bold">Thông báo</h4>
                    <p class="text-muted">Nhận thông báo của nhà trường nhanh nhất.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3 shadow rounded">
                    <h4 class="fw-bold">Hoạt động ngoại khóa</h4>
                    <p class="text-muted">Thông tin về các hoạt động ngoại khóa của trường.</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 py-3">Đăng nhập ngay</a>
        </div>
    </div>
@endsection
