<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hdmhdrsub extends Model
{
    use \Awobaz\Compoships\Compoships;
    
    protected $table = 'hospital.dbo.hdmhdrsub';
    public $timestamps = false;

    protected $fillable = [
        'dmdcomb', 'dmdctr', 'dmhdrsub', 'stockbal', 'statusMed', 'baldteasof'
    ];

}
