<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pap extends Model
{
    protected $primaryKey = 'pap_id';
    public $timestamps = false;

    protected $fillable = [
        'pap_code', 'pap_desc'
    ];
}
