<?php
// app/Mail/DonorThankYou.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class DonorThankYou extends Mailable
{
    use Queueable, SerializesModels;

    public $donation;
    public $transaction;

    public function __construct(Order $donation, $transaction = null)
    {
        $this->donation = $donation;
        $this->transaction = $transaction;
    }

    public function build()
    {
        return $this->subject('🙏 Thank You for Your Generous Donation to ENVED Foundation')
                    ->view('emails.donor-thankyou')
                    ->with([
                        'donation' => $this->donation,
                        'transaction' => $this->transaction,
                    ]);
    }
}