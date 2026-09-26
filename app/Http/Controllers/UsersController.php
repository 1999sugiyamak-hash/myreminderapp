<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    // Return users index
    public function index()
    {
        return view('users.index');
    }

    // Return create users page
    public function create()
    {
        return view('users.create');
    }

    // Store users information to users DB
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string',
                'endpoint' => 'required|string',
                'token' => 'required|string',
                'key' => 'required|string',
                'encoding' => 'required|string'
            ]);
            Log::info('finish validate');
            Users::create([
                'name' => $validated['name'],
                'endpoint' => $validated['endpoint'],
                'key' => $validated['key'],
                'token' => $validated['token'],
                'encoding' =>  $validated['encoding'],
            ]);
        } catch (Exception $e) {
            $message = $e->getMessage();
            Log::error($message);
        }
        return redirect('/users');
    }
}
