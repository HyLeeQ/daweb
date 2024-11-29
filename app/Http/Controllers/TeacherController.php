<?php

// app/Http/Controllers/TeacherController.php
namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Timetable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index()
    {
        // Lấy giáo viên đang đăng nhập
        $teacher = Auth::user()->teacher;

        // Lấy danh sách học sinh của giáo viên
        $students = $teacher->students;

        // Lấy ID của giáo viên
        $teacher_id = $teacher->id;

        // Truyền teacher, students, và teacher_id vào view
        return view('teacher.dashboard', compact('teacher', 'students', 'teacher_id'));
    }
    public function showTimeTable()
    {
        $teacher_id = Auth::id();

        // Lấy thời khóa biểu của giáo viên theo teacher_id
        $timetable = Timetable::with('classroom')  // eager load quan hệ classroom
            ->where('teacher_id', $teacher_id)
            ->get();

        // Lấy thông tin giáo viên từ người dùng đang đăng nhập
        $teacher = Auth::user()->teacher;

        // Kiểm tra nếu không có giáo viên
        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->withErrors('Bạn chưa được cấp thông tin giáo viên.');
        }

        // Trả về view với cả $timetable và $teacher
        return view('teacher.timetable', compact('timetable', 'teacher', 'teacher_id'));
    }

    public function storeTeacher(Request $request)
    {
        // Validate các dữ liệu đầu vào
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'dob' => 'required|date',
            'course' => 'required|string',
            'address' => 'required|string',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        // Lấy user từ bảng users
        $user = User::find($request->user_id);
        if (!$user) {
            return back()->withErrors(['user_id' => 'User không tồn tại.']);
        }

        // Lấy môn học từ bảng subjects
        $subject = Subject::find($request->subject_id);

        if (!$subject) {
            return back()->withErrors(['subject_id' => 'Môn học không tồn tại.']);
        }

        // Tạo mới giáo viên
        $teacher = Teacher::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'role' => $user->role,
            'dob' => $request->dob,
            'course' => $request->course,
            'address' => $request->address,
            'subject_id' => $request->subject_id, // Lưu subject_id
            'subject' => $subject->name, // Lưu tên môn học vào bảng teacher
        ]);

        return redirect()->route('admin.index')->with('status', 'Thông tin giáo viên đã được cập nhật!');
    }


    public function showNotifications(Teacher $teacher)
    {
        // Lấy tất cả thông báo của giáo viên
        $notifications = $teacher->notifications()->orderBy('created_at', 'desc')->get();
        $teacher_id = $teacher->id;
        return view('teacher.notification.show', compact('teacher', 'notifications', 'teacher_id'));
    }
}
