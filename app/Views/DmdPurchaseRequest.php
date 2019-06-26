<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class DmdPurchaseRequest extends Model
{
    protected $table = 'view_dmd_purchase_request';
    public $timestamps = false;

    public function dmd_price_schedule(){
        return $this->hasOne('App\Views\DmdPriceSchedule', 'dmd_id', 'dmd_id')->orderBy('rank', 'asc');
    }

    public function app_dmd(){
        return $this->hasOne('App\Views\AppDmd', 'dmd_id', 'dmd_id');
    }
    
    public function dmd_rfqs(){
        return $this->hasMany('App\Models\DmdRfq', 'dmd_id', 'dmd_id');
    }
}
