<?php

// app/Http/Controllers/CommentController.php  
namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Services\CommentService;
use App\Trait\ResponseStorageTrait;

class CommentController extends Controller
{

    use ResponseStorageTrait;
    protected $commentService;


    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(CommentRequest $request, $poadcast_id)
    {

        $this->commentService->createComment($request, $poadcast_id);

        return $this->SuccessResponse('Your Comment Stored Successfully');
    }


    public function GetAllCommentsWithReplies()
    {

        $comments = Comment::whereNull('parent_id')->get();
        return ($comments);

    }
}
