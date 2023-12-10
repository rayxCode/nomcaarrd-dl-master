<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'rating' => 'required',
        ]);

        $id = $request->input('id');
        $rate = $request->input('rating');

        // Validation
        $commentary = app('profanityFilter')
            ->replaceWith('*')
            ->replaceFullWords(false)
            ->filter($request->input('comment'));

        // Updating Catalog
        $catalog = Catalog::findOrFail($id);
        $catalog->rating = (($catalog->rating * $catalog->nUserRated) + $rate) / ($catalog->nUserRated + 1);
        $catalog->nUserRated++;



        // Create a new comment
        $comment = new Comment();
        $comment->users_id = auth()->user()->id;
        $comment->comment = $commentary;
        $comment->catalog_id = $id;
        $comment->rating = $rate;
        // Save Comment and Update Catalog
        $comment->save();
        $catalog->update();

        return back();
    }
}
