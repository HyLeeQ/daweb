<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token = null){
        return view('reset', ['token'=> $token, 'email'=> $request->email]);
    }

    public function reset(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|confirmed|min:8',
            'token'=> 'required'
        ]);

        $status = Password::reset(
            $request->only('email', 'password','password_confirmation', 'token'),
            function($user,$password){
                $user->password = hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            // Sử dụng thông báo từ tệp ngôn ngữ cho trường hợp thành công
            return back()->with('status', __('passwords.password_reset_success'));
        } else {
            // Sử dụng thông báo từ tệp ngôn ngữ cho trường hợp không thành công
            return back()->withErrors(['email' => [__('passwords.password_reset_failed')]]);
        }
    }
}
