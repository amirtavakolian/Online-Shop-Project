<?php

namespace Modules\Auth\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckTwoAuthIsActive
{

    public function handle(Request $request, Closure $next): Response
    {
        if (
            auth()->user() &&
            auth()->user()->two_auth == 1 &&
            !Session::has('2fa') ||
            now()->diffInMinutes(session::get('2fa')) > 30
        ) {
            return redirect()->route('two-auth.index');
        }
        return $next($request);
    }
}
