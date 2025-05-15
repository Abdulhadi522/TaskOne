<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;

use App\Actions\LikeAction;
use App\Actions\UnlikeAction;

class LikeController extends Controller
{
    protected $likeAction, $unlikeAction;

    public function __construct(LikeAction $likeAction, UnlikeAction $unlikeAction)
    {
        $this->likeAction = $likeAction;
        $this->unlikeAction = $unlikeAction;
    }

    public function like($poadcastId)
    {
        return $this->likeAction->like($poadcastId);
    }

    /**  
     * Unlike a podcast.  
     */
    public function unlike($poadcastId)
    {
        return $this->unlikeAction->unlike($poadcastId);
    }
}
