<?php

namespace App\Containers\LiveDrop\Events;

use App\Containers\LiveDrop\UI\API\Resources\LiveDropResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewLiveDropEvent implements ShouldBroadcast, ShouldDispatchAfterCommit
{
    use Dispatchable, SerializesModels;

    public $live_drop;

    public function __construct($player, $item)
    {
        $this->live_drop = new LiveDropResource(compact('player', 'item'));
    }

    public function broadcastOn()
    {
        return new Channel('public:live-drops');
    }
}
