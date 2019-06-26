<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    protected $table = 'view_carts';
    public $timestamps = false;

    public function dmd_price_schedule(){
        return $this->hasOne('App\Views\DmdPriceSchedule', 'dmd_id', 'dmd_id')->orderBy('rank', 'asc');
    }

    public function app_dmd(){
        return $this->belongsTo('App\Views\AppDmd', 'dmd_id', 'dmd_id');
    }
}
