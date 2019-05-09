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
        return $this->belongsToMany('App\Models\Item');
    }
}
