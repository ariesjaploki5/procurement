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
}
