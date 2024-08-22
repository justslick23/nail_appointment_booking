<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentTimesSeeder extends Seeder
{
    public function run()
    {
        $startTime = new \DateTime('09:00');
        $endTime = new \DateTime('16:00');

        while ($startTime < $endTime) {
            DB::table('appointment_times')->insert([
                'date' => now()->toDateString(), // Adjust as needed
                'time' => $startTime->format('H:i'),
                'available' => true,
            ]);

            $startTime->modify('+1 hour');
        }
    }
}