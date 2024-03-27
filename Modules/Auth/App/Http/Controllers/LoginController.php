<?php

namespace Modules\Auth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Modules\Auth\App\Http\Requests\LoginUserRequest;
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
                ->with('failed', 'اکانت شما غیر فعال شده است. لطفا جهت فعال کردن ایمیلتان <a href="' . route('') . '">کلیک کنید</a>');
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            Redis::incr($user->email . '_attempts');
            return redirect()->back()->with('failed', 'ایمیل یا پسورد وارد شده اشتباه است');
        }
    }
}
