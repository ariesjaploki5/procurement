<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class HomisDrugsAndMedicinesEndUser extends Model
{
    use \Awobaz\Compoships\Compoships;

    protected $table = 'view_homis_drugs_and_medicines_end_user';
    public $timestamps = false;

    public function item_homis_link(){
        return $this->hasMany('App\Views\ItemHomisLink');
    }
}
