<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    // Return users index
    public function index(){

    }

    // Return create users page
    public function create(){
        return view('users.create');
    }

    // Store users information to users DB
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string',
            'endpoint' => 'required|string',
            'key' => 'required|string',
            'token' => 'required|string',
            'encoding' => 'nullable|string'
        ]);

       Users::create([
        'name' => $validated['name'],
        'endpoint' => $validated['endpoint'],
        'key' => $validated['key'],
        'token' => $validated['token'],
        'encoding' => $validated['encoding'],
       ]);

       return redirect('/users');
    }
}
