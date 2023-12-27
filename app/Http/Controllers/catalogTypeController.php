<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatalogType;
use Exception;

use function PHPSTORM_META\type;

class catalogTypeController extends Controller
{
    //
    public function index(){
        $types = CatalogType::paginate(10);
        $types->appends(['sort' => 'name']);
        return view('admin.admin_catalogsType', compact('types'));
    }

    public function show($id)
    {
        // Retrieve a specific catalog type
        $edit = CatalogType::findOrFail($id);
        return view('admin.forms.catalogType_profile', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        // Retrieve a specific catalog type
        try {
            $catalogType = CatalogType::findOrFail($id);
            $catalogType->name = $request->input('name');
            $catalogType->editedBy = auth()->user()->username;
            $catalogType->update();
            return redirect()->back()->with('success', 'Type name edited successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong. Try again...');
        }
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new catalog type
        CatalogType::create($request->all());

        // Redirect to the catalog types index
        return redirect()->route('types_index');
    }

    public function destroy($id)
    {
        $type = CatalogType::findOrFail($id);
        $type->delete();

        return redirect()->back()->with('success', 'Affiliate record deleted successfully!');
    }

    // Add other methods like edit, update, delete based on your requirements
}
