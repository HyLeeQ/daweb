<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ParentModel;
use App\Models\Student;
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

        $classrooms = Classroom::all();
        return view('admin.students.create', compact('classrooms', 'parents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'course' => 'required|string',
            'class' => 'required|exists:classrooms,id',
            'teacher' => 'required|string|max:255',
            'parent_id' => 'required|exists:parents,id'
        ]);

        Student::create([
            'name' => $request->name,
            'dob' => $request->dob,
            'course' => $request->course,
            'class' => $request->class,
            'teacher' => $request->teacher,
            'parent_id' => $request->parent_id,
        ]);

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
        ]);

        // Tìm và cập nhật thông tin học sinh
        $student = Student::findOrFail($id);
        $student->update([
            'name' => $request->name,
            'dob' => $request->dob,
            'course' => $request->course,
            'class' => $request->class,
            'teacher' => $request->teacher,
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
