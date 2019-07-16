<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class DmdRfq2 extends Model
{
    protected $table = 'view_dmd_rfq_2';
    public $timestamps = false;

    public function homis_dmd(){
        return $this->belongsTo('App\Views\HomisDmd', 'dmd_id', 'dmd_id');
    }
}
