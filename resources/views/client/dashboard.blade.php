@extends('layouts.app')
@php
    use Carbon\Carbon;
@endphp
@include('partials.header') <!-- Include Header -->
@include('partials.sidebar') <!-- Include Sidebar -->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>My Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">My Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Next Appointment Card -->
            <div class="col-lg-6 col-md-12">
                <div class="card info-card appointment-card">
                    <div class="card-body">
                        <h5 class="card-title">Next Appointment <span>| Upcoming</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <div class="ps-3">
                                @if ($nextAppointment)
                                    <h6>{{ Carbon::parse($nextAppointment->appointment_date)->format('d F Y') }}</h6>
                                    @foreach($nextAppointment->services as $service)
        <span class="text-muted small pt-2">Service: {{ $service['name'] ?? 'N/A' }}</span><br>
    @endforeach                                @else
                                    <h6>No upcoming appointments</h6>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Next Appointment Card -->

            <!-- Booking History Card -->
            <div class="col-lg-6 col-md-12">
                <div class="card info-card history-card">
                    <div class="card-body">
                        <h5 class="card-title">Booking History <span>| This Year</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $recentAppointments->count() }} Appointments</h6>
                                <br>
                                <span class="text-muted small pt-2">
                                    Last: {{ $lastAppointment ? $lastAppointment->appointment_date : 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Booking History Card -->

            <!-- Recently Booked Services -->
       <!-- Recently Booked Services -->
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Recently Booked Services <span>| This Year</span></h5>
            <!-- Check if there are recent appointments -->
            @if($recentAppointments->isEmpty())
                <p class="text-muted">No recent appointments</p>
            @else
                <!-- Table with recent bookings -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Service</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentAppointments as $appointment)
                                <tr>
                                    <td>{{ Carbon::parse($appointment->appointment_date)->format('d F Y') }}</td>
<!-- Adjusted code to display service names -->
<td>
    @forelse ($appointment->services as $service)
        {{ $service->name }}@if (!$loop->last), @endif
    @empty
        N/A
    @endforelse
</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div><!-- End Recently Booked Services -->

        </div>
    </section>

</main><!-- End #main -->
