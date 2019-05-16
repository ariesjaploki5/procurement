<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class HomisDrugsAndMedicinesEndUser extends Model
{
    use \Awobaz\Compoships\Compoships;

    protected $table = 'view_homis_drugs_and_medicines_end_user';
    public $timestamps = false;
}
