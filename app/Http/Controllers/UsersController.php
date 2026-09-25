<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    // Return users index
    public function index(){
        // return view('users');
    }

    // Return create users page
    public function create(){
        return view('users.create');
    }

    // Store users information to users DB
    public function store(Request $request){
        Log::info($request);
        try {
            $validated = $request->validate([
            'name' => 'required|string',
            'endpoint' => 'required|string',
            'keys'=>[

            'auth' => 'required|string',
            'p256dh' => 'required|string',
            ],
            
            // 'key' => 'required|string',
            // 'token' => 'required|string',
            // 'encoding' => 'nullable|string'
        ]);} catch (Exception $e){
            $message = $e->getMessage();
            Log::error($message);
        }
        Log::info('finish validate');
    //    Users::create([
    //     'name' => $validated['name'],
    //     'endpoint' => $validated['endpoint'],
    //     'key' => $validated['keys.p256dh'],
    //     'token' => $validated['keys.auth'],
    //     'encoding' => $validated['encoding'],
    //    ]);

    //    return redirect('/users');
    }
}
