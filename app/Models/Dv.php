<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dv extends Model
{
    protected $table = 'dvs';
    public $timestamps = false;

    protected $fillable = [
        'po_id', 'purchase_order_id', 'amount', 'dv_officer_id', 'dv_id'
    ];   

    public function attachments(){
        return $this->hasMany('App\Models\DvAttachment2', 'dv_id', 'dv_id');
    }
}
