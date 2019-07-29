<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class NewCart extends Model
{
    protected $table = 'view_new_cart';
    public $timestamps = false;

    public function dmd_price_schedule(){
        return $this->hasOne('App\Views\DmdPriceSchedule', 'dmd_id', 'dmd_id')->orderBy('rank', 'asc');
    }

}
