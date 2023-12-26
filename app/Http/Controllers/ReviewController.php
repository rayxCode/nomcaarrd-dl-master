<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
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
        $search= $request->input('search', '');

        $catalogs = Catalog::where('title', 'like', '%' . $search . '%')->get();

        return view('reviewer.review_catalogs', compact('catalogs'));
    }
}
