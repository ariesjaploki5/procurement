<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mode extends Model
{
    protected $primaryKey = 'mode_id';
    public $timestamps = false;

    protected $fillable = [
        'mode_desc',
    ];
}
