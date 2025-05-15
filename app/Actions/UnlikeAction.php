<?php
namespace App\Actions;
use App\Models\Like;
use App\Trait\ResponseStorageTrait;
use Illuminate\Support\Facades\Auth;

class UnlikeAction
{
    use ResponseStorageTrait;
    public function unlike($poadcastId)
    {
        $userId = Auth::id();

        $like = Like::where('poadcast_id', $poadcastId)->where('user_id', $userId)->first();

        if (!$like) {
            return $this->ErrorResponse('Like Not Found');
        }

        $like->delete();

        return $this->CreateUnLikeMessage('Podcast unliked successfully!', 201);
    }
}
