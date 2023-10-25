<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Catalog;

class CatalogController extends Controller
{

    // Display a listing of the catalog.
    public function index()
    {
        $catalogs = Catalog::all();
        return view('catalogs.index', compact('catalogs'));
    }

    // Show the form for creating a new catalog entry.
    public function create()
    {
        return view('catalogs.create');
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
            'editedBy' => 'required|string',
        ]);

        $catalog = Catalog::create($request->all());

        return redirect()->route('catalogs.index')
            ->with('success', 'Catalog entry created successfully.');
    }

    // Display the specified catalog entry.
    public function show($id)
    {
        $catalog = Catalog::find($id);
        return view('catalogs.show', compact('catalog'));
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
