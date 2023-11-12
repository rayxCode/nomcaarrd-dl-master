<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bookmark;


class bookmarkController extends Controller
{
    public function addBookmark(Request $request, $id)
    {
        if (auth()->check()) {
            $userId = auth()->user()->id;
        } else {
            // Handle the case where there is no authenticated user.
            // You might redirect the user to a login page, show an error, etc.
            return redirect('login');
        }

        $message = [
            'catalog_id.required' => 'There\'s no catalog that exists like that',
        ];
        // Validate the request
        $validatedData = $request->validate([
            'catalog_id' => 'required|exists:catalogs,catalog_id', // assuming 'catalogs' table has 'id' column
        ]);

        $userId = Auth::id();

        $bookmark = Bookmark::create([
            'catalog_id' => $validatedData['catalog_id'],
            'users_id' => $userId,
            'editedBy' => ' ',
        ]);

        $bookmark->save();
        // The rest of your code for creating a bookmark goes here

        return back()->with('success', 'Bookmark added!');
    }

    public function showBookmark($id){
        $bookmarks = Bookmark::where('users_id', auth()->user()->id);

    }
}
