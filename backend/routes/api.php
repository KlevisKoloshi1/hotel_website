<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\BookingController;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/apartments', [ApartmentController::class, 'index']);

Route::middleware('auth.api')->group(function () {
    Route::post('/bookings', [BookingController::class, 'store']);
});


