<?php

namespace App\Http\Controllers\Media;

use App\Actions\SubscribeToChannelAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChannelResource;
use App\Models\Channel;
use App\Services\ChannelService;
use App\Trait\ResponseStorageTrait;
use Illuminate\Http\Request;

class ChannelController extends Controller
{

    use ResponseStorageTrait;
    protected $channelService;
    public function __construct(ChannelService $channelService)
    {
        $this->channelService = $channelService;
    }


    public function subscribe($channelId, SubscribeToChannelAction $action)
    {
        $channel = Channel::findOrFail($channelId);
        $action->execute($channel, auth()->id());
        return $this->SuccessResponse('Subscribed Successfuly');
    }

    public function showChannel($id)
    {
        $channel =  $this->channelService->getWithPublishedPoadcasts($id);
        return new ChannelResource($channel);
    }


    public function search(Request $request)
    {
        $results = $this->channelService->search($request->input('query'));
        return $results;

    }
}
