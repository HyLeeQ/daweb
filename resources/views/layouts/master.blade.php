<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    {{-- gõ tiếng việt --}}

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- reponsize --}}

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- đảm bảo trang sẽ sử dụng chế độ tương thích mới nhất với IE --}}

    <meta name="description" content="@yield('description', 'Mô tả mặc định')">
    {{-- mô tả trang  --}}

    <meta name="author" content="DAWEB">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('css/template1/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template1/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template1/style.css') }}">
    <title>@yield('title', 'My Application')</title>
</head>

<body>
    <header>
    </header>
    <main>
        @yield('content')
    </main>

    <footer>
        <div class="col-md-12 text-center">
            <p><small>&copy; Tất cả quyền được bảo lưu. Thiết kế bởi <a
                        href="https://freehtml5.co">FreeHTML5.co</a></small></p>
        </div>
    </footer>
    <!-- jQuery -->
    <script src="{{ asset('js/template1/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('js/template1/bootstrap.min.js') }}"></script>
    <!-- Placeholder -->
    <script src="{{ asset('js/template1/jquery.placeholder.min.js') }}"></script>
    <!-- Waypoints -->
    <script src="{{ asset('js/template1/jquery.waypoints.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('js/template1/main.js') }}"></script>

    <script src="{{ asset('js/template1/modernizr-2.6.2.min.js') }}"></script>

</body>

</html>
