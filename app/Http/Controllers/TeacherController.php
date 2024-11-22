<?php

// app/Http/Controllers/TeacherController.php
namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Timetable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function index()
    {
        $teacher = Auth::user()->teacher;
        return view('teacher.dashboard', compact('teacher'));
    }

    public function showTimeTable()
    {
        $teacherId = Auth::id();

        // Lấy thời khóa biểu của giáo viên theo teacher_id
        $timetable = Timetable::with('classroom')  // eager load quan hệ classroom
            ->where('teacher_id', $teacherId)
            ->get();

        // Lấy thông tin giáo viên từ người dùng đang đăng nhập
        $teacher = Auth::user()->teacher;

        // Kiểm tra nếu không có giáo viên
        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->withErrors('Bạn chưa được cấp thông tin giáo viên.');
        }

        // Trả về view với cả $timetable và $teacher
        return view('teacher.timetable', compact('timetable', 'teacher'));
    }

    public function storeTeacher(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'dob' => 'required|date',
            'course' => 'required|string',
            'subject' => 'required|string',
            'address' => 'required|string',
        ]);

        $user = User::find($request->user_id);

        if (!$user) {
            return back()->withErrors(['user_id' => 'User không tồn tại.']);
        }

        Teacher::create([
            'user_id' => $user->id, // Lưu liên kết đến user
            'name' => $user->name, // Lấy từ bảng users
            'email' => $user->email, // Lấy từ bảng users
            'phone' => $user->phone, // Lấy từ bảng users
            'role' => $user->role, // Lấy role từ bảng users
            'dob' => $request->dob,
            'course' => $request->course,
            'subject' => $request->subject,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.index')->with('status', 'Thông tin giáo viên đã được cập nhật!');
    }
    public function showNotifications(Teacher $teacher)
    {
        // $teacher là đối tượng Teacher đã được ánh xạ tự động từ route
        $notifications = $teacher->notifications()->orderBy('created_at', 'desc')->get();

        return view('teacher.notifications', compact('teacher', 'notifications'));
    }
}
