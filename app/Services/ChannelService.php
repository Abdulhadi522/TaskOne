<?php

namespace App\Services;

use App\Http\Resources\ChannelResource;
use App\Http\Resources\PoadcastResource;
use App\Models\Channel;
use App\Models\Poadcast;

class ChannelService
{
    public function getWithPublishedPoadcasts(int $id): Channel
    {
        $channel =  Channel::with(['poadcasts' => function ($query) {
            $query->published();
        }])->findOrFail($id);
        return $channel;
    }

    public function search(string $query)
    {
        $channels = Channel::where('name', 'like', "%{$query}%")->get();
        $poadcasts = Poadcast::where('title', 'like', "%{$query}%")->published()->get();
        return response()->json([
            'channels' => ChannelResource::collection($channels),
            'poadcasts' => PoadcastResource::collection($poadcasts),
        ]);

        
    }
}
