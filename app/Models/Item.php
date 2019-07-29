<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use \Awobaz\Compoships\Compoships;

    protected $primaryKey = 'item_id';
    public $timestamps = false;

    protected $fillable = [
        'item_desc', 'cat_id', 'unit_id', 'ssl', 'beg_bal', 'item_specs'
    ];

    public function ppmps(){
        return $this->belongsToMany('App\Models\Ppmp');
    }

    public function price_schedules(){
        return $this->belongsToMany('App\Models\PriceSchedule')->withPivot('bid_price', 'supplier_id', 'brand_id', 'packaging_id', 'manufacturer_id', 'country_id');
    }

    public function category(){
        return $this->hasOne('App\Models\Category', 'cat_id', 'category_id');
    }

    public function unit(){
        return $this->hasOne('App\Models\Unit');
    }

    public function total_received(){

    }

    public function item_price_schedules(){
        return $this->hasMany('App\Models\ItemPriceSchedule', 'item_id', 'item_id');
    }

    public function item_ppmps(){
        return $this->hasMany('App\Models\ItemPpmp', 'item_id', 'item_id');
    }

    public function item_homis_link(){
        return $this->hasOne('App\Views\ItemHomisLink', 'item_id', 'item_id');
    }

}
