<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'appointment_date', 'appointment_time', 'user_id'];

    public function scopeAvailableTimes($query, $date)
    {
        $start = \Carbon\Carbon::createFromTime(9, 0);
        $end = \Carbon\Carbon::createFromTime(16, 0);
        $duration = 90; // 1 hour 30 minutes

        // Collect all booked times
        $appointments = $query->where('appointment_date', $date)->get();
        $bookedTimes = $appointments->pluck('appointment_time')->toArray();

        $availableTimes = [];
        while ($start->lt($end)) {
            $timeSlotEnd = $start->copy()->addMinutes($duration);
            if (!$bookedTimes || !$bookedTimes->contains($start->format('H:i'))) {
                $availableTimes[] = $start->format('H:i');
            }
            $start->addHour(); // Increment by an hour
        }

        return $availableTimes;
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'appointment_service');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
