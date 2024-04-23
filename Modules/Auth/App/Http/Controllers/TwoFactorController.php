<?php

namespace Modules\Auth\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Auth\App\Http\Requests\TwoAuthCodeRequest;
use Modules\Auth\App\Services\TwoFactorService;

class TwoFactorController
{

    public function __construct(private TwoFactorService $twoFactorService)
    {
    }

    public function index()
    {
        $this->twoFactorService->sendTwoFactorCode();
        return view('auth::two-factor.index');
    }

    public function checkTwoAuthCode(TwoAuthCodeRequest $request)
    {
        $status = $this->twoFactorService->checkTwoAuthCode($request->input('two_auth'));

        if ($status == TwoFactorService::EMAIL_NOT_FOUND) {
            return redirect()->back()->with('failed', 'ایمیل مورد نظر یافت نشد');
        }

        if ($status == TwoFactorService::ٌWRONG_CODE) {
            return redirect()->back()->with('failed', 'کد وارد شده صحیح نمیباشد');
        }
        Session::put('2fa', now());
        return redirect()->route('home.index');
    }

    public function toggleView()
    {
        return view('auth::two-factor.toggle');
    }

    public function toggle(Request $request)
    {
        if (!$request->input('status')) {
            auth()->user()->deactiveTwoFactorAuth();
            return redirect()->back()->with('success', 'عملیات با موفقیت انجام شد');
        }
        $this->twoFactorService->activeTwoFactor(auth()->user());
        return redirect()->route('two-auth.active.view')->with('success', 'لطفا ایمیل خود را چک کنید');
    }

    public function activeView()
    {
        return view('auth::two-factor.active');
    }

    public function active(Request $request)
    {
        $status = $this->twoFactorService->checkTwoAuthCode($request->input('two_auth'), 'activation_');

        if ($status == TwoFactorService::EMAIL_NOT_FOUND) {
            return redirect()->back()->with('failed', 'ایمیل مورد نظر یافت نشد');
        }

        if ($status == TwoFactorService::ٌWRONG_CODE) {
            return redirect()->back()->with('failed', 'کد وارد شده صحیح نمیباشد');
        }
        auth()->user()->activeTwoFactorAuth();
        return redirect()->route('two-auth.toggle.view')->with('success', 'رمز عبور 2 مرحله ای برای شما فعال شد');
    }
}
