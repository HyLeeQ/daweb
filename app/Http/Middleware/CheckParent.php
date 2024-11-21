<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckParent
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'parent') {
            return $next($request);
        }

        return redirect()->route('login.form')->with('error', 'Bạn không có quyền truy cập vào trang này.');
    }
}

