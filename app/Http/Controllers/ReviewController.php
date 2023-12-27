<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\CatalogType;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //
    public function appoved($id)
    {
        $catalog = Catalog::where('status', 0)->findOrFail($id);
        return redirect()->back()->with('success', 'You have approved a catalog.');
    }
    public function search(Request $request)
    {
        $search = $request->input('search', '');

        $catalogs = Catalog::where('title', 'like', '%' . $search . '%')->paginate(10);

        return view('reviewer.review_catalogs', compact('catalogs', 'search'));
    }

    public function index(){
        $catalogs = Catalog::orderBy('title')->with('types')->paginate(10);
        $types = CatalogType::all();
        return view('reviewer.review_catalogs', compact('catalogs', 'types'));
    }

    public function setStatusApproved($id){
        $catalog= Catalog::findOrFail($id);
        $catalog->status = 1;
        $catalog->editedBy = auth()->user()->username;
        $catalog->update();

        return back()->with('success', 'You have approved a catalog.');
    }

    public function setStatusDeclined($id){
        $catalog= Catalog::findOrFail($id);
        $catalog->status = 3;
        $catalog->editedBy = auth()->user()->username;
        $catalog->update();

        return back()->with('error', 'Catalog has been declined.');
    }
}
