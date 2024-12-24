<?php

// app/Http/Controllers/TimeTableController.php
namespace App\Http\Controllers;

use App\Models\Timetable;
use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TimeTableController extends Controller
{
    public function create()
    {
        $classes = Classroom::all();  // Lấy tất cả các lớp
        $teachers = Teacher::all();  // Lấy tất cả các giáo viên
        return view('admin.timetable.create', compact('classes', 'teachers'));
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'class_id' => 'required|exists:classrooms,id',
            'time' => 'required|array',
            'schedule' => 'required|array',
        ]);

        // Lưu dữ liệu vào bảng timetables
        foreach ($validated['schedule'] as $timeSlot => $days) {
            foreach ($days as $day => $teacherId) {
                if ($teacherId) {
                    Timetable::create([
                        'class_id' => $validated['class_id'],
                        'time_slot' => $timeSlot,
                        'day_of_week' => $day,
                        'teacher_id' => $teacherId,
                    ]);
                }
            }
        }

        return redirect()->route('admin.timetable.create')->with('status', 'Thời khóa biểu đã được tạo thành công!');
    }
    public function destroy($class_id)
    {
        // Xóa tất cả thời khóa biểu liên quan đến lớp với class_id
        Timetable::where('class_id', $class_id)->delete();

        // Trả về thông báo thành công
        return redirect()->route('admin.timetable.index')->with('status', 'Thời khóa biểu của lớp đã được xóa thành công.');
    }
}
