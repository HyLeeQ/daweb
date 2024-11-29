<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('teacher_id')->nullable();  // Thêm cột teacher_id
    
            // Nếu cần có quan hệ, có thể thêm foreign key để liên kết với bảng teachers
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);  // Xóa foreign key
            $table->dropColumn('teacher_id');  // Xóa cột teacher_id
        });
    }
    
};
