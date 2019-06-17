<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dmd extends Model
{

    protected $table = 'procurement.dbo.dmds';
    protected $primaryKey = 'dmd_id';
    public $timestamps = false;

    protected $fillable = [
        'dmdctr', 'dmdcomb', 'ssl', 'unit_id',
    ];

    public function homis_dmd(){
        return $this->hasOne('App\Views\HomisDmd', ['dmdcomb', 'dmdctr'], ['dmdcomb', 'dmdctr']);
    }

    public function dmd_price_schedules(){
        return $this->hasMany('App\Models\DmdPriceSchedule', 'dmd_id', 'dmd_id');
    }

    public function apps(){
        return $this->belongsToMany('App\Models\App', 'app_dmd', 'dmd_id', 'app_id');
    }

    public function app_dmd(){
        return $this->hasMany('App\Models\AppDmd');
    }

    public function carts(){
        return $this->belongsToMany('App\Models\Cart', 'cart_dmd', 'dmd_id', 'cart_id');
    }
}
