<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $primaryKey = 'purchase_order_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'supplier_id',
    ];

    public function items(){
        return $this->belongsToMany('App\Models\Item');
    }
}
