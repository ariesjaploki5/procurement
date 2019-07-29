<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hperson extends Model
{
    protected $table = 'hospital.dbo.hperson';
    public $timestamps = false;

    public function consignment_requests(){
        return $this->hasMany('App\Models\ConsignmentRequest', 'hpercode', 'hpercode');
    }
}
