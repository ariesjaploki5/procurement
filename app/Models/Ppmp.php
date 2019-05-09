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
}
