<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MmoStock extends Model
{
    
    protected $table = 'procurement.dbo.mmo_stocks';
    public $timestamps = false;

    protected $fillable = [
        'code', 'cost_price', 'quantity'
    ]; 

    
}
