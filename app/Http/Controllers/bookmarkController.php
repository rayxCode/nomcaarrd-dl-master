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

    public function showBookmark($id){
        $bookmarks = Bookmark::where('users_id', auth()->user()->id);
        return view('pages.account_bookmarks', compact('bookmarks'));
    }
    public function destroy($id){
        $bookmarks = Bookmark::where('catalog_id', $id)->where('users_id', auth()->user()->id);
        return redirect()->back();
    }

    public function clearAllBookmarks($id)
    {

    }
}
