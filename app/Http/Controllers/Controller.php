<?php

namespace App\Http\Controllers;

use App\Models\Affiliation;
use App\Models\Catalog;
use App\Models\User;
use App\Models\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function index(){
        $user = User::all();
        $userCounts = $user->count();
        $catalogs = Catalog::all();
        $catalogCounts = $catalogs->count();
        $pending = $catalogs->where('status', 0)->count();
        $approved = $catalogs->where('status', 1)->count();
        $declined = $catalogs->where('status', 3)->count();
        $affiliationCounts = Affiliation::count();
        return view('admin.admin_dashboard', compact('userCounts',
        'catalogCounts', 'approved', 'pending', 'declined', 'affiliationCounts'));
    }

    public function requestAccessIndex(){
        $index = Requests::where('status', 0)->paginate(10);
        return view('admin.admin_requests', compact('index'));
    }


    public function requestAccess(Request $request){

        $requestFile = Requests::create([
            'catalog_id' => $request->input('id'),
            'users_id' => auth()->user()->id
        ]);

        return redirect()->back()->with('success', "You have requested a document");
    }

    public function setRequests(Request $request)
    {
        $id = $request->input('id');
        $requestsFile = Requests::findOrFail($id);
        $requestsFile->status = $request->input('status');
        $requestsFile->update();

        return redirect()->back()->with('success', 'Request updated successfully');
    }
}
