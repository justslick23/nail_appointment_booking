<!-- In resources/views/appointments/index.blade.php -->
@extends('layouts.app') <!-- Extending NiceAdmin layout -->

@section('content')
@include('partials.header') <!-- Include Header -->
@include('partials.sidebar') <!-- Include Sidebar -->

<div class="container mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Appointments</li>
        </ol>
    </nav>

    <h1 class="mt-4">Appointments List</h1>

    <!-- Table -->
    <div class="card mb-4">
     
        <div class="card-body">
            <table class="table table-striped table-bordered datatable" id="appointmentsTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Services</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->user->name }}</td>
                            <td>
                                @foreach($appointment->services as $service)
                                    <span class="badge badge-primary">
                                        {{ $service->name }}
                                    </span>
                                @endforeach
                            </td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d F Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- Include DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#appointmentsTable').DataTable({
            // DataTables options can be added here
            "paging": true,         // Enable pagination
            "searching": true,      // Enable searching
            "info": true,           // Show info about the table
            "lengthChange": true,   // Allow user to change number of rows per page
            "order": [[2, 'desc']],  // Default ordering by date column
        });
    });
</script>
@endpush
