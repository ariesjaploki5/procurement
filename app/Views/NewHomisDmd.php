<?php

namespace App\Views;

use Illuminate\Database\Eloquent\Model;

class NewHomisDmd extends Model
{
    protected $table = 'view_new_dmds';
    public $timestamps = false;

    public function new_app_dmd(){
        return $this->hasOne('App\Views\NewAppDmd', 'dmd_id', 'dmd_id');
    }
}
