<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password',);

        if (Auth::attempt($credentials)) {
            // Authentication was successful
            // Redirect to the desired page after login
            if(auth()->user()->access_level == 1)
            return redirect()->route('dashboard');
            else
            return redirect()->route('index');

        }

        // Authentication failed
       return redirect()->back()->withErrors('errors', 'Authentication failed')->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
