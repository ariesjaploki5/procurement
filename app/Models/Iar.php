<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iar extends Model
{
    
    public $timestamps = false;

    protected $fillable = [
        'iar_no', 'dmd_id', 'expiry_date', 'received_quantity', 'batch_no'
    ];

    public function iar(){
        return $this->hasOne('App\Models\DmdPoReceived');
    }
}
