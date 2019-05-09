<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'hospital.dbo.hpersonal';
    protected $primaryKey = 'employeeid';
    public $incrementing = false;
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne('App/User');
    }
}
