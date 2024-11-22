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
        Schema::table('students', function (Blueprint $table) {
             // Thay đổi kiểu dữ liệu thành unsignedBigInteger để phù hợp với kiểu dữ liệu của bảng classrooms
             $table->unsignedBigInteger('classroom_id')->nullable();

             // Đặt khóa ngoại với bảng classrooms
             $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['classroom_id']);
            $table->dropColumn('classroom_id');
        });
    }
};
