<?php

// app/Mail/BookingConfirmation.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Appointment;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function build()
    {
        return $this->view('emails.booking_confirmation')
                    ->with([
                        'date' => $this->appointment->appointment_date,
                        'time' => $this->appointment->appointment_time,
                        'services' => $this->appointment->services->pluck('name')->join(', '),
                    ]);
    }
}
