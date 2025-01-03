<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherNotificationController;
use App\Http\Controllers\TimeTableController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckParent;
use App\Http\Middleware\CheckTeacher;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route cho hiển thị form đăng nhập
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.form');

// Route xử lý đăng nhập
Route::post('login', [LoginController::class, 'login'])->name('login');

// Route cho đăng xuất
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Route cho hiển thị form đăng ký
Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register.form');

// Route xử lý đăng ký
Route::post('register', [RegisterController::class, 'register'])->name('register');

// Route để hiển thị form nhập email quên mật khẩu
Route::get('password/forgot', [ForgotPasswordController::class, 'showLinkResetForm'])->name('forgot.email');

// Route để gửi email đặt lại mật khẩu
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Route để hiển thị form đặt lại mật khẩu (sau khi nhấp vào link trong email)
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Route để xử lý đặt lại mật khẩu
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Route cho admin
Route::middleware(['auth', CheckAdmin::class])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('index');

    // Route để xem danh sách học sinh
    Route::get('/student', [StudentController::class, 'index'])->name('students.index');
    // Route để tạo học sinh mới
    Route::get('/student/create', [StudentController::class, 'create'])->name('students.create');
    // Route để tìm kiếm học sinh
    Route::get('/student/search', [StudentController::class, 'search'])->name('students.search');
    // Route để chỉnh sửa học sinh (cần ID học sinh)
    Route::get('/student/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
    // Route để cập nhật học sinh 
    Route::put('/student/{id}', [StudentController::class, 'update'])->name('students.update');
    // Route để lưu học sinh mới
    Route::post('/student/store', [StudentController::class, 'store'])->name('students.store');
    // Route để xóa học sinh
    Route::delete('/student/{id}', [StudentController::class, 'destroy'])->name('students.destroy');


    Route::get('/teacher', [AdminController::class, 'teachersIndex'])->name('teacher.index');
    // Route::get('teachers/create', [AdminController::class, 'teachersCreate'])->name('teachers.create');
    Route::post('/teacher', [AdminController::class, 'teachersStore'])->name('teacher.store');
    Route::get('/teacher/search', [AdminController::class, 'teachersSearch'])->name('teacher.search');
    Route::get('/teacher/{id}/edit', [AdminController::class, 'teachersEdit'])->name('teacher.edit');
    Route::put('/teacher/{id}', [AdminController::class, 'teachersUpdate'])->name('teacher.update');
    Route::delete('/teacher/{id}', [AdminController::class, 'teachersDestroy'])->name('teacher.destroy');
    //Route dẫn tới form điền thông tin dành cho giáo viên
    Route::get('/teacher/create/{user_id}', [AdminController::class, 'createTeacherForm'])->name('teacher.create');
    // Route để lưu thông tin giáo viên
    Route::post('/teacher/store/{user_id}', [TeacherController::class, 'storeTeacher'])->name('teacher.store');


    // Route hiển thị form gửi thông báo
    Route::get('/notification', [AdminNotificationController::class, 'create'])->name('notification.create');

    // Route xử lý gửi thông báo
    Route::post('/notification/send', [AdminNotificationController::class, 'sendNotification'])->name('notification.send');

    //Route thông báo đã gửi
    Route::get('/notification/index', [AdminNotificationController::class, 'showAdminNotifications'])->name('notification.index');
    // Route tao thoi khoa bieu
    Route::get('/timetable/create', [TimeTableController::class, 'create'])->name('timetable.create');
    // Route luu thoi khoa bieu
    Route::post('/timetable/store', [TimeTableController::class, 'store'])->name('timetable.store');

    // Route cho trang xem tất cả thời khóa biểu
    Route::get('/timetable/index', [AdminController::class, 'showTimetable'])->name('timetable.index');
    // Xóa thời khóa biểu của một lớp
    Route::delete('/timetable/{class_id}', [TimetableController::class, 'destroy'])->name('timetable.destroy');


    // Route để lấy thời khóa biểu của lớp
    // Route::get('/timetable/{class_id}', [TimetableController::class, 'getTimetable'])->name('timetable.get');


    //Route dẫn tới form điền thông tin phụ huynh
    Route::get('/parents', [AdminController::class, 'parentsIndex'])->name('parents.index');
    Route::get('/parent/{id}', [AdminController::class, 'showParentInformation'])->name('parents.information.parent.students');
    Route::get('/parent/create/{user_id}', [AdminController::class, 'createParentForm'])->name('parents.create');
    Route::post('/parent/store/{user_id}', [ParentController::class, 'storeParent'])->name('parents.store');
    Route::get('/parent/{id}/edit', [AdminController::class, 'parentsEdit'])->name('parents.edit');
    Route::put('/parent/{id}', [AdminController::class, 'parentsUpdate'])->name('parents.update');
    Route::get('/parent/search', [AdminController::class, 'parentsSearch'])->name('parents.search');
    Route::delete('/parent/{id}', [AdminController::class, 'parentsDelete'])->name('parents.delete');
});


// Route cho phụ huynh
Route::middleware(['auth', CheckParent::class])->prefix('parent')->name('parents.')->group(function () {
    Route::get('/student-inf', [ParentController::class, 'showStudentInformation'])->name('studentInf');
    Route::get('/timetable', [ParentController::class, 'showTimeTable'])->name('timetable');
    Route::get('/notifications', [ParentController::class, 'showNotifications'])->name('notifications');
    Route::get('/results', [ParentController::class, 'results'])->name('results');
    Route::get('/fees', [ParentController::class, 'fees'])->name('fees');
});



Route::middleware(['auth', CheckTeacher::class])->prefix('teacher')->name('teacher.')->group(function () {
    // Route cho trang dashboard của giáo viên
    Route::get('/dashboard', [TeacherController::class, 'index'])->name('dashboard');

    // Route cho trang lịch giảng dạy
    Route::get('/time-table', [TeacherController::class, 'showTimeTable'])->name('timetable');

    // Route cho trang thông báo của giáo viên
    Route::get('/{teacher}/notifications', [TeacherController::class, 'showNotifications'])->name('notification.show');

    // Route hiển thị form gửi thông báo
    Route::get('/notification', [TeacherNotificationController::class, 'create'])->name('notification.create');

    // Route xử lý gửi thông báo
    Route::post('/notification/send', [TeacherNotificationController::class, 'sendNotification'])->name('notification.send');

    // Route API để lấy học sinh theo lớp
    Route::get('/api/classrooms/{classroom}/students', [TeacherNotificationController::class, 'getStudents']);

    Route::get('/{teacher_id}/grades', [GradeController::class, 'index'])->name('grades.index');
    Route::get('/{teacher_id}/grades/class/{class_id}', [GradeController::class, 'show'])->name('grades.show');
    Route::get('/{teacher_id}/grades/create', [GradeController::class, 'create'])->name('grades.create');
    Route::post('/grades/store', [GradeController::class, 'store'])->name('grades.store');
    Route::get('/{teacher_id}/class/{class_id}/student/{student_id}/edit', [GradeController::class, 'edit'])->name('grades.edit');
});
Route::fallback(function () {
    return response('Route không tồn tại. Kiểm tra lại URL.', 404);
});
Route::get('/grades/{teacher_id}', function ($teacher_id) {
    return "Teacher ID: " . $teacher_id;
})->name('grades.index');
