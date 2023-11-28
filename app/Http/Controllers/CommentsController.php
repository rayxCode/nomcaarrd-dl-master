<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'comment' => ['required', 'string', 'bail', 'censor:profane_word1,profane_word2'],
            // Add any other validation rules you need
        ]);
        // Create a new comment
        $comments = new Comment();
        $comments->fill([
            'users_id' => auth()->user()->id,
            'catalog_id' => $request->input('catalog_id'),
            'comment' => $request->input('comment'),
        ]);
        //saveeeeeeeeeeeeeeeee
        $comments->save();

        return back()->with('success', 'Comment added successfully.');
    }
}
