<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class DmdPriceSchedule extends Model
{
    protected $table = 'view_dmd_price_schedule';
    public $timestamps = false;

    public function dmd(){
        return $this->belongsTo('App\Models\Dmd');
    }

    public function price_schedule(){
        return $this->belongsTo('App\Models\PriceSchedule');
    }

    public function supplier(){
        return $this->belongsTo('App\Models\Supplier', 'supplier_id', 'supplier_id');
    }

    public function manufacturer(){
        return $this->belongsTo('App\Models\Manufacturer', 'manufacturer_id', 'manufacturer_id');
    }

    public function country(){
        return $this->belongsTo('App\Models\Country', 'country_id', 'country_id');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'brand_id');
    }
    
    public function packaging(){
        return $this->belongsTo('App\Models\Packaging', 'packaging_id', 'packaging_id');
    }

    public function new_dmd(){
        return $this->belongsTo('App\Views\NewHomisDmd', 'dmd_id', 'dmd_id');
    }
}
