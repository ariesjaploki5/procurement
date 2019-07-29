<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\PurchaseOrderUpdated;
use App\Events\PurchaseOrderCreated;

class PurchaseOrder extends Model
{
    protected $primaryKey = 'purchase_order_id';
    public $timestamps = false;

    protected $fillable = [
        'created_at', 'allotment_id', 'uacs_id', 
        'fund_source_id', 'amount', 'obrs_date', 
        'date_of_delivery', 'terminated',

        'div_head_rcv_po', 'div_head_rls_po',

        'pmo_rcv_po', 'pmo_rls_po',

        'budget_rcv', 'budget_rls',

        'accntng_rcv', 'accntng_rls',

        'fmo_rcv', 'fmo_rls',

        'mcc_rcv', 'mcc_rls',

        'mmo_rcv', 'mmo_rls', 
        
        'current_status',

        'supplier_id',
        'purchase_request_id',
        'mode_id',
        'delivery_term',
        'updated_at',
    ];

    protected $dispatchesEvents = [
        'updated' => PurchaseOrderUpdated::class,
        'created' => PurchaseOrderCreated::class,
    ];

    public function items(){
        
        return $this->belongsToMany('App\Models\Item');

    }

    public function purchase_request(){

        return $this->hasOne('App\Models\PurchaseRequest', 'purchase_order_id', 'purchase_order_id');

    }

    public function uacs(){

        return $this->belongsTo('App\Models\Uacs', 'uacs_id', 'id');

    }

    public function fund_source(){

        return $this->belongsTo('App\Models\FundSource', 'fund_source_id', 'id');

    }

    public function allotment(){

        return $this->belongsTo('App\Models\Allotment', 'allotment_id', 'allotment_id');

    }

    public function dmd_purchase_orders(){

        return $this->hasMany('App\Models\DmdPurchaseOrder', 'purchase_order_id', 'purchase_order_id');

    }

    public function supplier(){
        return $this->belongsTo('App\Models\Supplier', 'supplier_id', 'supplier_id');
    }

    public function mode(){
        return $this->belongsTo('App\Models\Mode','mode_id', 'mode_id');
    }

    public function purchase_order_statuses(){
        return $this->hasMany('App\Models\PurchaseOrderStatus', 'purchase_order_id', 'purchase_order_id');
    }
}
