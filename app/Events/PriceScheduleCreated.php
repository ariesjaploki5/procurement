<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PriceScheduleCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ps;
    
    public function __construct($ps)
    {
        $this->$ps = $ps;
    }

    public function broadcastOn()
    {
        return new Channel('ps_created');
    }

    public function broadcastAs(){
        return 'price_schedule.created';
    }
}
