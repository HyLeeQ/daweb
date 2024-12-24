<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:15',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required|in:admin,teacher,parent',
        ], [
            'name.required' => 'Họ và tên không được để trống.',
            'email.required' => 'Email không được để trống.',
            'email.unique' => 'Email này đã được sử dụng. Vui lòng chọn email khác.',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp.',
            'role.required' => 'Vui lòng chọn loại tài khoản.',
        ]);

        // Bắt đầu transaction để đảm bảo tính toàn vẹn dữ liệu
        DB::beginTransaction();
        try {
            // Tạo người dùng
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'password' => Hash::make($validatedData['password']),
                'role' => $validatedData['role'],
            ]);

            // Điều hướng theo loại tài khoản
            if ($validatedData['role'] === 'teacher') {
                DB::commit();
                return redirect()->route('admin.teacher.create', ['user_id' => $user->id]);
            } elseif ($validatedData['role'] === 'parent') {
                DB::commit();
                return redirect()->route('admin.parents.create', ['user_id' => $user->id]);
            }

            // Hoàn tất giao dịch
            DB::commit();
            return redirect()->route('admin.index')->with('success', 'Tài khoản đã được tạo thành công.');
        } catch (\Exception $e) {
            // Rollback nếu có lỗi
            DB::rollBack();
            return back()->withErrors(['error' => 'Đã xảy ra lỗi khi tạo tài khoản: ' . $e->getMessage()]);
        }
    }
}