<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticeOfAdjustment extends Model
{
    
    public $timestamps = false;

    protected $fillable = [
        'purchase_order_id',
        'adjust_ors_burs_no',
        'resp_center_to',
        'particulars_to',
        'mfo_pap_to',
        'account_code_to',
        'amount_to_p',
        'adjust_raod',
        'remarks'
    ];

    public function purchase_order(){
        return $this->belongsTo('App\Models\PurchaseOrder', 'purchase_order_id', 'purchase_order_id');
    }

}
