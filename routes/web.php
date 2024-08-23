<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return view('auth.login');
});

// Custom route for registration
Route::get('register', function () {
    return view('auth.register');
})->name('register');

// Route to handle the form submission
Route::post('register', [RegisterController::class, 'register'])->name('register.post');

// Route for the login page
Route::get('login', function () {
    return view('auth.login');
})->name('login');

// Route to handle the login form submission
Route::post('login', [LoginController::class, 'login'])->name('login.post');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');


Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
Route::post('/services', [ServiceController::class, 'store'])->name('services.store');

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');

Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');

Route::get('appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('appointments', [AppointmentController::class, 'store'])->name('appointments.store');Route::get('/appointments/available-times', [AppointmentController::class, 'availableTimes'])->name('appointments.availableTimes');
Route::get('/appointments/available-times', [AppointmentController::class, 'availableTimes'])->name('appointments.availableTimes');
