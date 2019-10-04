<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\PurchaseOrderUpdated;
use App\Events\PurchaseOrderCreated;

class PurchaseOrder extends Model
{
    protected $primaryKey = 'po_id';
    protected $table = 'procurement.dbo.purchase_orders';
    public $incrementing = false;

    protected $fillable = [
        'po_id',
        'pr_id',
        'created_at', 
        'updated_at',
        'terminated', 
        'date_served',
        'payment_term_id', 
        'place_of_delivery', 
        'supplier_id',
        'mode_id',
        'delivery_term',
        'dod',
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
        return $this->hasOne('App\Models\PurchaseRequest', 'pr_id', 'pr_id');
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
        return $this->hasMany('App\Models\DmdPurchaseOrder', 'po_id', 'po_id');
    }

    public function supplier(){
        return $this->belongsTo('App\Models\Supplier', 'supplier_id', 'supplier_id');
    }

    public function mode(){
        return $this->belongsTo('App\Models\Mode','mode_id', 'mode_id');
    }

    public function purchase_order_statuses(){
        return $this->hasMany('App\Models\PurchaseOrderStatus', 'po_id', 'po_id');
    }

    public function last_status(){
        return $this->hasOne('App\Models\PurchaseOrderStatus', 'po_id', 'po_id')
        ->orderBy('id', 'desc');
    }

    public function payment_term(){
        return $this->belongsTo('App\Models\PaymentTerm', 'payment_term_id', 'id');
    }

    public function notice_of_adjustment(){
        return $this->hasMany('App\Models\NoticeOfAdjustment', 'po_id', 'po_id');
    }
    
    public function dv_current_status(){
        return $this->hasMany('App\Models\DvCurrentStatus', 'po_id', 'po_id');
    }

    public function obrs_no(){
        return $this->hasOne('App\Models\PoObrs', 'po_id', 'po_id');
    }
}
