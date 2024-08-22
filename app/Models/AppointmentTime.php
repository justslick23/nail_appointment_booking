<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentTime extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'time',
        'available',
    ];

    public function appointments()
{
    return $this->belongsToMany(Appointment::class);
}

// In app/Models/AppointmentTime.php
public static function updateAvailability($date, $time, $isAvailable)
{
    $appointmentTime = self::where('date', $date)
                            ->where('time', $time)
                            ->first();

    if ($appointmentTime) {
        $appointmentTime->update(['available' => $isAvailable]);
    }
}

}
