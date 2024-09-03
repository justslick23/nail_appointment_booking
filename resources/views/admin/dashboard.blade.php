@extends('layouts.app')
@php
    use Carbon\Carbon;
@endphp
@include('partials.header') <!-- Include Header -->
@include('partials.sidebar') <!-- Include Sidebar -->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Total Clients Card -->
            <div class="col-lg-4 col-md-6">
                <div class="card info-card clients-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Clients <span>| This Month</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $userCount }} </h6> <!-- Dummy client count -->
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Total Clients Card -->

          
            

            <!-- Total Revenue Card -->
            <div class="col-lg-4 col-md-6">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Revenue <span>| This Month</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-pound"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{   $totalRevenue }}</h6> <!-- Dummy revenue amount -->
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Total Revenue Card -->

            <!-- New Bookings Card -->
            <div class="col-lg-4 col-md-6">
                <div class="card info-card bookings-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Bookings <span>| This Month</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-calendar-plus"></i>
                            </div>
                            <div class="ps-3">
                                <h6> {{$appointmentCount}} </h6> <!-- Dummy number of new bookings -->
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End New Bookings Card -->

            <!-- Most Active Technicians -->
       <!-- Appointments for Next 2 Days -->
       <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Appointments for the Next 2 Days</h5>
                        @if($upcomingAppointments->isEmpty())
                            <p>No appointments in the next 2 days.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Service</th>
                                            <th scope="col">Customer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($upcomingAppointments as $appointment)
                                            <tr>
                                            <td>{{ Carbon::parse($appointment->appointment_date)->format('d F Y') }}</td>
                                            <td>{{ $appointment->appointment_time->format('g:i A') }}</td>
                                                <td>{{ $appointment->services->pluck('name')->join(', ') }}</td>
                                                <td>{{ $appointment->user->name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div><!-- End Appointments for Next 2 Days -->

   <!-- Appointment Trends -->
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Appointment Trends <span>/ This Year</span></h5>
            <!-- Line Chart -->
            <div id="appointmentTrendsChart" style="width: 90%;"></div>
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const monthlyAppointments = @json($monthlyAppointments); // Pass PHP data to JavaScript

                    new ApexCharts(document.querySelector("#appointmentTrendsChart"), {
                        series: [{
                            name: 'Appointments',
                            data: Object.values(monthlyAppointments) // Convert month data to array
                        }],
                        chart: {
                            height: '100%',
                            type: 'line',
                            toolbar: { show: false },
                        },
                        colors: ['#FF5722'],
                        xaxis: {
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] // Monthly labels
                        },
                        yaxis: {
                            title: { text: 'Number of Appointments' }
                        }
                    }).render();
                });
            </script>
        </div>
    </div>
</div><!-- End Appointment Trends -->

<!-- Revenue Trends -->
<div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Revenue Trends <span>/ This Year</span></h5>
            <!-- Area Chart -->
            <div id="revenueTrendsChart" style="width: 85%;"></div>
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const revenues = @json($revenues); // Pass PHP data to JavaScript
                    const months = @json($monthNames); // Pass PHP data to JavaScript

                    new ApexCharts(document.querySelector("#revenueTrendsChart"), {
                        series: [{
                            name: 'Revenue',
                            data: revenues
                        }],
                        chart: {
                            height: '100%',
                            type: 'area',
                            toolbar: { show: false },
                        },
                        colors: ['#4CAF50'],
                        xaxis: {
                            categories: months // Monthly labels
                        },
                        yaxis: {
                            title: { text: 'Revenue (£)' }
                        }
                    }).render();
                });
            </script>
        </div>
    </div>
</div><!-- End Revenue Trends -->

<!-- Service Popularity -->
<div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Service Popularity <span>/ This Month</span></h5>
            <!-- Pie Chart -->
            <div id="servicePopularityChart" style="width: 100%;"></div>
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const serviceNames = @json($serviceNames); // Pass PHP data to JavaScript
                    const serviceCounts = @json($serviceCounts); // Pass PHP data to JavaScript

                    new ApexCharts(document.querySelector("#servicePopularityChart"), {
                        series: serviceCounts,
                        chart: {
                            height: '100%',
                            type: 'pie',
                        },
                        colors: ['#FF5722', '#4CAF50', '#FFC107', '#00BCD4', '#9C27B0'], // Customize as needed
                        labels: serviceNames,
                        legend: {
                            position: 'bottom'
                        }
                    }).render();
                });
            </script>
        </div>
    </div>
</div><!-- End Service Popularity -->


        </div>
    </section>

</main><!-- End #main -->
