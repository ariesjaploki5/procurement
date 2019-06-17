<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DmdPurchaseRequest extends Model
{
    protected $table = 'dmd_purchase_request';
    public $timestamps = false;

    protected $fillable = [
        'dmd_id', 'purchase_request_id', 'request_quantity', 'order_quantity', 'status', 'received_quantity'
    ];

    public function purchase_request(){
        return $this->belongsTo('App\Models\PurchaseRequest');
    }
}
