<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class ItemHomisLink extends Model
{
    use \Awobaz\Compoships\Compoships;

    protected $table = 'view_item_homis_link';
    public $timestamps = false;

    public function end_users(){
        return $this->hasMany('App\Views\HomisDrugsAndMedicinesEndUser', ['dmdcomb', 'dmdctr'], ['dmdcomb', 'dmdctr']);
    }

    public function balance_on_hand(){
        return $this->hasOne('App\Views\HomisDrugsAndMedicinesBoh', ['dmdcomb', 'dmdctr'], ['dmdcomb', 'dmdctr']);
    }
}
