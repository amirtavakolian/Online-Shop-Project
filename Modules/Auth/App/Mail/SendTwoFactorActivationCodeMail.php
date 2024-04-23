<?php

namespace Modules\Auth\App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendTwoFactorActivationCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $code)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Two Factor Activation Code Mail',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'auth::mail.two-factor',
            with: ['code', $this->code]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
