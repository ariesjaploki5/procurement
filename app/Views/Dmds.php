<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class Dmds extends Model
{
    protected $table = 'view_dmds';
    public $timestamps = false;


    
    public function app_dmd(){
        return $this->hasMany('App\Models\AppDmd', 'dmd_id', 'dmd_id');
    }

    public function dmd_price_schedules(){
        return $this->hasMany('App\Models\DmdPriceSchedule', 'dmd_id', 'dmd_id');
    }

}
