<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        //tìm người dùng theo số điện thoại
        $user = User::where('phone', $request->phone)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            // Phân luồng dựa trên vai trò của người dùng
            if ($user->role == 'admin') {
                return redirect()->route('admin.index'); // Đổi lại route admin phù hợp
            } elseif ($user->role == 'teacher') {
                return redirect()->route('teacher.dashboard'); // Đổi lại route teacher phù hợp
            } elseif ($user->role == 'parent') {
                return redirect()->route('parents.timetable'); // Đổi lại route parent phù hợp
            }
        }
        return back()->withErrors([
            'phone' => 'Thông tin đăng nhập chưa chính xác!!!'
        ]);
    }

    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
