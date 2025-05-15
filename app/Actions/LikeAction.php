<?php
namespace App\Actions;
use App\Models\Like;
use App\Trait\ResponseStorageTrait;
use Illuminate\Support\Facades\Auth;

class LikeAction
{
    use ResponseStorageTrait;
    public function Like($poadcastId)
    {
        Like::create([
            'poadcast_id' => $poadcastId,
            'user_id' => Auth::id(),
        ]);
        return $this->CreateLikeMessage('Podcast liked successfully!', 201);

    }
}
