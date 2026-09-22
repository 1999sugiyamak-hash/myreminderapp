<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminders;
use Illuminate\Support\Facades\Log;

class ReminderController extends Controller
{
    // get reminders index
    public function index(){
        $reminders = Reminders::all();
        
        return view('reminders.index', compact('reminders'));
    }

    // display create reminder page
    public function create(){
        return view('reminders.create');
    }

    // store reminder data to reminders DB
    public function store(Request $request){
        Log::info($request['latitude']);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'remind_at' => 'nullable|date',
            'latitude' => 'nullable|numeric|decimal:1,7',
            'longitude' => 'nullable|numeric|decimal:1,7',
        ]);

        Reminders::create([
            'created_user' => 1, // mock implementation
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_received_reminder' => 1, // mock implementation
            'remind_at' => $validated['remind_at'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'completed' => false,
            'repeated' => false,
            'updated_at' => now(),
            'created_at'
        ]);

        return redirect('/reminders');
    }
}
