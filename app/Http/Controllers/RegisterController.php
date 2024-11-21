<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('register');
    }

    // Xử lý đăng ký người dùng
    public function register(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:15',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required|in:admin,teacher,parent', 
        ]);

        // Tạo người dùng mới
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password), 
            'role' => $request->role, 
        ]);

        if($request->role === 'teacher'){
            return redirect()->route('admin.teacher.create', ['user_id' =>  $user->id]);
        }else if($request->role === 'parent'){
            return redirect()->route('admin.parents.create',['user_id' =>  $user->id]);
        }
        return redirect()->route('admin.index')->with('success', 'Đăng ký thành công');
    }
}

