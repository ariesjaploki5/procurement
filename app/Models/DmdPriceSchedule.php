<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\DmdPriceScheduleUpdated;
use App\Events\DmdPriceScheduleCreated;

class DmdPriceSchedule extends Model
{
    protected $table = 'dmd_price_schedule';
    public $timestamps = false;

    protected $dispatchesEvents = [
        'saved' => DmdPriceScheduleCreated::class,
        'updated' => DmdPriceScheduleUpdated::class,
    ];

    protected $fillable = [
        'supplier_id', 'manufacturer_id', 'packaging_id', 'brand_id', 'bid_price', 'country_id', 'dmd_id', 'price_schedule_id', 'rank', 'terminated'
    ];

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
}