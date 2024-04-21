<?php

namespace Modules\Auth\App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Modules\Auth\App\Mail\MagicLoginMail;

class MagicLoginJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private string $email,
        private string $token
    )
    {
        //
    }
    public function handle(): void
    {
        Mail::to($this->email)->send(new MagicLoginMail($this->email, $this->token));
    }
}
