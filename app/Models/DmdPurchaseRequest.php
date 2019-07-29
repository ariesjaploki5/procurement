<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DmdPurchaseRequest extends Model
{
    protected $table = 'dmd_purchase_request';
    public $timestamps = false;

    protected $fillable = [
        'dmd_id', 'purchase_request_id',
        'request_quantity', 'cost_price',
        'purchase_order_id', 'order_quantity',
        'status', 'received_quantity',
        'terminated',
    ];

    public function purchase_request(){
        return $this->belongsTo('App\Models\PurchaseRequest');
    }

    public function dmd_price_schedule(){
        return $this->hasMany('App\Views\DmdPriceSchedule', 'dmd_id', 'dmd_id');
    }

    public function dmd(){
        return $this->belongsTo('App\Views\NewHomisDmd', 'dmd_id', 'dmd_id');
    }

    public function new_app_dmd(){
        return $this->belongsTo('App\Views\NewAppDmd', 'dmd_id', 'dmd_id');
    }

    public function dmd_rfqs(){
        return $this->hasMany('App\Models\DmdRfq', 'dmd_id', 'dmd_id');
    }

    public function new_dmd_homis(){
        return $this->hasOne('App\Views\NewDmdHomis', 'dmd_id', 'dmd_id');
    }
}
