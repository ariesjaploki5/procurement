<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iar extends Model
{
    
    public $timestamps = false;

    protected $fillable = [
        'iar_no', 
        'po_id', 
        'inspector_id', 
        'officer_id', 
        'date_received', 
        'invoice_no', 
        'invoice_date',
        'officer_inspected',
        'inspector_inspected'
    ];

    public function iar(){
        return $this->hasOne('App\Models\DmdPoReceived');
    }

    public function iar_batches(){
        return $this->hasMany('App\Models\IarBatch', 'iar_no', 'iar_no');
    }
}
