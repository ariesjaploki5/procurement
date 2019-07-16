<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MdsConsignmentDetails extends Model
{
    protected $table = 'hospital.les.medicalSuppliesConsignmentRequestDetails';

    public $fillable = [
        'crID', 'itemcode', 'itemStat', 'itemPrice', 'itemQty'
    ];

    const CREATED_AT = 'tStamp';
    const UPDATED_AT = 'tStamp';

    public function mds_consignment(){
        return $this->hasOne('App\Models\MdsConsignment', 'cl2comb', 'itemcode');
    }
}
