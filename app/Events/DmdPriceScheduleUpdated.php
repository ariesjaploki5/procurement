<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DmdPriceScheduleUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $dmd_price_schedule;
    
    public function __construct($dmd_price_schedule)
    {
        $this->$dmd_price_schedule = $dmd_price_schedule;
    }

    public function broadcastOn()
    {
        return new Channel('dmd_price_schedule_updated');
    }

    public function broadcastAs(){
        return 'dmd_price_schedule.updated';
    }
}
