<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    protected $primaryKey = 'purchase_request_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'supplier_id', 'purchase_request_quantity',
    ];

    public function items(){
        return $this->belongsToMany('App\Models\Item');
    }

    public function supplier(){
        return $this->belongsTo('App\Models\Supplier');
    }
    
}
