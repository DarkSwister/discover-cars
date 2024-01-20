<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['name' => 'api.','middleware' => ['throttle:100,1']], function (): void {
    Route::get('locations', \App\Http\Controllers\Api\LocationController::class);
    Route::get('offers/{location}', \App\Http\Controllers\Api\OfferController::class);
    Route::post('reservations', \App\Http\Controllers\Api\ReservationController::class);
});

Route::fallback(function () {
    return response()->json(['message' => 'Page Not Found'], 404);
});
