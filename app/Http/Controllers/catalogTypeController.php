<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class catalogTypeController extends Controller
{
    //
    public function index()
    {
        // Retrieve all catalog types
        $catalogTypes = CatalogType::all();
        return view('catalog_types.index', compact('catalogTypes'));
    }

    public function show($id)
    {
        // Retrieve a specific catalog type
        $catalogType = CatalogType::findOrFail($id);
        return view('catalog_types.show', compact('catalogType'));
    }

    public function create()
    {
        // Show the form to create a new catalog type
        return view('catalog_types.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'editedBy' => 'required|string|max:255',
        ]);

        // Create a new catalog type
        CatalogType::create($request->all());

        // Redirect to the catalog types index
        return redirect()->route('catalog_types.index');
    }

    // Add other methods like edit, update, delete based on your requirements
}
