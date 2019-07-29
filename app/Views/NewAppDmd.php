<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class NewAppDmd extends Model
{
    protected $table = 'view_new_app_dmd';
    public $timestamps = false;

    public function last_pr(){
        return $this->hasOne('App\Models\DmdPurchaseRequest', 'dmd_id', 'dmd_id')->orderBy('id', 'desc');
    }

    public function dmd_price_schedule(){
        return $this->hasOne('App\Views\DmdPriceSchedule', 'dmd_id', 'dmd_id')->orderBy('rank', 'asc');
    }

    public function dmd(){
        return $this->belongsTo('App\Views\NewHomisDmd', 'dmd_id', 'dmd_id');
    }
}
