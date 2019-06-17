<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DmdUacs extends Model
{
    protected $table = 'dmd_uacs';
    public $timestamps = false;

    protected $fillable = [
        'code', 'dmd_id', 'brand_id'
    ];

    public function dmd(){
        return $this->belongsTo('App\Models\Dmd', 'dmd_id', 'dmd_id');
    }
}
