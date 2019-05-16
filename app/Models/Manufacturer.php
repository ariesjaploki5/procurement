<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $primaryKey = 'manufacturer_id';
    public $timestamps = false;

    protected $fillable = [
        'manufacturer_desc',
    ];
}
