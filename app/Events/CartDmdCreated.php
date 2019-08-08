<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CartDmdCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $cart_dmd;
    
    public function __construct($cart_dmd)
    {
        $this->$cart_dmd = $cart_dmd;
    }

    public function broadcastOn()
    {
        return new Channel('cart_dmd_created');
    }

    public function broadcastAs(){
        return 'cart_dmd.created';
    }
}
