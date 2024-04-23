<?php

namespace Modules\Auth\App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Modules\Auth\App\Mail\LoginViaLinkMail;
use Modules\Auth\App\Models\User;

class LoginViaLinkJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct(private User $user)
    {
        //
    }

    public function handle(): void
    {
        Mail::to($this->user->email)->send(new LoginViaLinkMail($this->user));
    }
}
