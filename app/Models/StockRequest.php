<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockRequest extends Model
{
    
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'quantity', 'dmd_id', 'created_at'
    ];
}
