<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use App\Mail\BookingConfirmationWithAttachment;
use Illuminate\Support\Facades\Storage;
class AppointmentController extends Controller
{
    public function index()
    {
        // Fetch all appointments
        $appointments = Appointment::all();

        // Return the view with appointments data
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $services = Service::all();
        $user = auth()->user();
  if ($user->role === 'admin') {
        // Fetch customers (assuming there's a 'customer' role or similar)
        $users = User::where('role', 'customer')->get();
    }
        return view('appointments.create', compact('services', 'user', 'users'));
    }

    public function availableTimes(Request $request)
    {
        $date = $request->input('date');
        
        // Define the default appointment duration in minutes
        $appointmentDuration = 90; // 90 minutes
        
        // Define working hours
        $startHour = 9; // 9 AM
        $endHour = 16; // 4 PM
    
        // Get all booked appointments for the selected date
        $appointments = Appointment::whereDate('appointment_date', $date)->get();
    
        $availableTimes = [];
    
        // Generate all possible start times at 30-minute intervals
        for ($hour = $startHour; $hour < $endHour; $hour++) {
            for ($minute = 0; $minute < 60; $minute += 30) {
                $startTime = sprintf('%02d:%02d', $hour, $minute);
                $endTime = date('H:i', strtotime($startTime . ' +' . $appointmentDuration . ' minutes'));
                
                // Convert start and end times to timestamps
                $startTimestamp = strtotime($date . ' ' . $startTime);
                $endTimestamp = strtotime($date . ' ' . $endTime);
                
                $isAvailable = true;
    
                // Check if the time slot overlaps with any existing appointments
                foreach ($appointments as $appointment) {
                    $appointmentStart = strtotime($appointment->appointment_date . ' ' . $appointment->appointment_time);
                    $appointmentEnd = $appointmentStart + ($appointmentDuration * 60);
    
                    // Check for overlap
                    if (($startTimestamp < $appointmentEnd) && ($endTimestamp > $appointmentStart)) {
                        $isAvailable = false;
                        break;
                    }
                }
    
                // Add time slot to available times if it's free
                if ($isAvailable) {
                    $availableTimes[] = $startTime;
                }
            }
        }
    
        return response()->json(['times' => $availableTimes]);
    }
    
    
    
    
 
public function store(Request $request)
{
    // Validate input
    $validated = $request->validate([
        'name' => 'string|max:255',
        'email' => 'required|email|max:255',
        'appointment_date' => 'required|date',
        'appointment_time' => 'required|string',
        'services' => 'nullable|array', // Validate services as an array
        'services.*' => 'exists:services,id' // Ensure each service ID exists
    ]);

    // Store the appointment
    $appointment = new Appointment();
    $appointment->appointment_date = $validated['appointment_date'];
    $appointment->appointment_time = $validated['appointment_time'];
    $appointment->user_id = $request->input('user_id');;
    $appointment->save();

    // Attach selected services to the appointment
    if ($request->has('services')) {
        $serviceIds = $request->input('services'); // Get the array of service IDs
        $appointment->services()->attach($serviceIds);
    }

    // Notify admin and client
    $admin = User::where('role', 'admin')->first();
    $client = auth()->user(); // Assuming the client is authenticated

    // Notify admin
    $this->notifyUser($admin, 'Booking Created', 'A new booking has been created.');

    // Notify client
    $this->notifyUser($client, 'Booking Confirmation', 'Your booking has been confirmed.');

  /*   // Send email with booking details
    Mail::to($client->email)->send(new BookingConfirmation($appointment));
 */
    // Redirect with success message
    return redirect()->route('appointments.create')->with('success', 'Appointment booked successfully!');
}

private function notifyUser($user, $type, $message)
{
    Notification::create([
        'user_id' => $user->id,
        'type' => $type,
        'data' => $message,
    ]);
}

}

