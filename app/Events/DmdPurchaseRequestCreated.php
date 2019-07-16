<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DmdPurchaseRequestCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $dmd_purchase_request;
    
    public function __construct($dmd_purchase_request)
    {
        $this->$dmd_purchase_request = $dmd_purchase_request;
    }

    public function broadcastOn()
    {
        return new Channel('dmd_purchase_request_created');
    }

    public function broadcastAs(){
        return 'dmd_purchase_request.created';
    }
}
