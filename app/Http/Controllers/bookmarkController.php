<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Bookmark;

class bookmarkController extends Controller
{
    public function addBookmark(Request $request)
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
            'catalog_id' => 'required|exists:catalogs,catalog_id',
            'users_id' => $userId,
        ]);

        Bookmark::create($request->all());

        // The rest of your code for creating a bookmark goes here

        return back()->with('success', 'Bookmark added!');
    }
}
