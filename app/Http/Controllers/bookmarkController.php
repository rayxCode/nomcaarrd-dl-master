<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bookmark;

use function Pest\Laravel\delete;

class bookmarkController extends Controller
{
    public function store(Request $request, $id)
    {
        if (auth()->check()) {
            $userId = auth()->user()->id;
        } else {
            // Handle the case where there is no authenticated user.
            // You might redirect the user to a login page, show an error, etc.
            return redirect('login');
        }

        $userId = Auth::id();

        $bookmark = Bookmark::create([
            'catalog_id' => $id,
            'users_id' => $userId,
            'editedBy' => " ",
        ]);

        $bookmark->save();
        // The rest of your code for creating a bookmark goes here

        return back()->with('success', 'Bookmark added!');
    }

    public function index()
    {
        $bookmarks = Bookmark::where('users_id', auth()->user()->id);
        return view('pages.account_bookmarks', compact('bookmarks'));
    }
    public function destroy($id)
    {
        $bookmarks = Bookmark::where('catalog_id', $id)->where('users_id', auth()->user()->id);
        return redirect()->back();
    }

    public function clearAllBookmarks($id)
    {
        // Find all bookmarks for the given user ID
        $bookmarks = Bookmark::findorFail('users_id');

        // Delete each bookmark
        foreach ($bookmarks as $bookmark) {
            $bookmark->delete();
        }

        return redirect()->back()->with('success', "Bookmarks cleared.");
    }
}
