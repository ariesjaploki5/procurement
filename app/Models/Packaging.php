<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packaging extends Model
{
    protected $primaryKey = 'packaging_id';
    public $timestamps = false;

    protected $fillable = [
        'packaging_desc',
    ];
}
