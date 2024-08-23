@extends('layouts.app')

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
                                <h6>August 28, 2024, 10:00 AM</h6> <!-- Dummy appointment date and time -->
                                <span class="text-muted small pt-2">Service: Manicure</span>
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
                                <h6>12 Appointments</h6> <!-- Dummy number of appointments -->
                                <span class="text-muted small pt-2">Last: August 15, 2024</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Booking History Card -->

           

            <!-- Recently Booked Services -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Recently Booked Services <span>| This Year</span></h5>
                        <!-- Table with recent bookings -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Service</th>
                                        <th scope="col">Technician</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>August 15, 2024</td>
                                        <td>Pedicure</td>
                                        <td>Emily Johnson</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td>July 20, 2024</td>
                                        <td>Gel Nails</td>
                                        <td>Jessica Lee</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td>June 18, 2024</td>
                                        <td>Manicure</td>
                                        <td>Olivia White</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- End Recently Booked Services -->

        </div>
    </section>

</main><!-- End #main -->
