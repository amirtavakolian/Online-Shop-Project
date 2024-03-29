<?php

namespace Modules\Auth\App\Repositories;

use Modules\Auth\App\Models\User;

class AuthRepo implements IAuthRepo
{

    public function register(array $userCredentials)
    {
        return User::query()->create($userCredentials);
    }

    public function findUserByEmail($email)
    {
        return User::query()->where('email', $email)->first();
    }

    public function getLockedEmail($email)
    {
        return User::query()->where('email', $email)
            ->where('is_locked', 1)
            ->first();
    }
}
