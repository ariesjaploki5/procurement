<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequestRemark extends Model
{
    protected $table = 'pr_remarks';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'purchase_request_id', 'remarks', 'viewed',
    ];


    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }

    
    public function purchase_request(){
        return $this->belongsTo('App\Models\PurchaseRequest', 'purchase_request_id', 'purchase_request_id');
    }

}
