<?php

namespace App\Services;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentService
{

    public function createComment(CommentRequest $request, $poadcast_id)
    {

        if (Auth::user()->id) {
            $comment =  Comment::create([
                'poadcast_id' => $poadcast_id,
                'user_id'     => Auth::user()->id,
                'text'        => $request->text,
                'parent_id'   => $request->parent_id,
            ]);
            return $comment;
        }
    }
}
