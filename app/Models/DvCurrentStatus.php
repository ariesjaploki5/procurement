<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DvCurrentStatus extends Model
{
    
    protected $table = 'dv_current_status';
    public $timestamps = false;

    protected $fillable = [
        'po_id', 'purchase_order_id', 'current_status_id'
    ];    

    
}
