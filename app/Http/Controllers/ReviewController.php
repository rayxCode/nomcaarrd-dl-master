<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\CatalogType;
use Exception;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //
    public function search(Request $request)
    {
        $search = $request->input('search', '');
        $status = $request->input('status');
        $catalogs = Catalog::where('status', $status);

        if ($search) {
            $catalogs->where('title', 'like', '%' . $search . '%');
        }

        $catalogs = $catalogs->paginate(10);
        return view('reviewer.review_catalogs', compact('catalogs', 'search', 'status'));
    }

    public function showPDF($code)
    {
        try {
            $catalog = Catalog::where('code', $code)->first();
            return view('reviewer.review_show', compact('catalog'));
        } catch (Exception) {
            return back()->with('error', 'Document you selected doesn\'t seems to exist.');
        }
    }

    public function index()
    {
        $catalogs = Catalog::where('status', 0)->orderBy('title')->with('types')->paginate(5);
        $types = CatalogType::all();
        $status = 0;
        return view('reviewer.review_catalogs', compact('catalogs', 'types', 'status'));
    }
    public function approved()
    {
        $catalogs = Catalog::where('status', 1)->orderBy('title')->with('types')->paginate(5);
        $types = CatalogType::all();
        $status = 1;
        return view('reviewer.review_catalogs', compact('catalogs', 'types', 'status'));
    }
    public function declined()
    {
        $catalogs = Catalog::where('status', 3)->orderBy('title')->with('types')->paginate(5);
        $types = CatalogType::all();
        $status = 3;
        return view('reviewer.review_catalogs', compact('catalogs', 'types', 'status'));
    }

    public function setStatusApproved($id)
    {
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
    public function remarksAdded(Request $request, $id)
    {

        Catalog::where('id', $id)
            ->update([
                'remarks' => $request->input('remarks'),
                'status' => $request->input('status'),
            ]);

        return redirect()->route('review_declined')->with('success', 'Remarks added successfully');
    }

    public function setStatusDeclined(Request $request, $id)
    {

        $status = $request->input('status');
        $catalog = Catalog::findOrFail($id);

        return view('reviewer.review_remarks', compact('status', 'catalog')); //->with('error', 'Catalog has been declined.');
        // Handle the case where the user is not authenticated.
    }
}
