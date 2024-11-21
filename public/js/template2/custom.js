$(document).ready(function () {
    // Đảm bảo rằng việc toggle navbar chỉ xảy ra khi màn hình nhỏ
    $(".navbar-toggler").click(function () {
        $(".navbar-collapse").toggleClass("show");
    });
});