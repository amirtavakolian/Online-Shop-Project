<?php

namespace Modules\Auth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\App\Http\Requests\RegisterUserRequest;
use Modules\Auth\App\Jobs\VerificatiomEmailJob;
use Modules\Auth\App\Repositories\IAuthRepo;

class RegisterController extends Controller
{

    public function __construct(private IAuthRepo $authRepo)
    {
    }

    public function registerView()
    {
        return view('auth::register');
    }

    public function register(RegisterUserRequest $request)
    {
        $user = $this->authRepo->register($request->validated());
        Auth::login($user);
        VerificatiomEmailJob::dispatch($user);
        return redirect()->route('home.index');
    }
}
