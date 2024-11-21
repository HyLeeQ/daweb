<?php

namespace App\Http\Controllers;

use App\Models\ParentModel;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function createParentForm() {}

    // Hiển thị thời khóa biểu của phụ huynh
    public function showTimeTable()
    {
        return view('parents.timetable');
    }

    // Trang chủ của phụ huynh
    public function home()
    {
        return view('parents.home');
    }

    // Hiển thị thông tin học sinh của phụ huynh
    public function showStudentInformation()
    {
        return view('parents.studentInf');
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
            'student_class' => 'required|string|max:40',
            'student_teacher' => 'required|string|max:40'
        ]);

        $user = User::find($request->user_id);

        if (!$user) {
            return back()->withErrors(['user_id' => 'User không tồn tại']);
        }

        // Lưu thông tin phụ huynh
        $parent = ParentModel::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            // Lưu thông tin tên con vào trường 'child_name'
            'child_name' => $request->student_name,
        ]);

        // Lưu thông tin học sinh
        $student = Student::create([
            'parent_id' => $parent->id, // Liên kết học sinh với phụ huynh
            'name' => $request->student_name,  // Tên học sinh
            'dob' => $request->student_dob,   // Ngày sinh học sinh
            'course' => $request->student_course, // Khóa học
            'class' => $request->student_class,   // Lớp học
            'teacher' => $request->student_teacher, // Giáo viên
        ]);

        // Chuyển hướng sau khi lưu dữ liệu
        return redirect()->route('admin.index')->with('status', 'Thông tin phụ huynh và học sinh đã được lưu');
    }
   
}
