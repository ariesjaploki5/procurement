<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequestStatus extends Model
{
    protected $table = 'purchase_request_status';
    public $timestamps = false;

    protected $fillable = [
        'purchase_request_id', 'current_status_id', 'status_date_time',
    ];

    public function purchase_request(){
        return $this->belongsTo('App\Models\PurchaseRequest', 'purchase_request_id', 'purchase_request_id');
    }

    public function current_status(){
        return $this->belongsTo('App\Models\CurrentStatus', 'current_status_id', 'id');
    }

}
