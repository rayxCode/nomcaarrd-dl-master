<?php

namespace App\Http\Controllers;

use App\Models\Affiliation;
use App\Models\Catalog;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function index(){
        $userCounts = User::count();
        $catalogCounts= Catalog::count();
        $pending = Catalog::where('status', 0)->count();
        $affiliationCounts = Affiliation::count();
        return view('admin.admin_dashboard', compact('userCounts',
        'catalogCounts', 'pending', 'affiliationCounts'));
    }
}
