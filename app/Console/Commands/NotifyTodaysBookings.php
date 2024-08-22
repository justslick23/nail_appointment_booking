<?php

// app/Console/Commands/NotifyTodaysBookings.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Notification;
use Carbon\Carbon;

class NotifyTodaysBookings extends Command
{
    protected $signature = 'notify:today-bookings';
    protected $description = 'Notify clients and admin about today\'s bookings';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::today();
        $bookings = Appointment::whereDate('appointment_date', $today)->get();

        if ($bookings->isNotEmpty()) {
            $admin = User::where('is_admin', true)->first();

            foreach ($bookings as $booking) {
                $client = $booking->user; // Assuming each booking has a user relationship

                $message = "Your booking is scheduled for today:\n";
                $message .= "Service: {$booking->services->pluck('name')->join(', ')}\n";
                $message .= "Time: {$booking->appointment_time}";

                Notification::create([
                    'user_id' => $client->id,
                    'type' => 'Today\'s Booking',
                    'data' => $message,
                ]);
            }

            // Notify admin
            $adminMessage = "Today's bookings:\n";
            foreach ($bookings as $booking) {
                $adminMessage .= "Client: {$booking->user->name}, Service: {$booking->services->pluck('name')->join(', ')}, Time: {$booking->appointment_time}\n";
            }

            Notification::create([
                'user_id' => $admin->id,
                'type' => 'Today\'s Bookings',
                'data' => $adminMessage,
            ]);
        }

        return 0;
    }
}
