<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentsTable extends Migration
{
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Liên kết với bảng users
            $table->string('name');   // Tên phụ huynh, lấy từ bảng users
            $table->string('email');  // Email, lấy từ bảng users
            $table->string('phone');  // Số điện thoại, lấy từ bảng users
            $table->string('child_name')->nullable(); // Tên con cái, thông tin riêng của bảng parents
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parents');
    }
}

