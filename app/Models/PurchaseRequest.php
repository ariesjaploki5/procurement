<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\PurchaseRequestUpdated;

class PurchaseRequest extends Model
{
    protected $primaryKey = 'purchase_request_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 
        'supplier_id', 
        'mode_id',
        'category_id',

        'purchase_order_id',

        'request_quantity',
        'div_head_rcv', 'div_head_rls',
        'div_head_rcv_2', 'div_head_rls_2',
        'pmo_rcv','pmo_rls',
        'pmo_rcv_2','pmo_rls_2',
        'pmo_rcv_3', 'pmo_rls_3',

        'budget_rcv', 'budget_rls',
        'accounting_rcv', 'accounting_rls',
        'mcc_rcv', 'mcc_rls',
        'fmo_rcv', 'fmo_rls',
        'mmo_rcv', 'mmo_rls',
    ];

    protected $dispatchesEvents = [
        'updated' => PurchaseRequestUpdated::class,
    ];

    public function purchase_order(){
        return $this->belongsTo('App\Models\PurchaseOrder', 'purchase_order_id', 'purchase_order_id');
    }

    public function items(){
        return $this->belongsToMany('App\Models\Item');
    }

    public function supplier(){
        return $this->belongsTo('App\Models\Supplier', 'supplier_id', 'supplier_id');
    }
    
    public function dmd_purchase_requests(){
        return $this->hasMany('App\Models\DmdPurchaseRequest', 'purchase_request_id', 'purchase_request_id');
    }

    public function view_dmd_purchase_requests(){
        return $this->hasMany('App\Views\DmdPurchaseRequest', 'purchase_request_id', 'purchase_request_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }

    public function mode(){
        return $this->belongsTo('App\Models\Mode', 'mode_id', 'mode_id');
    }

    public function purchase_orders(){
        return $this->belongsTo('App\Models\PurchaseOrder', 'purchase_order_id', 'purchase_order_id');
    }
}
