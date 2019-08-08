<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\CartDmdCreated;
use App\Events\CartDmdUpdated;

class Cart extends Model
{
    protected $table = 'dbo.carts';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'status', 'mode_id',
    ];

    protected $dispatchesEvents = [
        'created' => CartDmdCreated::class,
        'updated' => CartDmdUpdated::class,
    ];

    public function dmds(){
        return $this->belongsToMany('App\Models\Dmd', 'cart_dmd', 'cart_id', 'dmd_id');
    }

    public function cart_dmds(){
        return $this->hasMany('App\Models\CartDmd');
    }

}
