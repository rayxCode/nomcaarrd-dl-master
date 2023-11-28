<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAccessLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->access_level !== 2) {
            return redirect('/');
        }elseif(auth()->check() && auth()->user()->access_level >= 2)
        {
            return $next($request);
        }
        else{
            return redirect('login');
        }
    }

    /*     protected function redirectTo(Request $request): ?string
    {

        if (auth()->check() && auth()->user()->access_level !== 2) {
            return redirect('/profile');
        }
        elseif (auth()->check() && auth()->user()->access_level > 2){
            return redirect('/index');
        }else{
            return $request->expectsJson() ? null : route('login');
        }


    } */
    }
}
