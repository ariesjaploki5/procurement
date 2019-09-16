<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $primaryKey = 'holiday_id';
    public $timestamps = false;

    protected $fillable = [
        'holiday_name', 'holiday_date'
    ];
}
