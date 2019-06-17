<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DmdUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $dmd;
    
    public function __construct($dmd)
    {
        $this->$dmd = $dmd;
    }

    public function broadcastOn()
    {
        return new Channel('dmd_updated');
    }

    public function broadcastAs(){
        return 'dmd.updated';
    }
}
