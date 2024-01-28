<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;
use App\Models\Comment;

use function PHPUnit\Framework\isEmpty;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $id = $request->input('id');
        $rate = $request->input('rating') ?? 0;

        // Validation
        $commentary = app('profanityFilter')
            ->replaceWith('*')
            ->replaceFullWords(false)
            ->filter($request->input('comment'));

        // Updating Catalog
        if ($rate > 0) {
            $catalog = Catalog::findOrFail($id);
            $catalog->rating = (($catalog->rating * $catalog->nUserRated) + $rate) / ($catalog->nUserRated + 1);
            $catalog->nUserRated++;
        }

        // Create a new comment
        $comment = new Comment();
        $comment->users_id = auth()->user()->id;
        $comment->comment = $commentary;
        $comment->catalog_id = $id;
        $comment->rating = $rate;
        // Save Comment and Update Catalog
        if ($rate > 0 || $commentary) {
            $comment->save();
            if ($rate > 0)
                $catalog->update();
        }


        return back();
    }
}
