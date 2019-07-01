<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\PurchaseOrderUpdated;

class PurchaseOrder extends Model
{
    protected $primaryKey = 'purchase_order_id';
    public $timestamps = false;

    protected $fillable = [
        'created_at', 'allotment_id', 'uacs_id', 'fund_source_id', 'amount', 'obrs_date', 'date_of_delivery'
    ];

    protected $dispatchesEvents = [
        'updated' => PurchaseOrderUpdated::class,
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
}
