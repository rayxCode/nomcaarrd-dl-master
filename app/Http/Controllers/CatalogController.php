<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Catalog;
use App\Models\Bookmark;
use App\Models\CatalogType;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\error;

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
        $catalogs = Catalog::query()->with('types');

        // Apply search query
        if ($search) {
            $catalogs->where('title', 'like', '%' . $search . '%');
        }

        // Apply other filters (add more as needed)
        if (!empty($filters)) {
            $catalogs->whereIn('type_id', $filters); // 'paper_type' should be the column in your Catalog model that corresponds to these filters
        }

        //sets catalog top picks
        $ratedCatalogs = Catalog::orderBy('rating', 'desc')->take(5)->get();

        // Get the filtered results
        $filteredCatalogs = $catalogs->paginate(10);


        return view('pages.search', compact('filteredCatalogs', 'search', 'ratedCatalogs'));
    }

    // Edit a selected listing in catalogs.
    public function indexUpdate($id)
    {
    }


    // Store a newly created catalog entry in storage.
    public function store(Request $request)
    {

        // Validate the incoming request with any necessary rules
        $validator =  Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'published' => 'required|date',
            'file' => 'required',
            'type' => 'required' // Adjust the file types and size as needed
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Create the folder path based on the specified format
        $folderPath = '/lib/files/pdf';
        $imagePath = '/lib/files/g';

        // Create the folder if it doesn't exist
        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }

        if (!Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->makeDirectory($imagePath);
        }

        $count = Catalog::count();

        // Retrieve the file from the request
        $file = $request->file('file');
        $image = $request->file('image');

        // Generate a custom name for the file
        $customFileName = 'catalog_' . now()->format('dmy') . $count . "." . $file->getClientOriginalExtension();
        $customImageName = 'catalog_cover_' . now()->format('dmy') . $count . "." . $image->getClientOriginalExtension();

        // Move the file to the storage folder with the custom name
        Storage::disk('public')->put($folderPath . '/' . $customFileName, file_get_contents($file), 'public');
        Storage::disk('public')->put($imagePath . '/' . $customImageName, file_get_contents($image), 'public');

        // Get the full URL of the saved files
        $fullFilePath = $folderPath . '/' . $customFileName;
        $fullImagePath = $imagePath . '/' . $customImageName;
        // Convert authors input to an array (assuming it's a comma-separated string)
        $authors = json_decode($request->input('authorsJSON'), true);

        $status = (auth()->user()->access_level == 1) ? 0 : 1;

        // Save the catalog details to the database
        $catalog = Catalog::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'publishedDate' => $request->input('published'),
            'fileURL' => $fullFilePath,
            'authors' => $authors,
            'type_id' => $request->input('type'),
            'photo_path' => $fullImagePath,
            'status' => $status,
            'rating' => 0,
            'nUserRated' => 0,
            // assuming there's a column named 'authors' in your database
            // Add other fields as needed

        ]);
        // Return a response, redirect, or any other logic you need
        return redirect()->back()->with('success', 'Catalog added successfully');
    }

    // Display the specified catalog entry.
    public function show($id)
    {
        $count = 0;
        $catalogs = Catalog::with('types')->find($id);
        $bookmarkCount = Bookmark::where('catalog_id', $id);
        if (Auth::check() != null)
            $count = $bookmarkCount->where('users_id', auth()->user()->id)->count();
        $ratedCatalogs = Catalog::orderBy('rating', 'desc')->take(5)->get();
        $comments = Comment::with('user')->where('catalog_id', $id)->orderBy('created_at', 'desc')->paginate(10);
        return view('pages.catalogs', compact('catalogs', 'bookmarkCount', 'ratedCatalogs', 'comments', 'count'));
    }

    // Show the form for editing the specified catalog entry.
    public function edit($id)
    {
        $edit = Catalog::find($id);
        $types = CatalogType::all();
        return view('admin.forms.catalogs_profile', compact('edit', 'types'));
    }

    // Update the specified catalog entry in storage.
    public function update(Request $request, $id)
    {
        // Validate the incoming request with any necessary rules
        $validator =  Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'published' => 'required|date', // Adjust the file types and size as needed
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $catalog = Catalog::find($id);
        // Create the folder path based on the specified format
        $folderPath = '/lib/files/pdf';
        $imagePath = '/lib/files/g';

        // Move the file to the storage folder with the custom name
        // Retrieve the file from the request
        if ($request->input('file') != null) {
            $file = $request->file('file');
            Storage::disk('public')->put(asset($catalog->fileURL), file_get_contents($file), 'public');
        }
        if ($request->input('image') != null) {
            $image = $request->file('image');
            Storage::disk('public')->put(asset($catalog->photo_path), file_get_contents($image), 'public');
        }
        // Convert authors input to an array (assuming it's a comma-separated string)
        $authors = json_decode($request->input('authorsJSON'), true);

        $status = (auth()->user()->access_level == 1) ? 0 : 1;

        $catalog->title = $request->input('title') ?? $catalog->title;
        $catalog->description = $request->input('description') ?? $catalog->description;
        $catalog->publishedDate = $request->input('published') ?? $catalog->publishedDate;
        $catalog->authors = $authors ?? $catalog->authors;
        $catalog->type_id = $request->input('type') ?? $catalog->type_id;

        $catalog->update();

        return redirect()->back()
            ->with('success', 'Catalog record updated successfully');
    }

    // Remove the specified catalog entry from storage.
    public function destroy($id)
    {
        $catalog = Catalog::find($id);
        $catalog->delete();
        return redirect()->back()
            ->with('success', 'Catalog entry deleted successfully');
    }

    public function searchCatalog(Request $request)
    {
        $search= $request->input('search', '');
        $catalogs = Catalog::query();

       if($search){
        $catalogs->where('title', 'like', '%' . $search. '%')->paginate(10);
       }

        return redirect()->route('catalogs_review')->with(['catalogs' => $catalogs]);
    }
}
