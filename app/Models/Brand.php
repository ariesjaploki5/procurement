<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $primaryKey = 'brand_id';
    public $timestamps = false;

    protected $fillable = [
        'brand_desc',
    ];
}
