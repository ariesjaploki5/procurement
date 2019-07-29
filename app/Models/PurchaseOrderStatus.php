<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderStatus extends Model
{
    protected $table = 'purchase_order_status';
    public $timestamps = false;

    protected $fillable = [
        'purchase_order_id', 'current_status_id', 'status_date_time',
    ];

    public function purchase_order(){
        return $this->belongsTo('App\Models\PurchaseOrder', 'purchase_order_id', 'purchase_order_id');
    }

    public function current_status(){
        return $this->belongsTo('App\Models\CurrentStatus');
    }
}
