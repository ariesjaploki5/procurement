<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPpmp extends Model
{
    protected $table = 'item_ppmp';
    protected $primaryKey = 'item_ppmp_id';
    public $timestamps = false;

    protected $fillable = [
        'item_id', 'ppmp_id', 'budget', 'mode_id', 
        'jan', 'feb', 'mar', 'apr', 'may', 'june', 
        'july', 'aug', 'sept', 'oct', 'nov', 'dec'
    ];

    public function item(){
        return $this->belongsTo('App\Models\Item', 'item_id', 'item_id');
    }

    public function ppmp(){
        return $this->belongsTo('App\Models\Ppmp', 'ppmp_id', 'ppmp_id');
    }
}
