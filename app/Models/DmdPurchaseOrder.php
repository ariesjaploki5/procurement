<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DmdPurchaseOrder extends Model
{
    protected $table = 'dmd_purchase_order';
    protected $primaryKey = 'dmd_po_id';
    public $timestamps = false;

    protected $fillable = [
        'purchase_order_id', 
        'purchase_request_id',
        'dmd_id', 
        'quantity',
        'brand_id',
        'manufacturer_id',
        'country_id',
        'cost_price',
    ];

    public function purchase_order(){
        return $this->belongsTo('App\Models\PurchaseOrder', 'purchase_order_id', 'purchase_order_id');
    }

    public function purchase_request(){
        return $this->belongsTo('App\Models\PurchaseRequest', 'purchase_request_id', 'purchase_request_id');
    }

}
