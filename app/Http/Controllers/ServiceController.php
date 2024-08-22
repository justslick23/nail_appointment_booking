<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create', );
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'service_name' => 'required|string|max:255',
            'service_price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:0',
            'description' => 'nullable|string|max:1000',
        ]);

        // Create a new nail service
        Service::create([
            'name' => $validated['service_name'],
            'price' => $validated['service_price'],
            'duration' => $validated['duration'],
            'description' => $validated['description'],
        ]);

        // Redirect to the services index page with a success message
        return redirect()->route('services.index')->with('success', 'Nail service created successfully.');
    }
}
