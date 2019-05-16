<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PpmpCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ppmp;
    
    public function __construct($ppmp)
    {
        $this->$ppmp = $ppmp;
    }

    public function broadcastOn()
    {
        return new Channel('ppmp_created');
    }

    public function broadcastAs(){
        return 'ppmp.created';
    }
}
