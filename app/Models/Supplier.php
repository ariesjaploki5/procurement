<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $primaryKey = 'supplier_id';
    public $timestamps = false;

    protected $fillable = [
        'supplier_name', 'supplier_address'
    ];
}
