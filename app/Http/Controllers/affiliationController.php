<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class affiliationController extends Controller
{
    //
    public function index()
    {
        // Retrieve all affiliations
        $affiliations = Affiliation::all();
        return view('affiliations.index', compact('affiliations'));
    }

    public function show($id)
    {
        // Retrieve a specific affiliation
        $affiliation = Affiliation::findOrFail($id);
        return view('affiliations.show', compact('affiliation'));
    }

    public function create()
    {
        // Show the form to create a new affiliation
        return view('affiliations.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'editedBy' => 'required|string|max:255',
        ]);

        // Create a new affiliation
        Affiliation::create($request->all());

        // Redirect to the affiliations index
        return redirect()->route('affiliations.index');
    }

    // Add other methods like edit, update, delete based on your requirements
}
