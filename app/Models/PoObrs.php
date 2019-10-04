<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoObrs extends Model
{
    protected $primaryKey = 'po_id';
    protected $table = 'procurement.dbo.po_obrs';
    // public $timestamps = false;

    protected $fillable = [
        'po_id', 'obrs_no', 'to_id', 'fund_cluster'
    ];

    public function po(){
        return $this->belongsTo('App\Models\PurchaseOrder'. 'po_id', 'po_id');
    }
}
