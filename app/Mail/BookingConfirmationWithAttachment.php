<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class BookingConfirmationWithAttachment extends Mailable
{
    use Queueable, SerializesModels;

    public $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function build()
    {
        return $this->view('emails.booking_confirmation_with_attachment')
                    ->attach(Storage::path($this->filename))
                    ->subject('Your Booking Confirmation');
    }
}
