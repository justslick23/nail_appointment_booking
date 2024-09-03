<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Determine the user's role and redirect accordingly (case-insensitive)
        $role = strtolower(Auth::user()->role);
    
        if ($role === 'admin') {
            return $this->adminDashboard();
        } elseif ($role === 'customer') {
            return $this->customerDashboard();
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    // Admin dashboard function
    protected function adminDashboard()
    {
        // Get the current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $startDate = now();
        $endDate = now()->addDays(2);
        $upcomingAppointments = Appointment::whereBetween('appointment_date', [$startDate, $endDate])
            ->with('services', 'user') // Adjust based on your relationships
            ->get();
        // Count users and appointments created in the current month
        $userCount = User::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
        $appointmentCount = Appointment::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();

        // Get number of appointments per month for the current year
        $appointmentCounts = DB::table('appointments')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->pluck('count', 'month')
            ->toArray();
        
        $monthlyAppointments = array_fill(1, 12, 0);
        foreach ($appointmentCounts as $month => $count) {
            $monthlyAppointments[$month] = $count;
        }

        // Calculate total revenue for the current month
        $totalRevenue = DB::table('appointment_service')
            ->join('services', 'appointment_service.service_id', '=', 'services.id')
            ->join('appointments', 'appointment_service.appointment_id', '=', 'appointments.id')
            ->whereMonth('appointments.created_at', $currentMonth)
            ->whereYear('appointments.created_at', $currentYear)
            ->sum('services.price');

        // Fetch notifications for the admin
        $notifications = Notification::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Service popularity for the current month
        $servicePopularity = Appointment::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->with('services')
            ->get()
            ->flatMap(function ($appointment) {
                return $appointment->services;
            })
            ->groupBy('name')
            ->map(function ($group) {
                return $group->count();
            });
        
        $serviceNames = $servicePopularity->keys()->toArray();
        $serviceCounts = $servicePopularity->values()->toArray();

        // Total revenue for each month of the current year
        $appointments = Appointment::whereYear('created_at', $currentYear)
            ->with('services')
            ->get();
        
        $monthlyRevenue = $appointments->groupBy(function ($appointment) {
            return Carbon::parse($appointment->created_at)->month;
        })->map(function ($appointments) {
            return $appointments->flatMap(function ($appointment) {
                return $appointment->services;
            })->sum('price');
        });
        
        $months = range(1, 12);
        $revenues = array_map(function ($month) use ($monthlyRevenue) {
            return $monthlyRevenue->get($month, 0);
        }, $months);
        
        $monthNames = array_map(function ($month) {
            return Carbon::create()->month($month)->shortMonthName;
        }, $months);

        return view('admin.dashboard', compact('upcomingAppointments','revenues', 'monthNames', 'serviceNames', 'serviceCounts', 'userCount', 'appointmentCount', 'monthlyAppointments', 'totalRevenue', 'notifications'));
    }

    // Customer dashboard function
    public function customerDashboard()
    {
        $userId = Auth::id();
        $user = Auth::user();

        // Get the next appointment for the customer
        $nextAppointment = Appointment::where('user_id', $user->id)
        ->where('appointment_date', '>', Carbon::now())
        ->orderBy('appointment_date')
        ->first();
        // Get all appointments for the current year
        $appointmentsThisYear = Appointment::where('user_id', $userId)
            ->whereYear('appointment_time', Carbon::now()->year)
            ->get();
    
        // Get the last appointment for the customer
        $lastAppointment = Appointment::where('user_id', $user->id)
        ->orderBy('appointment_time', 'desc')
        ->first();

            // Cast dates to Carbon instances
    $nextAppointment = $nextAppointment ? $nextAppointment->setAttribute('appointment_time', Carbon::parse($nextAppointment->appointment_time)) : null;
    $lastAppointment = $lastAppointment ? $lastAppointment->setAttribute('appointment_time', Carbon::parse($lastAppointment->appointment_time)) : null;

        // Get the recently booked services for the current year
        $recentAppointments = Appointment::where('user_id', $user->id)
        ->whereYear('appointment_time', Carbon::now()->year)
        ->orderBy('appointment_time', 'desc')
        ->get();

    
        return view('client.dashboard', compact('nextAppointment', 'appointmentsThisYear', 'lastAppointment', 'recentAppointments'));
    }
    
}
