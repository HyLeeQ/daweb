<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id(); // ID của bản ghi điểm
            $table->foreignId('teacher_id')->constrained('users'); // ID của giáo viên (khóa ngoại đến bảng users)
            $table->foreignId('student_id')->constrained('students'); // ID của học sinh (khóa ngoại đến bảng students)
            $table->foreignId('class_id')->constrained('classrooms'); // ID của lớp (khóa ngoại đến bảng classrooms)
            $table->decimal('regular_score_1', 5, 2)->default(0.00);
            $table->decimal('regular_score_2', 5, 2)->default(0.00);
            $table->decimal('regular_score_3', 5, 2)->default(0.00);
            $table->decimal('midterm_score', 5, 2)->default(0.00);
            $table->decimal('final_score', 5, 2)->default(0.00);
            $table->timestamps();
        
            // Đảm bảo mỗi giáo viên và học sinh chỉ có một bảng điểm
            $table->unique(['teacher_id', 'student_id', 'class_id']); 
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
