<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReminderController;

Route::get('/', function () {
    return view('welcome');
});

// Display reminders index page
Route::get('/reminders', [ReminderController::class, 'index']);

// Display create reminders page
Route::get('/reminders/create', [ReminderController::class, 'create']);

// Store reminder data to reminders DB
Route::post('/reminders', [ReminderController::class, 'store']);

// Complete reminders and update reminder completed flag
Route::patch('/reminders/complete/{id}', [ReminderController::class, 'complete']);