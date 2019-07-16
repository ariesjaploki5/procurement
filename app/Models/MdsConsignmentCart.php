<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MdsConsignmentCart extends Model
{
    protected $table = 'procurement.dbo.mds_c_cart';
    public $timestamps = false;

    protected $fillable = [
        'cl2comb', 'costprc'
    ];
}
