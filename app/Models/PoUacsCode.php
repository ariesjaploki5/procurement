<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoUacsCode extends Model
{
    protected $primaryKey = 'po_id';
    protected $table = 'procurement.dbo.po_uacs_codes';
    // public $timestamps = false;

    protected $fillable = [
        'po_id', 'uacs_code', 'amount'
    ];

    public function po(){
        return $this->belongsTo('App\Models\PurchaseOrder'. 'po_id', 'po_id');
    }
}
