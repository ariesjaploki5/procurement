<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemHomisDrug extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'item_id', 'dmdctr', 'dmdcomb',
    ];
}
