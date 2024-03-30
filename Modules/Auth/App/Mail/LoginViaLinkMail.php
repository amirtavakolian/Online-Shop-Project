<?php

namespace Modules\Auth\App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoginViaLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $url)
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
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
