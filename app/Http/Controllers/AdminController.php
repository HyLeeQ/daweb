<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ParentModel;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Timetable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function __construct() {}

    public function index()
    {
        return view('admin.dashboard');
    }

    public function createTeacherForm($user_id)
    {
        $user = User::find($user_id);
        $subjects = Subject::all();
        return view('admin.teachers.create', compact('user', 'subjects'));
    }

    public function createParentForm($user_id)
    {
        $user = User::find($user_id);
        $classrooms = Classroom::all();
        $teachers = Teacher::all();

        return view('admin.parents.create', compact('user', 'classrooms', 'teachers'));
    }

    public function teachersIndex()
    {
        $teachers = Teacher::all();
        $classrooms = Classroom::all();
        return view('admin.teachers.index', compact('teachers', 'classrooms'));
    }

    // Hiển thị form tạo mới giáo viên
    public function teachersCreate()
    {
        return view('admin.teachers.create');
    }

    // Lưu giáo viên mới vào cơ sở dữ liệu
    public function teachersStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'phone' => 'required|string|max:15',
            'dob' => 'required|date',
            'course' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'address' => 'required|string|max:500'
        ]);

        Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'course' => $request->course,
            'subject' => $request->subject,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.teacher.index')->with('success', 'Thêm giáo viên thành công');
    }

    // Tìm kiếm giáo viên
    public function teachersSearch(Request $request)
    {
        $keyword = $request->input('keyword');
        $teachers = Teacher::where('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('email', 'LIKE', '%' . $keyword . '%')
            ->orWhere('course', 'LIKE', '%' . $keyword . '%')
            ->orWhere('subject', 'LIKE', '%' . $keyword . '%')
            ->get();

        return view('admin.teachers.search', compact('teachers'));
    }

    // Hiển thị form chỉnh sửa giáo viên
    public function teachersEdit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('admin.teachers.edit', compact('teacher'));
    }

    // Cập nhật thông tin giáo viên
    public function teachersUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $id,
            'phone' => 'required|string|max:15',
            'dob' => 'required|date',
            'course' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'address' => 'required|string|max:500'
        ]);

        $teacher = Teacher::findOrFail($id);
        $teacher->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'course' => $request->course,
            'subject' => $request->subject,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.teacher.index')->with('success', 'Cập nhật thông tin giáo viên thành công!');
    }

    // Xóa giáo viên
    public function teachersDestroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $user = $teacher->user;
        $teacher->delete();
        $user->delete();

        return redirect()->route('admin.teacher.index')->with('success', 'Xóa giáo viên thành công!');
    }

    public function parentsIndex()
    {
        $parents = ParentModel::with('students')->get();

        return view('admin.parents.index', compact('parents'));
    }

    public function parentsEdit($id)
    {
        $parent = ParentModel::with('students')->find($id);
        $classrooms = Classroom::all();

        if (!$parent) {
            return redirect()->route('admin.parents.index')->withErrors(['parent', 'Không tìm thấy phụ huynh nào']);
        }
        return view('admin.parents.edit', compact('parent', 'classrooms'));
    }

    public function parentsUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'students.*.name' => 'required|string|max:255',
            'students.*.classroom_id' => 'required|exists:classrooms,id',
            // 'students.*.gender'=> 'required|string|max:10'
        ]);

        $parent = ParentModel::find($id);

        if (!$parent) {
            return redirect()->route('admin.parents.index')->withErrors('parent', 'Không tìm thấy phụ huynh nào');
        }
        $parent->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone']
        ]);

        foreach ($request->students as $studentId => $studentData) {
            $student = $parent->students()->find($studentId);
            if ($student) {
                // Lấy tên lớp từ classroom_id
                $classroom = Classroom::find($studentData['classroom_id']);

                // Cập nhật thông tin học sinh
                $student->update([
                    'name' => $studentData['name'],          // Cập nhật tên học sinh
                    'classroom_id' => $studentData['classroom_id'],  // Cập nhật ID lớp học
                    'class' => $classroom ? $classroom->name : null, // Cập nhật tên lớp
                ]);
            }
        }
        return redirect()->route('admin.parents.index')->with('status', 'Thông tin của phụ huynh đã được lưu');
    }

    public function parentsDelete($id)
    {
        $parent = ParentModel::with('students')->find($id);

        if (!$parent) {
            return redirect()->route('admin.parents.index')->withErrors('parent', 'Không tìm thấy phụ huynh nào');
        }

        $parent->students()->delete();

        $user = $parent->user();

        $parent->delete();

        if ($user) {
            $user->delete();
        }

        return redirect()->route('admin.parents.index')->with('status', 'Phụ huynh và tất cả học sinh liên quan đã được xóa');
    }

    public function showParentInformation($id)
    {
        $parent = ParentModel::with('students')->find($id);

        if (!$parent) {
            return redirect()->back()->withErrors(['parent' => 'Không tìm thấy phụ huynh']);
        }

        return view('admin.parents.show', compact('parent'));
    }

    public function parentsSearch(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ request
        $keyword = $request->input('keyword');

        // Tìm phụ huynh theo tên, email, hoặc số điện thoại
        $parents = ParentModel::where('name', 'like', "%$keyword%")
            ->orWhere('email', 'like', "%$keyword%")
            ->orWhere('phone', 'like', "%$keyword%")
            ->get();

        // Trả về kết quả tìm kiếm ra view
        return view('admin.parents.search', compact('parents'));
    }

    public function showTimetable(Request $request)
    {
        // Lấy tất cả các lớp để hiển thị trong select box
        $classes = Classroom::all();
        
        // Kiểm tra xem có lớp nào được chọn hay không
        $selected_class_id = $request->input('class_id');
        
        if ($selected_class_id) {
            // Nếu có lớp được chọn, lấy thời khóa biểu của lớp đó
            $timetables = Timetable::with('classroom', 'teacher')
                ->where('class_id', $selected_class_id) // Lọc theo class_id
                ->get();
        } else {
            // Nếu không có lớp nào được chọn, không lấy thời khóa biểu
            $timetables = collect();
        }
        
        // Trả về view với danh sách lớp và thời khóa biểu nếu có
        return view('admin.timetable.index', compact('timetables', 'classes', 'selected_class_id'));
    }
    
    
}
