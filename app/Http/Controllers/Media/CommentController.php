<?php

// app/Http/Controllers/CommentController.php  
namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Trait\ResponseStorageTrait;
use App\Actions\CreateCommentAction;

class CommentController extends Controller
{

    use ResponseStorageTrait;
    protected $commentAction;


    public function __construct(CreateCommentAction $commentAction)
    {
        $this->commentAction = $commentAction;
    }

    public function store(CommentRequest $request, $poadcast_id)
    {

        $this->commentAction->createComment($request, $poadcast_id);

        return $this->SuccessResponse('Your Comment Stored Successfully');
    }


    public function GetAllCommentsWithReplies()
    {

        $comments = Comment::whereNull('parent_id')
            ->with('children')
            ->get();

        return CommentResource::collection($comments);
    }
}
