<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Appointment;

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
        $userCount = 120; // Dummy user count
        $appointmentCount = Appointment::count(); // Dummy appointment count
        $totalRevenue = 9800; // Dummy total revenue
        $notifications = Notification::where('user_id', auth()->user()->id)
        ->orderBy('created_at', 'desc')
        ->get();

    
        $tasks = [
            (object) ['name' => 'Complete Dashboard Redesign', 'due_date' => now()->addDays(7), 'status' => 'In Progress'],
            (object) ['name' => 'Fix Bug in Appointment Module', 'due_date' => now()->addDays(3), 'status' => 'Pending'],
            (object) ['name' => 'Update User Roles', 'due_date' => now()->addDays(5), 'status' => 'Completed']
        ]; // Dummy tasks

        return view('admin.dashboard', compact('userCount', 'appointmentCount', 'totalRevenue', 'notifications', 'tasks'));
    }    }

