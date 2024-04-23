<?php

namespace Modules\Auth\App\Services;

use Illuminate\Support\Str;
use Modules\Auth\App\Jobs\MagicLoginJob;
use Modules\Auth\App\Models\MagicLogin;
use Modules\Auth\App\Models\User;

class MagicLoginService
{

    public function sendMagicLoginLink($email)
    {
        $token = $this->generateToken();
        $this->storeTokenAndEmail($email, $token);
        $this->storeEmailInUsersTable($email);
        $this->sendLoginMail($email, $token);
    }

    private function generateToken()
    {
        return Str::random(16);
    }

    private function storeTokenAndEmail($email, $token)
    {
        MagicLogin::query()->updateOrCreate(
            [
                "email" => $email,
            ],
            [
                "token" => $token
            ]
        );
    }

    private function storeEmailInUsersTable($email)
    {
        $email = User::query()->where('email', $email)->first();
        if (!$email) {
            User::query()->create([
                "email" => $email
            ]);
        }
    }

    private function sendLoginMail($email, $token)
    {
        MagicLoginJob::dispatch($email, $token);
    }

    public function authenticate($email, $token)
    {
        $userEmail = $this->findByEmail($email, $token);
        if (!$userEmail) {
            return false;
        }
        $userEmail->delete();
        return User::query()->where('email', $email)->first();
    }

    private function findByEmail($email, $token)
    {
        return MagicLogin::query()->where([
            'email' => $email,
            "token" => $token
        ])->first();
    }
}
