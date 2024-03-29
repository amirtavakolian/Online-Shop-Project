<?php

namespace Modules\Auth\App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UnlockAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $url)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Unlock Account Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'auth::mail.unlock',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
