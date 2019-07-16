<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsignmentRequest extends Model
{
    protected $table = 'hospital.les.medicalSuppliesConsignmentRequest';
    
    public $fillable = [
        'crID', 'crDept', 'crSection', 'crDate', 'crStat', 'encode', 'entryby', 'purpose'
    ];

    public function details(){
        return $this->hasMany('App\Models\MdsConsignmentDetails', 'crID', 'crID');
    }

    const CREATED_AT = 'tCreated';
    const UPDATED_AT = 'tUpdated';

}
