<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DmdReceived extends Model
{
    protected $table = 'procurement.dbo.dmd_received';
    public $timestamps = false;

    protected $fillable = [
        'dmd_id', 
        'purchase_request_id',
        'purchase_order_id', 
        'received_quantity',
        'received_type_id', 
        'received_exp',
        'dmd_po_id'
    ];

    public function dmd(){
        return $this->belongsTo('App\Models\Dmd', 'dmd_id', 'dmd_id');
    }

    public function purchase_request(){
        return $this->belongsTo('App\Models\PurchaseRequest', 'purchase_request_id', 'purchase_request_id');
    }

    public function purchase_order(){
        return $this->belongsTo('App\Models\PurchaseOrder', 'purchase_order_id', 'purchase_order_id');
    }

    public function dmd_po(){
        return $this->belongsTo('App\Models\DmdPurchaseOrder', 'dmd_po_id', 'dmd_po_id');
    }

    public function new_dmd_homis(){
        return $this->hasOne('App\Views\NewDmdHomis', 'dmd_id', 'dmd_id');
    }
    
}
