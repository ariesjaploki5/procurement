<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'dbo.carts';
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'status', 'mode_id',
    ];

    public function dmds(){
        return $this->belongsToMany('App\Models\Dmd', 'cart_dmd', 'cart_id', 'dmd_id');
    }


}
