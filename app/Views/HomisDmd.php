<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class HomisDmd extends Model
{

    protected $table = 'view_homis_dmds';
    public $timestamps = false;

    public function dmd_rfqs(){
        return $this->hasMany('App\Views\DmdRfq2', 'dmd_id', 'dmd_id');
    }

    public function pr(){
        return $this->hasOne('App\Views\DmdRfq2', 'dmd_id', 'dmd_id');
    }
}
