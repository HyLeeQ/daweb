<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Cổng thông tin phụ huynh')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        ul,
        ol {
            list-style: none;
            /* Loại bỏ dấu chấm hoặc các ký tự mặc định khác */
            padding-left: 0;
            /* Loại bỏ khoảng cách trái của danh sách */
        }

        .table td,
        .table th {
            text-align: center;
            /* Căn giữa theo chiều ngang */
            vertical-align: middle;
            /* Căn giữa theo chiều dọc */
        }
    </style>
</head>

<body>
    @include('partials.navbarA')
    <div class="container">
        @yield('content')
    </div>
</body>

</html>
