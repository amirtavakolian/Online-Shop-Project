<?php

namespace Modules\Auth\App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Modules\Auth\App\Models\User;

class LoginViaLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $user)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Login Via Link Mail',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'auth::mail.link-login',
            with: ['url' => $this->generateLink()]
        );
    }

    public function attachments(): array
    {
        return [];
    }

    private function generateLink()
    {
        return URL::temporarySignedRoute(
            'login.link', now()->addMinutes(10), ['email' => $this->user->email]);
    }
}
