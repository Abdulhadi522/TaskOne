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


}
