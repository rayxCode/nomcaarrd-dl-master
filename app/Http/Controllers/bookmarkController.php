<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class bookmarkController extends Controller
{
    //
    public function index()
    {
        // Retrieve all bookmarks
        $bookmarks = Bookmark::all();
        return view('bookmarks.index', compact('bookmarks'));
    }

    public function show($id)
    {
        // Retrieve a specific bookmark
        $bookmark = Bookmark::findOrFail($id);
        return view('bookmarks.show', compact('bookmark'));
    }

    public function create()
    {
        // Show the form to create a new bookmark
        return view('bookmarks.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'catalog_id' => 'required|exists:catalogs,catalog_id',
            'users_id' => 'required|exists:users,users_id',
            'editedBy' => 'required|string|max:255',
        ]);

        // Create a new bookmark
        Bookmark::create($request->all());

        // Redirect to the bookmarks index
        return redirect()->route('bookmarks.index');
    }

    // Add other methods like edit, update, delete based on your requirements
}
