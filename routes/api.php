<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\VenueController;
use App\Http\Controllers\API\TicketController;

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::get('events', [EventController::class, 'index']);
Route::get('events/{event}', [EventController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('events', [EventController::class, 'store']);
    Route::put('events/{event}', [EventController::class, 'update']);
    Route::delete('events/{event}', [EventController::class, 'destroy']);

    Route::post('events/{eventId}/ticket', [TicketController::class, 'store']);
    Route::get('user/tickets', [TicketController::class, 'userTickets']);
    Route::get('tickets', [TicketController::class, 'allTickets']);

    Route::get('venues', [VenueController::class, 'index']);
    Route::post('venues', [VenueController::class, 'store']);
    Route::put('venues/{venue}', [VenueController::class, 'update']);
    Route::delete('venues/{venue}', [VenueController::class, 'destroy']);
});
