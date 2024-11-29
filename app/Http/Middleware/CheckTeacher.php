<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckTeacher
{
    public function handle(Request $request, Closure $next)
    {
        // Ghi log thông tin để debug
        Log::info('Request data:', $request->all());
        Log::info('Route parameters:', $request->route()->parameters());

        // Kiểm tra quyền truy cập
        if (Auth::check() && Auth::user()->role == 'teacher') {
            return $next($request);
        }

        // Chuyển hướng nếu không có quyền
        return redirect()->route('login.form')->with('error', 'Bạn không có quyền truy cập vào trang này.');
    }
}
