<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsignmentRequest extends Model
{
    protected $table = 'hospital.les.medicalSuppliesConsignmentRequest';

    public $fillable = [
        'crID', 'crDept', 'crSection', 'crDate', 'crStat', 'enccode', 'entryby', 'purpose', 'hpercode'
    ];

    public function details(){
        return $this->hasMany('App\Models\MdsConsignmentDetails', 'crID', 'crID');
    }

    public function hperson(){
        return $this->belongsTo('App\Models\Hperson', 'hpercode', 'hpercode');
    }

    const CREATED_AT = 'tCreated';
    const UPDATED_AT = 'tUpdated';

}
