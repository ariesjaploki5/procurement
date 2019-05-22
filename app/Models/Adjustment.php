<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adjustment extends Model
{
    protected $table = 'hospital.dbo.hadjustments';
    public $timestamps = false;

    protected $fillable = [
        'itemType', 'dmdComb', 'dmdCtr', 'dmhdrsub', 
        'stockB4Adjust', 'operation', 'transQty', 'remarks',
    ];
}
