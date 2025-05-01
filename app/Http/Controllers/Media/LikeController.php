<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use App\Services\LikeService;

class LikeController extends Controller
{
    protected $likeService;

    public function __construct(LikeService $likeService) {
        $this->likeService = $likeService;
    }

    public function like($poadcastId)  
    {  
        return $this->likeService->like($poadcastId);
    }  

    /**  
     * Unlike a podcast.  
     */  
    public function unlike($poadcastId)  
    {  
        $userId = Auth::id();  

        // Find the like record  
        $like = Like::where('poadcast_id', $poadcastId)->where('user_id', $userId)->first();  

        if (!$like) {  
            return response()->json(['message' => 'Like not found.'], 404);  
        }  

        // Delete the like  
        $like->delete();  

        return response()->json(['message' => 'Podcast unliked successfully!'], 200);  
    }  
}
