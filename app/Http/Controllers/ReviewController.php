<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\CatalogType;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //
    public function search(Request $request)
    {
        $search = $request->input('search', '');
        $catalogs = Catalog::where('status', 0);

        if ($search){
            $catalogs->where('title', 'like', '%' . $search . '%');
        }

        $catalogs = $catalogs->paginate(10);

        return view('reviewer.review_catalogs', compact('catalogs', 'search'));
    }


    public function index(){
        $catalogs = Catalog::where('status', 0)->orderBy('title')->with('types')->paginate(10);
        $types = CatalogType::all();
        return view('reviewer.review_catalogs', compact('catalogs', 'types'));
    }

    public function setStatusApproved($id){
        if (auth()->check()) {
            Catalog::where('id', $id)
                   ->update([
                       'status' => 1,
                       'editedBy' => auth()->user()->username,
                   ]);

            return redirect()->back()->with('success', 'You have approved a catalog.');
        }

        // Handle the case where the user is not authenticated.
    }

    public function setStatusDeclined($id){
        if (auth()->check()) {
            Catalog::where('id', $id)
                   ->update([
                       'status' => 3,
                       'editedBy' => auth()->user()->username,
                   ]);

            return redirect()->back();//->with('error', 'Catalog has been declined.');
        }

        // Handle the case where the user is not authenticated.
    }
}
