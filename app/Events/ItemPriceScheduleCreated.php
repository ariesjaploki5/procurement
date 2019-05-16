<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ItemPriceScheduleCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ips;
    
    public function __construct($ips)
    {
        $this->$ips = $ips;
    }

    public function broadcastOn()
    {
        return new Channel('ips_created');
    }

    public function broadcastAs(){
        return 'item_price_schedule.created';
    }
}
