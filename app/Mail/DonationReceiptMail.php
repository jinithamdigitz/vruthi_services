<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonationReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $donation;
    public $pdfPath;

    public function __construct($donation, $pdfPath)
    {
        $this->donation = $donation;
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        return $this->subject('Thank you for your donation!')
            ->view('emails.donation_receipt')
            ->attach($this->pdfPath, [
                'as' => 'DonationReceipt.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}
