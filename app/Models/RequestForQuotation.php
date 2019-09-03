<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestForQuotation extends Model
{
    protected $primaryKey = 'rfq_id';

    public $timestamps = false;

    protected $fillable = [
        'purchase_request_id',
    ];

    public function purchase_request(){
        return $this->belongsTo('App\Models\PurchaseRequest', 'purchase_request_id', 'purchase_request_id');
    }

    public function dmd_rfqs(){
        return $this->hasMany('App\Models\DmdRfq', 'purchase_request_id', 'purchase_request_id');
    }
}
