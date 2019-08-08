<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Events\CartDmdCreated;
use App\Events\CartDmdUpdated;


class CartDmd extends Model
{
    protected $table = 'procurement.dbo.cart_dmd';
    public $timestamps = false;

    protected $fillable = [
        'cart_id', 'dmd_id', 'request_quantity'
    ];

    protected $dispatchesEvents = [
        'created' => CartDmdCreated::class,
        'updated' => CartDmdUpdated::class,
    ];

    public function cart(){
        return $this->belongsTo('App\Models\Cart');
    }

    public function dmd(){
        return $this->belongsTo('App\Models\Dmd');
    }

    public function dmd_price_schedule(){
        return $this->hasOne('App\Models\DmdPriceSchedule', 'dmd_id', 'dmd_id')
        ->whereNotNull('rank')->where('terminated', 0)->orderBy('rank', 'asc');
    }

    public function public_bidding(){
        return $this->hasOne('App\Models\DmdPriceSchedule', 'dmd_id', 'dmd_id')
        ->whereNotNull('rank')->where('terminated', 0)->orderBy('rank', 'asc');
    }

    public function new_dmd(){
        return $this->hasOne('App\Views\NewHomisDmd', 'dmd_id', 'dmd_id');
    }

    public function app_dmd(){
        return $this->hasMany('App\Views\NewAppDmd', 'dmd_id', 'dmd_id');
    }

    public function app_dmd_year(){
        return $this->hasOne('App\Views\NewAppDmd', 'dmd_id', 'dmd_id')->where('app_year', Carbon::now()->year);
    }
}
