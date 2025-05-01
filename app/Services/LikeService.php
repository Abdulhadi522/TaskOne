<?php

namespace App\Services;

use App\Models\Like;
use App\Trait\ResponseStorageTrait;
use Illuminate\Support\Facades\Auth;
use App\Services\CreateLikeService;



class LikeService
{
    use ResponseStorageTrait;
    protected $CreateLikeService;

    public function __construct(CreateLikeService $CreateLikeService)
    {

        $this->CreateLikeService = $CreateLikeService;
    }

    public function Like($poadcastId)
    {

        $userId = Auth::id();

        $likeExists = Like::where('poadcast_id', $poadcastId)->where('user_id', $userId)->exists();

        if ($likeExists) {
            return $this->Existlike("You have already liked this podcast.", 409);
        }

        return  $this->CreateLikeService->CreateLike($userId, $poadcastId);
    }
}
