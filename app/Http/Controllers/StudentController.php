<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\ParentModel;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Timetable;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $parents = ParentModel::all();
        $teachers = Teacher::all();
        $classrooms = Classroom::all();
        return view('admin.students.create', compact('classrooms', 'parents', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'course' => 'required|string',
            'class' => 'required|exists:classrooms,id',
            'teacher' => 'required|exists:teachers,id', // Kiểm tra ID của giáo viên
            'parent_id' => 'required|exists:parents,id',
            'gender' => 'required|in:Nam,Nữ',
        ]);

        // Lấy lớp học từ tên lớp
        $classroom = Classroom::where('name', $request->class)->first();

        if (!$classroom) {
            return back()->withErrors(['class' => 'Tên lớp không hợp lệ.'])->withInput();
        }

        $student = Student::create([
            'name' => $request->name,
            'dob' => $request->dob,
            'course' => $request->course,
            'class' => $request->class,
            'teacher' => '',  // Chưa lưu tên giáo viên, sẽ lưu sau
            'parent_id' => $request->parent_id,
            'classroom_id' => $classroom->id,
            'gender' => $request->gender,
            'teacher_id' => $request->teacher // Lưu teacher_id vào bảng students
        ]);

        // Truy vấn tên giáo viên từ bảng teachers bằng teacher_id
        $teacher = Teacher::find($request->teacher);  // Lấy thông tin giáo viên theo teacher_id

        if ($teacher) {
            // Cập nhật tên giáo viên vào cột teacher của học sinh
            $student->teacher = $teacher->name;
            $student->save();  // Lưu lại thông tin đã cập nhật
        }

        // Lấy tất cả giáo viên dạy môn học trong lớp này
        $teachers = Timetable::where('class_id', $classroom->id)
            ->with('teacher')  // Eager load giáo viên
            ->get();

        // Lưu giáo viên vào bảng grades
        foreach ($teachers as $timetable) {
            // Lấy thông tin subject_id của giáo viên từ bảng teachers
            $teacher = $timetable->teacher;  // Lấy giáo viên từ quan hệ

            // Nếu không có subject_id từ bảng teachers
            if ($teacher) {
                Grade::create([
                    'student_id' => $student->id,  // ID học sinh
                    'teacher_id' => $timetable->teacher_id, // ID giáo viên
                    'subject_id' => $teacher->subject_id,  // Lấy subject_id từ giáo viên
                    'regular_score_1' => 0, // Điểm mặc định
                    'regular_score_2' => 0,
                    'regular_score_3' => 0,
                    'midterm_score' => 0,
                    'final_score' => 0,
                ]);
            }
        }

        // Chuyển hướng về trang danh sách học sinh
        return redirect()->route('admin.students.index')->with('success', 'Thêm học sinh thành công');
    }



    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $students = Student::where('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('class', 'LIKE', '%' . $keyword . '%')
            ->orWhere('course', 'LIKE', '%' . $keyword . '%')
            ->get();

        return view('admin.students.search', compact('students'));
    }


    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'course' => 'required|string',
            'class' => 'required|string|max:50',
            'teacher' => 'required|string|max:255',
            'gender' => 'required|in:Nam,Nữ',
        ]);

        // Tìm và cập nhật thông tin học sinh
        $student = Student::findOrFail($id);
        $student->update([
            'name' => $request->name,
            'dob' => $request->dob,
            'course' => $request->course,
            'class' => $request->class,
            'teacher' => $request->teacher,
            'gender' => $request->gender,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Cập nhật thông tin học sinh thành công!');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('admin.students.index')->with('success', 'Xóa học sinh thành công!');
    }
}
