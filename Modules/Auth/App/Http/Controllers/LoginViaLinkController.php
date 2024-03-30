<?php

namespace Modules\Auth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\App\Http\Requests\LoginViaLinkRequest;
use Modules\Auth\App\Jobs\LoginViaLinkJob;
use Modules\Auth\App\Repositories\IAuthRepo;

/*
 * @method Modules\Auth\App\Repositories\IAuthRepo findUserByEmail($email)
 */

class LoginViaLinkController extends Controller
{

    public function __construct(private IAuthRepo $authRepo)
    {
    }

    public function index()
    {
        return view('auth::login-link');
    }

    public function generateLink(LoginViaLinkRequest $request)
    {
        $user = $this->authRepo->findUserByEmail($request->input('email'));
        if (!$user) {
            $user = $this->authRepo->register($request->all());
        }
        LoginViaLinkJob::dispatch($user);
        return redirect()->back()->with('success', 'لینک مستقیم برای شما ایمیل شد');
    }

    public function login(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(404);
        }
        $user = $this->authRepo->findUserByEmail($request->input('email'));
        Auth::login($user);
        return redirect()->route('home.index');
    }
}
