<?php

namespace Modules\Auth\App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Modules\Auth\App\Mail\SendTwoFactorMail;

class SendTwoFactorMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct(private string $twoFactorCode, private string $email)
    {
        //
    }

    public function handle(): void
    {
        Mail::to($this->email)->send(new SendTwoFactorMail($this->twoFactorCode, $this->email));
    }
}
