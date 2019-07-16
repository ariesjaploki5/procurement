<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DmdRfq extends Model
{
    protected $table = 'dmd_rfq';
    public $timestamps = false;

    protected $fillable = [
        'rfq_id', 'dmd_id', 'brand_id', 'manufacturer_id', 'cost_unit', 'supplier_id',
    ];

    public function dmd(){
        return $this->belongsTo('App\Models\Dmd', 'dmd_id', 'dmd_id');
    }

    public function rfq(){
        return $this->belongsTo('App\Models\RequestForQuotation', 'rfq_id', 'rfq_id');
    }
    
    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'brand_id');
    }

    public function manufacturer(){
        return $this->belongsTo('App\Models\Manufacturer', 'manufacturer_id', 'manufacturer_id');
    }

    public function supplier(){
        return $this->belongsTo('App\Models\Supplier', 'supplier_id', 'supplier_id');
    }
}
