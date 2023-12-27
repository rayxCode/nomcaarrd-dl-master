<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Affiliation;
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
        $selectUser = User::with('affiliation')->find($id);
        $affs = Affiliation::all();
        /* if (!$selectUser) {
            // If the user is not found, returns an error or redirect to an error page
            return redirect()->back()->with('error', 'User not found');
        } */

        // Pass the user data to the view for editing
        return view('admin.edit_users')->with('selectUser', $selectUser)
        ->with('affs', $affs);
        //return redirect()->back()->compact('selectUser', 'affs');
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
        $user->access_level = $request->input('access_level');
        $user->update();
        // Redirect back to the profile page or a success page
        return redirect()->back();
    }

    public function updateAdmin(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
        ]);


        // Find the user by ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found!');
        }

        // Updates the 'name' from 'firstname', 'middlename', and 'lastname'
        $fullname = $request->input('lastname').", ".$request->input('firstname')." ".$request->input('middlename');
        // Update the user's profile with the new data
        $user->username = $request->input('username');
        $user->fullname =
        $user->firstname = $request->input('firstname');
        $user->middlename = $request->input('middlename');
        $user->lastname = $request->input('lastname');
        $user->affiliation_id = $request->input('affiliation')?? $user->affiliation_id;
        if ($request->input('password'))
            $user->password = bcrypt($request->input('password'));
        $user->access_level = $request->input('access_level');
        $user->editedBy = auth()->user()->username;
        $user->update();
        // Redirect back to the profile page or a success page
        return redirect()->back()->with('success', 'User profile edited successfully!');
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
    public function destroy($id)
    {
        // Fetch the user's details from the database using the provided $id
        $user = User::find($id);

        if (!$user) {
            // If the user is not found, returns an error or redirect to an error page
            return redirect()->back()->with('error', 'Something went wrong. Try again!');
        }
        $user->delete();

        // Pass the user data to the view for editing
        return redirect()->back()->with('success', 'User deleted successfully!');
    }
}
