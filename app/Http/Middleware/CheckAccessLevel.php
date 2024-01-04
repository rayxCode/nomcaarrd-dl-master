<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAccessLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle(Request $request, Closure $next, ...$levels)
     {
         // Perform your access level check here
         $user = auth()->user();

         foreach ($levels as $level) {
             if ($user->access_level >= $level) {
                 // User has the required access level, proceed
                 return $next($request);
             }
         }

         // User does not have the required access level, redirect or abort as needed
         return abort(403, 'Unauthorized');
     }
}
