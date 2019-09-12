<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IarBatch extends Model
{
    
    protected $table = "procurement.dbo.iar_batch";
    public  $timestamps = false;

    protected $fillable = [
        'iar_no', 'batch_no', 'received_quantity', 'expiry_date', 'dmd_id', 'remarks',
    ];

    public function iar(){
        return $this->belongsTo('App\Models\Iar', 'iar_no', 'iar_no');
    }
}
