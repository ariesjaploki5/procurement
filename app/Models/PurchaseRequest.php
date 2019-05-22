<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    protected $primaryKey = 'purchase_request_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 
        'supplier_id', 
        'mode_id',
        'request_quantity',
        'div_head_rcv', 'div_head_rls',
        'pmo_rcv','pm_rls',
        'div_head_rcv_2', 'div_head_rls_2',
        'pmo_rcv_2','pmo_rls_2',
        'budget_rcv', 'budget_rls',
        'accounting_rcv', 'accounting_rls',
        'mcc_rcv', 'mcc_rls',
        'fmo_rcv', 'fmo_rls',
        'pmo_rcv_3', 'pmo_rls_3',
        'mmo_rcv', 'mmo_rls',
    ];

    public function items(){
        return $this->belongsToMany('App\Models\Item');
    }

    public function supplier(){
        return $this->belongsTo('App\Models\Supplier');
    }
    
}
