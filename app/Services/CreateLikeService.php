<?php

namespace App\Services;
use App\Models\Like;
use App\Trait\ResponseStorageTrait;

class CreateLikeService
{
    use ResponseStorageTrait;

    public function CreateLike($userId,$poadcastId)
    {
        Like::create([
            'poadcast_id' => $poadcastId,
            'user_id' => $userId,
        ]);

        return $this->CreateLikeMessage('Podcast liked successfully!' ,201);
        
        // return response()->json(['message' => '', 'like' => $like], 201);
    }
}
