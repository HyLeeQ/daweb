<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="@yield('description', 'Mô tả mặc định')">
    <meta name="author" content="DAWEB">

    <title>@yield('title', 'My Application')</title>

    <!-- Google Fonts (Open Sans) -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/template1/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template2/bootstrap.css') }}">

    <!-- Custom CSS for template -->
    <link rel="stylesheet" href="{{ asset('css/template1/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template2/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template2/responsive.css') }}" />

    <!-- Font Awesome -->
    <link href="{{ asset('css/template2/font-awesome.min.css') }}" rel="stylesheet" />

    <!-- Owl Slider Stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- Nice Select -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
        integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />

    <!-- Datepicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body style="font-family: 'Open Sans', sans-serif;">
    <header class="header_section">
        <div class="hero_area">
            <div class="header_bottom">
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-lg custom_nav-container">
                        <a class="navbar-brand" href="#">
                            <img src="images/logo.png" alt="">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class=""> </span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="d-flex mr-auto flex-column flex-lg-row align-items-center">
                                <ul class="navbar-nav">
                                    <li
                                        class="nav-item {{ Route::currentRouteName() == 'parents.timetable' ? 'active' : '' }}">
                                        <a class="nav-link" href="{{route('teacher.timetable')}}">Thời Khóa Biểu</a>
                                    </li>

                                    <li
                                        class="nav-item dropdown {{ Route::currentRouteName() == '#' ? 'active' : '' }}">
                                        <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown"
                                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            thông báo
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end shadow"
                                            aria-labelledby="notificationDropdown">
                                            <a class="dropdown-item" href="{{ route('teacher.notifications', ['teacher' => $teacher->id]) }}" style="font-size: 15px">
                                                Thông báo từ admin
                                            </a>
                                            
                                            
                                            <a class="dropdown-item" href="#" style="font-size: 15px">Thông đến phụ huynh</a>
                                        </div>
                                    </li>
                                    <li
                                        class="nav-item {{ Route::currentRouteName() == 'parents.results' ? 'active' : '' }}">
                                        <a class="nav-link" href="#">Kết Quả Học Tập</a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <main>

    </main>


    <!-- jQuery -->
    <script src="{{ asset('js/template1/jquery.min.js') }}"></script>
    <script src="{{ asset('js/template2/jquery-3.4.1.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('js/template1/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/template2/bootstrap.js') }}"></script>

    <!-- Waypoints -->
    <script src="{{ asset('js/template1/jquery.waypoints.min.js') }}"></script>

    <!-- Owl Carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- Nice Select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"
        integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>

    <!-- Datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/template2/custom.js') }}"></script>

    <!-- Thêm Bootstrap 5 bundle JS vào cuối body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</html>
