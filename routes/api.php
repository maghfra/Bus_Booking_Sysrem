<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TripBookingController;
use App\Http\Controllers\TripGenerateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']); 
    Route::post('/login', [AuthController::class, 'login']);     

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);  
        Route::get('/user', [AuthController::class, 'user']);       
    });
});


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/create-trip', [TripGenerateController::class, 'index']);
    Route::post('/book-seat', [TripBookingController::class, 'bookSeat']);
    Route::post('/available-seats', [TripBookingController::class, 'getAvailableSeats']);
});