<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\ParentModel;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Notifications\AdminNotification;

class AdminNotificationController extends Controller
{
    // Hiển thị form gửi thông báo
    public function create()
    {
        $teachers = Teacher::all();
        $parents = ParentModel::all();
        return view('admin.notifications.create', compact('teachers', 'parents'));
    }

    // Gửi thông báo cho một giáo viên
    public function sendToTeacher(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate(
            [
                'teacher_id' => 'required|exists:teachers,id',
                'message' => 'required|string|max:255',
            ]
        );

        $teacher = Teacher::find($request->teacher_id);

        Notification::create([
            'type' => AdminNotification::class,  // Loại thông báo
            'data' => json_encode([              // Dữ liệu thông báo (mảng được chuyển thành chuỗi JSON)
                'message' => $request->message,
                'sender' => 'Admin',             // Người gửi
                'time' => now(),                 // Thời gian gửi
            ]),
            'notifiable_type' => Teacher::class,  // Loại đối tượng nhận thông báo
            'notifiable_id' => $teacher->id,      // ID của giáo viên
        ]);

        return back()->with('status', 'Thông báo đã được gửi tới giáo viên ID: ' . $request->teacher_id);
    }

    // Gửi thông báo cho nhiều giáo viên
    public function sendToMultipleTeachers(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|array',
            'teacher_id.*' => 'exists:teachers,id',
            'message' => 'required|string|max:255',
        ]);

        $teachers = Teacher::whereIn('id', $request->teacher_id)->get();
        foreach ($teachers as $teacher) {
            $teacher->notify(new AdminNotification($request->message));
        }

        return back()->with('status', 'Thông báo đã được gửi tới các giáo viên.');
    }

    // Gửi thông báo cho tất cả giáo viên
    public function sendToAllTeachers(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $teachers = Teacher::all();
        foreach ($teachers as $teacher) {
            $teacher->notify(new AdminNotification($request->message));
        }

        return back()->with('status', 'Thông báo đã được gửi tới tất cả giáo viên.');
    }

    // Gửi thông báo cho một phụ huynh
    public function sendToParent(Request $request)
    {
        $request->validate([
            'parent_id' => 'required|exists:parents,id', // Kiểm tra parent_id tồn tại trong bảng parents
            'message' => 'required|string|max:255',
        ]);

        $parent = ParentModel::find($request->parent_id);
        $parent->notify(new AdminNotification($request->message));

        return back()->with('status', 'Thông báo đã được gửi tới phụ huynh.');
    }

    // Gửi thông báo cho nhiều phụ huynh
    public function sendToMultipleParents(Request $request)
    {
        $request->validate([
            'parent_id' => 'required|array', // Đảm bảo parent_id là mảng
            'parent_id.*' => 'exists:parents,id', // Kiểm tra tất cả parent_id trong mảng tồn tại
            'message' => 'required|string|max:255',
        ]);

        $parents = ParentModel::whereIn('id', $request->parent_id)->get();
        foreach ($parents as $parent) {
            $parent->notify(new AdminNotification($request->message));
        }

        return back()->with('status', 'Thông báo đã được gửi tới các phụ huynh.');
    }

    // Gửi thông báo cho tất cả phụ huynh
    public function sendToAllParents(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $parents = ParentModel::all();
        foreach ($parents as $parent) {
            $parent->notify(new AdminNotification($request->message));
        }

        return back()->with('status', 'Thông báo đã được gửi tới tất cả phụ huynh.');
    }
}
