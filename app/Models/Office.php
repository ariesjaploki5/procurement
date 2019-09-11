<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{

    protected $table = 'procurement.dbo.offices';

    public function office_po(){
        return $this->hasMany('App\Models\OfficePo');
    }

    public function office_pr(){
        return $this->hasMany('App\Models\OfficePr');
    }
}
