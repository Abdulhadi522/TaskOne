<?php

namespace App\Actions;

use App\Models\Channel;

class SubscribeToChannelAction
{
    public function execute(Channel $channel , int $userId){

        $channel->subscribers()->syncWithoutDetaching([$userId]);

    }
}
