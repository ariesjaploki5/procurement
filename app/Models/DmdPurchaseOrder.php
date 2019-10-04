<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DmdPurchaseOrder extends Model
{

    protected $table = 'dmd_purchase_order';
    
    protected $primaryKey = 'dmd_po_id';
    
    public $timestamps = false;

    protected $fillable = [
        'po_id',
        'dmd_id',
        'order_quantity',
        
        'brand_id',
        'packaging_id',
        'manufacturer_id',
        'country_id',

        'cost_price',
        'list_no',
        'po_id',
        'total_received',
    ];


    public function purchase_order(){
        return $this->belongsTo('App\Models\PurchaseOrder', 'po_id', 'po_id');
    }


    public function purchase_request(){
        return $this->belongsTo('App\Models\PurchaseRequest', 'purchase_request_id', 'purchase_request_id');
    }


    public function new_dmd(){
        return $this->belongsTo('App\Views\NewHomisDmd', 'dmd_id', 'dmd_id');
    }

    public function manufacturer(){
        return $this->belongsTo('App\Models\Manufacturer', 'manufacturer_id', 'manufacturer_id');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'brand_id');
    }

    public function packaging(){
        return $this->belongsTo('App\Models\Packaging', 'packaging_id', 'packaging_id');
    }

    public function country(){
        return $this->belongsTo('App\Models\Country', 'country_id', 'country_id');
    }

    public function dmd_receiveds(){
        return $this->hasMany('App\Models\DmdReceived', 'dmd_po_id', 'dmd_po_id');
    }

    public function new_dmd_homis(){
        return $this->hasOne('App\Views\NewDmdHomis', 'dmd_id', 'dmd_id');
    }

    public function dmd_po_receiveds(){
        return $this->hasMany('App\Models\DmdPoReceived', 'list_no', 'list_no');
    }

    public function dmd_po_receiveds_2(){
        return $this->hasMany('App\Models\DmdPoReceived', 'id', 'dmd_po_id');
    }
}
