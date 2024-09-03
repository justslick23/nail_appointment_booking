@extends('layouts.app')

@section('content')
@include('partials.header')
@include('partials.sidebar')

<div class="container mt-4">
    <h1>Book an Appointment</h1>

    @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            Appointment Booking Form
        </div>
        <div class="card-body">
            <form action="{{ route('appointments.store') }}" method="POST">
                @csrf

                @if(auth()->user()->role === 'admin')
    <div class="form-group mb-3">
        <label for="user_id">Select User:</label>
        <select id="user_id" name="user_id" class="form-control" required>
            <option value="">Select a user</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
@else
    <div class="form-group mb-3">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ auth()->user()->name }}"  readonly>
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    </div>
@endif


                <div class="form-group mb-3">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="appointment_date">Appointment Date:</label>
                    <input type="date" id="appointment_date" name="appointment_date" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label>Available Times:</label>
                    <div id="available_times" class="d-flex flex-wrap">
                        <!-- Available times will be dynamically loaded here -->
                    </div>
                </div>
                <div class="form-group mb-3">
    <label>Services:</label>
    <div class="form-check">
        @foreach($services as $service)
            <div class="form-check">
                <input 
                    type="checkbox" 
                    id="service{{ $service->id }}" 
                    name="services[]" 
                    value="{{ $service->id }}" 
                    class="form-check-input"
                >
                <label 
                    for="service{{ $service->id }}" 
                    class="form-check-label"
                >
                    {{ $service->name }} - £{{ number_format($service->price, 2) }}
                </label>
            </div>
        @endforeach
    </div>
</div>



                <input type="hidden" id="selected_time" name="appointment_time">

                <button type="submit" class="btn btn-primary">Book Appointment</button>
            </form>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    flatpickr("#appointment_date", {
        minDate: "today",
        dateFormat: "Y-m-d",
        onChange: function(selectedDates, dateStr, instance) {
            // Load available times based on the selected date
            $.ajax({
                url: "{{ route('appointments.availableTimes') }}",
                method: "GET",
                data: { date: dateStr },
                success: function(data) {
                    var timeContainer = $("#available_times");
                    timeContainer.empty();
                    if (data.times.length > 0) {
                        $.each(data.times, function(index, time) {
                            var timeBlock = $('<button type="button" class="btn btn-outline-primary time-block"></button>');
                            timeBlock.text(time);
                            timeBlock.click(function() {
                                $(".time-block").removeClass('active');
                                $(this).addClass('active');
                                $("#selected_time").val(time);
                            });
                            timeContainer.append(timeBlock);
                        });
                    } else {
                        timeContainer.html('<p>No available times for this date.</p>');
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching available times:', xhr.responseText);
                }
            });
        }
    });

   
});
</script>

<style>
.time-block {
    margin: 5px;
    padding: 10px 15px;
    font-size: 16px;
    border-radius: 4px;
}

.time-block.active {
    background-color: #007bff;
    color: white;
}

.badge {
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;
}

.badge-primary {
    background-color: #007bff;
    color: white;
}
.badge-secondary {
    background-color: #28a745; /* Green color */
    color: white;
}
.badge-primary:hover,
.badge-secondary:hover {
    opacity: 0.8;
}
</style>

@endsection
