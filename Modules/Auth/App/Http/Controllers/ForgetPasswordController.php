<?php

namespace Modules\Auth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Modules\Auth\App\Http\Requests\ForgetPasswordRequest;
use Modules\Auth\App\Models\User;

class ForgetPasswordController extends Controller
{

    public function index()
    {
        return view('auth::forgetpass');
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => 'لینک تغییر پسورد با موفقیت ارسال شد'])
            : back()->with(['failed' => __($status)]);
    }

    public function resetPasswordView(Request $request, string $token)
    {
        $email = $request->input('email');
        return view('auth::reset-password', compact('token', 'email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', __($status))
            : back()->withErrors(['failed' => [__($status)]]);
    }
}
