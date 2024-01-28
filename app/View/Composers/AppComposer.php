<?php

namespace App\View\Composers;

use App\Models\Catalog;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Requests;
use App\Models\Appointments;

class AppComposer
{
    public function compose(View $view)
    {
        // Fetch the data you want to pass to the layout
        if(Auth::check())
        {
            $user = Auth::user();
            $users = User::all();
            $catalog = Catalog::all();
            $pendingCount = $catalog->where('status', 0)->count();
            $requestCount = $users->where('verify_status', 0)->whereNotNull('verify_status')->count();
            $docsCount= Requests::where('status', 0)->count();
            $appointmentsCount = Appointments::where('status', 0)->whereDate('time', now()->toDateString())->count();

            // Pass the data to the view
            $view->with([
                'user'=>$user,
                'pendingCount'=>$pendingCount,
                'requestCount'=>$requestCount,
                'docsCount'=>$docsCount,
                'appointmentsCount'=>$appointmentsCount,
            ]);
        }

    }
}
