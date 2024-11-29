<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Notification;
use App\Models\ParentModel;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherNotificationController extends Controller
{
    // Hiển thị form soạn thông báo
    public function create()
    {
        $teacher = Auth::user()->teacher;
        $teacher_id = $teacher->id;
        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->withErrors('Bạn chưa được cấp thông tin giáo viên.');
        }

        // Lấy tất cả các học sinh có teacher_id trùng với giáo viên đang đăng nhập
        $students = Student::where('teacher_id', $teacher->id)
            ->whereHas('classroom', function ($query) use ($teacher) {
                $query->where('teacher_id', $teacher->id);  // Chỉ lấy lớp của giáo viên đang chủ nhiệm
            })
            ->get();

        // Lấy danh sách các lớp học của giáo viên qua học sinh (tương tự như trước)
        $classrooms = $students->pluck('classroom')->unique();  // Lấy lớp học duy nhất

        return view('teacher.notification.create', compact('classrooms', 'teacher', 'teacher_id'));  // Truyền teacher và classrooms vào view
    }



    // Phương thức gửi thông báo
    public function sendNotification(Request $request)
    {
        $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'message' => 'required|string|max:255',
        ]);

        // Lấy lớp học
        $classroom = Classroom::find($request->classroom_id);

        // Kiểm tra giáo viên có phải là giáo viên chủ nhiệm của lớp này không
        $teacher = Auth::user()->teacher; // Giáo viên đang đăng nhập

        // Kiểm tra nếu giáo viên chủ nhiệm của lớp
        if (!$classroom->students()->where('teacher_id', $teacher->id)->exists()) {
            return redirect()->back()->withErrors('Bạn không có quyền gửi thông báo cho lớp này.');
        }

        // Lấy tất cả học sinh trong lớp này
        $students = $classroom->students;

        // Lấy tất cả phụ huynh của học sinh trong lớp
        $parentIds = $students->pluck('parent_id')->unique();  // Lấy danh sách các parent_id không trùng lặp

        // Gửi thông báo cho từng phụ huynh
        foreach ($parentIds as $parentId) {
            $parent = ParentModel::find($parentId);

            if ($parent) {
                // Tạo thông báo cho phụ huynh
                $notification = new Notification([
                    'type' => 'App\Notifications\TeacherNotification',  // Loại thông báo
                    'data' => json_encode([
                        'message' => $request->message,  // Nội dung thông báo
                    ]),
                    'notifiable_type' => ParentModel::class, // Loại đối tượng nhận thông báo (phụ huynh)
                    'notifiable_id' => $parent->id,  // ID của phụ huynh
                    'read_at' => null,  // Thông báo chưa được đọc
                ]);
                $parent->notifications()->save($notification);  // Lưu thông báo vào cơ sở dữ liệu
            }
        }

        return redirect()->route('teacher.notification.create')->with('status', 'Thông báo đã được gửi thành công!');
    }


    // Lấy danh sách học sinh trong lớp (API)
    public function getStudents(Classroom $classroom)
    {
        $students = $classroom->students;  // Lấy danh sách học sinh trong lớp
        return response()->json($students);
    }
}
