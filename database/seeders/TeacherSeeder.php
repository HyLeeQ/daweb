<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    public function run()
    {
        Teacher::create([
            'name' => 'Nguyễn Văn A',
            'email' => 'nguyenvana@example.com',
            'phone' => '0123456789',
            'dob' => '1985-07-15',
            'course' => 'Toán học',
            'subject' => 'Toán',
            'address' => 'Hà Nội, Việt Nam',
            'password' => Hash::make('password123'),
            'role' => 'teacher',
        ]);
    }
}
