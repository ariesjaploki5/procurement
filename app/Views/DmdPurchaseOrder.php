<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class DmdPurchaseOrder extends Model
{
    protected $table = 'view_dmd_purchase_order';
    public $timestamps = false;

    public function dmd_po_receiveds(){

        return $this->hasMany('App\Models\DmdPoReceived', 'dmd_po_id', 'dmd_po_id');
    
    }
}
