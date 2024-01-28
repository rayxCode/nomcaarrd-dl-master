<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Catalog;
use App\Models\Bookmark;
use App\Models\CatalogType;
use App\Models\Comment;
use App\Models\Requests;
use DateTime;
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
        $catalogs = Catalog::where('status', 1)->with('types');

        // Apply search query
        if ($search) {
            $catalogs->where('title', 'like', '%' . $search . '%');
        }

        // Apply other filters (add more as needed)
        if (!empty($filters)) {
            $catalogs->whereIn('type_id', $filters); // 'paper_type' should be the column in your Catalog model that corresponds to these filters
        }

        //sets catalog top picks
        $ratedCatalogs = Catalog::orderBy('nUserRated', 'desc')->orderBy('rating', 'desc')->take(5)->get();

        // Get the filtered results
        $filteredCatalogs = $catalogs->paginate(10);
        $categories = CatalogType::get();


        return view('pages.search', compact('filteredCatalogs', 'search', 'ratedCatalogs', 'categories'));
    }

    // Edit a selected listing in catalogs index admin side.
    public function index()
    {
        $catalogs = Catalog::where('status', 1)->orderBy('title')->with('types')->paginate(10);
        $catalogs->appends(['sort' => 'title']);
        $types = CatalogType::all();
        return view('admin.admin_catalogs', compact('catalogs', 'types'));
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

        $title = $request->input('title');
        $publisherName = $request->input('publisher');
        $dateTime = (new DateTime($request->input('published')))->format('Y');
        $publishedYear = $dateTime;
        $category = $request->input('type');
        $lastId = Catalog::latest()->first()->id;
        $id = $lastId;

        // Extracting first letters
        $firstLetterTitle = strtoupper(substr($title, 0, 1));
        $firstLetterPublisher = strtoupper(substr($publisherName, 0, 1));
        $firstLetterCategory = strtoupper(substr($category, 0, 1));

        // Creating the unique code
        $uniqueCode = $firstLetterTitle . $firstLetterPublisher . $publishedYear . $firstLetterCategory . $id;


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
            'code'=> $uniqueCode,
            'description' => $request->input('description'),
            'publishedDate' => $request->input('published'),
            'visibility' => $request->input('visibility'),
            'fileURL' => $fullFilePath,
            'authors' => $authors,
            'publisher' => $request->input('publisher'),
            'type_id' => $request->input('type'),
            'photo_path' => $fullImagePath,
            'status' => $status,
            'rating' => 0,
            'nUserRated' => 0,
            'view_count' => 0,
            'dl_count' => 0,
            // assuming there's a column named 'authors' in your database
            // Add other fields as needed

        ]);
        // Return a response, redirect, or any other logic you need
        return redirect()->back()->with('success', 'Catalog added successfully');
    }

    // Display the specified catalog entry.
    public function show($code)
    {
        $catalog = Catalog::where('code', $code)->first();
        $catalog->increment('view_count');
        $catalog->update();

        $count = 0;
        $catalogs = Catalog::with('types')->find($catalog->id);
        $bookmarkCount = Bookmark::where('catalog_id', $catalog->id);
        $userName = null;

        $requestsFile = Requests::where('catalog_id', $catalog->id);
        $userCount = 0;
        $userRequest = null;

        if (Auth::check()) {
            $count = $bookmarkCount->where('users_id', auth()->user()->id)->count();
            $userName = auth()->user()->fullname ?: auth()->user()->username;
            $userRequest = $requestsFile->where('users_id', auth()->user()->id)->first();
            $userCount = $requestsFile->where('users_id', auth()->user()->id)->count();
        }

        // Clean up the user name (remove extra characters)
        $userName = trim($userName);
        $cCounts = 0;
        // Query to count distinct authors in the 'authors' JSON column
        if ($userName) {
            $cCounts = Catalog::where('authors', 'like', '%' . $userName . '%')->where('status', 1)->count();
        }



        $ratedCatalogs = Catalog::where('status', 1)->orderBy('nUserRated', 'desc')->orderBy('rating', 'desc')->take(5)->get();
        $comments = Comment::with('user')->where('catalog_id', $catalog->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('pages.catalogs', compact('catalogs', 'cCounts', 'userCount', 'userRequest', 'bookmarkCount', 'ratedCatalogs', 'comments', 'count'));
    }

    // Show the form for editing the specified catalog entry.
    public function edit($id)
    {
        $edit = Catalog::find($id);
        $types = CatalogType::all();
        return view('admin.forms.edit_catalogs', compact('edit', 'types'));
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

        $title = $request->input('title');
        $publisherName = $request->input('publisher');
        $dateTime = (new DateTime($request->input('published')))->format('Y');
        $publishedYear = $dateTime;
        $category = $request->input('type');
        $id = $catalog->id;

        // Extracting first letters
        $firstLetterTitle = strtoupper(substr($title, 0, 1));
        $firstLetterPublisher = strtoupper(substr($publisherName, 0, 1));
        $firstLetterCategory = strtoupper(substr($category, 0, 1));

        // Creating the unique code
        $uniqueCode = $firstLetterTitle . $firstLetterPublisher . $publishedYear . $firstLetterCategory . $id;

        $catalog->title = $request->input('title') ?? $catalog->title;
        $catalog->code = $uniqueCode;
        $catalog->publisher = $request->input('publisher') ?? $catalog->publisher;
        $catalog->visibility = $request->input('visibility');
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

    public function dlCounts($id)
    {
        $catalog = Catalog::findOrFail($id);
        $catalog->increment('dl_count'); // Increment the download count
        $catalog->save();

        // Optionally, you can also force the file download here
        return response()->download(storage_path('app/public' . $catalog->fileURL));
    }

    public function searchCatalog(Request $request)
    {
        $search = $request->input('search', '');
        $catalogs = Catalog::where('status', 1);

        if ($search) {
            $catalogs->where('title', 'like', '%' . $search . '%');
        }
        $catalogs = $catalogs->orderBy('title')->with('types')->paginate(10);
        $types = CatalogType::all();

        return view('admin.admin_catalogs', compact('catalogs', 'search', 'types'));
    }
}
