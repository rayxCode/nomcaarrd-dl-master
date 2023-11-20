<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\Catalog;
use App\Models\Bookmark;
use App\Models\CatalogType;


class CatalogController extends Controller
{
    //method for our catalog search box
    public function search(Request $request)
    {
        // Fetch search query and selected filters
        $search = $request->input('search', '');
        $filters = $request->input('filter', []);
        // Retrieve other filters as needed

        // Query builder to filter catalogs based on search and filters
        $catalogs = Catalog::query();

        // Apply search query
        if ($search) {
            $catalogs->where('title', 'like', '%' . $search . '%');
        }

        // Apply other filters (add more as needed)
        if (!empty($filters)) {
            $catalogs->whereIn('type_id', $filters); // 'paper_type' should be the column in your Catalog model that corresponds to these filters
        }

        // Get the filtered results
        $filteredCatalogs = $catalogs->paginate(10);


        return view('pages.search', compact('filteredCatalogs', 'search'));
    }

    // Display a listing of the catalog.
    public function index()
    {
        $catalogs = Catalog::all();
        return view('catalogs.index', compact('catalogs'));
    }


    // Store a newly created catalog entry in storage.
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'title' => 'required|string|unique:catalogs|max:255',
            'description' => 'required|string',
            'publishedDate' => 'required|date',
            'type_id' => 'required|exists:catalogTypes,type_id',
            'fileURL' => 'required|string',
            'author_id' => 'required|exists:authors,author_id',
            'photo_path' => 'required|string',
        ]);

        $catalog = Catalog::create($request->all());

        return redirect()->route('pages.index')
            ->with('success', 'Catalog entry created successfully.');
    }

    // Display the specified catalog entry.
    public function show($id)
    {
        $catalogs = Catalog::find($id);
        $type = CatalogType::find($catalogs->type_id);
        $bookmarkCount = Bookmark::where('catalog_id', $catalogs->catalog_id)->count();
        $ratedCatalogs = Catalog::orderBy('rating', 'desc')->take(5)->get();
        return view('pages.catalogs', compact('catalogs', 'bookmarkCount', 'type', 'ratedCatalogs'));
    }

    // Show the form for editing the specified catalog entry.
    public function edit($id)
    {
        $catalog = Catalog::find($id);
        return view('catalogs.edit', compact('catalog'));
    }

    // Update the specified catalog entry in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:catalogs,title,' . $id,
            // Include other validation rules based on your requirements
        ]);

        $catalog = Catalog::find($id);
        $catalog->update($request->all());

        return redirect()->route('catalogs.index')
            ->with('success', 'Catalog entry updated successfully');
    }

    // Remove the specified catalog entry from storage.
    public function destroy($id)
    {
        $catalog = Catalog::find($id);
        $catalog->delete();

        return redirect()->route('catalogs.index')
            ->with('success', 'Catalog entry deleted successfully');
    }
}
