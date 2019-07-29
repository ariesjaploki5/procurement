<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrentStatus extends Model
{
    protected $table = 'procurement.dbo.current_status';

    public $timestamps = false;

    protected $fillable = [
        'current_status_desc',
    ];

    public function purchase_request_statuses(){
        return $this->hasMany('App\Models\PurchaseRequestStatus');
    }
}
