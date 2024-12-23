<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['splade'])->group(function () {
    Route::get('/', [\App\Http\Controllers\BookingController::class,'locations'])->name('locations');
    Route::get('/bookings', [\App\Http\Controllers\BookingController::class,'index'])->name('booking.index');
    Route::get('/cars/location/{location}', [\App\Http\Controllers\BookingController::class,'cars'])->name('cars');
    Route::post('/pre-reservation/redirect', [\App\Http\Controllers\BookingController::class,'preReservation'])->name('pre-reservations.store');
    Route::get('/reservation', [\App\Http\Controllers\BookingController::class,'customer'])->name('reservation');
    Route::get('/reservation/success', [\App\Http\Controllers\BookingController::class,'success'])->name('reservation.success');
    Route::post('/reservation', [\App\Http\Controllers\BookingController::class,'store'])->name('reservation.store');


    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();
});
