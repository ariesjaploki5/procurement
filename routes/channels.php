<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('po_updated', function(){
    return true;
});

Broadcast::channel('pr_created', function(){
    return true;
});

Broadcast::channel('pr_updated', function(){
    return true;
});

Broadcast::channel('ps_created', function(){
    return true;
});

Broadcast::channel('ps_updated', function(){
    return true;
});

Broadcast::channel('ips_created', function(){
    return true;
});

Broadcast::channel('ips_updated', function(){
    return true;
});

Broadcast::channel('app_created', function(){
    return true;
});

Broadcast::channel('app_updated', function(){
    return true;
});

Broadcast::channel('cart_dmd_created', function(){
    return true;
});

Broadcast::channel('cart_dmd_updated', function(){
    return true;
});

Broadcast::channel('ippmp_created', function(){
    return true;
});

Broadcast::channel('ippmp_updated', function(){
    return true;
});

Broadcast::channel('ppmp_created', function(){
    return true;
});

Broadcast::channel('ppmp_updated', function(){
    return true;
});

Broadcast::channel('dmd_updated', function(){
    return true;
});

Broadcast::channel('app_dmd_updated', function(){
    return true;
});

Broadcast::channel('dmd_price_schedule_updated', function(){
    return true;
});
Broadcast::channel('dmd_price_schedule_created', function(){
    return true;
});

Broadcast::channel('dmd_purchase_request_updated', function(){
    return true;
});
Broadcast::channel('dmd_purchase_request_created', function(){
    return true;
});