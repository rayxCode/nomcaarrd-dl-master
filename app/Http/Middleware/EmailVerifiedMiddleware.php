<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EmailVerifiedMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->email_verified_at != null) {
            // User email is not verified
            return redirect()->route('dashboard_profiles'); // Adjust the route as needed
        }

        return $next($request);
    }
}
