<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ppmp extends Model
{
    protected $primaryKey = 'ppmp_id';
    public $timestamps = false;

    protected $fillable = [
        'category_id', 'ppmp_year', 'user_id', 'ppmp_submitted'
    ];

    public function items(){
        return $this->belongsToMany('App\Models\Item');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id', 'category_id');
    }

    public function dmds(){
        return $this->belongsToMany('App\Models\Dmd', 'dmd_ppmp', 'ppmp_id', 'dmd_id');
    }

    public function dmd_ppmps(){
        return $this->haMany('App\Models\DmdPpmp', 'ppmp_id', 'ppmp_id');
    }
}
