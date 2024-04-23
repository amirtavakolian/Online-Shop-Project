<?php

namespace Modules\Auth\App\Services;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use Modules\Auth\App\Jobs\SendTwoFactorActivationCodeJob;
use Modules\Auth\App\Jobs\SendTwoFactorMailJob;

class TwoFactorService
{
    const EMAIL_NOT_FOUND = 'ایمیل مورد نظر یافت نشد';
    const  ٌWRONG_CODE = 'کد وارد شده صحیح نمیباشد';

    public function sendTwoFactorCode()
    {
        if (!$this->checkCodeExist()) {
            $twoFactorCode = $this->generateCode();
            $this->storeCodeInCache($twoFactorCode);
            SendTwoFactorMailJob::dispatch($twoFactorCode, auth()->user()->email);
        }
    }

    public function checkTwoAuthCode($userTypedCode, $index = "")
    {
        $twoAuthCode = Redis::get($index . auth()->user()->email);

        if (is_null($twoAuthCode)) {
            return self::EMAIL_NOT_FOUND;
        }

        if ($twoAuthCode != $userTypedCode) {
            return self::ٌWRONG_CODE;
        }
    }

    public function activeTwoFactor($user)
    {
        $code = $this->generateCode();
        $this->storeCodeInCache($code, 'activation_');
        SendTwoFactorActivationCodeJob::dispatch($code, $user->email);

    }

    private function generateCode()
    {
        return Str::random(6);
    }

    private function storeCodeInCache($twoFactorCode, $index = '')
    {
        Redis::setex($index . auth()->user()->email, 300, $twoFactorCode);
    }

    private function checkCodeExist()
    {
        return Redis::get(auth()->user()->email);
    }
}
