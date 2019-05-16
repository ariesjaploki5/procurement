<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ItemPpmpCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ippmp;
    
    public function __construct($ippmp)
    {
        $this->$ippmp = $ippmp;
    }

    public function broadcastOn()
    {
        return new Channel('ippmp_created');
    }

    public function broadcastAs(){
        return 'item_ppmp.created';
    }
}
