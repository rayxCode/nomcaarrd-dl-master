<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegistrationForm()
{
    return view('pages.login');
}

public function register(Request $request)
{
    $this->validate($request, [
        'email' => 'required|string|email|max:255|unique:users',
        'password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
            'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])/', // password validation
            // 8 letters, upper case, lower case, with numbers
        ],
        // Add other validation rules based on your schema
    ]);

       // Extract the name from the email
       $emailParts = explode('@', $request->input('email'));
       $name = $emailParts[0]; // Use the part before '@' as the name

    // Create the user
    $user = new User();
        $user->fill([
            'name' => $name,
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'affiliation' => 1,
            // Add other fields as needed
        ]);
        // Save the user to the database
        $user->save();

    // Optionally, you can automatically login the user after registration
    auth()->login($user);
    return redirect()->route('home')->with('success', 'You are now logged in!')->middleware(Auth);
}

}
