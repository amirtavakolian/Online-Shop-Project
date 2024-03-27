<?php

namespace Modules\Auth\App\Repositories;

interface IAuthRepo
{

    public function register(array $userCredentials);
}
