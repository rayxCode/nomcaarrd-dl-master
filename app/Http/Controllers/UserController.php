<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

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
            'username' => 'required',
            'email' => 'required|email',
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'affiliation' => 'required',
            'currentPassword' => [
                'required',
                'string',
                'min:8',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('The current password is incorrect.');
                    }
                },
            ],
            'password' => [
                'required',
                'min:8',
            ],
        ]);

        if(!($request->input('password') === $request->input('cfpassword')))
        {
            return back()->withErrors('error', "Input password does not match.");
        }

        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->session()->flash('error', 'User not found!');
        }

        // Create the 'name' from 'firstname', 'middlename', and 'lastname'
        // Update the user's profile with the new data
        $user->username = $request->input('username');
        $user->firstname = $request->input('firstname');
        $user->middlename = $request->input('middlename');
        $user->lastname = $request->input('lastname');
        $user->affiliation = $request->input('affiliation');
        $user->photo_path = $request->input('photo_path');
        if ($request->input('password'))
            $user->password = bcrypt($request->input('password'));
        $user->update();
        // Redirect back to the profile page or a success page
        return redirect()->back();
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
            'username' => 'required|string|max:255',
            'firstname' => 'required|string|max:50',
            'middlename' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'password' => 'required|string|min:8',
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
        $customName = 'u' . auth()->user()->id . $date . "." . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/lib/users', $customName);

        return response()->json(['filePath' => asset('storage/lib/users/' . $customName)]);
    }
    // Add other methods like edit, update, delete based on your requirements
}
