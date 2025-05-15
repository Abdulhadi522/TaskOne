<?php
namespace App\Actions;
use App\Http\Requests\PoadcastRequest;
use App\Models\Poadcast;
use Illuminate\Support\Facades\Auth;

class CreatePodcastAction
{
        public function StorePodcast(PoadcastRequest $request, $audioPath, $coverPath)
    {
    

            $poadcast = Poadcast::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'audio_file' => $audioPath,
                'cover_image' => $coverPath,
                'category_id' => $request->category_id,
                'channel_id' => $request->channel_id,

            ]);
            
            return $poadcast;
        
    }
}