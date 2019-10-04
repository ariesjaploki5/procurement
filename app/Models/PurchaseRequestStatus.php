<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequestStatus extends Model
{
    protected $table = 'purchase_request_status';
    public $timestamps = false;

    protected $fillable = [
        'pr_id', 
        'current_status_id', 
        'status_date_time', 
        'remarks'
    ];

    public function purchase_request(){
        return $this->belongsTo('App\Models\PurchaseRequest', 'pr_id', 'pr_id');
    }

    public function current_status(){
        return $this->belongsTo('App\Models\CurrentStatus', 'current_status_id', 'id');
    }

}
