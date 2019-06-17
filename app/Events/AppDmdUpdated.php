<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AppDmdUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $app_dmd;
    
    public function __construct($app_dmd)
    {
        $this->$app_dmd = $app_dmd;
    }

    public function broadcastOn()
    {
        return new Channel('app_dmd_updated');
    }

    public function broadcastAs(){
        return 'app_dmd.updated';
    }
}
