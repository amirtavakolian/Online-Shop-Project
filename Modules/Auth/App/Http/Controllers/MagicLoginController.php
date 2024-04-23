<?php

namespace Modules\Auth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\App\Http\Requests\MagicLogincRequest;
use Modules\Auth\App\Services\MagicLoginService;

class MagicLoginController extends Controller
{

    public function __construct(private MagicLoginService $magicLoginService)
    {
    }

    public function index()
    {
        return view('auth::magic-login');
    }

    public function sendMagicLoginLink(MagicLogincRequest $request)
    {
        $this->magicLoginService->sendMagicLoginLink($request->input('email'));
        return redirect()->back()->with('success', 'لینک ورود با موفقیت ارسال شد');
    }

    public function authenticate(Request $request)
    {
        $user = $this->magicLoginService->authenticate($request->input('email'), $request->input('token'));
        if (!$user) {
            return redirect()->route('magic.link.index')->with(['failed' => 'ایمیل وارد شده اشتباه است']);
        }
        Auth::login($user, true);
        return redirect()->route('home.index');
    }
}
