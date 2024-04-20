<?php

namespace Modules\Auth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Auth\App\Http\Requests\EmailVerificationRequest;
use Modules\Auth\App\Jobs\VerificatiomEmailJob;
use Modules\Auth\App\Models\User;

class ActiveEmailController extends Controller
{

    public function index()
    {
        return view('auth::verification.verification-index');
    }

    public function sendVerificationEmail(EmailVerificationRequest $request)
    {
        VerificatiomEmailJob::dispatch(auth()->user());
        return redirect()->route('panel')->with('success', 'ایمیل فعال سازی با موفقیت ارسال شد');
    }

    public function verify(Request $request, User $user)
    {
        if (
            !$request->hasValidSignature()
            || $user->email_verified_at
            || $user->email != auth()->user()->email
        ) {
            abort(404);
        }

        $user->markEmailAsVerified();
        return redirect()->route('home.index')->with('success', 'ایمیل شما با موفقیت فعال شد');
    }
}
