<?php

namespace App\Http\Controllers;

use App\Models\ParentModel;
use App\Models\Student;
use App\Models\User;
use App\Models\Teacher;
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
        return view('admin.teacher.create', compact('user'));
    }

    public function createParentForm($user_id)
    {
        $user = User::find($user_id);
        return view('admin.parents.create', compact('user'));
    }

    public function teachersIndex()
    {
        $teachers = Teacher::all();
        return view('admin.teachers.index', compact('teachers'));
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
        $teacher->delete();

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

        if (!$parent) {
            return redirect()->route('admin.parents.index')->withErrors(['parent', 'Không tìm thấy phụ huynh nào']);
        }
        return view('admin.parents.edit', compact('parent'));
    }

    public function parentsUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'students.*.name' => 'required|string|max:255',
            'students.*.class' => 'required|string|max:40',
        ]);

        $parent = ParentModel::find($id);

        if (!$parent) {
            return redirect()->route('admin.parents.index')->withErrors('parent', 'Không tìm thấy phụ huynh nào');
        }
        $parent->update($validatedData);

        foreach ($request->students as $studentId => $studentData) {
            $student = $parent->students()->find($studentId);
            if ($student) {
                $student->update($studentData);
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

        $parent->delete();

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
}
