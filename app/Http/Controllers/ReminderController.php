<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminders;

class ReminderController extends Controller
{
    // Get reminders index
    public function index()
    {
        $reminders = Reminders::where('completed', false)->get();

        return view('reminders.index', compact('reminders'));
    }

    // Display create reminder page
    public function create()
    {
        return view('reminders.create');
    }

    // Store reminder data to reminders DB
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'remind_at' => 'nullable|date',
            'location_name' => 'nullable|string',
            'latitude' => 'nullable|numeric|decimal:1,7',
            'longitude' => 'nullable|numeric|decimal:1,7',
        ]);

        Reminders::create([
            'created_user' => 1, // TODO: create feature to select create user
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_received_reminder' => 1, // TODO: create feature to select reminder received user
            'remind_at' => $validated['remind_at'],
            'location_name' => $validated['location_name'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'completed' => false,
            'repeated' => false,
            'updated_at' => now(),
            'created_at'
        ]);

        return redirect('/reminders');
    }

    // Update reminder's completed flag to true
    public function complete(int $id) {
        Reminders::where('id', $id)->update(['completed' => true]);

        return redirect('/reminders');
    }
}
