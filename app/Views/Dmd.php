<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class Dmd extends Model
{
    
    protected $table = 'procurement.dbo.view_dmd_uacs';

    public function dmd_uacs(){
        return $this->hasMany('App\Views\DmdUacs', 'dmd_id', 'dmd_id');

    }
}
