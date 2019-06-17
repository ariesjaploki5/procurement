<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class AppDmd extends Model
{
    protected $table = 'view_app_dmd';
    public $timestamps = false;

    public function dmd_price_schedule(){
        return $this->hasOne('App\Views\DmdPriceSchedule', 'dmd_id', 'dmd_id')->orderBy('rank', 'asc');
    }
}
