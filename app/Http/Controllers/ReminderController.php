<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminders;

class ReminderController extends Controller
{
    // get reminders index
    public function index(){
        $reminders = Reminders::all();
        
        return view('reminders.index', compact('reminders'));
    }
}
