<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $userRole = Auth::user()->role;

            // Ghi lại log về vai trò người dùng
            Log::info("User role: " . $userRole);

            if ($userRole == 'admin') {
                return $next($request);
            }
        }

        // Nếu người dùng không phải admin hoặc chưa đăng nhập
        return redirect()->route('login.form')->with('error', 'Bạn không có quyền truy cập vào trang này.');
    }
}
