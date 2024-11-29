<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Timetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    public function index($teacher_id)
    {
        // Lấy giáo viên theo teacher_id từ Auth (hoặc bạn có thể lấy từ cơ sở dữ liệu nếu cần)
        $teacher = Auth::user()->teacher;
    
        // Lấy danh sách thời khóa biểu của giáo viên
        $timetables = Timetable::where('teacher_id', $teacher_id)->get();
    
        // Khởi tạo mảng lưu điểm
        $grades = [];
        $classId = []; // Mảng lưu class_id của các lớp
    
        foreach ($timetables as $timetable) {
            // Lấy danh sách học sinh trong lớp (cần có bảng students liên kết với classrooms)
            $studentIds = DB::table('students')
                ->where('classroom_id', $timetable->class_id)
                ->pluck('id');
    
            // Lấy điểm của các học sinh đó
            $grades[$timetable->class_id] = Grade::whereIn('student_id', $studentIds)->get();
    
            // Lưu class_id vào mảng classIds
            $classId[] = $timetable->class_id;
        }
    
        // Truyền teacher, grades, teacher_id và classIds vào view
        return view('teacher.grades.index', compact('grades', 'teacher', 'teacher_id', 'classId'));
    }
    

    public function show($teacher_id, $class_id)
    {
        // Lấy thông tin điểm của học sinh trong lớp
        $grades = Grade::where('teacher_id', $teacher_id)
            ->whereHas('student', function ($query) use ($class_id) {
                $query->where('classroom_id', $class_id);
            })
            ->get();

        return view('teacher.grades.show', compact('grades'));
    }

    public function create($teacher_id)
    {
        // Lấy danh sách môn học của giáo viên
        $subjects = Subject::all();
        
        // Khởi tạo đối tượng Grade mới
        $grade = new Grade();
    
        return view('teacher.grades.create', compact('subjects', 'teacher_id', 'grade'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'teacher_id' => 'required',
            'subject_id' => 'required',
            'regular_score_1' => 'required|numeric',
            'regular_score_2' => 'required|numeric',
            'regular_score_3' => 'required|numeric',
            'midterm_score' => 'required|numeric',
            'final_score' => 'required|numeric',

        ]);

        Grade::create([
            'student_id' => $request->student_id,
            'teacher_id' => $request->teacher_id,
            'subject__id' => $request->subject_id,
            'regular_score_1' => $request->regular_score_1,
            'regular_score_2' => $request->regular_score_2,
            'regular_score_3' => $request->regular_score_3,
            'midterm_score' => $request->midterm_score,
            'final_score' => $request->final_score,
        ]);
        return redirect()->route('teacher.grades.index', ['teacher_id' => $request->teacher_id])->with('success', 'Điểm đã được cập nhật!');
    }
}
