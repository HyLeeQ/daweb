<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ParentModel;
use App\Models\Student;
use App\Models\Timetable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class ParentController extends Controller
{
    public function home()
    {
        return view('parents.home');
    }

    // Hiển thị thời khóa biểu của phụ huynh


    public function showTimeTable()
    {
        // Lấy thông tin phụ huynh của tài khoản đang đăng nhập
        $parent = ParentModel::with('students.classroom')->where('user_id', auth()->id())->first();

        if (!$parent) {
            return redirect()->route('admin.parents.index')->withErrors('Không tìm thấy phụ huynh nào');
        }

        $timetables = [];

        // Lấy thời khóa biểu của từng học sinh thuộc phụ huynh
        foreach ($parent->students as $student) {
            $classroomId = $student->classroom_id;

            $timetables[$student->id] = Timetable::with('teacher') // Chỉ cần load quan hệ teacher
                ->where('class_id', $classroomId)
                ->get();
        }

        return view('parents.timetable', compact('parent', 'timetables'));
    }

    // Hiển thị thông tin học sinh của phụ huynh
    public function showStudentInformation()
    {

        $parent = ParentModel::with('students.classroom')->where('user_id', auth()->id())->first();
        if (!$parent) {
            return redirect()->route('parents.home')->withErrors('Không tìm thấy thông tin phụ huynh');
        }
        $students = $parent->students;
        return view('parents.studentInf', compact('parent', 'students'));
    }

    public function storeParent(Request $request)
    {
        // Kiểm tra tất cả dữ liệu đầu vào
        // dd($request->all());

        $validatedData = $request->validate([
            'user_id'  => 'required|exists:users,id',
            'student_name' => 'required|string',
            'student_dob' => 'required|date',
            'student_course' => 'required|string|max:255',
            'student_class' => 'required|string|exists:classrooms,id',
            'student_teacher' => 'required|string|max:40',
            'gender' => 'required|in:male,female',
        ]);

        $user = User::find($request->user_id);
        $classroom = Classroom::find($validatedData['student_class']);
        if (!$user) {
            return back()->withErrors(['user_id' => 'User không tồn tại']);
        }

        $teacher = User::where('name', $request->student_teacher)->first();

        // Nếu không tìm thấy giáo viên, trả về lỗi
        if (!$teacher) {
            return back()->withErrors(['student_teacher' => 'Không tìm thấy giáo viên có tên này']);
        }

        // Lưu thông tin phụ huynh
        $parent = ParentModel::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'child_name' => $request->student_name,
        ]);

        // Lưu thông tin học sinh
        $student = Student::create([
            'parent_id' => $parent->id, // Liên kết học sinh với phụ huynh
            'name' => $request->student_name,  // Tên học sinh
            'dob' => $request->student_dob,   // Ngày sinh học sinh
            'course' => $request->student_course, // Khóa học
            'class' => $classroom->name,   // Lớp học
            'teacher' => $request->student_teacher, // Giáo viên
            'classroom_id' => $classroom->id,
            'gender' => $request->gender,
            'teacher_id' => $teacher->id,
        ]);

        // Chuyển hướng sau khi lưu dữ liệu
        return redirect()->route('admin.index')->with('status', 'Thông tin phụ huynh và học sinh đã được lưu');
    }

    public function showNotifications()
    {
        // Lấy thông tin phụ huynh đang đăng nhập
        $parent = ParentModel::where('user_id', auth()->id())->first();

        // Lấy thông báo từ bảng notifications theo phụ huynh, bao gồm thông báo từ Admin và Teacher
        $notifications = DatabaseNotification::where('notifiable_type', 'App\Models\ParentModel')
            ->where('notifiable_id', $parent->id)
            ->whereIn('type', ['App\Notifications\AdminNotification', 'App\Notifications\TeacherNotification']) // Sử dụng dấu \ đơn
            ->orderBy('created_at', 'desc')
            ->get();


        // Kiểm tra nếu dữ liệu là mảng thì không cần gọi json_decode
        foreach ($notifications as $notification) {
            if (is_string($notification->data)) {
                $notification->data = json_decode($notification->data, true);
            }
        }

        return view('parents.notifications', compact('notifications', 'parent'));
    }
}
