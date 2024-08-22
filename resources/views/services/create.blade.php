@extends('layouts.app')

@include('partials.header') <!-- Include Header -->
@include('partials.sidebar') <!-- Include Sidebar -->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Add New Nail Service</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Nail Services</a></li>
                <li class="breadcrumb-item active">Add New Service</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">New Nail Service</h5>

                        <!-- Form to Add New Service -->
                        <form action="{{ route('services.store') }}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <label for="service_name" class="col-sm-2 col-form-label">Service Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="service_name" name="service_name" placeholder="Enter service name" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="service_price" class="col-sm-2 col-form-label">Service Price</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="service_price" name="service_price" placeholder="Enter service price" step="0.01" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="duration" class="col-sm-2 col-form-label">Duration (minutes)</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="duration" name="duration" placeholder="Enter duration in minutes" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-sm-2 col-form-label">Description (Optional)</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter a description (optional)"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">Add Service</button>
                                </div>
                            </div>

                        </form><!-- End Form to Add New Service -->

                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
