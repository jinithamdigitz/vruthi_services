<?php
// app/Mail/ContactFormSubmitted.php

namespace App\Mail;

use App\Models\ContactSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    public function __construct(ContactSubmission $contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {
        return $this->subject('New Contact Form Submission: ' . $this->contact->subject)
                    ->view('emails.contact-submitted')
                    ->with([
                        'contact' => $this->contact,
                    ]);
    }
}