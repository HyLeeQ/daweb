@extends('layouts.parent')

@section('title',  'Cổng thông tin phụ huynh')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Thời Khóa Biểu</h1>
    <table class="table table-bordered table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Giờ</th>
                <th>Thứ Hai</th>
                <th>Thứ Ba</th>
                <th>Thứ Tư</th>
                <th>Thứ Năm</th>
                <th>Thứ Sáu</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>8:00 - 9:00</td>
                <td>Toán</td>
                <td>Hóa học</td>
                <td>Toán</td>
                <td>Tiếng Anh</td>
                <td>Văn học</td>
            </tr>
            <tr>
                <td>9:00 - 10:00</td>
                <td>Tiếng Anh</td>
                <td>Toán</td>
                <td>Thể dục</td>
                <td>Vật lý</td>
                <td>Ngữ văn</td>
            </tr>
            <tr>
                <td>10:00 - 11:00</td>
                <td>Vật lý</td>
                <td>Tiếng Anh</td>
                <td>Ngữ văn</td>
                <td>Địa lý</td>
                <td>Thể dục</td>
            </tr>
            <tr>
                <td>11:00 - 12:00</td>
                <td>Thể dục</td>
                <td>Địa lý</td>
                <td>Hóa học</td>
                <td>Tiếng Anh</td>
                <td>GDCD</td>
            </tr>
            <tr>
                <td>12:00 - 13:00</td>
                <td>Ngữ văn</td>
                <td>Văn học</td>
                <td>Vật lý</td>
                <td>Toán</td>
                <td>Hóa học</td>
            </tr>
            <tr>
                <td>13:00 - 14:00</td>
                <td>Hóa học</td>
                <td>GDCD</td>
                <td>Tiếng Anh</td>
                <td>Vật lý</td>
                <td>Toán</td>
            </tr>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection