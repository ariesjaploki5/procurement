<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $primaryKey = 'item_id';
    public $timestamps = false;

    protected $fillable = [
        'description', 'category_id', 'unit_id', 'standard_stock_level', 'beginning_balance',
    ];

    public function ppmps(){
        return $this->belongsToMany('App\Models\Ppmp');
    }

    public function price_schedules(){
        return $this->belongsToMany('App\Models\PriceSchedule')->withPivot('bid_price', 'supplier_id', 'brand_id', 'packaging_id', 'manufacturer_id', 'country_id');
    }

    public function category(){
        return $this->hasOne('App\Models\Category');
    }

    public function unit(){
        return $this->hasOne('App\Models\Unit');
    }

    public function total_received(){

    }

}
