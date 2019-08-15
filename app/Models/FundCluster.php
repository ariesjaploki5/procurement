<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundCluster extends Model
{
    
    public $timestamps = false;

    protected $fillable = [
        'fund_cluster_desc', 'fund_cluster_code'
    ];
}
