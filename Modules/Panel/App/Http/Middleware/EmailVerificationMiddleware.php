<?php

namespace Modules\Panel\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class EmailVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->email_verified_at == null) {
            Session::flash('verify_email', 'لطفا ایمیل خود را تایید کنید ' . "<a href='" . route('email.active.index') . "'>اینجا کلیک کنید</a>");
        }

        return $next($request);
    }
}
