<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DmdUacs extends Model
{
    protected $table = 'dmd_uacs';
    public $timestamps = false;

    protected $fillable = [
        'code', 'dmd_id', 'brand_id', 'stock_quantity'
    ];

    public function dmd(){
        return $this->belongsTo('App\Models\Dmd', 'dmd_id', 'dmd_id');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'brand_id');
    }

    
}
