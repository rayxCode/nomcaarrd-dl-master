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
        $query = $request->input('query');

        $catalogs = Catalog::where('title', 'like', '%' . $query . '%')->get();

        return response()->json($catalogs);
    }
}
