<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Retrieve all users
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        // Retrieve a specific user
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function create()
    {
        // Show the form to create a new user
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'birthdate' => 'required|date',
            'affiliation' => 'required|exists:affiliations , affiliation_id',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        // Create a new user
        User::create($request->all());

        // Redirect to the users index
        return redirect()->route('user.index');
    }

    // Add other methods like edit, update, delete based on your requirements
}

