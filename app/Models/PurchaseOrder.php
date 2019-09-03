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
        'created_at', 'allotment_id', 
        'fund_source_code_id', 'fund_cluster_id',
        'fund_source_id', 'uacs_code_id','amount', 'obrs_date', 
        'date_of_delivery', 'terminated',
        'payment_term_id', 'place_of_delivery',
        'current_status','supplier_id',
        'purchase_request_id','mode_id',
        'delivery_term','updated_at',
        'po_id','dod',
        'pod','ors_burs',
        'notice','waiver',        
    ];

    protected $dispatchesEvents = [
        'updated' => PurchaseOrderUpdated::class,
        'created' => PurchaseOrderCreated::class,
    ];

    public function items(){
        return $this->belongsToMany('App\Models\Item');
    }

    public function purchase_request(){
        return $this->hasOne('App\Models\PurchaseRequest', 'purchase_request_id', 'purchase_request_id');
    }

    public function uacs(){
        return $this->belongsTo('App\Models\Uacs', 'uacs_id', 'id');
    }

    public function fund_source(){
        return $this->belongsTo('App\Models\FundSource', 'fund_source_id', 'id');
    }

    public function fund_source_code(){
        return $this->belongsTo('App\Models\FundSourceCode', 'fund_source_code_id', 'id');
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

    public function last_status(){
        return $this->hasOne('App\Models\PurchaseOrderStatus', 'purchase_order_id', 'purchase_order_id')
        ->orderBy('id', 'desc');
    }

    public function payment_term(){
        return $this->belongsTo('App\Models\PaymentTerm', 'payment_term_id', 'id');
    }

    public function notice_of_adjustment(){
        return $this->hasMany('App\Models\NoticeOfAdjustment', 'purchase_order_id', 'purchase_order_id');
    }
    
    public function dv_current_status(){
        return $this->hasMany('App\Models\DvCurrentStatus', 'purchase_order_id', 'purchase_order_id');
    }
}
