<?php

namespace Modules\Coworkers\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Coworkers\App\Http\Requests\LoginCoworkerRequest;
use Modules\Coworkers\App\Models\Coworker;

class CoworkerAuthenticationController extends Controller
{

    public function loginIndex()
    {
        return view('coworkers::auth.login');
    }

    public function login(LoginCoworkerRequest $request)
    {
        $userExists = Coworker::query()->where('username', $request->input('username'))->first();
        if (!Auth::guard('coworker')->attempt($request->validated(), true)) {
            return redirect()->back()->with('failed', 'نام کاربری یا رمز عبور صحیح نمیباشد');
        }
        return redirect()->route('coworkers.tickets.index');
    }
}
