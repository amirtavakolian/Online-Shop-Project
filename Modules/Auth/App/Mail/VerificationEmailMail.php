<?php

namespace Modules\Auth\App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class VerificationEmailMail extends Mailable
{
    use Queueable, SerializesModels;


    public function __construct(private string $email)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verification Email Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $url = $this->generateLink();
        return new Content(
            view: 'auth::mail.verification-mail',
            with: ['url' => $url ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function generateLink()
    {
        return URL::temporarySignedRoute(
            'email.active.verify', now()->addMinutes(10), ['user' => $this->email]
        );
    }
}
