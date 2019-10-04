<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\PurchaseRequestUpdated;

class PurchaseRequest extends Model
{
    protected $primaryKey = 'pr_id';
    protected $table = 'procurement.dbo.purchase_requests';
    public $incrementing = false;

    protected $fillable = [
        'pr_id',
        'user_id', 
        'supplier_id', 
        'mode_id',
        'category_id',
        'purpose',
        'cart_id',

        'send',
        'current_status',
        'status',

        'updated_at',
        'ep'
    ];

    protected $dispatchesEvents = [
        'updated' => PurchaseRequestUpdated::class,
    ];

    public function purchase_order(){
        return $this->belongsTo('App\Models\PurchaseOrder', 'pr_id', 'pr_id');
    }

    public function items(){
        return $this->belongsToMany('App\Models\Item');
    }

    public function supplier(){
        return $this->belongsTo('App\Models\Supplier', 'supplier_id', 'supplier_id');
    }
    
    public function dmd_purchase_requests(){
        return $this->hasMany('App\Models\DmdPurchaseRequest', 'pr_id', 'pr_id');
    }

    public function view_dmd_purchase_requests(){
        return $this->hasMany('App\Views\DmdPurchaseRequest', 'pr_id', 'pr_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }

    public function mode(){
        return $this->belongsTo('App\Models\Mode', 'mode_id', 'mode_id');
    }

    public function purchase_orders(){
        return $this->belongsTo('App\Models\PurchaseOrder', 'pr_id', 'pr_id');
    }

    public function app_dmd(){
        return $this->belongsTo('App\Views\AppDmd', 'dmd_id', 'dmd_id');
    }

    public function rfq(){
        return $this->hasOne('App\Models\RequestForQuotation', 'pr_id', 'pr_id');
    }

    public function purchase_request_remarks(){
        return $this->hasOne('App\Models\PurchaseRequestRemark', 'pr_id', 'pr_id');
    }

    public function purchase_request_statuses(){
        return $this->hasMany('App\Models\PurchaseRequestStatus', 'pr_id', 'pr_id');
    }

    public function last_status(){
        return $this->hasOne("App\Models\PurchaseRequestStatus", 'pr_id', 'pr_id')
        ->orderBy('id', 'desc');
    }

}
