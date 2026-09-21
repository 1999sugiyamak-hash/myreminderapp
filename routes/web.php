<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReminderController;

Route::get('/', function () {
    return view('welcome');
});

// display reminders index page
Route::get('/reminders', [ReminderController::class, 'index']);

// display create reminders page
Route::get('/create', [ReminderController::class, 'create']);