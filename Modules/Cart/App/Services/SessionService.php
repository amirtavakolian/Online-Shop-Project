<?php

namespace Modules\Cart\App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SessionService
{

    public function add($key, $value)
    {
        Session::put($key, $value);
    }

    public function exists($key)
    {
        return Session::exists($key);
    }

    public function get($key)
    {
        return Session::get($key);
    }


    public function clear($key)
    {
        Session::remove($key);
    }
}
