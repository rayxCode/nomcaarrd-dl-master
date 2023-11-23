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

    public function edit($id)
    {
        // Fetch the user's details from the database using the provided $id
        $user = User::find($id);

        if (!$user) {
            // If the user is not found, returns an error or redirect to an error page
            return redirect()->route('error.page')->with('error', 'User not found');
        }

        // Pass the user data to the view for editing
        return view('profile.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'firstname' => 'required',
            'lastname' => 'required',
            'affiliation' => 'required',
        ]);

        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('error.page')->with('error', 'User not found');
        }

        // Create the 'name' from 'firstname', 'middlename', and 'lastname'
        $name = $request->input('firstname') . ' ' . $request->input('middlename') . ' ' . $request->input('lastname');

        // Update the user's profile with the new data
        $user->name = $name;
        $user->email = $request->input('email');
        $user->affiliation = $request->input('affiliation');

        $user->save();

        // Redirect back to the profile page or a success page
        return redirect()->route('profile.show', ['id' => $user->id])->with('success', 'Profile updated successfully');
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

    // app/Http/Controllers/AvatarController.php
    public function upload(Request $request)
    {
        $file = $request->file('avatar');
        $date = date("mdy");
        $customName = 'u'.auth()->user()->id.$date.".".$file->getClientOriginalExtension();
        $path = $file->storeAs('public/lib/users', $customName);

        return response()->json(['filePath' => asset('storage/lib/users/' . $customName)]);
    }
    // Add other methods like edit, update, delete based on your requirements
}
