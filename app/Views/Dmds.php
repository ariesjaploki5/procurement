<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Dmds extends Model
{
    protected $table = 'view_dmds';
    public $timestamps = false;
    
    public function app_dmd(){
        return $this->hasOne('App\Views\AppDmd', 'dmd_id', 'dmd_id')->where('app_year', Carbon::now()->year);
    }

    public function dmd_price_schedules(){
        return $this->hasMany('App\Views\DmdPriceSchedule', 'dmd_id', 'dmd_id');
    }

    public function dmd_rfqs(){
        return $this->hasMany('App\Views\DmdRfq', 'dmd_id', 'dmd_id');
    }

}
