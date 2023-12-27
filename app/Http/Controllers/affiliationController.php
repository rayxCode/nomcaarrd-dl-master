<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Affiliation;
use Exception;
use Illuminate\Support\Facades\Validator;

class affiliationController extends Controller
{
    public function index(){
        $affs = Affiliation::orderBy('name')->paginate(10);
        $affs->appends(['sort' => 'name']);
        return view('admin.admin_affiliations', compact('affs'));
    }

    public function show($id)
    {
        // Retrieve a specific affiliation
        $edit = Affiliation::findOrFail($id);
        return view('admin.forms.affiliations_profile', compact('edit'));
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
        return redirect()->back()->with('success', 'Affiliate added successfully!');
    }

    public function update(Request $request, $id)
    {
        // Retrieve a specific affiliation
        $affiliation = Affiliation::findOrFail($id);
        $request->validate([
            'name' => 'required',
        ]);
        try {
            $affiliation->name = $request->input('name');
            $affiliation->editedBy = auth()->user()->username;
            $affiliation->update();
            return redirect()->back()->with('success', 'Edited successfully!');
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong...');
        }
        // Add other methods like edit, update, delete based on your requirements
    }
}
