<?php

namespace Modules\Cart\App\Services;

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

    public function increase($key)
    {
        $item = $this->get($key);
        $item['quantity'] += 1;
        return $item;
    }
}
