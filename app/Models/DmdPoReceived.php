<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DmdPoReceived extends Model
{
    
    protected $table = 'procurement.dbo.dmd_po_receiveds';
    public $timestamps = false;

    protected $fillable = [
        'receiving_officer_id', 
        'inspection_officer_id',
        'batch_no', 
        'expiry_date', 
        'received_quantity',
        'remarks',
        'list_no',
        'created_at',
        'dmd_po_id',
        'date_received',
        'user_id',
        'iar_no',
    ];

    // public function dmd_purchase_order(){
    //     return $this->belongsTo('App\Models\DmdPurchaseOrder', 'list_no', 'list_no');
    // }

    public function dmd_purchase_order_2(){
        return $this->belongsTo('App\Models\DmdPurchaseOrder', 'dmd_po_id', 'id');
    }
}
