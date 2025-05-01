<?php

namespace App\Services;


use App\Http\Requests\PoadcastRequest;
use App\Models\Poadcast;
use Illuminate\Support\Facades\Auth;

class PodcastService
{
    public function AudioPath(PoadcastRequest $request)
    {
        $audioPath = $request->file('audio_file');
        return $audioPath;
    }


    public function CoverPath(PoadcastRequest $request)
    {
        $coverPath = $request->file('cover_image') ? $request->file('cover_image') : null;
        return $coverPath;
    }

    public function StorePodcast(PoadcastRequest $request, $audioPath, $coverPath)
    {
    

            $poadcast = Poadcast::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'audio_file' => $audioPath,
                'cover_image' => $coverPath,
            ]);
            
            return $poadcast;
        
    }
}
