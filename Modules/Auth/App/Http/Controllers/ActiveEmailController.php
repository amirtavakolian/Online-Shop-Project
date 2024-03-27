<?php

namespace Modules\Auth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\App\Models\User;

class ActiveEmailController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        if (!$request->hasValidSignature() || $user->email_verified_at) {
            abort(404);
        }
        $user->markEmailAsVerified();
        return redirect()->route('home.index')->with('success', 'ایمیل شما با موفقیت فعال شد');
    }
}
