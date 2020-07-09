<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Request $request, $micropostId)
    {
        Comment::create(
            [
                'user_id' => \Auth::user()->id,
                'micropost_id' => $micropostId,
                'content' => $request->input('content')
            ]
        );

        return back();
    }

    public function destroy($id)
    {
    }
}
