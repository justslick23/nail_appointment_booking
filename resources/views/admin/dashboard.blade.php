@extends('layouts.app')

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
            <div class="col-lg-3 col-md-6">
                <div class="card info-card clients-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Clients <span>| This Month</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="ps-3">
                                <h6>350</h6> <!-- Dummy client count -->
                                <span class="text-success small pt-1 fw-bold">10%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Total Clients Card -->

            <!-- Average Service Time Card -->
            <div class="col-lg-3 col-md-6">
                <div class="card info-card service-time-card">
                    <div class="card-body">
                        <h5 class="card-title">Average Service Time <span>| This Month</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div class="ps-3">
                                <h6>45 mins</h6> <!-- Dummy average time -->
                                <span class="text-danger small pt-1 fw-bold">-5%</span> <span class="text-muted small pt-2 ps-1">decrease</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Average Service Time Card -->

            <!-- Total Revenue Card -->
            <div class="col-lg-3 col-md-6">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Revenue <span>| This Month</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6>$7,500</h6> <!-- Dummy revenue amount -->
                                <span class="text-success small pt-1 fw-bold">15%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Total Revenue Card -->

            <!-- New Bookings Card -->
            <div class="col-lg-3 col-md-6">
                <div class="card info-card bookings-card">
                    <div class="card-body">
                        <h5 class="card-title">New Bookings <span>| This Month</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-calendar-plus"></i>
                            </div>
                            <div class="ps-3">
                                <h6>120</h6> <!-- Dummy number of new bookings -->
                                <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End New Bookings Card -->

            <!-- Most Active Technicians -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Most Active Technicians <span>/ This Month</span></h5>
                        <!-- Bar Chart -->
                        <div id="activeTechniciansChart"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#activeTechniciansChart"), {
                                    series: [{
                                        name: 'Appointments',
                                        data: [40, 35, 30, 25, 20] // Dummy data
                                    }],
                                    chart: {
                                        height: 350,
                                        type: 'bar',
                                        toolbar: { show: false },
                                    },
                                    colors: ['#4CAF50'],
                                    xaxis: {
                                        categories: ['Sarah Smith', 'Emily Johnson', 'Jessica Lee', 'Nancy Brown', 'Olivia White'] // Dummy technicians
                                    },
                                    yaxis: {
                                        title: { text: 'Number of Appointments' }
                                    }
                                }).render();
                            });
                        </script>
                    </div>
                </div>
            </div><!-- End Most Active Technicians -->

            <!-- Appointment Trends -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Appointment Trends <span>/ This Year</span></h5>
                        <!-- Line Chart -->
                        <div id="appointmentTrendsChart"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#appointmentTrendsChart"), {
                                    series: [{
                                        name: 'Appointments',
                                        data: [150, 180, 200, 170, 190, 220, 250, 270, 240, 260, 290, 310] // Dummy data for each month
                                    }],
                                    chart: {
                                        height: 350,
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
                        <div id="revenueTrendsChart"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#revenueTrendsChart"), {
                                    series: [{
                                        name: 'Revenue',
                                        data: [500, 600, 700, 650, 750, 800, 900, 950, 850, 900, 1000, 1100] // Dummy revenue data for each month
                                    }],
                                    chart: {
                                        height: 350,
                                        type: 'area',
                                        toolbar: { show: false },
                                    },
                                    colors: ['#4CAF50'],
                                    xaxis: {
                                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] // Monthly labels
                                    },
                                    yaxis: {
                                        title: { text: 'Revenue ($)' }
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
                        <div id="servicePopularityChart"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#servicePopularityChart"), {
                                    series: [30, 25, 15, 20, 10], // Dummy data for each service
                                    chart: {
                                        height: 350,
                                        type: 'pie',
                                    },
                                    colors: ['#FF5722', '#4CAF50', '#FFC107', '#00BCD4', '#9C27B0'],
                                    labels: ['Manicure', 'Pedicure', 'Nail Art', 'Gel Nails', 'Other'], // Dummy services
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
