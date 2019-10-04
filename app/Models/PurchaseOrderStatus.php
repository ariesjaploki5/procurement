<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderStatus extends Model
{
    protected $table = 'purchase_order_status';
    public $timestamps = false;

    protected $fillable = [
        'po_id', 'current_status_id', 'status_date_time', 'remarks'
    ];

    public function purchase_order(){
        return $this->belongsTo('App\Models\PurchaseOrder', 'po_id', 'po_id');
    }

    public function current_status(){
        return $this->belongsTo('App\Models\CurrentStatus');
    }
}
