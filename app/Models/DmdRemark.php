<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DmdRemark extends Model
{
    protected $table = 'dmd_remarks';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'dmd_id', 'remarks', 'viewed',
    ];

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }

    public function dmd(){
        return $this->belongsTo('App\Views\Dmds', 'dmd_id', 'dmd_id');
    }

    public function new_dmd_homis(){
        return $this->hasOne('App\Views\NewDmdHomis', 'dmd_id', 'dmd_id');
    }
}
