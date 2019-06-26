<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class DmdRfq extends Model
{
    protected $table = 'view_dmd_rfq';
    public $timestamps = false;

    public function app_dmd(){
        return $this->hasOne('App/Views/AppDmd', 'dmd_id', 'dmd_id');
    }

}
