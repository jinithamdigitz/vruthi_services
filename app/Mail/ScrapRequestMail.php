<?php

namespace App\Mail;

use App\Models\ScrapRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class ScrapRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $scrapRequest;

    /**
     * Create a new message instance.
     */
    public function __construct(ScrapRequest $scrapRequest)
    {
        $this->scrapRequest = $scrapRequest;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            subject: 'New Scrap Request Received - ' . $this->scrapRequest->full_name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.scrap-request',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}