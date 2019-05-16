<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceSchedule extends Model
{
    protected $primaryKey = 'price_schedule_id';
    public $timestamps = false;

    protected $fillable = [
        'category_id', 'price_schedule_year', 'user_id', 'price_schedule_submitted'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id', 'category_id');
    }

    public function created_by(){
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }

    public function items(){
        return $this->belongsToMany('App\Models\Item', 'item_price_schedule', 'price_schedule_id', 'item_id')
        ->withPivot('id', 'item_id', 'price_schedule_id', 'rank', 'bid_price', 'supplier_id', 'manufacturer_id', 'country_id', 'packaging_id', 'brand_id');
    }
}
