<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\User;

class AppComposer
{
    public function compose(View $view)
    {
        // Fetch the data you want to pass to the layout
        if(Auth::check())
        {
            $user = Auth::user();
            // Pass the data to the view
            $view->with('user', $user);
        }

    }
}
