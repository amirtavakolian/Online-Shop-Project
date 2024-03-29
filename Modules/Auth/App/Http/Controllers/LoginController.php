<?php

namespace Modules\Auth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnlockEmailRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\URL;
use Modules\Auth\App\Http\Requests\LoginUserRequest;
use Modules\Auth\App\Mail\UnlockAccountMail;
use Modules\Auth\App\Models\User;
use Modules\Auth\App\Repositories\IAuthRepo;

class LoginController extends Controller
{

    public function __construct(private IAuthRepo $authRepo)
    {
    }

    public function loginView()
    {
        return view('auth::login');
    }

    public function login(LoginUserRequest $request)
    {
        $user = $this->authRepo->findUserByEmail($request->input('email'));

        if (!$user) {
            return redirect()->back()->with('failed', 'ایمیل یا پسورد وارد شده اشتباه است');
        }

        if (Redis::get($user->email . '_attempts') == 5) {
            return redirect()->back()
                ->with('failed', 'اکانت شما غیر فعال شده است. لطفا جهت فعال کردن ایمیلتان <a href="' . route('unlock.index') . '">کلیک کنید</a>');
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            Redis::incr($user->email . '_attempts');
            if (Redis::get($user->email . '_attempts') == 5) {
                $user->is_locked = 1;
            }
        }
        return redirect()->route('home.index');
    }

    public function unlockView()
    {
        return view('auth::unlock');
    }

    public function unlock(UnlockEmailRequest $request)
    {
        $user = $this->authRepo->getLockedEmail($request->input('email'));
        if (!$user) {
            return redirect()->back()->with('failed', 'ایمیل وارد شده موجود نمیباشد');
        }
        $url = URL::temporarySignedRoute('unlock.email', now()->addMinutes(10), ['user' => $user->email]);
        Mail::to($user->email)->send(new UnlockAccountMail($url));
        return redirect()->back()->with('success', 'لطفا ایمیل خود را چک کنید');
    }

    public function unlockEmail(Request $request, User $user)
    {
        $user->is_locked = 0;
        Redis::del($user->email . '_attempts');
        return redirect()->route('login.index')->with('success', 'اکانت شما با موفقیت فعال شد');
    }
}
