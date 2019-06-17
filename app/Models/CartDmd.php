<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartDmd extends Model
{
    protected $table = 'procurement.dbo.cart_dmd';
    public $timestamps = false;

    protected $fillable = [
        'cart_id', 'dmd_id', 'request_quantity'
    ];
}
