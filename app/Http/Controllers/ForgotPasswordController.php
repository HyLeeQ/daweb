<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password; 
use App\Http\Controllers\Controller;

class ForgotPasswordController extends Controller
{
    public function showLinkResetForm()
    {
        return view('forgot');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        // Gửi link đặt lại mật khẩu
        $status = Password::sendResetLink($request->only('email'));

        // Kiểm tra trạng thái gửi email
        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __('passwords.reset_link_send'))
            : back()->withErrors(['email' => __('passwords.reset_failed')]);
    }
}
