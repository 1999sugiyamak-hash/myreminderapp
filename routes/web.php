<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return view('welcome');
});

// Reminders
// Display reminders index page
Route::get('/reminders', [ReminderController::class, 'index']);

// Display create reminders page
Route::get('/reminders/create', [ReminderController::class, 'create']);

// Store reminder data to reminders DB
Route::post('/reminders', [ReminderController::class, 'store']);

// Complete reminders and update reminder completed flag
Route::patch('/reminders/complete/{id}', [ReminderController::class, 'complete']);


// Users
// Display users index page
Route::get('/users', [UsersController::class, 'index']);

// Display create users page
Route::get('/users/create', [UsersController::class, 'create']);

// Store users information to users DB
Route::post('/users', [UsersController::class, 'store']);
